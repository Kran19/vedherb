@extends('customer.layouts.master')

@section('title', 'Sign Up - Ved Herbs & Ayurveda')

@push('styles')
<style>
.password-strength-bar {
    transition: width 0.3s ease, background-color 0.3s ease;
}

.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

#signup-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.error-message {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
    <!-- Breadcrumb -->
    <nav class="flex text-sm text-stone-500 mb-4 sm:mb-6 lg:mb-8">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                    <iconify-icon icon="lucide:home" width="16"></iconify-icon>
                    <span class="ml-1 sm:ml-2">Home</span>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                    <span class="ml-1 sm:ml-2 text-stone-900 font-medium">Sign Up</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Form Container -->
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 lg:p-8">
                <!-- Header -->
                <div class="text-center mb-6 sm:mb-8">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3 sm:mb-4">
                        <iconify-icon icon="lucide:user-plus" width="24" class="text-emerald-700"></iconify-icon>
                    </div>
                    <h1 class="text-xl sm:text-2xl font-semibold text-stone-900 mb-1 sm:mb-2">Create Account</h1>
                    <p class="text-sm sm:text-base text-stone-600">Join our Ved Herbs & Ayurvedic community today</p>
                </div>

                <!-- Form -->
                <form id="signup-form" method="POST" action="{{ route('customer.register.submit') }}" class="space-y-4 sm:space-y-6">
                    @csrf
                    
                    <!-- Name Field -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:user" width="16" class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="text" name="name" required value="{{ old('name') }}"
                                   class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('name') border-red-500 @enderror"
                                   placeholder="John Doe">
                        </div>
                        @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:mail" width="16" class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                   class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('email') border-red-500 @enderror"
                                   placeholder="john@example.com">
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mobile -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                            Mobile Number <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:phone" width="16" class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="tel" name="mobile" required value="{{ old('mobile') }}"
                                   class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('mobile') border-red-500 @enderror"
                                   placeholder="9876543210">
                        </div>
                        @error('mobile')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:lock" width="16" class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="password" name="password" id="password" required
                                   class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-10 sm:pr-12 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('password') border-red-500 @enderror"
                                   placeholder="Create a strong password">
                            <button type="button" class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600 toggle-password">
                                <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:lock" width="16" class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                   class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-10 sm:pr-12 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                   placeholder="Confirm your password">
                            <button type="button" class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600 toggle-password">
                                <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                            </button>
                        </div>
                        <p id="password-match" class="text-xs mt-1 sm:mt-2 hidden">
                            <iconify-icon icon="lucide:check" width="12" class="inline mr-1 text-emerald-600"></iconify-icon>
                            <span class="text-emerald-600">Passwords match</span>
                        </p>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-2 sm:gap-3">
                        <input type="checkbox" id="terms" name="terms" required
                               class="mt-0.5 sm:mt-1 rounded border-stone-300 text-emerald-600 focus:ring-emerald-500"
                               {{ old('terms') ? 'checked' : '' }}>
                        <label for="terms" class="text-xs sm:text-sm text-stone-700">
                            I agree to the <a href="{{ route('customer.page.terms') }}" class="text-emerald-700 hover:text-emerald-800">Terms of Service</a> and <a href="{{ route('customer.page.privacy') }}" class="text-emerald-700 hover:text-emerald-800">Privacy Policy</a>
                        </label>
                    </div>
                    @error('terms')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror

                    <!-- Submit Button -->
                    <button type="submit" id="signup-btn"
                            class="w-full py-2.5 sm:py-3 bg-emerald-900 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-2 sm:gap-3">
                        <iconify-icon icon="lucide:user-plus" width="16"></iconify-icon>
                        <span class="text-sm sm:text-base">Create Account</span>
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-stone-200"></div>
                        </div>
                        <div class="relative flex justify-center text-xs sm:text-sm">
                            <span class="px-2 sm:px-4 bg-white text-stone-500">Or sign up with</span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <button type="button" class="flex items-center justify-center gap-2 sm:gap-3 py-2.5 sm:py-3 bg-white border border-stone-300 rounded-lg sm:rounded-xl hover:bg-stone-50 transition-colors">
                            <iconify-icon icon="logos:google-icon" width="16"></iconify-icon>
                            <span class="text-xs sm:text-sm font-medium text-stone-700">Google</span>
                        </button>
                        <button type="button" class="flex items-center justify-center gap-2 sm:gap-3 py-2.5 sm:py-3 bg-white border border-stone-300 rounded-lg sm:rounded-xl hover:bg-stone-50 transition-colors">
                            <iconify-icon icon="logos:facebook" width="16"></iconify-icon>
                            <span class="text-xs sm:text-sm font-medium text-stone-700">Facebook</span>
                        </button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center pt-4">
                        <p class="text-sm sm:text-base text-stone-600">
                            Already have an account? 
                            <a href="{{ route('customer.login') }}" class="font-semibold text-emerald-700 hover:text-emerald-800">
                                Log in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signup-form');
    const signupBtn = document.getElementById('signup-btn');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordMatchText = document.getElementById('password-match');
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    
    let isPasswordVisible = false;
    
    // Toggle password visibility
    togglePasswordBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            const input = index === 0 ? passwordInput : confirmPasswordInput;
            const icon = this.querySelector('iconify-icon');
            
            isPasswordVisible = !isPasswordVisible;
            
            if (isPasswordVisible) {
                input.type = 'text';
                icon.setAttribute('icon', 'lucide:eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('icon', 'lucide:eye');
            }
        });
    });
    
    // Check password match
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (password && confirmPassword) {
            if (password === confirmPassword) {
                passwordMatchText.classList.remove('hidden');
                confirmPasswordInput.classList.remove('border-red-500');
                confirmPasswordInput.classList.add('border-emerald-500');
            } else {
                passwordMatchText.classList.add('hidden');
                confirmPasswordInput.classList.add('border-red-500');
                confirmPasswordInput.classList.remove('border-emerald-500');
            }
        } else {
            passwordMatchText.classList.add('hidden');
            confirmPasswordInput.classList.remove('border-red-500', 'border-emerald-500');
        }
    }
    
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    
    // Form submission
    signupForm.addEventListener('submit', function(e) {
        // Basic validation
        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Passwords Mismatch',
                text: 'Passwords do not match',
                confirmButtonColor: '#065f46',
            });
            return;
        }
        
        // Show loading
        signupBtn.disabled = true;
        signupBtn.innerHTML = `
            <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
            Creating Account...
        `;
    });
    
    // Show flash messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#065f46',
        });
    @endif
    
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#065f46',
        });
    @endif
});
</script>
@endpush
                                                    class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600 toggle-password">
                                                    <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                                                </button>
                                            </div>

                                        </div>

                                        <!-- Confirm Password -->
                                        <div>
                                            <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                                Confirm Password <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <iconify-icon icon="lucide:lock" width="16"
                                                    class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                                </iconify-icon>
                                                <input type="password" name="confirm_password" id="confirm_password"
                                                    required
                                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-10 sm:pr-12 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                                    placeholder="Confirm your password">
                                                <button type="button"
                                                    class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600 toggle-password">
                                                    <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                                                </button>
                                            </div>
                                            <p id="password-match" class="text-xs mt-1 sm:mt-2 hidden">
                                                <iconify-icon icon="lucide:check" width="12"
                                                    class="inline mr-1"></iconify-icon>
                                                <span>Passwords match</span>
                                            </p>
                                        </div>

                                        <!-- Phone with OTP Verification -->
                                        <div>
                                            <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                                Phone Number <span class="text-stone-500">(Optional)</span>
                                            </label>
                                            <div class="relative">
                                                <iconify-icon icon="lucide:phone" width="16"
                                                    class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                                </iconify-icon>
                                                <input type="tel" name="phone" id="phone"
                                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-28 sm:pr-32 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                                    placeholder="+1 (555) 000-0000">
                                                <button type="button" id="send-otp-btn"
                                                    class="absolute right-1.5 sm:right-2 top-1/2 transform -translate-y-1/2 text-xs sm:text-sm font-medium text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-2 sm:px-3 py-1 sm:py-1.5 rounded-md transition-colors">
                                                    Send OTP
                                                </button>
                                            </div>
                                            <p class="text-xs text-stone-500 mt-1">Add phone number for account recovery</p>
                                        </div>

                                        <!-- OTP Verification Section (Initially Hidden) -->
                                        <div id="otp-section" class="hidden space-y-3 sm:space-y-4">
                                            <div>
                                                <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                                    Enter OTP <span class="text-red-500">*</span>
                                                    <span class="text-xs font-normal text-stone-500">(Sent to your
                                                        phone)</span>
                                                </label>
                                                <div class="relative">
                                                    <iconify-icon icon="lucide:key" width="16"
                                                        class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                                    </iconify-icon>
                                                    <input type="text" name="otp" id="otp" maxlength="6"
                                                        class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                                        placeholder="Enter 6-digit OTP">
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between text-xs sm:text-sm">
                                                <div id="otp-timer" class="hidden text-stone-600">
                                                    <iconify-icon icon="lucide:clock" width="12"
                                                        class="inline mr-1"></iconify-icon>
                                                    <span id="timer">02:00</span> remaining
                                                </div>
                                                <button type="button" id="resend-otp-btn"
                                                    class="hidden text-emerald-700 hover:text-emerald-800 font-medium">
                                                    <iconify-icon icon="lucide:refresh-cw" width="12"
                                                        class="inline mr-1"></iconify-icon>
                                                    Resend OTP
                                                </button>
                                                <div id="otp-status" class="hidden">
                                                    <span class="flex items-center gap-1">
                                                        <iconify-icon icon="lucide:check" width="12"
                                                            class="text-green-600"></iconify-icon>
                                                        <span class="text-green-600 font-medium">Verified</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Terms & Conditions -->
                                        <div class="flex items-start space-x-3">
                                            <input type="checkbox" id="terms" name="terms" required
                                                class="mt-1 w-4 h-4 sm:w-5 sm:h-5 text-emerald-600 border-stone-300 rounded focus:ring-emerald-500 focus:ring-offset-0">
                                            <label for="terms" class="text-xs sm:text-sm text-stone-700">
                                                I agree to the
                                                <a href="#"
                                                    class="text-emerald-700 hover:text-emerald-800 font-medium">Terms &
                                                    Conditions</a>
                                                and
                                                <a href="#"
                                                    class="text-emerald-700 hover:text-emerald-800 font-medium">Privacy
                                                    Policy</a>
                                            </label>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" id="signup-btn"
                                            class="w-full py-2.5 sm:py-3 bg-emerald-900 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-2 sm:gap-3">
                                            <iconify-icon icon="lucide:user-plus" width="16" class="sm:w-18"></iconify-icon>
                                            <span class="text-sm sm:text-base">Create Account</span>
                                        </button>

                                        <!-- Divider -->
                                        <div class="relative">
                                            <div class="absolute inset-0 flex items-center">
                                                <div class="w-full border-t border-stone-200"></div>
                                            </div>
                                            <div class="relative flex justify-center text-xs sm:text-sm">
                                                <span class="px-2 sm:px-4 bg-white text-stone-500">Or sign up with</span>
                                            </div>
                                        </div>

                                        <!-- Social Sign Up -->
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                            <button type="button"
                                                class="flex items-center justify-center gap-2 sm:gap-3 py-2.5 sm:py-3 bg-white border border-stone-300 rounded-lg sm:rounded-xl hover:bg-stone-50 transition-colors">
                                                <iconify-icon icon="logos:google-icon" width="16"
                                                    class="sm:w-18"></iconify-icon>
                                                <span class="text-xs sm:text-sm font-medium text-stone-700">Google</span>
                                            </button>
                                            <button type="button"
                                                class="flex items-center justify-center gap-2 sm:gap-3 py-2.5 sm:py-3 bg-white border border-stone-300 rounded-lg sm:rounded-xl hover:bg-stone-50 transition-colors">
                                                <iconify-icon icon="logos:facebook" width="16"
                                                    class="sm:w-18"></iconify-icon>
                                                <span class="text-xs sm:text-sm font-medium text-stone-700">Facebook</span>
                                            </button>
                                        </div>

                                        <!-- Login Link -->
                                        <div class="text-center">
                                            <p class="text-sm sm:text-base text-stone-600">
                                                Already have an account?
                                                <a href="login.php"
                                                    class="font-semibold text-emerald-700 hover:text-emerald-800">
                                                    Log in here
                                                </a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Iconify Script -->
                    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

                    <!-- Add SweetAlert -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <!-- Sign Up Script with OTP Functionality -->
                    <script>
