@extends('customer.layouts.master')

@section('title', $title ?? 'All Products - Ved Herbs & Ayurveda')
@section('meta_description', $meta_description ?? 'Browse our complete collection of natural healing and wellness solutions.')

@section('styles')
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

        .material-tag {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            margin-right: 4px;
            margin-bottom: 2px;
        }

        .attribute-tag {
            display: inline-block;
            background: #dbeafe;
            color: #1e40af;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            margin-right: 4px;
            margin-bottom: 2px;
        }

        .discount-badge {
            background: #dc2626;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .color-swatch {
            display: inline-block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 1px solid #e5e7eb;
            vertical-align: middle;
            margin-right: 4px;
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

        /* Grid view button positioning (Default) */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
            position: absolute;
            bottom: 1rem;
            left: 1rem;
            right: 1rem;
            opacity: 1;
        }

        .btn-add-to-cart {
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
        }

        /* Mobile Filter Styles */
        @media (max-width: 1023px) {
            .mobile-filter-drawer {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 300px;
                background: white;
                z-index: 60;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                overflow-y: auto;
                visibility: hidden; /* Hide by default to prevent flash */
            }

            .mobile-filter-drawer.open {
                transform: translateX(0);
                visibility: visible;
            }

            .mobile-filter-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 50;
                opacity: 0;
                pointer-events: none;
                transition: opacity 0.3s ease;
            }

            .mobile-filter-overlay.open {
                opacity: 1;
                pointer-events: auto;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-stone-50 py-4">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('customer.home.index') }}"
                            class="inline-flex items-center text-sm text-stone-700 hover:text-emerald-700">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                            <span class="ml-3 text-sm font-medium text-gray-700">All Products</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">Premium Ayurvedic Collection</h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Discover authentic formulations for your wellness journey, crafted with nature's purest ingredients.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (isset($error))
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ $error }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Mobile Filter Toggle -->
            <div class="lg:hidden mb-4 w-full">
                <button id="mobileFilterToggle" class="w-full flex items-center justify-center gap-2 bg-white p-3 rounded-lg shadow text-gray-700 font-medium hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                    <i class="fas fa-filter"></i> Filters & Sort
                </button>
            </div>

            <!-- Mobile Filter Overlay -->
            <div id="mobileFilterOverlay" class="mobile-filter-overlay"></div>

            <!-- Sidebar Filters -->
            <div id="filterSidebar" class="mobile-filter-drawer lg:static lg:block lg:w-1/4 lg:h-auto lg:bg-transparent lg:shadow-none lg:transform-none lg:z-auto">
                <div class="bg-white lg:rounded-xl lg:shadow p-5 sticky top-6 filter-section h-full lg:h-auto overflow-y-auto lg:overflow-visible">
                    <!-- Mobile Header -->
                    <div class="flex justify-between items-center mb-5 lg:hidden pb-4 border-b">
                        <h3 class="text-xl font-bold text-gray-800">Filters</h3>
                        <button id="closeMobileFilter" class="p-2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Filter Header -->
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-lg font-bold text-gray-800">Filters</h3>
                        @if (request()->hasAny([
                                'search',
                                'min_price',
                                'max_price',
                                'category_id',
                                'brand_id',
                                'in_stock',
                                'is_featured',
                                'is_new',
                                'is_bestseller',
                            ]))
                            <a href="{{ route('customer.products.list') }}"
                                class="text-sm text-emerald-700 hover:text-emerald-800">Clear All</a>
                        @endif
                    </div>

                    <!-- Main Filter Form -->
                    <form id="filterForm" method="GET" action="{{ route('customer.products.list') }}">
                        <!-- Search Form -->
                        <div class="mb-5 relative">
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Search products..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                    <!-- Categories -->
                    @if (isset($filters['categories']) && count($filters['categories']) > 0)
                        <div class="mb-5">
                            <h4 class="font-semibold text-gray-800 mb-3">Categories</h4>
                            <div class="space-y-2 max-h-60 overflow-y-auto">
                                @foreach ($filters['categories'] as $category)
                                    <label
                                        class="flex items-center justify-between p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="category_id" value="{{ $category['id'] }}"
                                                class="category-filter h-4 w-4 text-emerald-600 rounded"
                                                {{ request('category_id') == $category['id'] ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-700 ml-3">{{ $category['name'] }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $category['count'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Price Range -->
                    <div class="mb-5">
                        <h4 class="font-semibold text-gray-800 mb-3">Price Range</h4>
                        <div class="space-y-4">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>₹{{ number_format($filters['price_range']['min'] ?? 0) }}</span>
                                <span>₹{{ number_format($filters['price_range']['max'] ?? 5000) }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <input type="number" name="min_price" value="{{ $minPrice ?? '' }}" placeholder="Min"
                                    min="0" max="{{ $filters['price_range']['max'] ?? 5000 }}"
                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                <input type="number" name="max_price" value="{{ $maxPrice ?? '' }}" placeholder="Max"
                                    min="0" max="{{ $filters['price_range']['max'] ?? 5000 }}"
                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            </div>
                            <button type="submit"
                                class="w-full py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm">
                                Apply Price
                            </button>
                        </div>
                    </div>

                    <!-- Brand Filter -->
                    @if (isset($filters['brands']) && count($filters['brands']) > 0)
                        <div class="mb-5">
                            <h4 class="font-semibold text-gray-800 mb-3">Brands</h4>
                            <div class="space-y-2 max-h-60 overflow-y-auto">
                                @foreach ($filters['brands'] as $brand)
                                    <label
                                        class="flex items-center justify-between p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                                        <div class="flex items-center">
                                            <input type="checkbox" name="brand_id" value="{{ $brand['id'] }}"
                                                class="brand-filter h-4 w-4 text-emerald-600 rounded"
                                                {{ request('brand_id') == $brand['id'] ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-700 ml-3">{{ $brand['name'] }}</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $brand['count'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Availability -->
                    <div class="mb-5">
                        <h4 class="font-semibold text-gray-800 mb-3">Availability</h4>
                        <label class="flex items-center p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="in_stock" value="1" class="h-4 w-4 text-emerald-600 rounded"
                                {{ ($inStock ?? false) ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="text-gray-700 ml-3">In Stock Only</span>
                        </label>
                    </div>

                    </form>
                    <!-- End Main Filter Form -->

                    <!-- Special Filters -->
                    <div class="space-y-3">
                        <h4 class="font-semibold text-gray-800 mb-2">Special Collections</h4>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('customer.products.list', array_merge(request()->query(), ['is_featured' => 1])) }}"
                                class="text-center py-2 px-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 text-sm">
                                <i class="fas fa-star mr-1"></i> Featured
                            </a>
                            <a href="{{ route('customer.products.list', array_merge(request()->query(), ['is_new' => 1])) }}"
                                class="text-center py-2 px-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 text-sm">
                                <i class="fas fa-bolt mr-1"></i> New arrivals
                            </a>
                            <a href="{{ route('customer.products.list', array_merge(request()->query(), ['is_bestseller' => 1])) }}"
                                class="text-center py-2 px-3 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm">
                                <i class="fas fa-fire mr-1"></i> Best sellers
                            </a>
                            <a href="{{ route('customer.products.list', array_merge(request()->query(), ['has_discount' => 1])) }}"
                                class="text-center py-2 px-3 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 text-sm">
                                <i class="fas fa-tag mr-1"></i> On Sale
                            </a>
                        </div>
                    </div>

                    <!-- Mobile Apply Button (Bottom Sticky) -->
                    <div class="lg:hidden mt-6 pt-4 border-t sticky bottom-0 bg-white">
                        <button onclick="document.getElementById('mobileFilterOverlay').click()" class="w-full py-3 bg-emerald-600 text-white rounded-lg font-bold shadow-lg hover:bg-emerald-700">
                            View Results
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
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
                        @if (!empty($search))
                            <p class="text-sm text-gray-600 mt-1">
                                Search results for: "<span class="font-semibold">{{ $search }}</span>"
                            </p>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <!-- Sort Form -->
                        <form method="GET" action="{{ route('customer.products.list') }}">
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
                                class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:outline-none">
                                <option value="newest" {{ ($sortBy ?? 'newest') == 'newest' ? 'selected' : '' }}>Newest
                                    First</option>
                                <option value="featured" {{ ($sortBy ?? '') == 'featured' ? 'selected' : '' }}>Featured
                                </option>
                                <option value="price_asc" {{ ($sortBy ?? '') == 'price_asc' ? 'selected' : '' }}>Price:
                                    Low to High</option>
                                <option value="price_desc" {{ ($sortBy ?? '') == 'price_desc' ? 'selected' : '' }}>Price:
                                    High to Low</option>
                                <option value="name_asc" {{ ($sortBy ?? '') == 'name_asc' ? 'selected' : '' }}>Name: A to
                                    Z</option>
                                <option value="name_desc" {{ ($sortBy ?? '') == 'name_desc' ? 'selected' : '' }}>Name: Z
                                    to A</option>
                                <option value="popular" {{ ($sortBy ?? '') == 'popular' ? 'selected' : '' }}>Most Popular
                                </option>
                            </select>
                        </form>

                        <!-- View toggle removed -->
                    </div>
                </div>

                <!-- Products Grid -->
                @if (count($products ?? []) > 0)
                    <div id="productsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div
                                class="product-card bg-white rounded-xl shadow overflow-hidden group grid-view flex flex-col relative">
                                <!-- Product Image -->
                                <div class="product-image-container relative bg-stone-50">
                                    <a href="{{ route('customer.products.details', $product['slug']) }}">
                                        <img src="{{ asset('storage/' . ltrim($product['main_image'], '/')) }}"
                                            alt="{{ $product['name'] }}" class="product-image"
                                            onerror="this.src='/images/placeholder-product.jpg'">
                                    </a>

                                    <!-- Badges -->
                                    <div class="absolute top-3 right-3 space-y-1">
                                        @if (($product['discount_percent'] ?? 0) > 0)
                                            <span class="discount-badge">{{ $product['discount_percent'] }}% OFF</span>
                                        @endif
                                        @if ($product['is_new'] ?? false)
                                            <span class="bg-green-600 text-white text-xs px-2 py-1 rounded">NEW</span>
                                        @endif
                                        @if ($product['is_featured'] ?? false)
                                            <span
                                                class="bg-purple-600 text-white text-xs px-2 py-1 rounded">FEATURED</span>
                                        @endif
                                        @if ($product['is_bestseller'] ?? false)
                                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded">BESTSELLER</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="p-4 flex flex-col flex-grow relative">
                                    <a href="{{ route('customer.products.details', $product['slug']) }}" class="block">
                                        <h3
                                            class="font-semibold text-gray-800 mb-2 hover:text-emerald-700 transition-colors line-clamp-2 min-h-[3rem]">
                                            {{ $product['name'] }}
                                        </h3>
                                    </a>

                                    <!-- Rating -->
                                    @if (($product['rating'] ?? 0) > 0)
                                        <div class="flex items-center gap-1 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($product['rating']))
                                                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                                                @elseif($i == ceil($product['rating']) && $product['rating'] % 1 >= 0.5)
                                                    <i class="fas fa-star-half-alt text-yellow-400 text-sm"></i>
                                                @else
                                                    <i class="far fa-star text-gray-300 text-sm"></i>
                                                @endif
                                            @endfor
                                            <span
                                                class="text-xs text-gray-500 ml-1">({{ $product['review_count'] ?? 0 }})</span>
                                        </div>
                                    @endif

                                    <!-- Price -->
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-xl font-bold text-gray-900">
                                            ₹{{ number_format($product['price'] ?? 0) }}
                                        </span>
                                        @if (($product['compare_price'] ?? 0) > ($product['price'] ?? 0))
                                            <span class="text-sm text-gray-400 line-through">
                                                ₹{{ number_format($product['compare_price']) }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="action-buttons">
                                        <button type="button"
                                            class="btn-add-to-cart add-to-cart-btn"
                                            data-product-id="{{ $product['id'] }}"
                                            data-variant-id="{{ $product['default_variant_id'] ?? $product['id'] }}"
                                            {{ !($product['is_in_stock'] ?? true) ? 'disabled' : '' }}>
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Add to Cart
                                        </button>
                                        <button onclick="addToWishlist({{ $product['id'] }}, {{ $product['default_variant_id'] ?? $product['id'] }})"
                                            class="btn-wishlist wishlist-btn"
                                            data-product-id="{{ $product['id'] }}"
                                            title="Add to Wishlist">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if (isset($paginator['last_page']) && $paginator['last_page'] > 1)
                        <div class="mt-12">
                            <div class="flex justify-center">
                                <nav class="flex items-center gap-1">
                                    <!-- Previous Page -->
                                    @if ($paginator['current_page'] > 1)
                                        <a href="{{ route('customer.products.list', array_merge(request()->query(), ['page' => $paginator['current_page'] - 1])) }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    @endif

                                    <!-- Page Numbers -->
                                    @php
                                        $start = max(1, $paginator['current_page'] - 2);
                                        $end = min($paginator['last_page'], $paginator['current_page'] + 2);
                                    @endphp

                                    @for ($i = $start; $i <= $end; $i++)
                                        <a href="{{ route('customer.products.list', array_merge(request()->query(), ['page' => $i])) }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-lg
                                                {{ $i == $paginator['current_page'] ? 'bg-emerald-600 text-white' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700' }}">
                                            {{ $i }}
                                        </a>
                                    @endfor

                                    <!-- Next Page -->
                                    @if ($paginator['current_page'] < $paginator['last_page'])
                                        <a href="{{ route('customer.products.list', array_merge(request()->query(), ['page' => $paginator['current_page'] + 1])) }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-lg text-gray-600 hover:bg-emerald-50 hover:text-emerald-700">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    @endif
                @else
                    <!-- No Products Found -->
                    <div class="text-center py-16 bg-white rounded-xl shadow">
                        <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Products Found</h3>
                        <p class="text-gray-600 mb-6">Try adjusting your filters or search terms</p>
                        <a href="{{ route('customer.products.list') }}"
                            class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                            Reset All Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- CSRF Token setup -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // CSRF Token setup for Axios
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Configure Axios for API calls
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['Accept'] = 'application/json';

        // Wishlist functionality
        async function addToWishlist(productId, variantId = null) {
            const variantIdToUse = variantId || productId;

            try {
                const response = await axios.post('{{ route("customer.wishlist.add") }}', {
                    product_variant_id: variantIdToUse
                });

                if (response.data.success) {
                    const heartIcon = document.querySelector(`[data-product-id="${productId}"] i`);
                    if (heartIcon) {
                        heartIcon.className = 'fas fa-heart text-red-500';
                    }
                    showToast('Product added to wishlist!', 'success');
                    if (typeof updateWishlistCount === 'function') {
                        updateWishlistCount(data.count);
                    }
                }
            } catch (error) {
                console.error('Wishlist Error:', error);
                const message = error.response?.data?.message || 'Failed to add product to wishlist.';
                showToast(message, error.response?.status === 400 ? 'success' : 'error'); // If already exists, treat as success/info
            }
        }

        // Mobile Filter Logic
        function toggleMobileFilters(show) {
            const sidebar = document.getElementById('filterSidebar');
            const overlay = document.getElementById('mobileFilterOverlay');
            if (show) {
                sidebar.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
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

            // Add to cart functionality
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const productId = this.getAttribute('data-product-id');
                    const variantId = this.getAttribute('data-variant-id') || productId;
                    const btn = this;
                    const originalText = btn.innerHTML;

                    if (btn.disabled) return;

                    // Show loading state
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Adding...';
                    btn.disabled = true;

                    try {
                        const response = await axios.post('/cart/add', {
                            variant_id: variantId,
                            quantity: 1
                        });

                        if (response.data.success) {
                            showToast('Product added to cart successfully!', 'success');
                            updateCartCount(response.data.cart_count || 0);
                        } else {
                            showToast(response.data.message || 'Failed to add to cart', 'error');
                        }
                    } catch (error) {
                        console.error('Add to cart error:', error);
                        showToast('An error occurred. Please try again.', 'error');
                    } finally {
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                    }
                });
            });

            // Price form validation
            document.getElementById('filterForm')?.addEventListener('submit', function(e) {
                const minPrice = this.querySelector('input[name="min_price"]').value;
                const maxPrice = this.querySelector('input[name="max_price"]').value;

                if (minPrice && maxPrice && parseInt(minPrice) > parseInt(maxPrice)) {
                    e.preventDefault();
                    showToast('Minimum price cannot be greater than maximum price', 'error');
                }
            });

            // Set default view mode to grid always
            localStorage.setItem('productViewMode', 'grid');
        });

        // Update cart count
        function updateCartCount(count) {
            const cartCountElements = document.querySelectorAll('.cart-count');
            cartCountElements.forEach(element => {
                element.textContent = count;
                element.style.display = count > 0 ? 'flex' : 'none';
            });
        }

        // Toast notification
        function showToast(message, type = 'success') {
            document.querySelectorAll('.custom-toast').forEach(toast => toast.remove());

            const toast = document.createElement('div');
            toast.className = `custom-toast fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
                type === 'success'
                    ? 'bg-green-100 text-green-800 border border-green-200'
                    : 'bg-red-100 text-red-800 border border-red-200'
            }`;
            toast.innerHTML = `
                <div class="flex items-center">
                    <iconify-icon icon="${type === 'success' ? 'lucide:check-circle' : 'lucide:alert-circle'}" width="20" class="mr-2"></iconify-icon>
                    <span>${message}</span>
                </div>
            `;

            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateY(0)';
            }, 10);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-20px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    </script>
@endpush
