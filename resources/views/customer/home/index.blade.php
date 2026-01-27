@extends('customer.layouts.master')

@section('title', 'Home - Ved Herbs & Ayurveda')

@section('content')

@push('styles')
<style>

     .hero-swiper {
    height: 100%;
    width: 100%;
}

.swiper-slide {
    height: 100%;
    width: 100%;
}

.swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0.7;
    transition: all 0.3s ease;
}

.swiper-pagination-bullet-active {
    background: #047857;
    opacity: 1;
    transform: scale(1.2);
}

.swiper-button-next,
.swiper-button-prev {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    backdrop-filter: blur(4px);
    border: 1px solid rgba(5, 150, 105, 0.2);
    transition: all 0.3s ease;
}

.swiper-button-next:hover,
.swiper-button-prev:hover {
    background: rgba(255, 255, 255, 0.95);
    border-color: rgba(5, 150, 105, 0.4);
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 18px;
    font-weight: bold;
    color: #047857;
}

</style>
@endpush

<div id="intro-overlay" class="intro-overlay">
    <img src="{{ asset('assets/images/logo.png') }}" alt="VED HERBS & AYURVEDA" class="intro-logo">
    <div class="intro-loader">
        <div id="intro-loader-fill" class="intro-loader-fill"></div>
    </div>
</div>

<!-- Hero Slider Section -->
<section class="relative min-h-[30vh] w-full overflow-hidden bg-stone-50">
    <!-- Swiper Container -->
    <div class="swiper-container hero-swiper w-full h-full">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/home1.PNG') }}" alt="Slide 1" class="w-full h-full object-fit object-center">
            </div>
            
            <!-- Slide 2 -->
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/home2.PNG') }}" alt="Slide 2" class="w-full h-full object-cover object-center">
            </div>
            
            <!-- Slide 3 -->
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/home3.PNG') }}" alt="Slide 3" class="w-full h-full object-cover object-center">
            </div>
            
            <!-- Slide 4 -->
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/home4.PNG') }}" alt="Slide 4" class="w-full h-full object-cover object-center">
            </div>
            
            <!-- Slide 5 -->
            <div class="swiper-slide">
                <img src="{{ asset('assets/images/home5.PNG') }}" alt="Slide 5" class="w-full h-full object-cover object-center">
            </div>
        </div>
    </div>
