<div class="lg:col-span-1">
    <!-- Account Summary -->
    <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-stone-200 mb-4 sm:mb-6">
        <div class="flex items-center gap-3 sm:gap-4 mb-4 sm:mb-6">
            <div
                class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700">
                <iconify-icon icon="lucide:user" width="18" class="sm:w-6"></iconify-icon>
            </div>
            <div>
                <h3 class="text-sm sm:text-base font-semibold text-stone-900">Welcome back,</h3>
                <p class="text-base sm:text-lg font-medium text-emerald-700">{{ Auth::guard('customer')->user()->name }}
                </p>
            </div>
        </div>

        <div class="space-y-3 sm:space-y-4">
            <div class="flex items-center justify-between">
                <span class="text-xs sm:text-sm text-stone-600">Member since</span>
                <span
                    class="text-sm sm:text-base font-medium text-stone-900">{{ Auth::guard('customer')->user()->created_at->format('Y') }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs sm:text-sm text-stone-600">Total Orders</span>
                <span
                    class="text-sm sm:text-base font-medium text-stone-900">{{ \App\Models\Order::where('customer_id', Auth::guard('customer')->id())->count() }}</span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs sm:text-sm text-stone-600">Wishlist Items</span>
                <span
                    class="text-sm sm:text-base font-medium text-stone-900">{{ \App\Models\WishlistItem::whereHas('wishlist', function ($query) {
    $query->where('customer_id', Auth::guard('customer')->id()); })->count() }}</span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="bg-white rounded-xl sm:rounded-2xl border border-stone-200 overflow-hidden">
        <nav class="space-y-0 sm:space-y-1">
            <a href="{{ route('customer.account.profile') }}"
                class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 {{ request()->routeIs('customer.account.profile') ? 'bg-stone-50 text-emerald-700 font-medium' : 'text-stone-700 hover:bg-stone-50 hover:text-emerald-800' }} transition-colors border-b border-stone-100 last:border-b-0">
                <iconify-icon icon="lucide:user" width="16" class="sm:w-4"></iconify-icon>
                <span class="text-sm sm:text-base">Profile</span>
            </a>
            <a href="{{ route('customer.account.orders') }}"
                class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 {{ request()->routeIs('customer.account.orders*') ? 'bg-stone-50 text-emerald-700 font-medium' : 'text-stone-700 hover:bg-stone-50 hover:text-emerald-800' }} transition-colors border-b border-stone-100 last:border-b-0">
                <iconify-icon icon="lucide:package" width="16" class="sm:w-4"></iconify-icon>
                <span class="text-sm sm:text-base">My Orders</span>
            </a>
            <a href="{{ route('customer.account.addresses') }}"
                class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 {{ request()->routeIs('customer.account.addresses') ? 'bg-stone-50 text-emerald-700 font-medium' : 'text-stone-700 hover:bg-stone-50 hover:text-emerald-800' }} transition-colors border-b border-stone-100 last:border-b-0">
                <iconify-icon icon="lucide:map-pin" width="16" class="sm:w-4"></iconify-icon>
                <span class="text-sm sm:text-base">Addresses</span>
            </a>
            <a href="{{ route('customer.wishlist.index') }}"
                class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 {{ request()->routeIs('customer.wishlist.index') ? 'bg-stone-50 text-emerald-700 font-medium' : 'text-stone-700 hover:bg-stone-50 hover:text-emerald-800' }} transition-colors border-b border-stone-100 last:border-b-0">
                <iconify-icon icon="lucide:heart" width="16" class="sm:w-4"></iconify-icon>
                <span class="text-sm sm:text-base">Wishlist</span>
            </a>

            <a href="{{ route('customer.account.change-password') }}"
                class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 {{ request()->routeIs('customer.account.change-password') ? 'bg-stone-50 text-emerald-700 font-medium' : 'text-stone-700 hover:bg-stone-50 hover:text-emerald-800' }} transition-colors border-b border-stone-100 last:border-b-0">
                <iconify-icon icon="lucide:lock" width="16" class="sm:w-4"></iconify-icon>
                <span class="text-sm sm:text-base">Change Password</span>
            </a>
            <form method="POST" action="{{ route('customer.logout') }}" class="border-t border-stone-100">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 px-4 sm:px-6 py-3 sm:py-4 w-full text-left text-red-600 hover:bg-red-50 transition-colors">
                    <iconify-icon icon="lucide:log-out" width="16" class="sm:w-4"></iconify-icon>
                    <span class="text-sm sm:text-base">Logout</span>
                </button>
            </form>
        </nav>
    </div>
</div>