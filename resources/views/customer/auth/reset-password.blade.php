@extends('customer.layouts.master')

@section('title', 'Reset Password - Ved Herbs & Ayurveda')

@section('content')
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
                        <span class="ml-2">Reset Password</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl border border-stone-200 p-8 mb-8">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4">
                        <iconify-icon icon="lucide:lock-keyhole" width="32" class="text-emerald-700"></iconify-icon>
                    </div>
                    <h1 class="text-2xl font-semibold text-stone-900 mb-2">Set New Password</h1>
                    <p class="text-stone-600">Please enter your new password below.</p>
                </div>

                <form id="reset-password-form" class="space-y-6" method="POST"
                    action="{{ route('customer.reset-password.submit') }}">
                    @csrf

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">New Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <iconify-icon icon="lucide:lock" width="18"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="password" name="password" required
                                class="w-full bg-stone-50 border border-stone-300 rounded-xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('password') border-red-500 @enderror"
                                placeholder="Min 8 chars, 1 uppercase, 1 symbol">
                            @error('password')
                                <span class="error-message text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">Confirm Password <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <iconify-icon icon="lucide:lock" width="18"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                            <input type="password" name="password_confirmation" required
                                class="w-full bg-stone-50 border border-stone-300 rounded-xl pl-12 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                placeholder="Confirm new password">
                        </div>
                    </div>

                    <button type="submit" id="submit-btn"
                        class="w-full py-3 bg-emerald-900 text-white font-semibold rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-3">
                        <iconify-icon icon="lucide:save" width="18"></iconify-icon>
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('reset-password-form');
            const submitBtn = document.getElementById('submit-btn');

            form.addEventListener('submit', function (e) {
                if (form.checkValidity()) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                    <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
                    Processing...
                `;
                }
            });

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