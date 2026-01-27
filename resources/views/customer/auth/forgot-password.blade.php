@extends('customer.layouts.master')

@section('title', 'Forgot Password - Ved Herbs & Ayurveda')

@push('styles')
<style>
    .error-message {
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
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
            <li>
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                    <span class="ml-2">Login</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                    <span class="ml-2 text-stone-900 font-medium">Forgot Password</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="max-w-md mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-2xl border border-stone-200 p-8 mb-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
                    <iconify-icon icon="lucide:key-round" width="32" class="text-emerald-700"></iconify-icon>
                </div>
                <h1 class="text-2xl font-semibold text-stone-900 mb-2">Reset Password</h1>
                <p class="text-stone-600">Enter your email address and we'll send you instructions to reset your password.</p>
            </div>

            <!-- Form -->
            <form id="forgot-password-form" class="space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-stone-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <iconify-icon icon="lucide:mail" 
                                     width="18" 
                                     class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                        </iconify-icon>
                        <input type="email" 
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               autofocus
                               class="w-full bg-stone-50 border border-stone-300 rounded-xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('email') border-red-500 @enderror"
                               placeholder="Enter your email">
                        @error('email')
                            <span class="error-message text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        id="submit-btn"
                        class="w-full py-3 bg-emerald-900 text-white font-semibold rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-3">
                    <iconify-icon icon="lucide:send" width="18"></iconify-icon>
                    Send Reset Link
                </button>

                <!-- Back to Login -->
                <div class="text-center pt-4">
                    <a href="{{ route('customer.login') }}" class="font-medium text-emerald-700 hover:text-emerald-800 flex items-center justify-center gap-2">
                        <iconify-icon icon="lucide:arrow-left" width="16"></iconify-icon>
                        Back to Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('forgot-password-form');
    const submitBtn = document.getElementById('submit-btn');

    form.addEventListener('submit', function(e) {
        if (form.checkValidity()) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
                Sending...
            `;
        }
    });

    @if(session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Email Sent',
            text: '{{ session('status') }}',
            confirmButtonColor: '#065f46',
        });
    @endif
    
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
            title: 'Error',
            text: '{{ $errors->first() }}',
            confirmButtonColor: '#065f46',
        });
    @endif
});
</script>
@endpush