</section>
<!-- 2. Trust & Credibility -->
<section class="py-8 sm:py-12 bg-white border-b border-stone-100">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
            <!-- 100% Natural -->
            <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                    <i data-lucide="leaf" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                </div>
                <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">100% Natural</h3>
                <p class="text-xs sm:text-sm text-stone-500">
                    Pure Ayurvedic formulations with ancient herbs
                </p>
            </div>

            <!-- GMP Certified -->
            <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                    <i data-lucide="badge-check" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                </div>
                <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">GMP Certified</h3>
                <p class="text-xs sm:text-sm text-stone-500">
                    ISO & GMP certified manufacturing facility
                </p>
            </div>

            <!-- Free Shipping -->
            <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                    <i data-lucide="truck" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                </div>
                <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">Free Shipping</h3>
                <p class="text-xs sm:text-sm text-stone-500">
                    Free shipping on orders above ₹999
                </p>
            </div>

            <!-- Fast Delivery -->
            <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                    <i data-lucide="clock" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                </div>
                <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">Fast Delivery</h3>
                <p class="text-xs sm:text-sm text-stone-500">
                    Quick dispatch within 24–48 hours
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 3. Products Section -->
<div class="px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
    <div class="flex flex-col items-center text-center mb-6 sm:mb-8 md:mb-12 gap-4 sm:gap-6">
        <div class="max-w-4xl px-4">
            <h2 class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-medium tracking-tight text-stone-900 text-center mb-3 sm:mb-4">
                <span class="block">Premium Ayurvedic Products</span>
                <span class="block">Natural Healing & Wellness Solutions</span>
            </h2>
            <p class="text-stone-500 text-sm sm:text-base md:text-lg font-light leading-relaxed">
                Authentic formulations with scientifically proven ingredients • ISO/GMP Certified • 100% Natural
            </p>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 md:gap-8" id="product-grid">
        <!-- Product 1 - Power Gel -->
        <div class="group relative flex flex-col product-item" data-category="power-gel">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Vata</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Stress</span>
                </div>
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="1"
                        data-name="Power Gel"
                        data-price="599"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG"
                        data-weight="Herbal Performance Gel">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>
                
                <a href="{{ route('customer.products.details', ['slug' => 'power-gel']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG"
                        alt="Power Gel - Herbal Performance Gel"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button (Visible on Hover) -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="1"
                        data-name="Power Gel"
                        data-price="599"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG"
                        data-weight="Herbal Performance Gel">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'power-gel']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Power Gel
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Herbal Performance Gel</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹599</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 2 - Veerya Shakti -->
        <div class="group relative flex flex-col product-item" data-category="veerya-shakti">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Tridosha</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Detox</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="2"
                        data-name="Veerya Shakti"
                        data-price="1249"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Veerya-Shakti.PNG"
                        data-weight="Ayurvedic Powder">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'veerya-shakti']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Veerya-Shakti.PNG"
                        alt="Veerya Shakti - Ayurvedic Powder"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="2"
                        data-name="Veerya Shakti"
                        data-price="1249"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Veerya-Shakti.PNG"
                        data-weight="Ayurvedic Powder">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'veerya-shakti']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Veerya Shakti
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Ayurvedic Powder</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹1249</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 3 - Prime Time -->
        <div class="group relative flex flex-col product-item" data-category="prime-time">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Pitta</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Glow</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="3"
                        data-name="Prime Time"
                        data-price="1599"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Prime-Time.PNG"
                        data-weight="Herbal Paste">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'prime-time']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Prime-Time.PNG"
                        alt="Prime Time - Herbal Paste"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="3"
                        data-name="Prime Time"
                        data-price="1599"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Prime-Time.PNG"
                        data-weight="Herbal Paste">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'prime-time']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Prime Time
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Herbal Paste</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹1599</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 4 - Pachan Shakti -->
        <div class="group relative flex flex-col product-item" data-category="pachan-shakti">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Kapha</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Energy</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="4"
                        data-name="Pachan Shakti Powder"
                        data-price="299"
                        data-image="https://www.vedherbsandayurveda.com/pachan-shakti.jpeg"
                        data-weight="Ayurvedic Digestive Powder">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'pachan-shakti']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/pachan-shakti.jpeg"
                        alt="Pachan Shakti Powder - Ayurvedic Digestive Powder"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="4"
                        data-name="Pachan Shakti Powder"
                        data-price="299"
                        data-image="https://www.vedherbsandayurveda.com/pachan-shakti.jpeg"
                        data-weight="Ayurvedic Digestive Powder">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'pachan-shakti']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Pachan Shakti Powder
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Ayurvedic Digestive Powder</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹299</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 5 - PowerMax Oil -->
        <div class="group relative flex flex-col product-item" data-category="powermax-oil">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Best Seller</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Occasional Use</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="5"
                        data-name="PowerMax Oil"
                        data-price="1099"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Power-Max.PNG"
                        data-weight="Ayurvedic Massage Oil">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'powermax-oil']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Power-Max.PNG"
                        alt="PowerMax Oil - Ayurvedic Massage Oil"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="5"
                        data-name="PowerMax Oil"
                        data-price="1099"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Power-Max.PNG"
                        data-weight="Ayurvedic Massage Oil">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'powermax-oil']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                PowerMax Oil
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Ayurvedic Massage Oil</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹1099</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 6 - Prime Gold Power -->
        <div class="group relative flex flex-col product-item" data-category="prime-gold-power">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Best Seller</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Occasional Use</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="6"
                        data-name="Prime Gold Power"
                        data-price="975"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Prime-Gold.PNG"
                        data-weight="Golden Ball Pills">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'prime-gold-power']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Prime-Gold.PNG"
                        alt="Prime Gold Power - Golden Ball Pills"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="6"
                        data-name="Prime Gold Power"
                        data-price="975"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Prime-Gold.PNG"
                        data-weight="Golden Ball Pills">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'prime-gold-power']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Prime Gold Power
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Golden Ball Pills</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹975</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 7 - Ayushakti -->
        <div class="group relative flex flex-col product-item" data-category="ayushakti">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Best Seller</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Occasional Use</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="7"
                        data-name="Ayushakti"
                        data-price="1999"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Ayushakti.jpeg"
                        data-weight="Vitality Paste">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'ayushakti']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Ayushakti.jpeg"
                        alt="Ayushakti - Vitality Paste"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="7"
                        data-name="Ayushakti"
                        data-price="1999"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Ayushakti.jpeg"
                        data-weight="Vitality Paste">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'ayushakti']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Ayushakti
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Vitality Paste</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹1999</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Product 8 - Stree Shakti -->
        <div class="group relative flex flex-col product-item" data-category="stree-shakti">
            <div class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                <!-- Badges -->
                <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Best Seller</span>
                    <span class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">Occasional Use</span>
                </div>
                
                <!-- Mobile Cart Icon -->
                <button class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                        data-id="8"
                        data-name="Stree Shakti"
                        data-price="1749"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Stree-Shakti.PNG"
                        data-weight="Premium Chyawanprash Paste">
                    <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                </button>

                <a href="{{ route('customer.products.details', ['slug' => 'stree-shakti']) }}">
                    <img 
                        src="https://www.vedherbsandayurveda.com/products-img/Stree-Shakti.PNG"
                        alt="Stree Shakti - Premium Chyawanprash Paste"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Desktop Add to Cart Button -->
                <button class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                        data-id="8"
                        data-name="Stree Shakti"
                        data-price="1749"
                        data-image="https://www.vedherbsandayurveda.com/products-img/Stree-Shakti.PNG"
                        data-weight="Premium Chyawanprash Paste">
                    <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                    Add to Cart
                </button>
            </div>

            <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                <a href="{{ route('customer.products.details', ['slug' => 'stree-shakti']) }}" class="group-hover:text-sage-800 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="pr-2">
                            <h3 class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                Stree Shakti
                            </h3>
                            <p class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">Premium Chyawanprash Paste</p>
                        </div>
                        <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">₹1749</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<!-- 4. Philosophy Section -->
