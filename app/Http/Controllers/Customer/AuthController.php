<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use Carbon\Carbon;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPVerify;
use App\Services\SmsService;

class AuthController extends Controller
{
    public function __construct(protected CartHelper $cartHelper, protected SmsService $smsService)
    {
    }
    public function loginPage()
    {
        return view('customer.auth.login');
    }

    public function registerPage()
    {
        // If we have validation errors, it means a form submission failed, so show the form
        if (session('errors')) {
            return view('customer.auth.register');
        }

        // If explicitly allowing edit (coming from Change Mobile)
        if (session('allow_edit')) {
            return view('customer.auth.register');
        }

        // Check if user has a pending registration
        if (session('verification_context') == 'register' && session('pending_mobile')) {
            $mobile = session('pending_mobile');
            $cacheKey = 'pending_register_' . $mobile;
            $data = Cache::get($cacheKey);

            // 1. If Cache Missing (Expired completely) -> Clear Session & Stay on Register
            if (!$data) {
                session()->forget(['pending_mobile', 'verification_context']);
                return view('customer.auth.register');
            }

            // 2. If OTP Expired (Key exists but expires_at < now) -> Clear Session & Stay on Register
            // Note: Cache TTL usually handles removal, but checking expires_at explicitly is safer if keys persist
            if (isset($data['expires_at']) && $data['expires_at'] < now()->timestamp) {

                // Cleanup cache to avoid confusion
                Cache::forget($cacheKey);
                Cache::forget('otp_' . $mobile);
                Cache::forget('otp_expires_' . $mobile);

                session()->forget(['pending_mobile', 'verification_context']);

                return view('customer.auth.register');
            }

            // 3. If Valid -> Redirect to Verify
            return redirect()->route('customer.verify');
        }

        return view('customer.auth.register');
    }

    public function showForgotPassword()
    {
        return view('customer.auth.forgot-password');
    }