document.addEventListener('DOMContentLoaded', function() {
    const signupForm = document.getElementById('signup-form');
    const signupBtn = document.getElementById('signup-btn');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordMatchText = document.getElementById('password-match');
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    
    let isPasswordVisible = false;
    
    // Toggle password visibility
    togglePasswordBtns.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            const input = index === 0 ? passwordInput : confirmPasswordInput;
            const icon = this.querySelector('iconify-icon');
            
            isPasswordVisible = !isPasswordVisible;
            
            if (isPasswordVisible) {
                input.type = 'text';
                icon.setAttribute('icon', 'lucide:eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('icon', 'lucide:eye');
            }
        });
    });
    
    // Check password match
    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (password && confirmPassword) {
            if (password === confirmPassword) {
                passwordMatchText.classList.remove('hidden');
                confirmPasswordInput.classList.remove('border-red-500');
                confirmPasswordInput.classList.add('border-emerald-500');
            } else {
                passwordMatchText.classList.add('hidden');
                confirmPasswordInput.classList.add('border-red-500');
                confirmPasswordInput.classList.remove('border-emerald-500');
            }
        } else {
            passwordMatchText.classList.add('hidden');
            confirmPasswordInput.classList.remove('border-red-500', 'border-emerald-500');
        }
    }
    
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    passwordInput.addEventListener('input', checkPasswordMatch);
    
    // Form submission
    signupForm.addEventListener('submit', function(e) {
        // Basic validation
        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Passwords Mismatch',
                text: 'Passwords do not match',
                confirmButtonColor: '#065f46',
            });
            return;
        }
        
        // Show loading
        signupBtn.disabled = true;
        signupBtn.innerHTML = `
            <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
            Creating Account...
        `;
    });
    
    // Show flash messages
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#065f46',
        });
    @endif
    
    @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#065f46',
        });
    @endif
});
                                                    confirmButtonColor: '#065f46',
                                                });

                                                otpInput.focus();
                                                otpInput.select();
                                            }
                                        }, 1000);

                                        return; // Don't proceed further until OTP is verified
                                    }
                                }

                                // If no phone or OTP already verified, submit directly
                                submitForm();
                            });

                            // Function to submit form after OTP verification
                            function submitForm() {
                                const formData = new FormData(signupForm);

                                // Show loading for account creation
                                signupBtn.innerHTML = `
                <iconify-icon icon="lucide:loader-2" width="16" class="animate-spin mr-2"></iconify-icon>
                Creating Account...
            `;
                                signupBtn.disabled = true;

                                // Simulate API call
                                setTimeout(() => {
                                    // Show success message briefly, then redirect
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Account Created Successfully!',
                                        text: 'Redirecting to homepage...',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading();
                                        }
                                    }).then(() => {
                                        // Redirect to index.php
                                        window.location.href = 'index.php';
                                    });

                                    // Here you would typically submit the form to your backend
                                    // Example: 
                                    // const response = await fetch('signup-process.php', {
                                    //     method: 'POST',
                                    //     body: formData
                                    // });
                                    // if (response.ok) {
                                    //     window.location.href = 'index.php';
                                    // }

                                }, 1500);
                            }

                            // Auto-advance to form submission when OTP is complete
                            otpInput.addEventListener('input', function (e) {
                                if (this.value.length === 6 && phoneInput.value) {
                                    // Focus on Create Account button
                                    signupBtn.focus();
                                }
                            });
                        });
                    </script>

                    <style>
                        /* Add responsive styles for OTP section */
                        #otp-section {
                            transition: all 0.3s ease;
                        }

                        /* OTP input styling */
                        #otp {
                            letter-spacing: 8px;
                            font-size: 1.25rem;
                            text-align: center;
                            font-weight: 600;
                        }

                        @media (max-width: 640px) {
                            #otp {
                                letter-spacing: 6px;
                                font-size: 1.125rem;
                            }
                        }

                        /* Timer animation */
                        #otp-timer {
                            animation: pulse 2s infinite;
                        }

                        @keyframes pulse {
                            0% {
                                opacity: 1;
                            }

                            50% {
                                opacity: 0.7;
                            }

                            100% {
                                opacity: 1;
                            }
                        }

                        /* Button states */
                        #send-otp-btn:disabled {
                            opacity: 0.5;
                            cursor: not-allowed;
                        }

                        /* Success state */
                        .verified {
                            border-color: #10b981 !important;
                            background-color: #f0fdf4 !important;
                        }

                        /* Loading spinner */
                        .animate-spin {
                            animation: spin 1s linear infinite;
                        }

                        @keyframes spin {
                            from {
                                transform: rotate(0deg);
                            }

                            to {
                                transform: rotate(360deg);
                            }
                        }

                        /* Responsive adjustments */
                        @media (max-width: 640px) {
                            #phone {
                                padding-right: 100px;
                            }

                            #send-otp-btn {
                                font-size: 11px;
                                padding: 4px 8px;
                            }
                        }

                        /* Improve touch targets */
                        @media (max-width: 640px) {

                            #send-otp-btn,
                            #resend-otp-btn {
                                min-height: 40px;
                            }
                        }

                        /* Highlight OTP input when focused */
                        #otp:focus {
                            background-color: #f9fafb;
                            border-color: #10b981;
                            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
                        }

                        /* Smooth transitions */
                        #signup-btn {
                            transition: all 0.3s ease;
                        }

                        /* Verified status animation */
                        #otp-status {
                            animation: slideIn 0.3s ease-out;
                        }

                        @keyframes slideIn {
                            from {
                                opacity: 0;
                                transform: translateY(-5px);
                            }

                            to {
                                opacity: 1;
                                transform: translateY(0);
                            }
                        }
                    </style>
                    

                                        @section('content')
                    
                   
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-stone-900 font-medium">Sign Up</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Center the form container -->
        <div class="flex justify-center">
            <div class="w-full max-w-lg">
                <!-- Sign Up Form -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 lg:p-8">
                    <!-- Header -->
                    <div class="text-center mb-6 sm:mb-8">
                        <div
                            class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3 sm:mb-4">
                            <iconify-icon icon="lucide:user-plus" width="24"
                                class="sm:w-32 text-emerald-700"></iconify-icon>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-semibold text-stone-900 mb-1 sm:mb-2">Create Account</h1>
                        <p class="text-sm sm:text-base text-stone-600">Join our Ved Herbs & Ayurvedic community today</p>
                    </div>

                    <!-- Sign Up Form -->
                    <form id="signup-form" method="POST" class="space-y-4 sm:space-y-6">
                        @csrf

                        <!-- Name Fields -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <iconify-icon icon="lucide:user" width="16"
                                        class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                    </iconify-icon>
                                    <input type="text" name="first_name" id="first_name" required
                                        value="{{ old('first_name') }}"
                                        class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('first_name') border-red-500 @enderror"
                                        placeholder="John">
                                </div>
                                @error('first_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <iconify-icon icon="lucide:user" width="16"
                                        class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                    </iconify-icon>
                                    <input type="text" name="last_name" id="last_name" required
                                        value="{{ old('last_name') }}"
                                        class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('last_name') border-red-500 @enderror"
                                        placeholder="Doe">
                                </div>
                                @error('last_name')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <iconify-icon icon="lucide:mail" width="16"
                                    class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                </iconify-icon>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('email') border-red-500 @enderror"
                                    placeholder="john@example.com">
                            </div>
                            @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <iconify-icon icon="lucide:lock" width="16"
                                    class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                </iconify-icon>
                                <input type="password" name="password" id="password" required
                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-10 sm:pr-12 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('password') border-red-500 @enderror"
                                    placeholder="Create a strong password">
                                <button type="button"
                                    class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600 toggle-password">
                                    <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                                </button>
                            </div>
                            @error('password')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror

                            <!-- Password Strength Indicator -->
                            <div class="mt-1 sm:mt-2">
                                <div class="flex items-center gap-1 sm:gap-2 mb-1">
                                    <div class="flex-1 h-1 bg-stone-200 rounded-full overflow-hidden">
                                        <div id="password-strength" class="h-full bg-red-500 w-0"></div>
                                    </div>
                                    <span id="strength-text" class="text-xs text-stone-500">Weak</span>
                                </div>
                                <p class="text-xs text-stone-500">Use 8+ characters with letters, numbers & symbols</p>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <iconify-icon icon="lucide:lock" width="16"
                                    class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                </iconify-icon>
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-10 sm:pr-12 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                    placeholder="Confirm your password">
                                <button type="button"
                                    class="absolute right-3 sm:right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600 toggle-password">
                                    <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                                </button>
                            </div>
                            <p id="password-match" class="text-xs mt-1 sm:mt-2 hidden">
                                <iconify-icon icon="lucide:check" width="12"
                                    class="inline mr-1 text-emerald-600"></iconify-icon>
                                <span class="text-emerald-600">Passwords match</span>
                            </p>
                        </div>

                        <!-- Phone (Optional) -->
                        <div>
                            <label class="block text-sm font-medium text-stone-700 mb-1 sm:mb-2">
                                Phone Number <span class="text-stone-500">(Optional)</span>
                            </label>
                            <div class="relative">
                                <iconify-icon icon="lucide:phone" width="16"
                                    class="absolute left-3 sm:left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                                </iconify-icon>
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg sm:rounded-xl pl-10 sm:pl-12 pr-3 sm:pr-4 py-2.5 sm:py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                    placeholder="+91 9876543210">
                            </div>
                            @error('phone')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Terms -->
                        <div class="flex items-start gap-2 sm:gap-3">
                            <input type="checkbox" id="terms" name="terms" required
                                class="mt-0.5 sm:mt-1 rounded border-stone-300 text-emerald-600 focus:ring-emerald-500" {{ old('terms') ? 'checked' : '' }}>
                            <label for="terms" class="text-xs sm:text-sm text-stone-700">
                                I agree to the <a href="{{ route('customer.page.terms') }}"
                                    class="text-emerald-700 hover:text-emerald-800">Terms of Service</a> and <a
                                    href="{{ route('customer.page.privacy') }}"
                                    class="text-emerald-700 hover:text-emerald-800">Privacy Policy</a>
                            </label>
                        </div>
                        @error('terms')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror

                        <!-- Submit Button -->
                        <button type="submit" id="signup-btn"
                            class="w-full py-2.5 sm:py-3 bg-emerald-900 text-white font-semibold rounded-lg sm:rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-2 sm:gap-3">
                            <iconify-icon icon="lucide:user-plus" width="16" class="sm:w-18"></iconify-icon>
                            <span class="text-sm sm:text-base">Create Account</span>
                        </button>

                        <!-- Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-stone-200"></div>
                            </div>
                            <div class="relative flex justify-center text-xs sm:text-sm">
                                <span class="px-2 sm:px-4 bg-white text-stone-500">Or sign up with</span>
                            </div>
                        </div>

                        <!-- Social Sign Up -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            {{-- <a href="{{ route('social.login', ['provider' => 'google']) }}" --}} <a
                                class="flex items-center justify-center gap-2 sm:gap-3 py-2.5 sm:py-3 bg-white border border-stone-300 rounded-lg sm:rounded-xl hover:bg-stone-50 transition-colors">
                                <iconify-icon icon="logos:google-icon" width="16" class="sm:w-18"></iconify-icon>
                                <span class="text-xs sm:text-sm font-medium text-stone-700">Google</span>
                            </a>
                            {{-- <a href="{{ route('social.login', ['provider' => 'facebook']) }}" --}} <a
                                class="flex items-center justify-center gap-2 sm:gap-3 py-2.5 sm:py-3 bg-white border border-stone-300 rounded-lg sm:rounded-xl hover:bg-stone-50 transition-colors">
                                <iconify-icon icon="logos:facebook" width="16" class="sm:w-18"></iconify-icon>
                                <span class="text-xs sm:text-sm font-medium text-stone-700">Facebook</span>
                            </a>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center pt-4">
                            <p class="text-sm sm:text-base text-stone-600">
                                Already have an account?
                                <a href="{{ route('customer.login') }}"
                                    class="font-semibold text-emerald-700 hover:text-emerald-800">
                                    Log in here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Responsive styles for signup page */
        #signup-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        input:checked+label {
            border-color: #10b981;
            background-color: #ecfdf5;
        }

        /* Smooth animations */
        .password-strength-bar {
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        /* Social login hover effects */
        button[type="button"]:hover,
        a:hover {
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }

        /* Error animations */
        .error-message {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading spinner animation */
        .animate-spin {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .grid-cols-3 {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        /* Ensure icons scale properly on mobile */
        iconify-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Improve touch targets on mobile */
        @media (max-width: 640px) {

            input,
            button,
            a,
            label {
                min-height: 44px;
                /* Apple's recommended minimum touch target */
            }

            .toggle-password {
                min-height: auto;
                padding: 8px;
            }
        }

        /* Centering styles */
        .max-w-lg {
            max-width: 32rem;
            /* 512px */
        }

        @media (min-width: 768px) {
            .max-w-lg {
                max-width: 36rem;
                /* 576px */
            }
        }

        @media (min-width: 1024px) {
            .max-w-lg {
                max-width: 40rem;
                /* 640px */
            }
        }
    </style>
@endpush

@push('scripts')
    <!-- Add SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const signupForm = document.getElementById('signup-form');
            const signupBtn = document.getElementById('signup-btn');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const passwordMatchText = document.getElementById('password-match');
            const passwordStrengthBar = document.getElementById('password-strength');
            const strengthText = document.getElementById('strength-text');
            const togglePasswordBtns = document.querySelectorAll('.toggle-password');

            let isPasswordVisible = false;

            // Toggle password visibility for all password fields
            togglePasswordBtns.forEach((btn, index) => {
                btn.addEventListener('click', function () {
                    const input = index === 0 ? passwordInput : confirmPasswordInput;
                    const icon = this.querySelector('iconify-icon');

                    isPasswordVisible = !isPasswordVisible;

                    if (isPasswordVisible) {
                        input.type = 'text';
                        icon.setAttribute('icon', 'lucide:eye-off');
                    } else {
                        input.type = 'password';
                        icon.setAttribute('icon', 'lucide:eye');
                    }
                });
            });

            // Password strength checker
            function checkPasswordStrength(password) {
                let strength = 0;

                // Length check
                if (password.length >= 8) strength++;
                if (password.length >= 12) strength++;

                // Complexity checks
                if (/[A-Z]/.test(password)) strength++;
                if (/[0-9]/.test(password)) strength++;
                if (/[^A-Za-z0-9]/.test(password)) strength++;

                return strength;
            }

            function updatePasswordStrength() {
                const password = passwordInput.value;
                const strength = checkPasswordStrength(password);

                // Update strength bar
                const width = (strength / 5) * 100;
                passwordStrengthBar.style.width = `${width}%`;

                // Update color and text
                if (strength <= 1) {
                    passwordStrengthBar.style.backgroundColor = '#ef4444';
                    strengthText.textContent = 'Weak';
                    strengthText.style.color = '#ef4444';
                } else if (strength <= 3) {
                    passwordStrengthBar.style.backgroundColor = '#f59e0b';
                    strengthText.textContent = 'Fair';
                    strengthText.style.color = '#f59e0b';
                } else {
                    passwordStrengthBar.style.backgroundColor = '#10b981';
                    strengthText.textContent = 'Strong';
                    strengthText.style.color = '#10b981';
                }

                // Check password match
                checkPasswordMatch();
            }

            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password && confirmPassword) {
                    if (password === confirmPassword) {
                        passwordMatchText.classList.remove('hidden');
                        passwordMatchText.classList.add('text-emerald-600');
                        confirmPasswordInput.classList.remove('border-red-500');
                        confirmPasswordInput.classList.add('border-emerald-500');
                    } else {
                        passwordMatchText.classList.add('hidden');
                        confirmPasswordInput.classList.add('border-red-500');
                        confirmPasswordInput.classList.remove('border-emerald-500');
                    }
                } else {
                    passwordMatchText.classList.add('hidden');
                    confirmPasswordInput.classList.remove('border-red-500', 'border-emerald-500');
                }
            }

            // Event listeners for password validation
            passwordInput.addEventListener('input', updatePasswordStrength);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Form validation
            function validateForm() {
                let isValid = true;
                const requiredFields = signupForm.querySelectorAll('[required]');

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');

                        // Add error message
                        let errorSpan = field.nextElementSibling;
                        if (!errorSpan || !errorSpan.classList.contains('error-message')) {
                            errorSpan = document.createElement('span');
                            errorSpan.className = 'error-message text-red-500 text-xs mt-1 block';
                            errorSpan.textContent = 'This field is required';
                            field.parentNode.appendChild(errorSpan);
                        }
                    } else {
                        field.classList.remove('border-red-500');

                        // Remove error message
                        const errorSpan = field.nextElementSibling;
                        if (errorSpan && errorSpan.classList.contains('error-message')) {
                            errorSpan.remove();
                        }
                    }
                });

                // Check password match
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                if (password && confirmPassword && password !== confirmPassword) {
                    isValid = false;
                    confirmPasswordInput.classList.add('border-red-500');

                    // Show error message
                    const errorSpan = confirmPasswordInput.nextElementSibling;
                    if (errorSpan && errorSpan.classList.contains('error-message')) {
                        errorSpan.textContent = 'Passwords do not match';
                    }
                }

                return isValid;
            }

            // Form submission
            signupForm.addEventListener('submit', function (e) {
                // Client-side validation
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }

                // Disable button and show loading
                signupBtn.disabled = true;
                signupBtn.innerHTML = `
                <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
                Creating Account...
            `;
            });

            // Real-time validation
            const formInputs = signupForm.querySelectorAll('input[required]');
            formInputs.forEach(input => {
                input.addEventListener('blur', function () {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('border-red-500');
                    } else {
                        this.classList.remove('border-red-500');
                        const errorSpan = this.nextElementSibling;
                        if (errorSpan && errorSpan.classList.contains('error-message')) {
                            errorSpan.remove();
                        }
                    }
                });

                input.addEventListener('input', function () {
                    this.classList.remove('border-red-500');
                    const errorSpan = this.nextElementSibling;
                    if (errorSpan && errorSpan.classList.contains('error-message')) {
                        errorSpan.remove();
                    }
                });
            });

            // Show flash messages if any
            @if(session('status'))
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: '{{ session('status') }}'
                });
            @endif

                @if(session('success'))
                    const SuccessToast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    SuccessToast.fire({
                        icon: 'success',
                        title: '{{ session('success') }}'
                    });
                @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    const ErrorToast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    ErrorToast.fire({
                        icon: 'error',
                        title: '{{ $error }}'
                    });
                @endforeach
            @endif
    });
    </script>
@endpush