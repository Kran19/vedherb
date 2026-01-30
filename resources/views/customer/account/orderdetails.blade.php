@extends('customer.layouts.master')

@section('title', 'Order Details')

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
                <li>
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <a href="{{ route('customer.account.orders') }}"
                            class="ml-1 sm:ml-2 text-xs sm:text-sm hover:text-emerald-700">My Orders</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm text-stone-900 font-medium">Order
                            #{{ $order->order_number }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Left Sidebar - Account Navigation -->
            @include('customer.account.partials.sidebar')

            <!-- Right Content Area -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Header Card -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 shadow-sm">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6 pb-6 border-b border-stone-100">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h1 class="text-xl sm:text-2xl font-bold text-stone-900">Order #{{ $order->order_number }}
                                </h1>
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                        'processing' => 'bg-amber-100 text-amber-800',
                                        'shipped' => 'bg-indigo-100 text-indigo-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        'refunded' => 'bg-purple-100 text-purple-800',
                                        'returned' => 'bg-pink-100 text-pink-800',
                                    ];
                                    $statusClass = $statusClasses[$order->status] ?? 'bg-stone-100 text-stone-800';
                                @endphp
                                <span
                                    class="px-2.5 py-0.5 rounded-full {{ $statusClass }} text-[10px] sm:text-xs font-bold uppercase tracking-wider">
                                    {{ $order->status }}
                                </span>
                            </div>
                            <p class="text-xs sm:text-sm text-stone-500">Placed on
                                {{ $order->created_at->format('d M, Y \a\t h:i A') }}
                            </p>
                        </div>
                        <div class="text-left sm:text-right">
                            <p class="text-2xl sm:text-3xl font-black text-emerald-700">
                                ₹{{ number_format($order->grand_total, 2) }}</p>
                            <p class="text-[10px] sm:text-xs text-stone-400 font-bold uppercase tracking-widest mt-1">Total
                                Amount</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <h3
                                class="text-sm font-bold text-stone-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <iconify-icon icon="lucide:info" class="text-emerald-600"></iconify-icon>
                                Order Info
                            </h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-stone-500">Payment:</span>
                                    <span class="font-semibold text-stone-900">{{ ucfirst($order->payment_method) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-stone-500">P. Status:</span>
                                    <span
                                        class="font-bold {{ $order->payment_status == 'paid' ? 'text-green-600' : 'text-red-500' }}">{{ strtoupper($order->payment_status) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-stone-500">Shipping:</span>
                                    <span class="font-semibold text-stone-900">{{ ucfirst($order->shipping_method) }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3
                                class="text-sm font-bold text-stone-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                                <iconify-icon icon="lucide:map-pin" class="text-emerald-600"></iconify-icon>
                                Shipping Address
                            </h3>
                            <div
                                class="text-sm text-stone-600 leading-relaxed bg-stone-50 rounded-xl p-4 border border-stone-100">
                                <p class="font-bold text-stone-900 mb-1">{{ $shippingAddress['name'] ?? 'N/A' }}</p>
                                <p>{{ $shippingAddress['address'] ?? 'N/A' }}</p>
                                <p>{{ $shippingAddress['city'] ?? 'N/A' }}, {{ $shippingAddress['state'] ?? 'N/A' }}
                                    {{ $shippingAddress['pincode'] ?? '' }}
                                </p>
                                <div class="mt-2 text-stone-900 font-semibold flex items-center gap-2">
                                    <iconify-icon icon="lucide:phone" width="14"></iconify-icon>
                                    {{ $shippingAddress['mobile'] ?? ($shippingAddress['phone'] ?? 'N/A') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items Card -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 shadow-sm">
                    <h3 class="text-sm font-bold text-stone-900 uppercase tracking-wider mb-6 flex items-center gap-2">
                        <iconify-icon icon="lucide:shopping-bag" class="text-emerald-600"></iconify-icon>
                        Order Items ({{ $order->items->count() }})
                    </h3>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div
                                class="flex gap-4 p-3 sm:p-4 rounded-xl border border-stone-100 hover:border-emerald-200 transition-colors">
                                <div
                                    class="w-16 h-16 sm:w-20 sm:h-20 bg-stone-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <iconify-icon icon="lucide:package" width="24" class="text-stone-300"></iconify-icon>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-stone-900 text-sm sm:text-base truncate">{{ $item->product_name }}
                                    </h4>
                                    <p class="text-xs text-stone-500 mb-2">Qty: {{ $item->quantity }} ×
                                        ₹{{ number_format($item->unit_price, 2) }}</p>
                                    @if($item->attributes)
                                        @php $atts = json_decode($item->attributes, true); @endphp
                                        @if(is_array($atts))
                                            <div class="flex flex-wrap gap-1.5">
                                                @foreach($atts as $k => $v)
                                                    <span
                                                        class="px-1.5 py-0.5 bg-stone-100 text-stone-600 text-[10px] font-bold rounded uppercase">{{ $k }}:
                                                        {{ $v }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-stone-900 text-sm sm:text-base">
                                        ₹{{ number_format($item->total, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary Calculation -->
                    <div class="mt-8 border-t border-stone-100 pt-6 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500">Subtotal</span>
                            <span class="font-semibold text-stone-900">₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->tax_total > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-stone-500">Tax</span>
                                <span class="font-semibold text-stone-900">₹{{ number_format($order->tax_total, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-sm">
                            <span class="text-stone-500">Shipping</span>
                            <span class="font-semibold text-stone-900">
                                @if($order->shipping_total > 0)
                                    ₹{{ number_format($order->shipping_total, 2) }}
                                @else
                                    <span class="text-emerald-600">FREE</span>
                                @endif
                            </span>
                        </div>
                        @if($order->discount_total > 0)
                            <div class="flex justify-between text-sm text-green-600">
                                <span>Discount</span>
                                <span class="font-bold">-₹{{ number_format($order->discount_total, 2) }}</span>
                            </div>
                        @endif
                        <div
                            class="flex justify-between text-lg font-black text-stone-900 pt-3 border-t border-dashed border-stone-200">
                            <span>Total</span>
                            <span class="text-emerald-700">₹{{ number_format($order->grand_total, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Timeline & Actions Block -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Timeline -->
                    <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 shadow-sm">
                        <h3 class="text-sm font-bold text-stone-900 uppercase tracking-wider mb-6 flex items-center gap-2">
                            <iconify-icon icon="lucide:clock" class="text-emerald-600"></iconify-icon>
                            Order Timeline
                        </h3>
                        <div class="space-y-6 relative">
                            @php
                                $timelineMap = [
                                    'pending' => ['icon' => 'lucide:clock', 'color' => 'text-amber-500'],
                                    'confirmed' => ['icon' => 'lucide:check-circle', 'color' => 'text-blue-500'],
                                    'processing' => ['icon' => 'lucide:settings', 'color' => 'text-indigo-500'],
                                    'shipped' => ['icon' => 'lucide:truck', 'color' => 'text-purple-500'],
                                    'delivered' => ['icon' => 'lucide:home', 'color' => 'text-emerald-500'],
                                    'cancelled' => ['icon' => 'lucide:x-circle', 'color' => 'text-red-500'],
                                ];
                            @endphp
                            @foreach($statusHistory as $h)
                                <div class="flex gap-4 relative">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-8 h-8 rounded-full bg-stone-50 border border-stone-100 flex items-center justify-center {{ $timelineMap[$h->status]['color'] ?? 'text-stone-400' }} z-10 shadow-sm">
                                            <iconify-icon icon="{{ $timelineMap[$h->status]['icon'] ?? 'lucide:circle' }}"
                                                width="16"></iconify-icon>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="w-0.5 h-full bg-stone-100 -mt-1 mb-1"></div>
                                        @endif
                                    </div>
                                    <div class="pb-6">
                                        <p class="text-sm font-bold text-stone-900">{{ ucfirst($h->status) }}</p>
                                        <p class="text-[10px] text-stone-400 font-bold uppercase tracking-widest">
                                            {{ $h->created_at->format('d M, h:i A') }}
                                        </p>
                                        @if($h->notes)
                                            <p class="text-xs text-stone-500 mt-1 italic">{{ $h->notes }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-4">
                        <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 shadow-sm">
                            <h3 class="text-sm font-bold text-stone-900 uppercase tracking-wider mb-4">Quick Actions</h3>
                            <div class="space-y-3">
                                <button
                                    class="w-full flex items-center justify-between px-4 py-3 bg-stone-50 rounded-xl hover:bg-stone-100 transition-colors group">
                                    <span class="text-sm font-bold text-stone-700">Download Invoice</span>
                                    <iconify-icon icon="lucide:download"
                                        class="text-stone-300 group-hover:text-emerald-600 transition-colors"></iconify-icon>
                                </button>

                                @if(in_array($order->status, ['pending', 'confirmed']))
                                    <button onclick="openCancelModal()"
                                        class="w-full flex items-center justify-between px-4 py-3 bg-red-50 rounded-xl hover:bg-red-100 transition-colors group">
                                        <span class="text-sm font-bold text-red-700">Cancel Order</span>
                                        <iconify-icon icon="lucide:trash-2"
                                            class="text-red-300 group-hover:text-red-600 transition-colors"></iconify-icon>
                                    </button>
                                @endif
                            </div>
                        </div>

                        <div
                            class="bg-emerald-900 rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg shadow-emerald-900/20 text-white">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-emerald-300 mb-2">Need Help?</h3>
                            <p class="text-sm text-emerald-100/80 mb-4">If you have any issues with your order, our 24/7
                                support team is here to help.</p>
                            <a href="{{ route('customer.page.contact') }}"
                                class="inline-flex items-center gap-2 text-sm font-bold hover:gap-3 transition-all">
                                Contact Support
                                <iconify-icon icon="lucide:arrow-right"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div id="cancelModal"
        class="fixed inset-0 bg-stone-900/60 backdrop-blur-sm hidden items-center justify-center z-[70] p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 transform transition-all scale-95 opacity-0 duration-300"
            id="cancelModalContent">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 rounded-full bg-red-50 flex items-center justify-center text-red-600 mb-6">
                    <iconify-icon icon="lucide:alert-triangle" width="32"></iconify-icon>
                </div>
                <h3 class="text-2xl font-bold text-stone-900 mb-2">Cancel Order?</h3>
                <p class="text-stone-500 mb-8">Are you sure you want to cancel this order? This action cannot be undone.</p>

                <form method="POST" action="{{ route('customer.account.orders.cancel', $order->id) }}"
                    class="w-full space-y-4">
                    @csrf
                    <div class="text-left">
                        <label class="block text-xs font-bold text-stone-400 uppercase tracking-widest mb-2">Reason for
                            cancellation</label>
                        <select name="cancellation_reason" required
                            class="w-full px-4 py-3 rounded-xl border border-stone-200 focus:border-red-500 focus:ring-4 focus:ring-red-500/10 focus:outline-none transition-all text-sm font-medium bg-white">
                            <option value="">Select a reason</option>
                            <option value="Changed my mind">Changed my mind</option>
                            <option value="Found a better price">Found a better price</option>
                            <option value="Long delivery time">Long delivery time</option>
                            <option value="Order mistake">Order mistake</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-3 pt-4">
                        <button type="submit"
                            class="w-full py-4 bg-red-600 text-white rounded-2xl font-bold hover:bg-red-700 transition-colors shadow-lg shadow-red-600/20">
                            Confirm Cancellation
                        </button>
                        <button type="button" onclick="closeCancelModal()"
                            class="w-full py-4 bg-stone-50 text-stone-600 rounded-2xl font-bold hover:bg-stone-100 transition-colors">
                            Keep My Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openCancelModal() {
            const modal = document.getElementById('cancelModal');
            const content = document.getElementById('cancelModalContent');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancelModal');
            const content = document.getElementById('cancelModalContent');
            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection