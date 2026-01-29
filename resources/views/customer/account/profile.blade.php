@extends('customer.layouts.master')

@section('title', 'My Account')

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
                <li aria-current="page">
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm text-stone-900 font-medium">My Account</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Left Sidebar - Account Navigation -->
            @include('customer.account.partials.sidebar')

            <!-- Right Content Area -->
            <div class="lg:col-span-2">
                <!-- Recent Orders -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 mb-6 sm:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-2">
                        <h2 class="text-lg sm:text-xl font-semibold text-stone-900">Recent Orders</h2>
                        <a href="{{ route('customer.account.orders') }}"
                            class="text-emerald-700 hover:text-emerald-800 font-medium text-xs sm:text-sm flex items-center gap-1 self-end sm:self-auto">
                            View All
                            <iconify-icon icon="lucide:arrow-right" width="12" class="sm:w-4"></iconify-icon>
                        </a>
                    </div>

                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <div class="min-w-full inline-block align-middle">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-stone-200">
                                        <th
                                            class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">
                                            Order #</th>
                                        <th
                                            class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">
                                            Date</th>
                                        <th
                                            class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">
                                            Status</th>
                                        <th
                                            class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">
                                            Total</th>
                                        <th
                                            class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100">
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4">
                                                <span
                                                    class="font-medium text-xs sm:text-sm text-stone-900">#{{ $order['order_number'] }}</span>
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-stone-600">
                                                {{ $order['created_at']->format('d M, Y') }}
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4">
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                                        'processing' => 'bg-amber-100 text-amber-800',
                                                        'shipped' => 'bg-indigo-100 text-indigo-800',
                                                        'delivered' => 'bg-green-100 text-green-800',
                                                        'cancelled' => 'bg-red-100 text-red-800',
                                                    ];
                                                    $statusClass = $statusClasses[$order['status']] ?? 'bg-stone-100 text-stone-800';
                                                @endphp
                                                <span
                                                    class="px-2 sm:px-3 py-1 rounded-full {{ $statusClass }} text-xs font-medium">
                                                    {{ ucfirst($order['status']) }}
                                                </span>
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4 font-medium text-xs sm:text-sm text-stone-900">
                                                ₹{{ number_format($order['grand_total'], 2) }}
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4">
                                                <a href="{{ route('customer.account.orders.details', $order['id']) }}"
                                                    class="text-emerald-700 hover:text-emerald-800 text-xs sm:text-sm font-medium">View</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-10 text-center text-stone-500">
                                                No recent orders found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Wishlist Items -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-2">
                        <h2 class="text-lg sm:text-xl font-semibold text-stone-900">My Wishlist</h2>
                        <a href="{{ route('customer.wishlist.index') }}"
                            class="text-emerald-700 hover:text-emerald-800 font-medium text-xs sm:text-sm flex items-center gap-1 self-end sm:self-auto">
                            View All
                            <iconify-icon icon="lucide:arrow-right" width="12" class="sm:w-4"></iconify-icon>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        @forelse($wishlistItems as $item)
                            @php $product = $item->variant->product; @endphp
                            <div
                                class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 border border-stone-200 rounded-lg sm:rounded-xl hover:border-emerald-300 transition-colors">
                                <div
                                    class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg bg-[#F0EFEC] flex items-center justify-center p-2 flex-shrink-0">
                                    @if(!empty($product->image))
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-contain">
                                    @else
                                        <iconify-icon icon="lucide:image" width="24" class="text-stone-300"></iconify-icon>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm sm:text-base font-medium text-stone-900 mb-1 truncate">
                                        {{ $product->name }}</h4>
                                    <p class="text-xs sm:text-sm text-stone-500 mb-2 truncate">{{ $product->short_description }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-sm sm:text-base font-medium text-stone-900">₹{{ number_format($item->variant->price, 2) }}</span>
                                        <div class="flex items-center gap-1 sm:gap-2">
                                            <button class="p-1 sm:p-2 text-emerald-700 hover:text-emerald-800"
                                                onclick="addToCart({{ $item->variant->id }}, 1)">
                                                <iconify-icon icon="lucide:shopping-bag" width="14"
                                                    class="sm:w-4"></iconify-icon>
                                            </button>
                                            <button class="p-1 sm:p-2 text-red-500 hover:text-red-600"
                                                onclick="removeFromWishlist({{ $item->id }})">
                                                <iconify-icon icon="lucide:x" width="14" class="sm:w-4"></iconify-icon>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center text-stone-500">
                                Your wishlist is empty.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Account Health Section -->
                <div class="mt-6 sm:mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                    <div class="bg-emerald-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border border-emerald-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <iconify-icon icon="lucide:trophy" width="14"
                                    class="sm:w-4 text-emerald-700"></iconify-icon>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-emerald-800 truncate">Wellness Level</p>
                                <p class="text-base sm:text-lg font-semibold text-emerald-900">Silver</p>
                            </div>
                        </div>
                        <div class="w-full bg-emerald-200 rounded-full h-1.5 sm:h-2">
                            <div class="bg-emerald-600 h-1.5 sm:h-2 rounded-full" style="width: 65%"></div>
                        </div>
                        <p class="text-xs text-emerald-700 mt-2">65% to Gold level</p>
                    </div>

                    <div class="bg-blue-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border border-blue-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                <iconify-icon icon="lucide:heart-pulse" width="14"
                                    class="sm:w-4 text-blue-700"></iconify-icon>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-blue-800 truncate">Wellness Streak</p>
                                <p class="text-base sm:text-lg font-semibold text-blue-900">28 Days</p>
                            </div>
                        </div>
                        <p class="text-xs text-blue-700">Keep going for your next milestone!</p>
                    </div>

                    <div
                        class="bg-purple-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border border-purple-200 sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-3 mb-3">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
                                <iconify-icon icon="lucide:wallet" width="14" class="sm:w-4 text-purple-700"></iconify-icon>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-purple-800 truncate">Reward Points</p>
                                <p class="text-base sm:text-lg font-semibold text-purple-900">450</p>
                            </div>
                        </div>
                        <p class="text-xs text-purple-700">Available for discounts on next order</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Add Iconify Script if not already in layout -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
@endpush