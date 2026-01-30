@extends('customer.layouts.master')

@section('title', ($category->name ?? 'Category') . ' - Ved Herbs & Ayurveda')
@section('meta_description', $category->meta_description ?? 'Browse our ' . ($category->name ?? '') . ' collection of natural healing and wellness solutions.')

@push('styles')
    <style>
        .filter-section {
            transition: all 0.3s ease;
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .discount-badge {
            background: #dc2626;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        /* Fix for consistent image size */
        .product-image-container {
            aspect-ratio: 4/5;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
            mix-blend-mode: multiply;
        }

        .product-image:hover {
            transform: scale(1.05);
        }

        /* List view styles */
        .product-card.list-view {
            flex-direction: row !important;
            height: auto !important;
        }

        .list-view .product-image-container {
            width: 250px;
            aspect-ratio: 1/1 !important;
            flex-shrink: 0;
        }

        .list-view .product-details {
            flex: 1;
            padding: 1.5rem;
        }

        /* Button styles */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-add-to-cart {
            flex: 1;
            background: #059669;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-add-to-cart:hover {
            background: #047857;
        }

        .btn-add-to-cart:disabled {
            background: #9ca3af;
            cursor: not-allowed;
        }

        .btn-wishlist {
            width: 40px;
            height: 40px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.375rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-wishlist:hover {
            background: #f0fdf4;
            color: #059669;
            border-color: #059669;
        }

        /* Hero Section Animation */
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out both;
        }

        /* Mobile Filter Styles */
        @media (max-width: 1023px) {
            .mobile-filter-drawer {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 320px;
                background: white;
                z-index: 100;
                transform: translateX(-100%);
                transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                overflow-y: auto;
                box-shadow: 10px 0 25px rgba(0, 0, 0, 0.1);
                visibility: hidden;
            }

            .mobile-filter-drawer.open {
                transform: translateX(0);
                visibility: visible;
            }

            .mobile-filter-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                z-index: 90;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.4s ease;
            }

            .mobile-filter-overlay.open {
                opacity: 1;
                pointer-events: auto;
            }

            .filter-section-container {
                padding: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Category Hero Header -->
    <div class="relative bg-stone-100 py-16 overflow-hidden">
        <div class="absolute inset-0 pointer-events-none opacity-20">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-200 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-stone-300 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <nav class="flex justify-center mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('customer.home.index') }}" class="text-stone-600 hover:text-emerald-700 text-sm">
                            <i class="fas fa-home mr-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="{{ route('customer.products.shop') }}" class="text-stone-600 hover:text-emerald-700 text-sm">Products</a>
                        </div>
                    </li>
                    @if(isset($category->parent))
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                                <a href="{{ route('customer.category.products', $category->parent->slug) }}" class="text-stone-600 hover:text-emerald-700 text-sm">{{ $category->parent->name }}</a>
                            </div>
                        </li>
                    @endif
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <span class="text-stone-800 font-semibold text-sm">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>
                @if(isset($category->description))
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-8">{{ $category->description }}</p>
                @endif

                @if(isset($childCategories) && count($childCategories) > 0)
                    <div class="flex flex-wrap justify-center gap-3">
                        @foreach($childCategories as $child)
                            <a href="{{ route('customer.category.products', $child->slug) }}" 
                               class="px-6 py-2 bg-white border border-stone-200 rounded-full text-stone-700 hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-700 transition-all shadow-sm">
                                {{ $child->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Mobile Filter Toggle -->
            <div class="lg:hidden mb-6 w-full">
                <button id="mobileFilterToggle" class="w-full flex items-center justify-center gap-3 bg-white py-4 px-6 rounded-xl border border-stone-200 shadow-sm text-stone-700 font-semibold hover:bg-stone-50 active:scale-[0.98] transition-all">
                    <i class="fas fa-sliders-h text-emerald-600"></i>
                    <span>Filter & Sort</span>
                </button>
            </div>

            <!-- Mobile Filter Overlay -->
            <div id="mobileFilterOverlay" class="mobile-filter-overlay"></div>

            <!-- Sidebar Filters -->
            <div id="filterSidebar" class="mobile-filter-drawer lg:static lg:block lg:w-1/4 lg:h-auto lg:bg-transparent lg:shadow-none lg:transform-none lg:z-auto">
                <div class="bg-white lg:rounded-xl lg:shadow p-5 sticky top-6 filter-section h-full lg:h-auto overflow-y-auto lg:overflow-visible">
                    <!-- Mobile Header -->
                    <div class="flex justify-between items-center mb-6 lg:hidden pb-4 border-b border-stone-100">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-sliders-h text-emerald-600"></i>
                            <h3 class="text-xl font-bold text-stone-800">Filter & Sort</h3>
                        </div>
                        <button id="closeMobileFilter" class="w-10 h-10 flex items-center justify-center rounded-full bg-stone-100 text-stone-500 hover:bg-stone-200 hover:text-stone-700 transition-colors">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                    </div>

                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-lg font-bold text-gray-800">Filters</h3>
                        @if (request()->hasAny(['search', 'min_price', 'max_price', 'brand_id', 'in_stock']))
                            <a href="{{ url()->current() }}"
                                class="text-sm text-emerald-700 hover:text-emerald-800">Clear All</a>
                        @endif
                    </div>

                    <!-- Filter Form -->
                    <form id="filterForm" method="GET" action="{{ url()->current() }}">
                        <div class="mb-5 relative">
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Search in this category..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>

                        <!-- Price Range -->
                        <div id="filter-price" class="mb-5">
                            <h4 class="font-semibold text-gray-800 mb-3 text-sm">Price Range</h4>
                            <div class="space-y-4">
                                <div class="flex space-x-2">
                                    <input type="number" name="min_price" value="{{ $minPrice ?? '' }}" placeholder="Min"
                                        class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                    <input type="number" name="max_price" value="{{ $maxPrice ?? '' }}" placeholder="Max"
                                        class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                </div>
                                <button type="submit"
                                    class="w-full py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm">
                                    Apply Price
                                </button>
                            </div>
                        </div>

                        <!-- Availability -->
                        <div id="filter-availability" class="mb-5">
                            <h4 class="font-semibold text-gray-800 mb-3 text-sm">Availability</h4>
                            <label class="flex items-center p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                                <input type="checkbox" name="in_stock" value="1" class="h-4 w-4 text-emerald-600 rounded"
                                    {{ ($inStock ?? false) ? 'checked' : '' }} onchange="this.form.submit()">
                                <span class="text-gray-700 ml-3 text-sm">In Stock Only</span>
                            </label>
                        </div>
                        
                        <!-- Brands -->
                        @if (isset($filters['brands']) && count($filters['brands']) > 0)
                            <div id="filter-brands" class="mb-5">
                                <h4 class="font-semibold text-gray-800 mb-3 text-sm">Brands</h4>
                                <div class="space-y-1">
                                    @foreach ($filters['brands'] as $brand)
                                        <label class="flex items-center p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                                            <input type="checkbox" name="brand_id" value="{{ $brand['id'] }}"
                                                class="h-4 w-4 text-emerald-600 rounded"
                                                {{ request('brand_id') == $brand['id'] ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-700 ml-3 text-sm">{{ $brand['name'] }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </form>

                    <!-- Related Categories -->
                    @if(isset($relatedCategories) && count($relatedCategories) > 0)
                        <div id="filter-related-categories" class="mb-5 border-t pt-5">
                            <h4 class="font-semibold text-gray-800 mb-3 text-sm">Related Categories</h4>
                            <div class="space-y-1">
                                @foreach($relatedCategories as $relCat)
                                    <a href="{{ route('customer.category.products', $relCat->slug) }}" 
                                       class="block p-2 text-stone-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg text-sm transition-colors">
                                        {{ $relCat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Mobile Apply Button (Bottom Sticky) -->
                    <div class="lg:hidden mt-8 pt-6 border-t border-stone-100 sticky bottom-0 bg-white">
                        <button onclick="toggleMobileFilters(false)" class="w-full py-4 bg-emerald-600 text-white rounded-xl font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-700 active:scale-[0.98] transition-all">
                            Show Results
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products Grid Area -->
            <div class="lg:w-3/4">
                <!-- Results Header -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <p class="text-gray-700">
                            @if (isset($paginator['total']) && $paginator['total'] > 0)
                                Showing <span class="font-semibold">{{ $paginator['from'] ?? 0 }}</span> to
                                <span class="font-semibold">{{ $paginator['to'] ?? 0 }}</span> of
                                <span class="font-semibold">{{ $paginator['total'] ?? 0 }}</span> products
                            @else
                                No products found
                            @endif
                        </p>
                    </div>

                    <div class="hidden lg:flex items-center gap-4">
                        <form method="GET" action="{{ url()->current() }}">
                            @foreach (request()->except('sort_by', 'page') as $key => $value)
                                @if (is_array($value))
                                    @foreach ($value as $val)
                                        <input type="hidden" name="{{ $key }}[]" value="{{ $val }}">
                                    @endforeach
                                @else
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endif
                            @endforeach

                            <select name="sort_by" onchange="this.form.submit()"
                                class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                <option value="newest" {{ ($sortBy ?? 'newest') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                <option value="price_asc" {{ ($sortBy ?? '') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ ($sortBy ?? '') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="popular" {{ ($sortBy ?? '') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            </select>
                            <!-- Mobile Sort Section -->
                            <div id="mobile-sort-section" class="mb-5 lg:hidden">
                                <h4 class="font-semibold text-gray-800 mb-3 text-sm">Sort By</h4>
                                <div class="space-y-2">
                                    @php
                                        $sortOptions = [
                                            'newest' => 'Newest First',
                                            'price_asc' => 'Price: Low to High',
                                            'price_desc' => 'Price: High to Low',
                                            'popular' => 'Most Popular'
                                        ];
                                    @endphp
                                    @foreach($sortOptions as $value => $label)
                                        <label class="flex items-center p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                                            <input type="radio" name="sort_by" value="{{ $value }}" 
                                                class="h-4 w-4 text-emerald-600 border-gray-300 focus:ring-emerald-500"
                                                {{ ($sortBy ?? 'newest') == $value ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-700 ml-3 text-sm">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                @if (count($products ?? []) > 0)
                    <div id="productsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div class="product-card bg-white rounded-xl shadow overflow-hidden group flex flex-col relative">
                                <div class="product-image-container relative bg-stone-50">
                                    <a href="{{ route('customer.products.details', $product['slug']) }}">
                                        <img src="{{ asset('storage/' . ltrim($product['main_image'], '/')) }}"
                                            alt="{{ $product['name'] }}" class="product-image"
                                            onerror="this.src='/images/placeholder-product.jpg'">
                                    </a>

                                    <div class="absolute top-3 right-3 space-y-1">
                                        @if (($product['discount_percent'] ?? 0) > 0)
                                            <span class="discount-badge">{{ $product['discount_percent'] }}% OFF</span>
                                        @endif
                                        @if ($product['is_new'] ?? false)
                                            <span class="bg-green-600 text-white text-xs px-2 py-1 rounded">NEW</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-4 flex flex-col flex-grow">
                                    <a href="{{ route('customer.products.details', $product['slug']) }}" class="block">
                                        <h3 class="font-semibold text-gray-800 mb-2 hover:text-emerald-700 transition-colors line-clamp-2 min-h-[3rem]">
                                            {{ $product['name'] }}
                                        </h3>
                                    </a>

                                    @if (($product['rating'] ?? 0) > 0)
                                        <div class="flex items-center gap-1 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="{{ $i <= floor($product['rating']) ? 'fas' : 'far' }} fa-star text-yellow-400 text-sm"></i>
                                            @endfor
                                            <span class="text-xs text-gray-500 ml-1">({{ $product['review_count'] ?? 0 }})</span>
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-xl font-bold text-gray-900">₹{{ number_format($product['price'] ?? 0) }}</span>
                                        @if (($product['compare_price'] ?? 0) > ($product['price'] ?? 0))
                                            <span class="text-sm text-gray-400 line-through">₹{{ number_format($product['compare_price']) }}</span>
                                        @endif
                                    </div>

                                    <div class="mt-auto space-y-2">
                                        <button type="button"
                                            class="w-full bg-emerald-600 text-white rounded-lg py-2.5 font-medium hover:bg-emerald-700 transition-colors add-to-cart-btn"
                                            data-variant-id="{{ $product['default_variant_id'] ?? $product['id'] }}"
                                            {{ !($product['is_in_stock'] ?? true) ? 'disabled' : '' }}>
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if (isset($paginator['last_page']) && $paginator['last_page'] > 1)
                        <div class="mt-12 flex justify-center">
                            <nav class="flex items-center gap-1">
                                @if ($paginator['current_page'] > 1)
                                    <a href="{{ request()->fullUrlWithQuery(['page' => $paginator['current_page'] - 1]) }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                @endif

                                @for ($i = 1; $i <= $paginator['last_page']; $i++)
                                    <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg
                                            {{ $i == $paginator['current_page'] ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">
                                        {{ $i }}
                                    </a>
                                @endfor

                                @if ($paginator['current_page'] < $paginator['last_page'])
                                    <a href="{{ request()->fullUrlWithQuery(['page' => $paginator['current_page'] + 1]) }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                @endif
                            </nav>
                        </div>
                    @endif
                @else
                    <div class="text-center py-16 bg-white rounded-xl shadow">
                        <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Products Found</h3>
                        <p class="text-gray-600 mb-6">Currently there are no products in this category matching your filters.</p>
                        <a href="{{ url()->current() }}"
                            class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                            Reset Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Axios config
        axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['Accept'] = 'application/json';

        // Mobile Filter Logic
        function toggleMobileFilters(show, targetId = null) {
            const sidebar = document.getElementById('filterSidebar');
            const overlay = document.getElementById('mobileFilterOverlay');
            if (show) {
                sidebar.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';

                if (targetId) {
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        setTimeout(() => {
                            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }, 100);
                    }
                }
            } else {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Filter Event Listeners
            document.getElementById('mobileFilterToggle')?.addEventListener('click', () => toggleMobileFilters(true));
            document.getElementById('mobileFilterOverlay')?.addEventListener('click', () => toggleMobileFilters(false));
            document.getElementById('closeMobileFilter')?.addEventListener('click', () => toggleMobileFilters(false));

            // Add to cart
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', async function() {
                    const variantId = this.getAttribute('data-variant-id');
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>';
                    this.disabled = true;

                    try {
                        const response = await axios.post('/cart/add', {
                            variant_id: variantId,
                            quantity: 1
                        });
                        if (response.data.success) {
                            showToast('Added to cart!', 'success');
                            if (window.updateCartBadge) window.updateCartBadge(response.data.cart_count);
                        } else {
                            showToast(response.data.message || 'Error', 'error');
                        }
                    } catch (error) {
                        showToast('Failed to add to cart', 'error');
                    } finally {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }
                });
            });
        });

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'
            }`;
            toast.innerHTML = `<div class="flex items-center"><iconify-icon icon="${type === 'success' ? 'lucide:check-circle' : 'lucide:alert-circle'}" width="20" class="mr-2"></iconify-icon><span>${message}</span></div>`;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
@endpush
