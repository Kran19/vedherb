@extends('customer.layouts.master')

@section('title', 'Shop - Ved Herbs & Ayurveda')

@push('styles')
<style>
/* Shop Page Critical CSS */
.shop-container {
    padding: 2rem 1rem;
}

@media (min-width: 640px) {
    .shop-container {
        padding: 3rem 1.5rem;
    }
}

@media (min-width: 768px) {
    .shop-container {
        padding: 4rem 2rem;
    }
}

@media (min-width: 1024px) {
    .shop-container {
        padding: 2rem;
    }
}

.shop-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 1.5rem;
    gap: 1rem;
}

@media (min-width: 640px) {
    .shop-header {
        margin-bottom: 2rem;
        gap: 1.5rem;
    }
}

@media (min-width: 768px) {
    .shop-header {
        margin-bottom: 3rem;
    }
}

.shop-header-content {
    max-width: 56rem;
    padding: 0 1rem;
}

.shop-title {
    font-family: serif;
    font-size: 1.5rem;
    font-weight: 500;
    letter-spacing: -0.025em;
    color: #1c1917;
    text-align: center;
    margin-bottom: 0.75rem;
}

@media (min-width: 640px) {
    .shop-title {
        font-size: 1.875rem;
        margin-bottom: 1rem;
    }
}

@media (min-width: 768px) {
    .shop-title {
        font-size: 2.25rem;
    }
}

@media (min-width: 1024px) {
    .shop-title {
        font-size: 3rem;
    }
}

.shop-title span {
    display: block;
}

.shop-description {
    color: #78716c;
    font-size: 0.875rem;
    font-weight: 300;
    line-height: 1.75;
}

@media (min-width: 640px) {
    .shop-description {
        font-size: 1rem;
    }
}

@media (min-width: 768px) {
    .shop-description {
        font-size: 1.125rem;
    }
}

.shop-filters-desktop {
    display: none;
    flex-wrap: wrap;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1rem;
}

@media (min-width: 768px) {
    .shop-filters-desktop {
        display: flex;
    }
}

.shop-filter-btn {
    padding: 0.375rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
}

@media (min-width: 640px) {
    .shop-filter-btn {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
}

.shop-filter-btn.active {
    background-color: #1c1917;
    color: white;
}

.shop-filter-btn.active:hover {
    background-color: #292524;
}

.shop-filter-btn:not(.active) {
    background-color: white;
    border: 1px solid #e7e5e4;
    color: #57534e;
}

.shop-filter-btn:not(.active):hover {
    border-color: #d6d3d1;
    color: #1c1917;
}

.shop-filters-mobile {
    width: 100%;
    max-width: 28rem;
    margin: 0 auto 1.5rem;
}

@media (min-width: 768px) {
    .shop-filters-mobile {
        display: none;
    }
}

.shop-mobile-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border-radius: 9999px;
    background-color: white;
    border: 1px solid #e7e5e4;
    color: #57534e;
    font-size: 0.875rem;
    font-weight: 500;
    appearance: none;
    outline: none;
}

.shop-product-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

@media (min-width: 640px) {
    .shop-product-grid {
        gap: 1.5rem;
    }
}

@media (min-width: 768px) {
    .shop-product-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }
}

