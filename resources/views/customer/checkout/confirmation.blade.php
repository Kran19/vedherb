@extends('customer.layouts.master')

@section('title', 'Order Confirmed - ' . config('app.name'))

@section('content')
    <section class="relative bg-stone-50 py-20 overflow-hidden min-h-[80vh] flex items-center">
        <!-- Background Decor -->
        <div class="absolute top-0 left-0 w-full h-1/2 bg-white skew-y-3 -translate-y-1/2 pointer-events-none"></div>

        <div class="max-w-4xl mx-auto px-4 relative z-10 w-full">
            <div class="text-center mb-12">
                <div
                    class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm border border-green-100">
                    <i class="fas fa-check text-green-600 text-3xl"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-serif text-gray-800 mb-4">Your Order is Placed!</h1>
                <p class="text-gray-500 text-lg">Thank you for choosing VedHerb. Your wellness journey begins here.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-stone-100 mb-8">
                <div class="p-8 md:p-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                        <!-- Order Details -->
                        <div>
                            <h3 class="text-xl font-serif text-gray-800 mb-6 border-b border-stone-100 pb-4">Order Summary
                            </h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Order
                                        Number</span>
                                    <span class="text-sm font-medium text-stone-800">#{{ $order->order_number }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400 font-bold uppercase tracking-widest">Date</span>
                                    <span
                                        class="text-sm font-medium text-stone-800">{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-lg pt-4 border-t border-stone-100">
                                    <span class="font-serif text-gray-800">Total Paid</span>
                                    <span
                                        class="font-bold text-stone-800">₹{{ number_format($order->grand_total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Next Steps -->
                        <div class="bg-stone-50 rounded-3xl p-6 md:p-8">
                            <h3 class="text-lg font-serif text-gray-800 mb-4">What's Next?</h3>
                            <ul class="space-y-4">
                                <li class="flex gap-4">
                                    <div
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm">
                                        <i class="fas fa-envelope text-stone-400 text-xs"></i>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Confirming email sent to
                                        <strong>{{ $order->shipping_address['email'] ?? 'your email' }}</strong>.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm">
                                        <i class="fas fa-box-open text-stone-400 text-xs"></i>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Items will be dispatched within 24-48 hours. Tracking details will follow.
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <div
                                        class="w-8 h-8 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm">
                                        <i class="fas fa-headset text-stone-400 text-xs"></i>
                                    </div>
                                    <p class="text-xs text-gray-600 leading-relaxed">
                                        Need to change something? Contact us at support@vedherb.com
                                    </p>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="p-8 md:p-12 bg-stone-50/50 border-t border-stone-100 text-center">
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <a href="{{ route('customer.account.orders') }}"
                            class="bg-stone-800 text-white px-8 py-4 rounded-full font-bold text-sm shadow-lg hover:bg-stone-900 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-history text-stone-400"></i>
                            View Order History
                        </a>
                        <a href="{{ route('customer.products.shop') }}"
                            class="bg-white border border-stone-200 text-stone-800 px-8 py-4 rounded-full font-bold text-sm hover:bg-stone-50 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-bag text-stone-400"></i>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

            <p class="text-center text-[10px] text-gray-400 uppercase tracking-[0.2em] font-bold">
                A Confirmation Receipt Has Been Emailed To You
            </p>
        </div>
    </section>
@endsection