    public function editRegistration()
    {
        $mobile = session('pending_mobile');

        // If we are in the pending registration flow
        if ($mobile) {
            $cacheKey = 'pending_register_' . $mobile;
            $data = Cache::get($cacheKey);

            if ($data) {
                // DO NOT clear the pending state yet. 
                // We keep it valid in case the user goes "Back" to verify the old number.
                // It will be overwritten if they successfully register a new number.

                // Redirect to register with old input and allow_edit flag
                return redirect()->route('customer.register')
                    ->withInput($data)
                    ->with('allow_edit', true);
            }
        }

        // Fallback catch-all
        return redirect()->route('customer.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', new \App\Rules\IndianMobileNumber],
            'password' => 'required|min:8'
        ], [
            'mobile.required' => 'Mobile number is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'))
                ->with('form', 'login');
        }

        $credentials = $request->only('mobile', 'password');
        $remember = $request->has('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {
            $customer = Auth::guard('customer')->user();
            $request->session()->put('just_logged_in', true);
            $request->session()->put('customer_logged_in', true);
            $request->session()->put('is_logged_in', true);



            // Check if email is verified
            // if (!$customer->email_verified_at) {
            //     Auth::guard('customer')->logout();
            //     return redirect()->route('customer.verify')
            //         ->with([
            //             'customer_id' => $customer->id,
            //             'email' => $customer->email,
            //             'mobile' => $customer->mobile,
            //             'error' => 'Please verify your email and mobile before logging in.'
            //         ]);
            // }

            // Check if account is active
            // Check if account is active
            // if ($customer->status != 1) {
            //     Auth::guard('customer')->logout();
            //     return redirect()->back()
            //         ->withErrors(['email' => 'Your account is inactive. Please contact support.'])
            //         ->withInput($request->except('password'));
            // }

            // Update last login
            $customer->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip()
            ]);

            // Sync cart from session to database
            $this->cartHelper->syncCart();

            return redirect()->route('customer.home.index')
                ->with('success', 'Welcome back, ' . $customer->name . '!');
        }

        return redirect()->back()
            ->withErrors(['mobile' => 'Invalid mobile number or password. Please try again.'])
            ->withInput($request->except('password'))
            ->with('form', 'login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:150|unique:customers,email',
            'mobile' => ['required', 'string', 'unique:customers,mobile', new \App\Rules\IndianMobileNumber],
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
            'terms' => 'required|accepted'
        ], [
            'name.required' => 'Full name is required',
            'name.regex' => 'Name can only contain letters and spaces',
            'email.required' => 'Email address is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'mobile.required' => 'Mobile number is required',
            'mobile.unique' => 'This mobile number is already registered',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Passwords do not match',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character',
            'terms.required' => 'You must accept the terms and conditions',
            'terms.accepted' => 'You must accept the terms and conditions'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('form', 'register');
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        $mobile = trim($request->mobile);
        $expiresAt = now()->addMinutes(5);

        // Store registration data in Cache (Temporarily for 5 minutes)
        // Key: pending_register_{mobile}
        $registrationData = [
            'name' => ucwords(strtolower(trim($request->name))),
            'email' => strtolower(trim($request->email)),
            'mobile' => $mobile,
            'password' => Hash::make($request->password), // Hash it now for safety
            'otp' => $otp,
            'expires_at' => $expiresAt->timestamp,
            'attempts' => 0,
            'created_at' => now(),
        ];

        $cacheKey = 'pending_register_' . $mobile;
        Cache::put($cacheKey, $registrationData, 300); // 5 minutes

        // Also store OTP separately for quick validation if needed
        Cache::put('otp_' . $mobile, $otp, 300);
        // Store expiry for legacy/independent access if needed
        Cache::put('otp_expires_' . $mobile, $expiresAt->timestamp, 300);

        // Send OTP via SMS
        try {
            $this->smsService->sendOtp($mobile, $otp);
        } catch (\Exception $e) {
            \Log::error('OTP SMS sending failed: ' . $e->getMessage());
        }

        // Set session for the verify page identifying this as a pending registration
        session([
            'pending_mobile' => $mobile,
            'verification_context' => 'register'
        ]);

        return redirect()->route('customer.verify')
            ->with([
                'mobile' => $mobile,
                'success' => 'Please verify your mobile number to complete registration.'
            ]);
    }

    public function verifyPage()
    {
        $otpExpiresAt = null;
        $mobile = null;

        // 1. If Logged In, allow access
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            if ($customer->email_verified_at) {
                return redirect()->route('customer.home.index');
            }
            $mobile = $customer->mobile;
            if (!session()->has('mobile')) {
                session(['mobile' => $mobile]);
            }
        }
        // 2. If Pending Registration (New Flow)
        elseif (session()->has('pending_mobile') && session('verification_context') == 'register') {
            $mobile = session('pending_mobile');
            // Try pending cache first
            $cacheKey = 'pending_register_' . $mobile;
            $data = Cache::get($cacheKey);
            if ($data && isset($data['expires_at'])) {
                $otpExpiresAt = $data['expires_at'];
            }
        }
        // 3. Fallback for legacy/guest
        elseif (!session()->has('verification_key') && !session()->has('customer_id')) {
            return redirect()->route('customer.register')
                ->with('error', 'Please register first to get verification OTPs.');
        } else {
            $mobile = session('mobile');
        }

        // If not found in pending data, try general key
        if (!$otpExpiresAt && $mobile) {
            $otpExpiresAt = Cache::get('otp_expires_' . $mobile);
        }

        // Default to now + 5 mins if totally missing (fallback)
        if (!$otpExpiresAt) {
            $otpExpiresAt = now()->addMinutes(5)->timestamp;
        }

        return view('customer.auth.verify', compact('otpExpiresAt'));
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6'
        ], [
            'otp.required' => 'OTP is required',
            'otp.numeric' => 'OTP must be a number',
            'otp.digits' => 'OTP must be 6 digits'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('form', 'verify');
        }

        // Determine context
        $mobile = session('pending_mobile') ?? session('mobile');
        $isPendingRegistration = session('verification_context') == 'register';

        // === CASE 1: PENDING REGISTRATION (User not created yet) ===
        if ($isPendingRegistration && $mobile) {
            $cacheKey = 'pending_register_' . $mobile;
            $registrationData = Cache::get($cacheKey);

            if (!$registrationData) {
                return redirect()->route('customer.register')
                    ->with('error', 'Verification session expired. Please register again.');
            }

            // Verify OTP
            if ($registrationData['otp'] != $request->otp) {
                // Increment attempts could go here
                return redirect()->route('customer.verify')
                    ->withErrors(['otp' => 'Invalid OTP. Please try again.'])
                    ->withInput()
                    ->with('form', 'verify');
            }

            // SUCCESS: Create User Now
            $customer = Customer::create([
                'name' => $registrationData['name'],
                'email' => $registrationData['email'],
                'mobile' => $registrationData['mobile'],
                'password' => $registrationData['password'], // Already hashed
                'status' => 1,
                'email_verified_at' => now(), // Assume verified since they passed OTP
                'mobile_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Clear Cache & Session
            Cache::forget($cacheKey);
            Cache::forget('otp_' . $mobile);
            session()->forget(['pending_mobile', 'verification_context']);

            // Login
            Auth::guard('customer')->login($customer);

            // Send Welcome
            try {
                $this->smsService->sendWelcome($customer->mobile);
            } catch (\Exception $e) {
            }

            // Sync Cart
            $this->cartHelper->syncCart();

            return redirect()->route('customer.home.index')
                ->with('success', 'Registration and Verification successful!');
        }

        // === CASE 2: EXISTING USER VERIFICATION (Already Logged In or Legacy Session) ===

        // Get verification data from legacy session keys
        $verificationKey = session('verification_key');
        $customerId = session('customer_id');

        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $customerId = $customer->id;
            $mobile = $customer->mobile;
        }

        if (!$customerId) {
            return redirect()->route('customer.register')
                ->with('error', 'Session invalid. Please login or register.');
        }

        // Get cached OTPs
        $cachedOTP = Cache::get('otp_' . $mobile);

        // Verify
        if (!$cachedOTP || $cachedOTP != $request->otp) {
            return redirect()->route('customer.verify')
                ->withErrors(['otp' => 'Invalid OTP. Please try again.'])
                ->withInput()
                ->with('form', 'verify');
        }

        // Success for existing user
        $customer = Customer::find($customerId);
        if ($customer) {
            $customer->update([
                'email_verified_at' => now(),
                'mobile_verified_at' => now(),
                'status' => 1
            ]);

            // Clear legacy session/cache
            if ($verificationKey)
                Cache::forget($verificationKey);
            Cache::forget('otp_' . $mobile);
            session()->forget(['verification_key', 'customer_id', 'email', 'mobile']);

            // If not logged in, login
            if (!Auth::guard('customer')->check()) {
                Auth::guard('customer')->login($customer);
            }

            return redirect()->route('customer.home.index')
                ->with('success', 'Verification successful!');
        }

        return redirect()->route('customer.login')->with('error', 'User not found.');
    }

    public function resendOTP(Request $request)
    {
        // 1. Pending Registration Flow
        if (session('verification_context') == 'register' && session('pending_mobile')) {
            $mobile = session('pending_mobile');
            $cacheKey = 'pending_register_' . $mobile;
            $registrationData = Cache::get($cacheKey);

            if (!$registrationData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration session expired. Please register again.'
                ], 400);
            }

            // Generate new OTP
            $newOTP = rand(100000, 999999);
            $expiresAt = now()->addMinutes(5);

            // Update cache
            $registrationData['otp'] = $newOTP;
            $registrationData['expires_at'] = $expiresAt->timestamp;

            Cache::put($cacheKey, $registrationData, 300);
            Cache::put('otp_' . $mobile, $newOTP, 300);
            Cache::put('otp_expires_' . $mobile, $expiresAt->timestamp, 300);

            try {
                $this->smsService->sendOtp($mobile, $newOTP);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send SMS.'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'OTP resent successfully.',
                'expires_at' => $expiresAt->timestamp
            ]);
        }

        // 2. Existing Legacy Flow
        $verificationKey = session('verification_key');
        $customerId = session('customer_id');
        $mobile = session('mobile');

        if (Auth::guard('customer')->check()) {
            $mobile = Auth::guard('customer')->user()->mobile;
        }

        if (!$mobile) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired.'
            ], 400);
        }

        // Generate new OTPs
        $newOTP = rand(100000, 999999);
        $expiresAt = now()->addMinutes(5);

        // Update cache
        Cache::put('otp_' . $mobile, $newOTP, 300);
        Cache::put('otp_expires_' . $mobile, $expiresAt->timestamp, 300);

        // Use SMS Service
        try {
            $this->smsService->sendOtp($mobile, $newOTP);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send SMS.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'OTP resent successfully',
            'expires_at' => $expiresAt->timestamp
        ]);
    }



    public function changeMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'unique:customers,mobile', new \App\Rules\IndianMobileNumber]
        ], [
            'mobile.required' => 'Mobile number is required',
            'mobile.unique' => 'This mobile number is already registered'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        $customerId = session('customer_id');
        if (!$customerId) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please register again.'
            ], 400);
        }

        $customer = Customer::find($customerId);
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.'
            ], 400);
        }

        // Update mobile
        $oldMobile = $customer->mobile;
        $customer->mobile = trim($request->mobile);
        $customer->save();

        // Clear old cache
        Cache::forget('otp_' . $oldMobile);

        // Update Session
        session(['mobile' => $customer->mobile]);

        // Resend OTP to new mobile
        return $this->resendOTP($request);
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer.home.index')
            ->with('success', 'Logged out successfully.');
    }
    /*
    |--------------------------------------------------------------------------
    | PASSWORD RESET (SMS OTP)
    |--------------------------------------------------------------------------
    */
    public function sendResetOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'exists:customers,mobile', new \App\Rules\IndianMobileNumber],
        ], [
            'mobile.exists' => 'No account found with this mobile number.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mobile = $request->mobile;

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store in Cache (valid for 5 mins)
        Cache::put('reset_otp_' . $mobile, $otp, 300);

        // Also store in session for the next step UI
        session(['mobile' => $mobile]);

        // Send SMS
        try {
            $this->smsService->sendOtp($mobile, $otp);
        } catch (\Exception $e) {
            \Log::error('Password Reset OTP failed: ' . $e->getMessage());
            // For dev/testing if SMS fails, we might still want to proceed or show error
            // keeping it silent for user but logging it
        }

        return redirect()->route('customer.forgot-password.verify')
            ->with('success', 'OTP sent to your mobile number.');
    }

    public function showVerifyResetOtp()
    {
        if (!session('mobile')) {
            return redirect()->route('customer.forgot-password');
        }
        return view('customer.auth.verify-reset-otp');
    }

    public function verifyResetOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $mobile = session('mobile');
        if (!$mobile) {
            return redirect()->route('customer.forgot-password')
                ->with('error', 'Session expired. Please try again.');
        }

        $cachedOtp = Cache::get('reset_otp_' . $mobile);

        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // OTP Verified
        Cache::forget('reset_otp_' . $mobile);

        // Set a secure flag for the next step
        session(['reset_verified_mobile' => $mobile]);

        return redirect()->route('customer.reset-password');
    }

    public function showResetPassword()
    {
        if (!session('reset_verified_mobile')) {
            return redirect()->route('customer.forgot-password')
                ->with('error', 'Please verify OTP first.');
        }
        return view('customer.auth.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $mobile = session('reset_verified_mobile');

        if (!$mobile) {
            return redirect()->route('customer.forgot-password')
                ->with('error', 'Session expired. Please start over.');
        }

        $validator = Validator::make($request->all(), [
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number and one special character',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Update Password
        $customer = Customer::where('mobile', $mobile)->first();

        if ($customer) {
            $customer->password = Hash::make($request->password);
            $customer->password_changed_at = now();
            $customer->save();

            // Clean up session
            session()->forget(['mobile', 'reset_verified_mobile', 'otp']);

            return redirect()->route('customer.login')
                ->with('success', 'Password reset successful! Please login with your new password.');
        }

        return redirect()->route('customer.forgot-password')
            ->with('error', 'Account not found.');
    }
}
