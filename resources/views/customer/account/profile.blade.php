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
        <div class="lg:col-span-1">
            <!-- Account Summary -->
            <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-stone-200 mb-4 sm:mb-6">
                <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700">
                        <iconify-icon icon="lucide:user" width="18" class="sm:w-6"></iconify-icon>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-semibold text-stone-900">Welcome back,</h3>
                        <p class="text-base sm:text-lg font-medium text-emerald-700">kalp</p>
                    </div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-stone-600">Member since</span>
                        <span class="text-sm sm:text-base font-medium text-stone-900">2023</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-stone-600">Total Orders</span>
                        <span class="text-sm sm:text-base font-medium text-stone-900">12</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-stone-600">Wishlist Items</span>
                        <span class="text-sm sm:text-base font-medium text-stone-900">8</span>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 overflow-hidden">
                <nav class="space-y-0 sm:space-y-1">
                    <a href="{{ route('customer.account.orders') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 text-stone-700 hover:bg-stone-50 hover:text-emerald-800 transition-colors border-b border-stone-100 last:border-b-0">
                        <iconify-icon icon="lucide:package" width="16" class="sm:w-4"></iconify-icon>
                        <span class="text-sm sm:text-base">My Orders</span>
                    </a>
                    <a href="{{ route('customer.account.addresses') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 text-stone-700 hover:bg-stone-50 hover:text-emerald-800 transition-colors border-b border-stone-100 last:border-b-0">
                        <iconify-icon icon="lucide:map-pin" width="16" class="sm:w-4"></iconify-icon>
                        <span class="text-sm sm:text-base">Addresses</span>
                    </a>
                    <a href="{{ route('customer.wishlist.index') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 text-stone-700 hover:bg-stone-50 hover:text-emerald-800 transition-colors border-b border-stone-100 last:border-b-0">
                        <iconify-icon icon="lucide:heart" width="16" class="sm:w-4"></iconify-icon>
                        <span class="text-sm sm:text-base">Wishlist</span>
                    </a>
                    <a href="{{ route('customer.account.profile') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 bg-stone-50 text-emerald-700 font-medium border-b border-stone-100 last:border-b-0">
                        <iconify-icon icon="lucide:user" width="16" class="sm:w-4"></iconify-icon>
                        <span class="text-sm sm:text-base">Profile</span>
                    </a>
                    <a href="{{ route('customer.account.change-password') }}" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 text-stone-700 hover:bg-stone-50 hover:text-emerald-800 transition-colors border-b border-stone-100 last:border-b-0">
                        <iconify-icon icon="lucide:lock" width="16" class="sm:w-4"></iconify-icon>
                        <span class="text-sm sm:text-base">Change Password</span>
                    </a>
                    <form method="POST" class="border-t border-stone-100">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 w-full text-left text-red-600 hover:bg-red-50 transition-colors">
                            <iconify-icon icon="lucide:log-out" width="16" class="sm:w-4"></iconify-icon>
                            <span class="text-sm sm:text-base">Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <!-- Right Content Area -->
        <div class="lg:col-span-2">
            <!-- Recent Orders -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6 mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-2">
                    <h2 class="text-lg sm:text-xl font-semibold text-stone-900">Recent Orders</h2>
                    <a href="{{ route('customer.account.orders') }}" class="text-emerald-700 hover:text-emerald-800 font-medium text-xs sm:text-sm flex items-center gap-1 self-end sm:self-auto">
                        View All
                        <iconify-icon icon="lucide:arrow-right" width="12" class="sm:w-4"></iconify-icon>
                    </a>
                </div>

                <div class="overflow-x-auto -mx-4 sm:mx-0">
                    <div class="min-w-full inline-block align-middle">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-stone-200">
                                    <th class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">Order #</th>
                                    <th class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">Date</th>
                                    <th class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">Status</th>
                                    <th class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">Total</th>
                                    <th class="text-left py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-medium text-stone-600">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                <!-- Sample Data - Replace with dynamic data -->
                                <tr>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <span class="font-medium text-xs sm:text-sm text-stone-900">#AYU-2024-156</span>
                                    </td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-stone-600">15 Jan, 2024</td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <span class="px-2 sm:px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">
                                            Delivered
                                        </span>
                                    </td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4 font-medium text-xs sm:text-sm text-stone-900">$96.50</td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <a href="#" class="text-emerald-700 hover:text-emerald-800 text-xs sm:text-sm font-medium">View</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <span class="font-medium text-xs sm:text-sm text-stone-900">#AYU-2024-142</span>
                                    </td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-stone-600">05 Jan, 2024</td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <span class="px-2 sm:px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium">
                                            Shipped
                                        </span>
                                    </td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4 font-medium text-xs sm:text-sm text-stone-900">$145.75</td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <a href="#" class="text-emerald-700 hover:text-emerald-800 text-xs sm:text-sm font-medium">Track</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <span class="font-medium text-xs sm:text-sm text-stone-900">#AYU-2023-389</span>
                                    </td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4 text-xs sm:text-sm text-stone-600">22 Dec, 2023</td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <span class="px-2 sm:px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-medium">
                                            Processing
                                        </span>
                                    </td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4 font-medium text-xs sm:text-sm text-stone-900">$67.25</td>
                                    <td class="py-3 sm:py-4 px-3 sm:px-4">
                                        <a href="#" class="text-emerald-700 hover:text-emerald-800 text-xs sm:text-sm font-medium">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Wishlist Items -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-2">
                    <h2 class="text-lg sm:text-xl font-semibold text-stone-900">My Wishlist</h2>
                    <a href="{{ route('customer.wishlist.index') }}" class="text-emerald-700 hover:text-emerald-800 font-medium text-xs sm:text-sm flex items-center gap-1 self-end sm:self-auto">
                        View All
                        <iconify-icon icon="lucide:arrow-right" width="12" class="sm:w-4"></iconify-icon>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Wishlist Item 1 -->
                    <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 border border-stone-200 rounded-lg sm:rounded-xl hover:border-emerald-300 transition-colors">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg bg-[#F0EFEC] flex items-center justify-center p-2 flex-shrink-0">
                            <img src="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG" 
                                 alt="Ashwagandha" 
                                 class="w-full h-full object-contain">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm sm:text-base font-medium text-stone-900 mb-1 truncate">Ashwagandha Root</h4>
                            <p class="text-xs sm:text-sm text-stone-500 mb-2 truncate">Stress Relief & Energy</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm sm:text-base font-medium text-stone-900">$32.00</span>
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <button class="p-1 sm:p-2 text-emerald-700 hover:text-emerald-800">
                                        <iconify-icon icon="lucide:shopping-bag" width="14" class="sm:w-4"></iconify-icon>
                                    </button>
                                    <button class="p-1 sm:p-2 text-red-500 hover:text-red-600">
                                        <iconify-icon icon="lucide:x" width="14" class="sm:w-4"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist Item 2 -->
                    <div class="flex items-center gap-3 sm:gap-4 p-3 sm:p-4 border border-stone-200 rounded-lg sm:rounded-xl hover:border-emerald-300 transition-colors">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-lg bg-[#F0EFEC] flex items-center justify-center p-2 flex-shrink-0">
                            <img src="https://www.vedherbsandayurveda.com/products-img/Veerya-Shakti.PNG" 
                                 alt="Triphala" 
                                 class="w-full h-full object-contain">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm sm:text-base font-medium text-stone-900 mb-1 truncate">Triphala Complex</h4>
                            <p class="text-xs sm:text-sm text-stone-500 mb-2 truncate">Digestive Support</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm sm:text-base font-medium text-stone-900">$28.00</span>
                                <div class="flex items-center gap-1 sm:gap-2">
                                    <button class="p-1 sm:p-2 text-emerald-700 hover:text-emerald-800">
                                        <iconify-icon icon="lucide:shopping-bag" width="14" class="sm:w-4"></iconify-icon>
                                    </button>
                                    <button class="p-1 sm:p-2 text-red-500 hover:text-red-600">
                                        <iconify-icon icon="lucide:x" width="14" class="sm:w-4"></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Health Section -->
            <div class="mt-6 sm:mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                <div class="bg-emerald-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border border-emerald-200">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:trophy" width="14" class="sm:w-4 text-emerald-700"></iconify-icon>
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
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="lucide:heart-pulse" width="14" class="sm:w-4 text-blue-700"></iconify-icon>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs sm:text-sm font-medium text-blue-800 truncate">Wellness Streak</p>
                            <p class="text-base sm:text-lg font-semibold text-blue-900">28 Days</p>
                        </div>
                    </div>
                    <p class="text-xs text-blue-700">Keep going for your next milestone!</p>
                </div>

                <div class="bg-purple-50 rounded-lg sm:rounded-xl p-4 sm:p-5 border border-purple-200 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-purple-100 flex items-center justify-center flex-shrink-0">
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