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
                            <input type="tel" name="mobile" required value="{{ old('mobile') }}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
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
                                              
                 