@media (min-width: 1024px) {
    .shop-product-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (min-width: 1280px) {
    .shop-product-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

.shop-product-item {
    position: relative;
    display: flex;
    flex-direction: column;
    transition: all 0.3s;
}

.shop-product-image-container {
    position: relative;
    width: 100%;
    aspect-ratio: 4/5;
    background-color: #f0efec;
    border-radius: 0.5rem;
    overflow: hidden;
    border: 1px solid #f5f5f4;
}

@media (min-width: 640px) {
    .shop-product-image-container {
        border-radius: 0.75rem;
    }
}

@media (min-width: 768px) {
    .shop-product-image-container {
        border-radius: 1rem;
    }
}

.shop-product-badges {
    position: absolute;
    top: 0.5rem;
    left: 0.5rem;
    z-index: 10;
    display: flex;
    gap: 0.25rem;
}

@media (min-width: 640px) {
    .shop-product-badges {
        top: 0.75rem;
        left: 0.75rem;
        gap: 0.5rem;
    }
}

.shop-product-badge {
    padding: 0.125rem 0.375rem;
    background-color: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(4px);
    border-radius: 0.25rem;
    font-size: 9px;
    font-weight: 500;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #57534e;
    border: 1px solid rgba(231, 229, 228, 0.5);
}

@media (min-width: 640px) {
    .shop-product-badge {
        padding: 0.25rem 0.5rem;
        font-size: 10px;
    }
}

.shop-mobile-add-btn {
    position: absolute;
    bottom: 0.5rem;
    right: 0.5rem;
    z-index: 20;
    width: 1.75rem;
    height: 1.75rem;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #57534e;
    border: 1px solid rgba(231, 229, 228, 0.5);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: background-color 0.2s;
    cursor: pointer;
}

@media (min-width: 640px) {
    .shop-mobile-add-btn {
        bottom: 0.75rem;
        right: 0.75rem;
        width: 2.25rem;
        height: 2.25rem;
    }
}

@media (min-width: 768px) {
    .shop-mobile-add-btn {
        display: none;
    }
}

.shop-mobile-add-btn:hover {
    background-color: #fafaf9;
}

.shop-product-link {
    display: block;
    width: 100%;
    height: 100%;
}

.shop-product-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    transition: transform 0.7s ease-out;
    opacity: 1;
    mix-blend-mode: multiply;
}

.shop-product-item:hover .shop-product-image {
    transform: scale(1.05);
}

.shop-desktop-add-btn {
    display: none;
    position: absolute;
    bottom: 0.75rem;
    right: 0.75rem;
    left: 0.75rem;
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    color: #1c1917;
    padding: 0.5rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transform: translateY(1rem);
    opacity: 0;
    transition: all 0.3s;
    border: 1px solid #f5f5f4;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    cursor: pointer;
}

@media (min-width: 640px) {
    .shop-desktop-add-btn {
        padding: 0.75rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        gap: 0.5rem;
        bottom: 1rem;
        right: 1rem;
        left: 1rem;
    }
}

@media (min-width: 768px) {
    .shop-desktop-add-btn {
        display: flex;
    }
}

.shop-desktop-add-btn:hover {
    background-color: #fafaf9;
}

.shop-product-item:hover .shop-desktop-add-btn {
    transform: translateY(0);
    opacity: 1;
}

.shop-product-info {
    margin-top: 0.75rem;
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

@media (min-width: 640px) {
    .shop-product-info {
        margin-top: 1rem;
    }
}

.shop-product-details {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.shop-product-text {
    padding-right: 0.5rem;
}

.shop-product-title {
    font-size: 0.875rem;
    font-family: serif;
    font-weight: 500;
    color: #1c1917;
    transition: color 0.2s;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

@media (min-width: 640px) {
    .shop-product-title {
        font-size: 1rem;
    }
}

@media (min-width: 768px) {
    .shop-product-title {
        font-size: 1.125rem;
    }
}

.shop-product-item:hover .shop-product-title {
    color: #047857;
}

.shop-product-subtitle {
    font-size: 10px;
    font-weight: 500;
    color: #a8a29e;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-top: 0.125rem;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}

@media (min-width: 640px) {
    .shop-product-subtitle {
        font-size: 0.75rem;
    }
}

.shop-product-price {
    font-size: 1rem;
    font-weight: 500;
    color: #1c1917;
    flex-shrink: 0;
}

@media (min-width: 640px) {
    .shop-product-price {
        font-size: 1.125rem;
    }
}

@media (min-width: 768px) {
    .shop-product-price {
        font-size: 1.25rem;
    }
}
</style>
@endpush

@section('content')
<!-- Products Section -->
<div class="shop-container">
    <div class="shop-header">
        <div class="shop-header-content">
            <h2 class="shop-title">
                <span>Premium Ayurvedic Products</span>
                <span>Natural Healing & Wellness Solutions</span>
            </h2>
            <p class="shop-description">
                Authentic formulations with scientifically proven ingredients • ISO/GMP Certified • 100% Natural
            </p>
        </div>

        <!-- Filters (Visible Only on Desktop) -->
        <div class="shop-filters-desktop" id="filter-buttons">
            <!-- All -->
            <button class="shop-filter-btn active" data-filter="all">
                🌿 All <span id="all-count"></span>
            </button>

            <!-- Other filter buttons -->
            <button class="shop-filter-btn" data-filter="prime-gold-power">
                🌟 Prime Gold Power <span id="prime-gold-power-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="power-gel">
                😌 Power Gel <span id="power-gel-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="veerya-shakti">
                💪 Veerya Shakti <span id="veerya-shakti-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="pachan-shakti">
                🌱 Pachan Shakti <span id="pachan-shakti-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="prime-time">
                👨 Prime Time <span id="prime-time-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="ayushakti">
                ⚡ Ayushakti <span id="ayushakti-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="stree-shakti">
                👩 Stree Shakti <span id="stree-shakti-count"></span>
            </button>

            <button class="shop-filter-btn" data-filter="powermax-oil">
                🦵 PowerMax Oil <span id="powermax-oil-count"></span>
            </button>
        </div>

        <!-- Mobile Filters Dropdown -->
        <div class="shop-filters-mobile">
            <select id="mobile-filter" class="shop-mobile-select">
                <option value="all">🌿 All Products</option>
                <option value="prime-gold-power">🌟 Prime Gold Power</option>
                <option value="power-gel">😌 Power Gel</option>
                <option value="veerya-shakti">💪 Veerya Shakti</option>
                <option value="pachan-shakti">🌱 Pachan Shakti</option>
                <option value="prime-time">👨 Prime Time</option>
                <option value="ayushakti">⚡ Ayushakti</option>
                <option value="stree-shakti">👩 Stree Shakti</option>
                <option value="powermax-oil">🦵 PowerMax Oil</option>
            </select>
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
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Ashwagandha Bottle"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Triphala Powder"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Kumkumadi Oil"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Brahmi Pearls"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Performance Pills"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Performance Pills"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Performance Pills"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
                
                <!-- Mobile Cart Icon (Bottom Right) - Hidden on Desktop -->
                <button class="md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm mobile-add-btn"
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
                        alt="Performance Pills"
                        class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply"
                    />
                </a>

                <!-- Quick Add Button (Visible on Hover - Hidden on Mobile) -->
                <button class="hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50 desktop-add-btn"
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get all filter buttons and product items
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');
    const productGrid = document.getElementById('product-grid');
    const mobileFilter = document.getElementById('mobile-filter');
    
    // Count products per category
    const categoryCounts = {};
    
    // Initialize counts
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
});
</script>
@endpush