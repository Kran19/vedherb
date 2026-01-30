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
    <section class="relative min-h-[30vh] md:min-h-[60vh] w-full overflow-hidden bg-stone-50">
        <!-- Swiper Container -->
        <div class="swiper-container hero-swiper w-full h-full">
            <div class="swiper-wrapper">
                @forelse($banners as $banner)
                    <div class="swiper-slide relative">
                        <img src="{{ !empty($banner->image) ? (filter_var($banner->image, FILTER_VALIDATE_URL) ? $banner->image : asset('storage/' . $banner->image)) : asset('assets/images/home1.PNG') }}"
                            alt="{{ $banner->title }}" class="w-full h-full object-cover">
                        @if($banner->title || $banner->subtitle)
                            <div class="absolute inset-0 bg-black/20 flex items-center justify-center text-center p-4">
                                <div class="max-w-2xl text-white">
                                    @if($banner->title)
                                        <h2 class="text-3xl sm:text-5xl font-serif mb-2 animate-fade-in-up">
                                            {{ $banner->title }}
                                        </h2>
                                    @endif
                                    @if($banner->subtitle)
                                        <p class="text-sm sm:text-lg mb-6 opacity-90 animate-fade-in-up delay-100">
                                            {{ $banner->subtitle }}
                                        </p>
                                    @endif
                                    @if($banner->cta_link)
                                        <a href="{{ $banner->cta_link }}"
                                            class="inline-block px-8 py-3 bg-white text-emerald-900 rounded-full font-semibold hover:bg-emerald-50 transition-colors animate-fade-in-up delay-200">
                                            {{ $banner->cta_text ?? 'Shop Now' }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="swiper-slide text-center bg-stone-100 flex items-center justify-center">
                        <img src="{{ asset('assets/images/home1.PNG') }}" alt="Ved Herbs" class="w-full h-full object-cover">
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- 2. Trust & Credibility -->
    <section class="py-8 sm:py-12 bg-white border-b border-stone-100">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
                <!-- 100% Natural -->
                <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                        <i data-lucide="leaf" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                    </div>
                    <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">100% Natural</h3>
                    <p class="text-xs sm:text-sm text-stone-500">
                        Pure Ayurvedic formulations with ancient herbs
                    </p>
                </div>

                <!-- GMP Certified -->
                <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                        <i data-lucide="badge-check" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                    </div>
                    <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">GMP Certified</h3>
                    <p class="text-xs sm:text-sm text-stone-500">
                        ISO & GMP certified manufacturing facility
                    </p>
                </div>

                <!-- Free Shipping -->
                <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
                        <i data-lucide="truck" class="w-6 h-6 sm:w-8 sm:h-8 md:w-10 md:h-10"></i>
                    </div>
                    <h3 class="text-sm sm:text-base md:text-xl font-semibold text-stone-900">Free Shipping</h3>
                    <p class="text-xs sm:text-sm text-stone-500">
                        Free shipping on orders above ₹999
                    </p>
                </div>

                <!-- Fast Delivery -->
                <div class="flex flex-col items-center text-center gap-2 sm:gap-3 p-3 sm:p-4">
                    <div
                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-stone-50 flex items-center justify-center text-emerald-700">
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
                <h2
                    class="font-serif text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-medium tracking-tight text-stone-900 text-center mb-3 sm:mb-4">
                    <span class="block">Premium Ayurvedic Products</span>
                    <span class="block">Natural Healing & Wellness Solutions</span>
                </h2>
                <p class="text-stone-500 text-sm sm:text-base md:text-lg font-light leading-relaxed">
                    Authentic formulations with scientifically proven ingredients • ISO/GMP Certified • 100% Natural
                </p>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 md:gap-8"
            id="product-grid">
            @php
                $premiumProducts = collect();
                if (!empty($dynamicSections)) {
                    foreach ($dynamicSections as $sec) {
                        $premiumProducts = $premiumProducts->merge($sec['products']);
                    }
                }
                $premiumProducts = $premiumProducts->unique('id')->take(10);
            @endphp

            @forelse($premiumProducts as $product)
                <div class="group relative flex flex-col product-item" data-category="{{ $product['category_slug'] ?? 'all' }}">
                    <div
                        class="relative w-full aspect-[4/5] bg-[#F0EFEC] rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-stone-100">
                        <!-- Badges -->
                        <div class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 flex gap-1 sm:gap-2">
                            @if($product['is_new'])
                                <span
                                    class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-white/90 backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase text-stone-600 border border-stone-200/50">New</span>
                            @endif
                            @if($product['is_featured'])
                                <span
                                    class="px-1.5 py-0.5 sm:px-2 sm:py-1 bg-stone-900/90 text-white backdrop-blur-sm rounded text-[9px] sm:text-[10px] font-medium tracking-wide uppercase border border-stone-200/50">Featured</span>
                            @endif
                        </div>

                        <!-- Mobile Cart Icon -->
                        <button
                            class="mobile-add-btn md:hidden absolute bottom-2 right-2 sm:bottom-3 sm:right-3 z-20 w-7 h-7 sm:w-9 sm:h-9 rounded-full bg-white/95 backdrop-blur-sm flex items-center justify-center text-stone-700 border border-stone-200/50 shadow-sm hover:bg-stone-50 transition-colors"
                            data-id="{{ $product['id'] }}" data-name="{{ $product['name'] }}"
                            data-price="{{ $product['price'] }}"
                            data-image="{{ !empty($product['main_image']) ? asset('storage/' . $product['main_image']) : asset('images/placeholder-product.jpg') }}"
                            data-weight="{{ $product['short_description'] ?? '' }}"
                            data-variant-id="{{ $product['default_variant_id'] }}">
                            <i data-lucide="plus" class="w-4 h-4 sm:w-5 sm:h-5"></i>
                        </button>

                        <a href="{{ route('customer.products.details', $product['slug']) }}">
                            <img src="{{ !empty($product['main_image']) ? asset('storage/' . $product['main_image']) : asset('images/placeholder-product.jpg') }}"
                                alt="{{ $product['name'] }}"
                                class="w-full h-full object-contain object-center transition-transform duration-700 ease-out group-hover:scale-105 opacity-100 mix-blend-multiply" />
                        </a>

                        <!-- Desktop Add to Cart Button -->
                        <button
                            class="desktop-add-btn hidden md:flex absolute bottom-3 sm:bottom-4 right-3 sm:right-4 left-3 sm:left-4 bg-white/95 backdrop-blur-md text-stone-900 py-2 sm:py-3 rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium shadow-lg translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 border border-stone-100 items-center justify-center gap-1 sm:gap-2 hover:bg-stone-50"
                            data-id="{{ $product['id'] }}" data-name="{{ $product['name'] }}"
                            data-price="{{ $product['price'] }}"
                            data-image="{{ !empty($product['main_image']) ? asset('storage/' . $product['main_image']) : asset('images/placeholder-product.jpg') }}"
                            data-weight="{{ $product['short_description'] ?? '' }}"
                            data-variant-id="{{ $product['default_variant_id'] }}">
                            <iconify-icon icon="lucide:shopping-bag" width="14" height="14"></iconify-icon>
                            Add to Cart
                        </button>
                    </div>

                    <div class="mt-3 sm:mt-4 flex flex-col gap-1">
                        <a href="{{ route('customer.products.details', $product['slug']) }}"
                            class="group-hover:text-sage-800 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="pr-2">
                                    <h3
                                        class="text-sm sm:text-base md:text-lg font-serif font-medium text-stone-900 group-hover:text-sage-800 transition-colors line-clamp-1">
                                        {{ $product['name'] }}
                                    </h3>
                                    <p
                                        class="text-[10px] sm:text-xs font-medium text-stone-400 uppercase tracking-widest mt-0.5 line-clamp-1">
                                        {{ $product['brand'] ?? 'Ved Herbs' }}
                                    </p>
                                </div>
                                <p class="text-base sm:text-lg md:text-xl font-medium text-stone-900 shrink-0">
                                    ₹{{ number_format($product['price'], 0) }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center py-12 text-stone-400 italic">No products available at the moment.</p>
            @endforelse
        </div>
    </div>

    <!-- 4. Philosophy Section -->
    <section class="bg-emerald-950 text-white py-12 sm:py-16 md:py-20 lg:py-24 mt-8 sm:mt-12 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid md:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
                <div class="space-y-6 sm:space-y-8">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-semibold tracking-tight leading-tight">Rooted in
                        Tradition,<br>Refined by Science.</h2>
                    <div class="space-y-4 sm:space-y-6 text-stone-300">
                        <div class="flex gap-3 sm:gap-4">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-900 border border-emerald-800 flex items-center justify-center shrink-0">
                                <span class="font-semibold text-emerald-400 text-sm sm:text-base">01</span>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1 text-sm sm:text-base">Ethical Sourcing</h4>
                                <p class="text-xs sm:text-sm leading-relaxed">We work directly with farmers to source potent
                                    herbs at their peak season, ensuring fair trade and sustainability.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 sm:gap-4">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-900 border border-emerald-800 flex items-center justify-center shrink-0">
                                <span class="font-semibold text-emerald-400 text-sm sm:text-base">02</span>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1 text-sm sm:text-base">Clean Formulations</h4>
                                <p class="text-xs sm:text-sm leading-relaxed">Zero heavy metals, zero pesticides. Just pure,
                                    concentrated extracts standardized for efficacy.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 sm:gap-4">
                            <div
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-emerald-900 border border-emerald-800 flex items-center justify-center shrink-0">
                                <span class="font-semibold text-emerald-400 text-sm sm:text-base">03</span>
                            </div>
                            <div>
                                <h4 class="text-white font-medium mb-1 text-sm sm:text-base">Holistic Wellness</h4>
                                <p class="text-xs sm:text-sm leading-relaxed">Our products aren't just pills; they are part
                                    of a lifestyle designed to balance your mind, body, and spirit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative mt-8 md:mt-0">
                    <div
                        class="aspect-square rounded-lg sm:rounded-xl md:rounded-2xl overflow-hidden border border-emerald-800/50">
                        <img src="https://static.toiimg.com/thumb/msid-116232991,width-1280,height-720,resizemode-4/116232991.jpg?auto=format&amp;fit=crop&amp;q=80&amp;w=1000"
                            class="w-full h-full object-cover opacity-90" alt="Ayurvedic Preparation">
                    </div>
                    <div
                        class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-6 bg-stone-50 text-emerald-900 p-4 sm:p-6 rounded-lg shadow-xl max-w-xs hidden md:block">
                        <p class="font-serif italic text-sm sm:text-lg leading-snug">"Ayurveda teaches us that nature
                            provides everything we need to heal."</p>
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
            @forelse($testimonials as $testimonial)
                <div
                    class="testimonial min-w-[85vw] sm:min-w-[400px] md:min-w-[350px] lg:min-w-[400px] bg-white p-6 sm:p-8 rounded-2xl sm:rounded-3xl shadow-sm border border-stone-100">
                    <div class="flex gap-1 text-yellow-400 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        @endfor
                    </div>
                    <p class="text-stone-600 mb-6 italic text-sm sm:text-base">
                        "{{ $testimonial->message }}"
                    </p>
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-stone-200 overflow-hidden">
                            @if($testimonial->image)
                                <img src="{{ filter_var($testimonial->image, FILTER_VALIDATE_URL) ? $testimonial->image : asset('storage/' . $testimonial->image) }}"
                                    class="w-full h-full object-cover" alt="{{ $testimonial->name }}">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=047857&color=fff"
                                    class="w-full h-full object-cover" alt="{{ $testimonial->name }}">
                            @endif
                        </div>
                        <div>
                            <h5 class="font-bold text-xs sm:text-sm">{{ $testimonial->name }}</h5>
                            <p class="text-xs text-stone-400">{{ $testimonial->designation }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center py-12 text-stone-400 italic">No testimonials available at the moment.</p>
            @endforelse
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                    button.addEventListener('click', function () {
                        const filter = this.getAttribute('data-filter');
                        filterProducts(filter);
                    });
                });

                // Mobile filter dropdown event listener
                if (mobileFilter) {
                    mobileFilter.addEventListener('change', function () {
                        const filter = this.value;
                        filterProducts(filter);
                    });
                }

                // Initialize with "All" filter active
                filterProducts('all');
            }
        });


        // Initialize Swiper
        document.addEventListener('DOMContentLoaded', function () {
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