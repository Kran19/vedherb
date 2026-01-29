@extends('customer.layouts.master')

@section('title', 'Final Payment - ' . config('app.name'))

@section('content')
    <section class="relative bg-stone-50 py-20 overflow-hidden min-h-[70vh] flex items-center">
        <div class="max-w-4xl mx-auto px-4 relative z-10 w-full">
            <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-stone-100">
                <div class="grid grid-cols-1 md:grid-cols-2">

                    <!-- Left Column: Payment Action -->
                    <div
                        class="p-8 md:p-12 border-b md:border-b-0 md:border-r border-stone-100 flex flex-col justify-center">
                        <div class="mb-8 text-center md:text-left">
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 rounded-full mb-4">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                                </span>
                                <span class="text-[10px] font-bold text-amber-800 uppercase tracking-widest">Awaiting
                                    Payment</span>
                            </div>
                            <h1 class="text-3xl md:text-4xl font-serif text-gray-800 mb-4">Complete Your Order</h1>
                            <p class="text-gray-500 text-sm leading-relaxed">
                                You are just one step away. Please click the button below to open the secure payment
                                gateway.
                            </p>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-stone-50 p-6 rounded-2xl border border-stone-100">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-gray-400 text-xs uppercase font-bold tracking-tighter">Amount to
                                        Pay</span>
                                    <span class="text-stone-800 font-bold">₹{{ number_format($amount, 2) }}</span>
                                </div>
                                <div class="text-2xl font-serif text-stone-900">
                                    ₹{{ number_format($amount, 2) }}
                                </div>
                            </div>

                            <button id="pay-now-btn"
                                class="w-full bg-stone-800 text-white py-5 rounded-full font-bold text-lg shadow-xl hover:bg-stone-900 transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                                <i class="fas fa-lock text-stone-400"></i>
                                Pay Securely Now
                            </button>

                            <div class="flex flex-col gap-3">
                                <p class="text-[10px] text-gray-400 text-center uppercase tracking-widest leading-loose">
                                    Secure SSL Encrypted Payment <br> Powered by Razorpay
                                </p>
                                <div class="flex justify-center gap-4 grayscale opacity-40">
                                    <i class="fab fa-cc-visa text-xl"></i>
                                    <i class="fab fa-cc-mastercard text-xl"></i>
                                    <i class="fas fa-university text-xl"></i>
                                    <i class="fab fa-google-pay text-xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Summary Mini -->
                    <div class="bg-stone-50/50 p-8 md:p-12">
                        <h3 class="text-xl font-serif text-gray-800 mb-6">Order Details</h3>

                        <div class="space-y-6">
                            <!-- Order ID (Razorpay) -->
                            <div class="flex justify-between items-start border-b border-stone-100 pb-4">
                                <div class="text-xs text-gray-400 font-bold uppercase tracking-widest">Transaction ID</div>
                                <div
                                    class="text-sm font-medium text-stone-800 bg-white px-2 py-1 rounded border border-stone-100">
                                    {{ $orderId }}</div>
                            </div>

                            <!-- User Info -->
                            <div class="space-y-3">
                                <div class="text-xs text-gray-400 font-bold uppercase tracking-widest mb-1">Shipping To
                                </div>
                                <div class="text-sm text-gray-600 leading-relaxed italic">
                                    <strong
                                        class="text-gray-800 not-italic block mb-1">{{ $customer->name ?? 'Valued Customer' }}</strong>
                                    {{ $customer->email ?? '' }}<br>
                                    {{ $customer->mobile ?? '' }}
                                </div>
                            </div>

                            <!-- Footer Note -->
                            <div class="mt-12 pt-12 border-t border-stone-200">
                                <div class="flex gap-4 items-start">
                                    <div
                                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm">
                                        <i class="fas fa-headset text-stone-600"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-gray-800 uppercase tracking-tighter mb-1">Need
                                            help?</h4>
                                        <p class="text-[10px] text-gray-500 leading-relaxed">
                                            If you face any issues during the payment, please contact our support at
                                            support@vedherb.com
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('customer.checkout.index') }}"
                    class="text-stone-400 hover:text-stone-800 text-xs font-bold uppercase tracking-widest transition-all">
                    <i class="fas fa-arrow-left mr-2 font-normal"></i> Cancel & Go Back
                </a>
            </div>
        </div>
    </section>

    <!-- Razorpay Form (Hidden) -->
    <form id="razorpay-callback-form" action="{{ route('customer.checkout.payment.callback') }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="rzp-payment-id">
        <input type="hidden" name="razorpay_order_id" id="rzp-order-id">
        <input type="hidden" name="razorpay_signature" id="rzp-signature">
    </form>
@endsection

@push('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const payBtn = document.getElementById('pay-now-btn');
            const options = {
                "key": "{{ $keyId }}",
                "amount": "{{ (int) ($amount * 100) }}",
                "currency": "INR",
                "name": "{{ config('app.name') }}",
                "description": "Secure Order Payment",
                "order_id": "{{ $orderId }}",
                "handler": function (response) {
                    document.getElementById('rzp-payment-id').value = response.razorpay_payment_id;
                    document.getElementById('rzp-order-id').value = response.razorpay_order_id;
                    document.getElementById('rzp-signature').value = response.razorpay_signature;
                    document.getElementById('razorpay-callback-form').submit();
                },
                "prefill": {
                    "name": "{{ $customer->name ?? '' }}",
                    "email": "{{ $customer->email ?? '' }}",
                    "contact": "{{ $customer->mobile ?? '' }}"
                },
                "theme": {
                    "color": "#1c1917"
                },
                "modal": {
                    "ondismiss": function () {
                        console.log('Checkout form closed');
                    }
                }
            };

            const rzp = new Razorpay(options);

            payBtn.onclick = function (e) {
                rzp.open();
                e.preventDefault();
            }

            // Auto-open on load (optional, but good for UX)
            // rzp.open();
        });
    </script>
@endpush