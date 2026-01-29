@extends('customer.layouts.master')

@section('title', 'My Orders')

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
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm text-stone-900 font-medium">My Orders</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            <!-- Left Sidebar - Account Navigation -->
            @include('customer.account.partials.sidebar')

            <!-- Right Content Area -->
            <div class="lg:col-span-2">
                <!-- Orders List -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 mb-6 sm:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-2">
                        <h2 class="text-lg sm:text-xl font-semibold text-stone-900">My Orders ({{ $totalOrders }})</h2>
                    </div>

                    <!-- Order Status Filter -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <a href="{{ route('customer.account.orders') }}"
                            class="px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-colors {{ !isset($status) ? 'bg-emerald-600 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                            All
                        </a>
                        @foreach($statusCounts as $s => $count)
                            @if($count > 0)
                                <a href="{{ route('customer.account.orders.filter', $s) }}"
                                    class="px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium transition-colors {{ (isset($status) && $status == $s) ? 'bg-emerald-600 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                                    {{ ucfirst($s) }} ({{ $count }})
                                </a>
                            @endif
                        @endforeach
                    </div>

                    <!-- Orders Table -->
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
                                    @forelse($orders as $order)
                                        <tr>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4">
                                                <span
                                                    class="font-medium text-xs sm:text-sm text-stone-900">#{{ $order->order_number }}</span>
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-stone-600">
                                                {{ $order->created_at->format('d M, Y') }}
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
                                                        'refunded' => 'bg-purple-100 text-purple-800',
                                                        'returned' => 'bg-pink-100 text-pink-800',
                                                    ];
                                                    $statusClass = $statusClasses[$order->status] ?? 'bg-stone-100 text-stone-800';
                                                @endphp
                                                <span
                                                    class="px-2 sm:px-3 py-1 rounded-full {{ $statusClass }} text-xs font-medium">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4 font-medium text-xs sm:text-sm text-stone-900">
                                                ₹{{ number_format($order->grand_total, 2) }}
                                            </td>
                                            <td class="py-3 sm:py-4 px-3 sm:px-4">
                                                <a href="{{ route('customer.account.orders.details', $order->id) }}"
                                                    class="text-emerald-700 hover:text-emerald-800 text-xs sm:text-sm font-medium flex items-center gap-1">
                                                    Details
                                                    <iconify-icon icon="lucide:chevron-right" width="12"></iconify-icon>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-12 text-center">
                                                <div class="flex flex-col items-center justify-center text-stone-500">
                                                    <iconify-icon icon="lucide:package-open" width="48"
                                                        class="mb-2 opacity-20"></iconify-icon>
                                                    <p>No orders found matching your criteria.</p>
                                                    <a href="{{ route('customer.home.index') }}"
                                                        class="mt-4 text-emerald-700 font-medium hover:underline">Start
                                                        Shopping</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $orders->links() }}
                    </div>
                </div>

                <!-- Order Summary Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-emerald-50 rounded-xl p-5 border border-emerald-200">
                        <div class="flex items-center gap-3 mb-1">
                            <div
                                class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700">
                                <iconify-icon icon="lucide:wallet" width="20"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-emerald-800">Total Spent</p>
                                <p class="text-xl font-bold text-emerald-900">₹{{ number_format($totalSpent, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-stone-50 rounded-xl p-5 border border-stone-200">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center text-stone-600">
                                <iconify-icon icon="lucide:bar-chart-3" width="20"></iconify-icon>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-stone-800">Average Order</p>
                                <p class="text-xl font-bold text-stone-900">₹{{ number_format($averageOrder, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection