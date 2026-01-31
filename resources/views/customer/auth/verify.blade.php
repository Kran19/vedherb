@extends('customer.layouts.master')

@section('title', 'Verify Email - Ved Herbs & Ayurveda')

@push('styles')
    <style>
        .animate-wiggle {
            animation: wiggle 0.5s ease-in-out;
        }

        @keyframes wiggle {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-3deg);
            }

            75% {
                transform: rotate(3deg);
            }
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
                        <span class="ml-2 text-stone-900 font-medium">Verify Email</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="max-w-md mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-2xl border border-stone-200 p-8 mb-8 relative overflow-hidden">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 rounded-full bg-emerald-50 opacity-50 blur-2xl">
                </div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 rounded-full bg-amber-50 opacity-50 blur-2xl">
                </div>

                <!-- Header -->
                <div class="text-center mb-8 relative">
                    <div
                        class="w-16 h-16 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-4 animate-wiggle">
                        <iconify-icon icon="lucide:shield-check" width="32" class="text-emerald-700"></iconify-icon>
                    </div>
                    <h1 class="text-2xl font-semibold text-stone-900 mb-2">OTP Verification</h1>
                    <p class="text-stone-600">Enter the verification code sent to your mobile</p>
                </div>



                <!-- Form -->
                <form id="verifyForm" class="space-y-6 relative" method="POST"
                    action="{{ route('customer.verify.submit') }}">
                    @csrf

                    <div id="inline-messages">
                        @if(session('success'))
                            <div class="p-3 mb-4 rounded-lg bg-emerald-50 text-emerald-700 text-sm font-medium text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="p-3 mb-4 rounded-lg bg-red-50 text-red-600 text-sm font-medium text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="p-3 mb-4 rounded-lg bg-red-50 text-red-600 text-sm font-medium text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif
                    </div>

                    <input type="hidden" name="verification_key" value="{{ session('verification_key') }}">

                    <!-- OTP -->
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-2">
                            Enter OTP <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <iconify-icon icon="lucide:key" width="18"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                            </iconify-icon>
                            <input type="text" name="otp" maxlength="6" required value="{{ old('otp') }}"
                                class="w-full bg-stone-50 border border-stone-300 rounded-xl pl-12 pr-4 py-3 text-center text-xl font-mono tracking-widest focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 @error('otp') border-red-500 @enderror"
                                placeholder="123456" autocomplete="off" id="emailOtpInput">
                        </div>

                        <div class="flex justify-between items-center mt-3 text-sm">
                            <span class="text-stone-500">
                                @if(session('mobile'))
                                    Sent to: <span class="font-medium text-stone-700">{{ session('mobile') }}</span>
                                @endif
                            </span>
                            @if(session('verification_context') == 'register')
                                <a href="{{ route('customer.verify.edit-registration') }}"
                                    class="text-emerald-700 hover:text-emerald-800 font-medium flex items-center gap-1 transition-colors">
                                    <iconify-icon icon="lucide:pencil" width="12"></iconify-icon>
                                    Change Mobile
                                </a>
                            @else
                                <button type="button" onclick="openChangeMobileModal()"
                                    class="text-emerald-700 hover:text-emerald-800 font-medium flex items-center gap-1 transition-colors">
                                    <iconify-icon icon="lucide:pencil" width="12"></iconify-icon>
                                    Change Mobile
                                </button>
                            @endif
                        </div>

                        @error('otp')
                            <span class="error-message text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- OTP Timer -->
                    <div class="text-center p-3 bg-stone-50 rounded-lg">
                        <p class="text-sm text-stone-600 flex items-center justify-center gap-2">
                            <iconify-icon icon="lucide:clock" width="14"></iconify-icon>
                            OTP expires in: <span id="otpTimer"
                                class="font-semibold text-emerald-700 tabular-nums">05:00</span>
                        </p>
                    </div>

                    <!-- Resend OTP -->
                    <button type="button" id="resendOtpBtn" disabled
                        class="w-full text-sm text-emerald-700 hover:text-emerald-800 disabled:text-stone-400 disabled:cursor-not-allowed font-medium transition-colors flex items-center justify-center gap-2 py-2">
                        <iconify-icon icon="lucide:refresh-cw" width="14"></iconify-icon>
                        <span id="resendText">Resend OTP (60s)</span>
                    </button>

                    <!-- Submit Button -->
                    <button type="submit" id="submit-btn"
                        class="w-full py-3 bg-emerald-900 text-white font-semibold rounded-xl hover:bg-emerald-800 transition-colors flex items-center justify-center gap-3 shadow-lg shadow-emerald-900/10">
                        <iconify-icon icon="lucide:check-circle" width="18"></iconify-icon>
                        Verify Account
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Mobile Modal -->
    <div id="changeMobileModal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-stone-900/50 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal Panel -->
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    id="modalPanel">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-emerald-100 sm:mx-0 sm:h-10 sm:w-10">
                                <iconify-icon icon="lucide:pencil" width="20" class="text-emerald-600"></iconify-icon>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg font-semibold leading-6 text-stone-900" id="modal-title">Change Mobile
                                    Number</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-stone-500 mb-4">Enter your new mobile number. We will send a new
                                        OTP to this number.</p>
                                    <form id="changeMobileForm" class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-stone-700 mb-1">New Mobile
                                                Number</label>
                                            <div class="relative">
                                                <iconify-icon icon="lucide:phone" width="16"
                                                    class="absolute left-3 top-1/2 transform -translate-y-1/2 text-stone-400"></iconify-icon>
                                                <input type="tel" id="newMobileInput" required pattern="[0-9]{10}"
                                                    maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                                    class="w-full bg-stone-50 border border-stone-300 rounded-lg pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500"
                                                    placeholder="Enter 10-digit mobile number">
                                            </div>
                                        </div>

                                        <div class="flex justify-end gap-3 pt-4">
                                            <button type="button" onclick="closeChangeMobileModal()"
                                                class="px-4 py-2 text-sm font-medium text-stone-700 bg-white border border-stone-300 rounded-lg hover:bg-stone-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">Cancel</button>
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 flex items-center gap-2">
                                                Update & Resend
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Input Formatting
            const otpInput = document.getElementById('emailOtpInput');
            if(otpInput) {
                otpInput.addEventListener('input', function (e) {
                    this.value = this.value.replace(/\D/g, '');
                    this.classList.remove('border-red-500');
                });
            }

            // Modal Logic
            const modal = document.getElementById('changeMobileModal');
            const backdrop = document.getElementById('modalBackdrop');
            const panel = document.getElementById('modalPanel');
            const newMobileInput = document.getElementById('newMobileInput');

            window.openChangeMobileModal = function () {
                modal.classList.remove('hidden');
                void modal.offsetWidth; // Trigger reflow
                backdrop.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
                newMobileInput.value = '{{ session('mobile') }}';
                setTimeout(() => newMobileInput.focus(), 100);
            }

            window.closeChangeMobileModal = function () {
                backdrop.classList.add('opacity-0');
                panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
                panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }

            // Helper to show inline message
            function showInlineMessage(type, message) {
                const container = document.getElementById('inline-messages');
                if (!container) return;
                
                const div = document.createElement('div');
                div.className = `p-3 mb-4 rounded-lg text-sm font-medium text-center ${type === 'success' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-600'}`;
                div.innerText = message;
                
                container.innerHTML = '';
                container.appendChild(div);
                setTimeout(() => div.remove(), 5000);
            }

            // Change Mobile Submit
            const changeMobileForm = document.getElementById('changeMobileForm');
            if(changeMobileForm) {
                changeMobileForm.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const mobile = newMobileInput.value;
                    const btn = this.querySelector('button[type="submit"]');
                    const originalContent = btn.innerHTML;

                    btn.disabled = true;
                    btn.innerHTML = '<iconify-icon icon="lucide:loader-2" width="16" class="animate-spin"></iconify-icon> Updating...';

                    fetch("{{ route('customer.auth.change-mobile') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ mobile: mobile })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showInlineMessage('success', 'Mobile updated and OTP resent!');
                            closeChangeMobileModal();

                            const mobileSpan = document.querySelector('.text-stone-500 span.font-medium');
                            if (mobileSpan) mobileSpan.textContent = mobile;

                            if (data.expires_at) {
                                expiryTimestamp = data.expires_at;
                            } else {
                                expiryTimestamp = Math.floor(Date.now() / 1000) + 300;
                            }
                            clearInterval(timerInterval);
                            otpTimer.classList.remove('text-red-600');
                            otpTimer.classList.add('text-emerald-700');
                            updateOTPTimer();
                            timerInterval = setInterval(updateOTPTimer, 1000);
                            
                        } else {
                            alert(data.message || 'Failed to update mobile');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    })
                    .finally(() => {
                        btn.disabled = false;
                        btn.innerHTML = originalContent;
                    });
                });
            }

            // OTP Timer Logic
            const otpTimer = document.getElementById('otpTimer');
            const resendBtn = document.getElementById('resendOtpBtn');
            const resendText = document.getElementById('resendText');
            
            // Backend expiry timestamp
            let expiryTimestamp = {{ $otpExpiresAt ?? 0 }};
            if(expiryTimestamp === 0) {
                 expiryTimestamp = Math.floor(Date.now() / 1000) + 300;
            }

            let timerInterval;

            function updateOTPTimer() {
                const now = Math.floor(Date.now() / 1000);
                let secondsLeft = expiryTimestamp - now;

                if (secondsLeft <= 0) {
                    secondsLeft = 0;
                    clearInterval(timerInterval);
                    if(otpTimer) {
                        otpTimer.textContent = "Expired";
                        otpTimer.classList.remove('text-emerald-700');
                        otpTimer.classList.add('text-red-600');
                    }
                    if(resendBtn) {
                        resendBtn.disabled = false;
                        if(resendText) resendText.textContent = 'Resend OTP';
                    }
                } else {
                    const minutes = Math.floor(secondsLeft / 60);
                    const seconds = secondsLeft % 60;
                    if(otpTimer) otpTimer.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    
                    const generatedAt = expiryTimestamp - 300;
                    const resendAvailableAt = generatedAt + 60;
                    let resendSecondsLeft = resendAvailableAt - now;
                    
                    if (resendSecondsLeft > 0) {
                        if(resendBtn) resendBtn.disabled = true;
                        if(resendText) resendText.textContent = `Resend OTP (${resendSecondsLeft}s)`;
                    } else {
                        if(secondsLeft > 0) { 
                            if(resendBtn) resendBtn.disabled = false;
                            if(resendText) resendText.textContent = 'Resend OTP';
                        }
                    }
                }
            }

            // Start Timer
            updateOTPTimer(); 
            timerInterval = setInterval(updateOTPTimer, 1000);

            // Resend Click
            if(resendBtn) {
                resendBtn.addEventListener('click', function () {
                    if (this.disabled) return;

                    this.disabled = true;
                    if(resendText) resendText.innerHTML = '<iconify-icon icon="lucide:loader-2" width="14" class="animate-spin"></iconify-icon>';

                    fetch("{{ route('customer.otp.resend') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (data.expires_at) {
                                expiryTimestamp = data.expires_at;
                            } else {
                                expiryTimestamp = Math.floor(Date.now() / 1000) + 300;
                            }
                            
                            clearInterval(timerInterval);
                            if(otpTimer) {
                                otpTimer.classList.remove('text-red-600');
                                otpTimer.classList.add('text-emerald-700');
                            }
                            updateOTPTimer();
                            timerInterval = setInterval(updateOTPTimer, 1000);

                            showInlineMessage('success', 'OTP Resent Successfully');
                        } else {
                            showInlineMessage('error', data.message || 'Failed to resend OTP');
                            updateOTPTimer(); 
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showInlineMessage('error', 'An error occurred');
                        updateOTPTimer();
                    });
                });
            }

            const verifyForm = document.getElementById('verifyForm');
            if(verifyForm) {
                verifyForm.addEventListener('submit', function () {
                    if (this.checkValidity()) {
                        const btn = document.getElementById('submit-btn');
                        if(btn) {
                            btn.disabled = true;
                            btn.innerHTML = '<iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon> Verifying...';
                        }
                    }
                });
            }
        });
    </script>
@endpush