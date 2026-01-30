@extends('customer.layouts.master')

@section('title', 'Login - Ved Herbs & Ayurveda')

@push('styles')
    <style>
        /* Custom styles for login page */
        #login-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .error-message {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Social login hover effects */
        button[type="button"]:hover {
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="flex text-sm text-stone-500 mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                        <iconify-icon icon="lucide:home" width="16"></iconify-icon>
                        <span class="ml-2">Home</span>
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                        <span class="ml-2 text-stone-900 font-medium">Login</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="max-w-md mx-auto">
            <!-- Login Card -->
            <div class="bg-white rounded-2xl border border-stone-200 p-8 mb-8">
                <!-- Logo & Welcome -->
                <div class="text-center mb-8">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
                        <iconify-icon icon="lucide:leaf" width="32" class="text-emerald-700"></iconify-icon>
                    </div>
                    <h1 class="text-2xl font-semibold text-stone-900 mb-2">Welcome Back</h1>
                    <p class="text-stone-600">Sign in to your account to continue your Ved Herbs & Ayurvedic journey</p>
                </div>

                <!-- Login Form -->
                <form id="login-form" class="space-y-6" method="POST" action="{{ route('customer.login.submit') }}">
                    @csrf
                    <!-- Mobile Number -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">
                            Mobile Number <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:phone" width="18"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                            </iconify-icon>
                            <input type="tel" name="mobile" value="{{ old('mobile') }}" required autocomplete="tel"
                                autofocus
                                class="w-full bg-stone-50 border border-stone-300 rounded-xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('mobile') border-red-500 @enderror"
                                placeholder="Enter your mobile number">
                            @error('mobile')
                                <span class="error-message text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-medium text-stone-700">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <a href="{{ route('customer.forgot-password') }}"
                                class="text-sm text-emerald-700 hover:text-emerald-800">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative">
                            <iconify-icon icon="lucide:lock" width="18"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                            </iconify-icon>
                            <input type="password" name="password" required autocomplete="current-password"
                                class="w-full bg-stone-50 border border-stone-300 rounded-xl pl-12 pr-12 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('password') border-red-500 @enderror"
                                placeholder="Enter your password">
                            <button type="button"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-stone-400 hover:text-stone-600"
                                id="toggle-password">
                                <iconify-icon icon="lucide:eye" width="18" id="password-icon"></iconify-icon>
                            </button>
                            @error('password')
                                <span class="error-message text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                            class="rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
                        <label for="remember" class="text-sm text-stone-700">
                            Remember me for 30 days
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="login-btn"
                        class="w-full py-3 bg-emerald-900 text-white font-semibold rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-3">
                        <iconify-icon icon="lucide:log-in" width="18"></iconify-icon>
                        Sign In
                    </button>





                    <!-- Sign Up Link -->
                    <div class="text-center pt-4">
                        <p class="text-stone-600">
                            Don't have an account?
                            <a href="{{ route('customer.register') }}"
                                class="font-semibold text-emerald-700 hover:text-emerald-800">
                                Sign up now
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Benefits -->
            <div class="mt-12">
                <h3 class="text-lg font-semibold text-stone-900 mb-6 text-center">Why Join Our Community?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="text-center p-4">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                            <iconify-icon icon="lucide:shopping-bag" width="18" class="text-emerald-700"></iconify-icon>
                        </div>
                        <p class="text-sm text-stone-700">Track orders & wishlist</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                            <iconify-icon icon="lucide:truck" width="18" class="text-emerald-700"></iconify-icon>
                        </div>
                        <p class="text-sm text-stone-700">Faster checkout</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-3">
                            <iconify-icon icon="lucide:gift" width="18" class="text-emerald-700"></iconify-icon>
                        </div>
                        <p class="text-sm text-stone-700">Exclusive offers & rewards</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Add SweetAlert for notifications -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('login-form');
            const loginBtn = document.getElementById('login-btn');
            const togglePasswordBtn = document.getElementById('toggle-password');
            const passwordInput = document.querySelector('input[name="password"]');
            const passwordIcon = document.getElementById('password-icon');

            let isPasswordVisible = false;

            // Toggle password visibility
            togglePasswordBtn.addEventListener('click', function () {
                isPasswordVisible = !isPasswordVisible;

                if (isPasswordVisible) {
                    passwordInput.type = 'text';
                    passwordIcon.setAttribute('icon', 'lucide:eye-off');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.setAttribute('icon', 'lucide:eye');
                }
            });

            // Form validation
            function validateForm() {
                let isValid = true;
                const requiredFields = loginForm.querySelectorAll('[required]');

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

                return isValid;
            }

            // Form submission
            loginForm.addEventListener('submit', function (e) {
                // Remove any existing validation errors before submitting
                const existingErrors = loginForm.querySelectorAll('.error-message');
                existingErrors.forEach(error => error.remove());

                // Laravel will handle validation via server-side
                // Show loading state
                if (loginBtn) {
                    loginBtn.disabled = true;
                    loginBtn.innerHTML = `
                        <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
                        Signing In...
                    `;
                }
            });

            // Real-time validation (optional client-side validation)
            const formInputs = loginForm.querySelectorAll('input[required]');
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