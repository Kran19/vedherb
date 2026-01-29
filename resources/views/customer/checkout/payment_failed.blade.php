@extends('customer.layouts.master')

@section('title', 'Payment Failed - ' . config('app.name'))

@section('content')
    <section class="relative bg-stone-50 py-20 overflow-hidden min-h-[70vh] flex items-center">
        <div class="max-w-xl mx-auto px-4 relative z-10 w-full">
            <div
                class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-stone-100 p-8 md:p-12 text-center">
                <div
                    class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-red-100">
                    <i class="fas fa-times text-red-600 text-2xl"></i>
                </div>

                <h1 class="text-3xl font-serif text-gray-800 mb-4">Payment Unsuccessful</h1>
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    We're sorry, but the payment transaction could not be completed. Your order has not been placed.
                </p>

                <div class="bg-red-50/50 rounded-2xl p-6 border border-red-100 text-left mb-8">
                    <h3 class="text-xs font-bold text-red-800 uppercase tracking-widest mb-3">Possible Reasons:</h3>
                    <ul class="space-y-2">
                        <li class="flex gap-3 text-xs text-red-700/80">
                            <i class="fas fa-dot-circle mt-0.5 text-[8px]"></i>
                            Insufficient funds in your account.
                        </li>
                        <li class="flex gap-3 text-xs text-red-700/80">
                            <i class="fas fa-dot-circle mt-0.5 text-[8px]"></i>
                            Transaction timed out or was cancelled.
                        </li>
                        <li class="flex gap-3 text-xs text-red-700/80">
                            <i class="fas fa-dot-circle mt-0.5 text-[8px]"></i>
                            Authentication was failed by your bank.
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col gap-4">
                    <a href="{{ route('customer.checkout.index') }}"
                        class="bg-stone-800 text-white py-4 rounded-full font-bold text-sm shadow-lg hover:bg-stone-900 transition-all">
                        Try Checkout Again
                    </a>
                    <a href="{{ route('customer.cart') }}"
                        class="text-stone-400 hover:text-stone-800 text-xs font-bold uppercase tracking-widest transition-all">
                        Review Your Cart
                    </a>
                </div>
            </div>

            <p class="text-center mt-8 text-[10px] text-gray-400 uppercase tracking-widest leading-loose">
                Need help? Contact support@vedherb.com
            </p>
        </div>
    </section>
@endsection