<section class="bg-emerald-950 text-white py-12 sm:py-16 md:py-20 lg:py-24 mt-8 sm:mt-12 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid md:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
            <div class="space-y-6 sm:space-y-8">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-tight leading-tight">Rooted in Tradition,<br>Refined by Science.</h2>
                <div class="space-y-4 sm:space-y-6 text-stone-300">
                    <div class="flex gap-3 sm:gap-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-900 border border-emerald-800 flex items-center justify-center shrink-0">
                            <span class="font-semibold text-emerald-400 text-sm sm:text-base">01</span>
                        </div>
                        <div>
                            <h4 class="text-white font-medium mb-1 text-sm sm:text-base">Ethical Sourcing</h4>
                            <p class="text-xs sm:text-sm leading-relaxed">We work directly with farmers to source potent herbs at their peak season, ensuring fair trade and sustainability.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 sm:gap-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-900 border border-emerald-800 flex items-center justify-center shrink-0">
                            <span class="font-semibold text-emerald-400 text-sm sm:text-base">02</span>
                        </div>
                        <div>
                            <h4 class="text-white font-medium mb-1 text-sm sm:text-base">Clean Formulations</h4>
                            <p class="text-xs sm:text-sm leading-relaxed">Zero heavy metals, zero pesticides. Just pure, concentrated extracts standardized for efficacy.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 sm:gap-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-900 border border-emerald-800 flex items-center justify-center shrink-0">
                            <span class="font-semibold text-emerald-400 text-sm sm:text-base">03</span>
                        </div>
                        <div>
                            <h4 class="text-white font-medium mb-1 text-sm sm:text-base">Holistic Wellness</h4>
                            <p class="text-xs sm:text-sm leading-relaxed">Our products aren't just pills; they are part of a lifestyle designed to balance your mind, body, and spirit.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative mt-8 md:mt-0">
                <div class="aspect-square rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-emerald-800/50">
                    <img src="https://static.toiimg.com/thumb/msid-116232991,width-1280,height-720,resizemode-4/116232991.jpg?auto=format&amp;fit=crop&amp;q=80&amp;w=1000" class="w-full h-full object-cover opacity-90" alt="Ayurvedic Preparation">
                </div>
                <div class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 bg-stone-50 text-emerald-900 p-4 sm:p-6 rounded-lg shadow-xl max-w-xs hidden md:block">
                    <p class="font-serif italic text-sm sm:text-lg leading-snug">"Ayurveda teaches us that nature provides everything we need to heal."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="py-12 sm:py-16 md:py-20 lg:py-24 bg-stone-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 sm:mb-12">
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-stone-900 text-center">
            India Trusts Ved Herbs & Ayurveda
        </h2>
    </div>

    <div class="testimonial-container flex gap-4 sm:gap-6 overflow-x-auto px-4 sm:px-6 pb-8 sm:pb-10 scrollbar-hide">
        <!-- Review 1 -->
        <div class="testimonial min-w-[85vw] sm:min-w-[400px] md:min-w-[350px] lg:min-w-[400px] bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-stone-100">
            <div class="flex gap-1 text-yellow-400 mb-4">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
            </div>
            <p class="text-stone-600 mb-6 italic text-sm sm:text-base">
                "After using the Ayurvedic Power Capsules for a month, my energy levels are back. 100% natural and no side effects. Truly impressed!"
            </p>
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-stone-200 overflow-hidden">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-full h-full object-cover" alt="Rohit Sharma">
                </div>
                <div>
                    <h5 class="font-bold text-xs sm:text-sm">Rohit Sharma</h5>
                    <p class="text-xs text-stone-400">Verified Buyer · Mumbai</p>
                </div>
            </div>
        </div>

        <!-- Review 2 -->
        <div class="testimonial min-w-[85vw] sm:min-w-[400px] md:min-w-[350px] lg:min-w-[400px] bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-stone-100">
            <div class="flex gap-1 text-yellow-400 mb-4">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
            </div>
            <p class="text-stone-600 mb-6 italic text-sm sm:text-base">
                "The Women Wellness Syrup helped regulate my cycles naturally. Love that it's Ayurveda-based and chemical-free."
            </p>
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-stone-200 overflow-hidden">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-full h-full object-cover" alt="Priya Mehta">
                </div>
                <div>
                    <h5 class="font-bold text-xs sm:text-sm">Priya Mehta</h5>
                    <p class="text-xs text-stone-400">Verified Buyer · Ahmedabad</p>
                </div>
            </div>
        </div>

        <!-- Review 3 -->
        <div class="testimonial min-w-[85vw] sm:min-w-[400px] md:min-w-[350px] lg:min-w-[400px] bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-stone-100">
            <div class="flex gap-1 text-yellow-400 mb-4">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
            </div>
            <p class="text-stone-600 mb-6 italic text-sm sm:text-base">
                "My digestion issues are finally under control. The Triphala tablets are authentic and work exactly as promised."
            </p>
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-stone-200 overflow-hidden">
                    <img src="https://randomuser.me/api/portraits/men/55.jpg" class="w-full h-full object-cover" alt="Amit Verma">
                </div>
                <div>
                    <h5 class="font-bold text-xs sm:text-sm">Amit Verma</h5>
                    <p class="text-xs text-stone-400">Verified Buyer · Delhi</p>
                </div>
            </div>
        </div>

        <!-- Review 4 -->
        <div class="testimonial min-w-[85vw] sm:min-w-[400px] md:min-w-[350px] lg:min-w-[400px] bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-stone-100">
            <div class="flex gap-1 text-yellow-400 mb-4">
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
            </div>
            <p class="text-stone-600 mb-6 italic text-sm sm:text-base">
                "The Pain Relief Oil works wonders for my knee pain. Ayurvedic solutions are truly the best."
            </p>
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-stone-200 overflow-hidden">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" class="w-full h-full object-cover" alt="Sunita Patel">
                </div>
                <div>
                    <h5 class="font-bold text-xs sm:text-sm">Sunita Patel</h5>
                    <p class="text-xs text-stone-400">Verified Buyer · Surat</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality from index.php
    // Get all filter buttons and product items
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');
    const productGrid = document.getElementById('product-grid');
    const mobileFilter = document.getElementById('mobile-filter');
    
    // Count products per category
    const categoryCounts = {};
    
    // Initialize counts
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            const filter = button.getAttribute('data-filter');
            categoryCounts[filter] = 0;
        });
        
        // Count products in each category
        productItems.forEach(item => {
            const category = item.getAttribute('data-category');
            if (categoryCounts[category] !== undefined) {
                categoryCounts[category]++;
            }
        });
        
        // Update count displays on buttons
        filterButtons.forEach(button => {
            const filter = button.getAttribute('data-filter');
            const countElement = document.getElementById(`${filter}-count`);
            
            if (countElement && filter !== 'all') {
                const count = categoryCounts[filter] || 0;
                countElement.textContent = `(${count})`;
            }
        });
        
        // Update "All" count
        const allCountElement = document.getElementById('all-count');
        if (allCountElement) {
            allCountElement.textContent = `(${productItems.length})`;
        }
        
        // Filter products function
        function filterProducts(filter) {
            // Remove active class from all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-stone-900', 'text-white', 'hover:bg-stone-800');
                btn.classList.add('bg-white', 'border', 'border-stone-200', 'text-stone-600', 'hover:border-stone-300', 'hover:text-stone-900');
            });
            
            // Add active class to clicked button
            const activeButton = document.querySelector(`.filter-btn[data-filter="${filter}"]`);
            if (activeButton) {
                activeButton.classList.remove('bg-white', 'border', 'border-stone-200', 'text-stone-600', 'hover:border-stone-300', 'hover:text-stone-900');
                activeButton.classList.add('bg-stone-900', 'text-white', 'hover:bg-stone-800');
            }
            
            // Update mobile filter dropdown
            if (mobileFilter) {
                mobileFilter.value = filter;
            }
            
            // Show/hide products based on filter
            productItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Smooth animation for grid rearrangement
            setTimeout(() => {
                productGrid.classList.add('transition-all', 'duration-300');
            }, 10);
        }
        
        // Add click event listeners to filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                filterProducts(filter);
            });
        });
        
        // Mobile filter dropdown event listener
        if (mobileFilter) {
            mobileFilter.addEventListener('change', function() {
                const filter = this.value;
                filterProducts(filter);
            });
        }
        
        // Initialize with "All" filter active
        filterProducts('all');
    }
});


// Initialize Swiper
document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.hero-swiper', {
        direction: 'horizontal',
        loop: true,
        speed: 800,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        }
    });
});
</script>
@endpush