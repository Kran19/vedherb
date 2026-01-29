@extends('customer.layouts.master')

@section('title', 'Change Password')

@section('content')
    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6">
        <nav class="flex text-sm text-stone-500 mb-6 sm:mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                        <iconify-icon icon="lucide:home" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm">Home</span>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <a href="{{ route('customer.account.profile') }}"
                            class="ml-1 sm:ml-2 text-xs sm:text-sm hover:text-emerald-700">My Account</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm text-stone-900 font-medium">Change Password</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Left Sidebar - Account Navigation -->
            @include('customer.account.partials.sidebar')

            <!-- Right Content Area -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 lg:p-8">
                    <div class="max-w-md mx-auto sm:mx-0">
                        <div class="mb-6 sm:mb-8">
                            <h2 class="text-xl sm:text-2xl font-bold text-stone-900 mb-2">Change Your Password</h2>
                            <p class="text-sm text-stone-600">Secure your account with a strong password. We recommend a mix
                                of letters, numbers, and symbols.</p>
                        </div>

                        <form method="POST" action="{{ route('customer.account.change-password.update') }}"
                            class="space-y-4 sm:space-y-6">
                            @csrf

                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Current
                                    Password</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 group-focus-within:text-emerald-600 transition-colors">
                                        <iconify-icon icon="lucide:shield-check" width="18"></iconify-icon>
                                    </div>
                                    <input type="password" name="current_password" required
                                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base"
                                        placeholder="••••••••">
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <hr class="border-stone-100">

                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">New Password</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 group-focus-within:text-emerald-600 transition-colors">
                                        <iconify-icon icon="lucide:lock" width="18"></iconify-icon>
                                    </div>
                                    <input type="password" name="password" required
                                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base"
                                        placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-stone-700 mb-1.5 sm:mb-2">Confirm New
                                    Password</label>
                                <div class="relative group">
                                    <div
                                        class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400 group-focus-within:text-emerald-600 transition-colors">
                                        <iconify-icon icon="lucide:lock" width="18"></iconify-icon>
                                    </div>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full pl-11 pr-4 py-2.5 sm:py-3 rounded-xl border border-stone-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition-all text-sm sm:text-base"
                                        placeholder="••••••••">
                                </div>
                            </div>

                            <div class="pt-2 sm:pt-4">
                                <button type="submit"
                                    class="w-full sm:w-auto px-8 py-3 bg-emerald-700 text-white rounded-xl font-bold hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-500/20 active:scale-[0.98] transform flex items-center justify-center gap-2">
                                    <iconify-icon icon="lucide:refresh-cw" width="18"></iconify-icon>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: '<ul style="text-align: left; padding-left: 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true
            });
        @endif
    </script>
@endsection