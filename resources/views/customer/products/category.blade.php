@extends('customer.layouts.master')

@section('title', $category->name . ' - Ved Herbs & Ayurveda')
@section('meta_description', $category->meta_description ?? 'Browse our ' . $category->name . ' collection of natural healing and wellness solutions.')

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
    </style>
@endsection

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
                        <a href="{{ route('customer.home.index') }}" class="text-stone-600 hover:text-emerald-700">
                            <i class="fas fa-home mr-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <a href="{{ route('customer.products.list') }}" class="text-stone-600 hover:text-emerald-700">Products</a>
                        </div>
                    </li>
                    @if($category->parent)
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                                <a href="{{ route('customer.category.products', $category->parent->slug) }}" class="text-stone-600 hover:text-emerald-700">{{ $category->parent->name }}</a>
                            </div>
                        </li>
                    @endif
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <span class="text-stone-800 font-semibold">{{ $category->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>
                @if($category->description)
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

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow p-5 sticky top-6 filter-section">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-lg font-bold text-gray-800">Filters</h3>
                        @if (request()->hasAny(['search', 'min_price', 'max_price', 'brand_id', 'in_stock']))
                            <a href="{{ route('customer.category.products', $category->slug) }}"
                                class="text-sm text-emerald-700 hover:text-emerald-800">Clear All</a>
                        @endif
                    </div>

                    <!-- Search Form -->
                    <form method="GET" action="{{ route('customer.category.products', $category->slug) }}" class="mb-5">
                        <div class="relative">
                            <input type="text" name="search" value="{{ $search ?? '' }}"
                                placeholder="Search in this category..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
                        </div>
                    </form>

                    <!-- Price Range -->
                    <div class="mb-5">
                        <h4 class="font-semibold text-gray-800 mb-3 text-sm">Price Range</h4>
                        <form method="GET" action="{{ route('customer.category.products', $category->slug) }}" id="priceForm" class="space-y-4">
                            <div class="flex space-x-2">
                                <input type="number" name="min_price" value="{{ $minPrice ?? '' }}" placeholder="Min"
                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                                <input type="number" name="max_price" value="{{ $maxPrice ?? '' }}" placeholder="Max"
                                    class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            </div>
                            <button type="submit"
                                class="w-full py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm">
                                Apply
                            </button>
                        </form>
                    </div>

                    <!-- Availability -->
                    <div class="mb-5">
                        <h4 class="font-semibold text-gray-800 mb-3 text-sm">Availability</h4>
                        <label class="flex items-center p-2 hover:bg-emerald-50 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="in_stock" value="1" class="h-4 w-4 text-emerald-600 rounded"
                                {{ ($inStock ?? false) ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="text-gray-700 ml-3 text-sm">In Stock Only</span>
                        </label>
                    </div>

                    <!-- Related Categories -->
                    @if(isset($relatedCategories) && count($relatedCategories) > 0)
                        <div class="mb-5 border-t pt-5">
                            <h4 class="font-semibold text-gray-800 mb-3 text-sm">Other in {{ $category->parent->name ?? 'Category' }}</h4>
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
                                No products found in this category
                            @endif
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <form method="GET" action="{{ route('customer.category.products', $category->slug) }}">
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
                        </form>

                        <div class="flex items-center gap-2">
                            <button id="gridView" class="p-2 bg-emerald-100 text-emerald-700 rounded-lg">
                                <i class="fas fa-th"></i>
                            </button>
                            <button id="listView" class="p-2 text-gray-500 hover:text-emerald-700 rounded-lg">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                @if (count($products ?? []) > 0)
                    <div id="productsContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div class="product-card bg-white rounded-xl shadow overflow-hidden group grid-view flex flex-col relative">
                                <div class="product-image-container relative bg-stone-50">
                                    <a href="{{ route('customer.products.details', $product['slug']) }}">
                                        <img src="{{ asset('storage/' . $product['main_image']) }}"
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

                                <div class="p-4 flex flex-col flex-grow relative">
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
                        </div>
                    @endif
                @else
                    <div class="text-center py-16 bg-white rounded-xl shadow">
                        <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Products Found</h3>
                        <p class="text-gray-600 mb-6">Currently there are no products in this category.</p>
                        <a href="{{ route('customer.products.list') }}"
                            class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                            Browse All Products
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

        // Wishlist functionality
        async function addToWishlist(productId, variantId = null) {
            const variantIdToUse = variantId || productId;
            try {
                const response = await axios.post('{{ route("customer.wishlist.add") }}', {
                    product_variant_id: variantIdToUse
                });
                if (response.data.success) {
                    const heartIcon = document.querySelector(`[data-product-id="${productId}"] i`);
                    if (heartIcon) heartIcon.className = 'fas fa-heart text-red-500';
                    showToast('Added to wishlist!', 'success');
                }
            } catch (error) {
                const message = error.response?.data?.message || 'Failed to add to wishlist.';
                showToast(message, error.response?.status === 400 ? 'success' : 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // View mode toggle
            const gridBtn = document.getElementById('gridView');
            const listBtn = document.getElementById('listView');
            const container = document.getElementById('productsContainer');

            gridBtn?.addEventListener('click', () => setViewMode('grid'));
            listBtn?.addEventListener('click', () => setViewMode('list'));

            function setViewMode(mode) {
                if (!container) return;
                if (mode === 'grid') {
                    container.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6';
                    gridBtn.classList.add('bg-emerald-100', 'text-emerald-700');
                    listBtn.classList.remove('bg-emerald-100', 'text-emerald-700');
                    listBtn.classList.add('text-gray-500');
                } else {
                    container.className = 'grid grid-cols-1 gap-6';
                    listBtn.classList.add('bg-emerald-100', 'text-emerald-700');
                    gridBtn.classList.remove('bg-emerald-100', 'text-emerald-700');
                    gridBtn.classList.add('text-gray-500');
                }

                container.querySelectorAll('.product-card').forEach(card => {
                    const imgCont = card.querySelector('.product-image-container');
                    if (mode === 'grid') {
                        card.classList.add('grid-view', 'flex-col');
                        card.classList.remove('list-view', 'flex-row');
                        imgCont.classList.remove('w-64', 'h-64', 'flex-shrink-0');
                        imgCont.classList.add('aspect-[4/5]');
                    } else {
                        card.classList.remove('grid-view', 'flex-col');
                        card.classList.add('list-view', 'flex-row');
                        imgCont.classList.remove('aspect-[4/5]');
                        imgCont.classList.add('w-64', 'h-64', 'flex-shrink-0');
                    }
                });
                localStorage.setItem('productViewMode', mode);
            }

            // Init view mode
            const savedMode = localStorage.getItem('productViewMode') || 'grid';
            setViewMode(savedMode);

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
                            updateCartCount(response.data.cart_count);
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

        function updateCartCount(count) {
            const el = document.querySelector('.cart-count');
            if (el) {
                el.textContent = count;
                el.style.display = count > 0 ? 'flex' : 'none';
            }
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'
            }`;
            toast.innerHTML = `<div class="flex items-center"><iconify-icon icon="${type === 'success' ? 'lucide:check-circle' : 'lucide:alert-circle'}" width="20" class="mr-2"></iconify-icon><span>${message}</span></div>`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>
@endpush
