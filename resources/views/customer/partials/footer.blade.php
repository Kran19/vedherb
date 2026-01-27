<footer class="bg-white border-t border-stone-200 pt-12 md:pt-20 pb-8 md:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 lg:gap-16 mb-12 md:mb-20">
            <!-- Brand -->
            <div class="md:col-span-4 lg:col-span-4">
                <a href="{{ route('customer.home.index') }}" class="text-2xl font-bold tracking-tighter text-emerald-950 uppercase block mb-4 md:mb-6">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="SATTVA Logo" class="h-10 md:h-12 w-auto mb-3 md:mb-4">
                </a>
                <p class="text-stone-600 text-sm md:text-base leading-relaxed mb-6 md:mb-8 max-w-md">
                    Bringing the ancient science of life to the modern world. Pure, ethical, and effective Ayurvedic wellness for everyone.
                </p>
                <div class="flex gap-4 md:gap-6 text-stone-500">
                    <a href="#" class="hover:text-emerald-800 transition-colors transform hover:scale-110">
                        <i data-lucide="instagram" class="w-6 h-6 md:w-7 md:h-7"></i>
                    </a>
                    <a href="#" class="hover:text-emerald-800 transition-colors transform hover:scale-110">
                        <i data-lucide="facebook" class="w-6 h-6 md:w-7 md:h-7"></i>
                    </a>
                    <a href="#" class="hover:text-emerald-800 transition-colors transform hover:scale-110">
                        <i data-lucide="twitter" class="w-6 h-6 md:w-7 md:h-7"></i>
                    </a>
                    <a href="#" class="hover:text-emerald-800 transition-colors transform hover:scale-110">
                        <i data-lucide="youtube" class="w-6 h-6 md:w-7 md:h-7"></i>
                    </a>
                </div>
            </div>

            <!-- Links -->
            <div class="md:col-span-8 lg:col-span-8">
                <div class="grid grid-cols-2 md:grid-cols-8 lg:grid-cols-8 gap-8 md:gap-4 lg:gap-8">
                    <!-- Shop -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-2">
                        <h4 class="font-semibold text-stone-900 mb-4 md:mb-6 text-base md:text-lg">Shop</h4>
                        <ul class="space-y-3 md:space-y-4 text-sm md:text-base text-stone-600">
                            <li><a href="{{ route('customer.products.shop') }}" class="hover:text-emerald-700 transition-colors hover:underline">All Products</a></li>
                            {{-- <li><a href="#" class="hover:text-emerald-700 transition-colors hover:underline">Best Sellers</a></li> --}}
                            <li><a href="#" class="hover:text-emerald-700 transition-colors hover:underline">New Arrivals</a></li>
                            <li><a href="#" class="hover:text-emerald-700 transition-colors hover:underline">Gift Bundles</a></li>
                            <li><a href="{{ route('customer.cart') }}" class="hover:text-emerald-700 transition-colors hover:underline">Shopping Cart</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-2">
                        <h4 class="font-semibold text-stone-900 mb-4 md:mb-6 text-base md:text-lg">Support</h4>
                        <ul class="space-y-3 md:space-y-4 text-sm md:text-base text-stone-600">
                            <li><a href="{{ route('customer.page.privacy') }}" class="hover:text-emerald-700 transition-colors hover:underline">Privacy policy</a></li>
                            <li><a href="{{ route('customer.page.shipping-policy') }}" class="hover:text-emerald-700 transition-colors hover:underline">Shipping & Returns</a></li>
                            <li><a href="{{ route('customer.page.faq') }}" class="hover:text-emerald-700 transition-colors hover:underline">FAQ</a></li>
                            <li><a href="{{ route('customer.page.contact') }}" class="hover:text-emerald-700 transition-colors hover:underline">Contact Us</a></li>
                            <li><a href="{{ route('customer.products.blog') }}" class="hover:text-emerald-700 transition-colors hover:underline">Wellness Blog</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="col-span-2 md:col-span-4 lg:col-span-4 mt-6 md:mt-0">
                        <h4 class="font-semibold text-stone-900 mb-4 md:mb-6 text-base md:text-lg">Stay Balanced</h4>
                        <p class="text-stone-600 text-sm md:text-base mb-4 md:mb-6 max-w-md">Subscribe for wellness tips, Ayurvedic insights, and exclusive offers.</p>
                        <form class="flex flex-col sm:flex-row gap-3" action="#" method="POST">
                            @csrf
                            <input type="email" name="newsletter_email" placeholder="Enter your email" required class="flex-1 bg-stone-50 border border-stone-300 rounded-xl px-4 md:px-5 py-3 md:py-3.5 text-sm md:text-base focus:outline-none focus:ring-3 focus:ring-emerald-500/30 focus:border-emerald-500 transition-all">
                            <button type="submit" class="bg-emerald-900 text-white px-5 md:px-7 py-3 md:py-3.5 rounded-xl text-sm md:text-base font-semibold hover:bg-emerald-800 transition-colors transform hover:-translate-y-0.5 shadow-lg hover:shadow-xl sm:w-auto">
                                Join
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="pt-6 md:pt-8 border-t border-stone-200">
            <div class="text-center space-y-3 md:space-y-4">
                <!-- Copyright -->
                <p class="text-xs md:text-sm text-stone-600">© {{ date('Y') }} Sattva Wellness Pvt Ltd. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>