@extends('customer.layouts.master')

@section('title', $product['name'] . ' - Ved Herbs & Ayurveda')
@section('meta_description', $product['meta_description'] ?? ($product['short_description'] ?? 'Product details and specifications'))

@push('styles')
    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }

        /* Tab styles */
        .tab-pane {
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .tab-pane.active {
            display: block;
            opacity: 1;
        }

        /* Ensure tab container is always visible */
        #product-tabs {
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
            padding-top: 10px;
            margin-top: 0;
        }

        /* Image sliding effect */
        .image-slide-enter {
            transform: translateX(100%);
            opacity: 0;
        }

        .image-slide-enter-active {
            transform: translateX(0);
            opacity: 1;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .image-slide-exit {
            transform: translateX(0);
            opacity: 1;
        }

        .image-slide-exit-active {
            transform: translateX(-100%);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        /* Wishlist heart animation */
        .wishlist-btn.active .heart-icon {
            color: #dc2626;
            fill: #dc2626;
        }

        .wishlist-btn.active:hover .heart-icon {
            color: #b91c1c;
            fill: #b91c1c;
        }

        /* Amazon-style Zoom Modal Styles */
        .zoom-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 1000;
            cursor: zoom-out;
        }

        .zoom-modal-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .zoom-modal-image {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            transform-origin: center center;
            transition: transform 0.1s ease-out;
            cursor: grab;
        }

        .zoom-modal-image:active {
            cursor: grabbing;
        }

        .zoom-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1001;
        }

        .zoom-modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .zoom-modal-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1001;
            opacity: 1;
        }

        .zoom-modal-nav.prev {
            left: 20px;
        }

        .zoom-modal-nav.next {
            right: 20px;
        }

        .zoom-modal-nav:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .zoom-modal-counter {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            z-index: 1001;
        }

        /* Product image hover effect */
        .product-image-hover {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        /* Zoom button styles */
        .zoom-toggle-btn {
            display: none;
        }

        /* HOVER ZOOM STYLES */
        .zoom-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .main-image-zoom {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            cursor: crosshair;
            background-color: #F0EFEC;
        }

        .zoom-lens {
            position: absolute;
            border: 2px solid rgba(255, 255, 255, 0.7);
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow:
                0 0 10px rgba(0, 0, 0, 0.2),
                inset 0 0 15px rgba(255, 255, 255, 0.5);
            pointer-events: none;
            z-index: 10;
            display: none;
            border-radius: 4px;
            cursor: crosshair;
            transition: opacity 0.2s ease;
        }

        .zoom-preview-container {
            position: absolute;
            left: calc(100% + 20px);
            top: 0;
            width: 500px;
            height: 500px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            z-index: 100;
            display: none;
            border: 1px solid #e5e7eb;
        }

        .zoom-preview {
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-position: 0 0;
        }

        /* Add this media query to ensure proper display on different screens */
        @media (max-width: 1280px) {
            .zoom-preview-container {
                width: 400px;
                height: 400px;
            }
        }

        @media (max-width: 1100px) {
            .zoom-preview-container {
                display: none !important;
            }
        }

        /* Loading indicator */
        .zoom-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #333;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 16px;
            border-radius: 20px;
            display: none;
        }

        @media (max-width: 1024px) {
            .zoom-preview-container {
                display: none !important;
            }

            .zoom-lens {
                display: none !important;
            }
        }

        #mainImage {
            transform: none !important;
        }
    </style>
@endpush

@section('content')
    <!-- Image Zoom Modal (Amazon Style) -->
    <div class="zoom-modal-overlay" id="zoomModal">
        <button class="zoom-modal-close" id="zoomModalClose">
            <iconify-icon icon="lucide:x" width="24"></iconify-icon>
        </button>
        <button class="zoom-modal-nav prev" id="zoomModalPrev">
            <iconify-icon icon="lucide:chevron-left" width="24"></iconify-icon>
        </button>
        <button class="zoom-modal-nav next" id="zoomModalNext">
            <iconify-icon icon="lucide:chevron-right" width="24"></iconify-icon>
        </button>
        <div class="zoom-modal-content">
            <img class="zoom-modal-image" id="zoomModalImage" src="" alt="">
        </div>
        <div class="zoom-modal-counter" id="zoomModalCounter"></div>
    </div>

    <!-- Breadcrumb Navigation -->
    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6">
        <nav class="flex text-xs sm:text-sm text-stone-500 mb-4 sm:mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 sm:space-x-2 md:space-x-3 flex-wrap">
                <li class="inline-flex items-center">
                    <a href="{{ route('customer.home.index') }}"
                        class="inline-flex items-center hover:text-emerald-700 py-1">
                        <iconify-icon icon="lucide:home" width="14" class="sm:w-4"></iconify-icon>
                        <span class="ml-1 sm:ml-2">Home</span>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <a href="{{ route('customer.products.list') }}"
                            class="ml-1 sm:ml-2 hover:text-emerald-700 py-1">Shop</a>
                    </div>
                </li>
                @if(isset($product['category']))
                    <li>
                        <div class="flex items-center">
                            <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                            <a href="{{ route('customer.category.products', $product['category']['slug'] ?? '#') }}"
                                class="ml-1 sm:ml-2 hover:text-emerald-700 py-1">{{ $product['category']['name'] }}</a>
                        </div>
                    </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                        <span
                            class="ml-1 sm:ml-2 text-stone-900 font-medium py-1 truncate max-w-[150px] sm:max-w-none">{{ $product['name'] }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Product Section -->
        <div class="grid lg:grid-cols-2 gap-8 sm:gap-12 mb-12 sm:mb-16">
            <!-- Product Images -->
            <div class="space-y-3 sm:space-y-4">
                <!-- Main Image Container -->
                <div class="relative group aspect-square rounded-xl sm:rounded-2xl overflow-hidden bg-[#F0EFEC] border border-stone-200"
                    id="main-image-container">
                    <!-- Wishlist badge on image -->
                    <button id="image-wishlist-btn"
                        class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-stone-200 shadow hover:bg-white transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <iconify-icon icon="lucide:heart" width="18" class="heart-icon text-stone-600"></iconify-icon>
                    </button>

                    <!-- Prev Button -->
                    <button
                        class="absolute left-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-stone-200 shadow hover:bg-white transition flex items-center justify-center opacity-0 group-hover:opacity-100"
                        id="prev-image-btn">
                        <iconify-icon icon="lucide:chevron-left" width="18"></iconify-icon>
                    </button>

                    <!-- Main Image with Hover Zoom -->
                    <div class="relative w-full h-full overflow-hidden product-image-hover zoom-container"
                        id="main-image-wrapper">
                        <img src="{{ $product['main_image'] ? asset('storage/' . $product['main_image']) : asset('images/placeholder-product.jpg') }}"
                            alt="{{ $product['name'] }}" class="main-image-zoom" id="main-product-image" loading="lazy"
                            data-current-index="0">
                        <div class="zoom-loading" id="zoomLoading">Loading...</div>
                    </div>

                    <!-- Zoom Button (Hidden - using click on image instead) -->
                    <button
                        class="zoom-toggle-btn absolute bottom-3 right-3 z-10 w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-stone-200 shadow hover:bg-white transition flex items-center justify-center opacity-0 group-hover:opacity-100"
                        id="zoom-toggle-btn" title="Click to zoom">
                        <iconify-icon icon="lucide:zoom-in" width="18"></iconify-icon>
                    </button>

                    <!-- Next Button -->
                    <button
                        class="absolute right-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 rounded-full bg-white/90 backdrop-blur-sm border border-stone-200 shadow hover:bg-white transition flex items-center justify-center opacity-0 group-hover:opacity-100"
                        id="next-image-btn">
                        <iconify-icon icon="lucide:chevron-right" width="18"></iconify-icon>
                    </button>
                </div>

                <!-- Zoom Preview Container -->
                <div class="zoom-preview-container" id="zoomPreviewContainer">
                    <div class="zoom-preview" id="zoomPreview"></div>
                </div>

                <!-- Thumbnail Gallery (Dynamic) -->
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-2 sm:gap-3" id="thumbnail-gallery">
                    @php
                        $images = $product['images'] ?? [];
                        if (empty($images) && isset($product['main_image'])) {
                            $images = [['url' => $product['main_image'], 'alt' => $product['name']]];
                        }
                    @endphp
                    @foreach ($images as $index => $img)
                        <button
                            class="thumbnail-btn aspect-square rounded-lg border {{ $index === 0 ? 'border-2 border-emerald-500' : 'border-stone-300' }} overflow-hidden hover:border-emerald-500 transition-all"
                            data-image-index="{{ $index }}"
                            data-image-src="{{ asset('storage/' . ($img['url'] ?? $img['image'] ?? $img)) }}"
                            data-image-alt="{{ $product['name'] }} - View {{ $index + 1 }}">
                            <img src="{{ asset('storage/' . ($img['url'] ?? $img['image'] ?? $img)) }}"
                                alt="{{ $product['name'] }}" class="w-full h-full object-cover" loading="lazy">
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6 sm:space-y-8">
                <!-- Header -->
                <div>
                    <!-- Dosha Badges -->
                    <div class="flex flex-wrap gap-2 mb-3 sm:mb-4">
                        @if(isset($product['category']))
                            <span
                                class="px-2 sm:px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-medium border border-emerald-200 whitespace-nowrap">
                                {{ $product['category']['name'] }}
                            </span>
                        @endif
                        @if($product['is_new'] ?? false)
                            <span
                                class="px-2 sm:px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-medium border border-blue-200 whitespace-nowrap">
                                New
                            </span>
                        @endif
                        <span
                            class="px-2 sm:px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium border border-green-200 whitespace-nowrap">
                            <iconify-icon icon="lucide:check-circle" width="10" class="sm:w-3 mr-1"></iconify-icon>
                            {{ ($product['is_in_stock'] ?? true) ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-semibold text-stone-900 mb-1 sm:mb-2">
                        {{ $product['name'] }}
                    </h1>
                    <p class="text-base sm:text-lg font-medium text-emerald-700 italic mb-2 sm:mb-3">
                        {{ $product['short_description'] ?? '' }}
                    </p>

                    <!-- Rating -->
                    <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                        <div class="flex items-center gap-1">
                            @php
                                $rating = $product['rating'] ?? 0;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($rating))
                                    <iconify-icon icon="lucide:star" width="14"
                                        class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                                @elseif($i == ceil($rating) && $rating % 1 >= 0.5)
                                    <iconify-icon icon="lucide:star-half" width="14"
                                        class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                                @else
                                    <iconify-icon icon="lucide:star" width="14" class="sm:w-4 text-stone-300"></iconify-icon>
                                @endif
                            @endfor
                            <span
                                class="ml-1 sm:ml-2 text-xs sm:text-sm font-medium text-stone-700">{{ number_format($rating, 1) }}</span>
                        </div>
                        <span class="text-stone-300 sm:text-stone-400">•</span>
                        <a href="#reviews" class="text-xs sm:text-sm text-emerald-700 hover:text-emerald-800 font-medium">
                            {{ $product['review_count'] ?? 0 }} reviews
                        </a>
                    </div>
                </div>

                <!-- Price -->
                <div class="flex flex-wrap items-center gap-2 sm:gap-4">
                    <span
                        class="text-2xl sm:text-3xl font-semibold text-stone-900">₹{{ number_format($product['price'] ?? 0) }}</span>
                    @if(($product['compare_price'] ?? 0) > ($product['price'] ?? 0))
                        <span
                            class="text-base sm:text-lg text-stone-400 line-through">₹{{ number_format($product['compare_price']) }}</span>
                        <span
                            class="px-2 sm:px-3 py-1 bg-red-100 text-red-700 text-xs sm:text-sm font-medium rounded-full whitespace-nowrap">
                            Save
                            {{ round((($product['compare_price'] - $product['price']) / $product['compare_price']) * 100) }}%
                        </span>
                    @endif
                </div>

                <!-- Short Description -->
                <p class="text-base sm:text-lg text-stone-600 leading-relaxed">
                    {{ $product['description'] ? Str::limit(strip_tags($product['description']), 200) : '' }}
                </p>

                <!-- Product Options (Dynamic) -->
                <div class="space-y-4 sm:space-y-6">
                    @if (isset($product['attribute_groups']) && count($product['attribute_groups']) > 0)
                        @foreach ($product['attribute_groups'] as $attributeName => $attributeGroup)
                            <div>
                                <h4 class="font-medium text-stone-900 mb-2 sm:mb-3">Select {{ $attributeName }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($attributeGroup['options'] as $option)
                                        <button
                                            class="attribute-btn px-3 sm:px-4 py-2 rounded-lg border border-stone-300 hover:border-emerald-500 hover:bg-emerald-50 text-stone-700 hover:text-emerald-800 transition-all text-sm sm:text-base flex items-center justify-center gap-2"
                                            data-attribute-name="{{ $attributeName }}" data-attribute-value="{{ $option['value'] }}"
                                            onclick="selectAttribute(this, '{{ $attributeName }}', '{{ $option['value'] }}')">
                                            @if (!empty($option['color_code']))
                                                <span class="w-4 h-4 rounded-full border border-gray-300"
                                                    style="background-color: {{ $option['color_code'] }}"></span>
                                            @endif
                                            {{ $option['label'] }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <!-- Quantity -->
                    <div>
                        <h4 class="font-medium text-stone-900 mb-2 sm:mb-3">Quantity</h4>
                        <div class="flex items-center gap-2 sm:gap-3 max-w-xs">
                            <button onclick="changeQuantity(-1)"
                                class="quantity-minus w-10 h-10 sm:w-12 sm:h-12 rounded-lg border border-stone-300 flex items-center justify-center hover:bg-stone-50">
                                <iconify-icon icon="lucide:minus" width="14" class="sm:w-4"></iconify-icon>
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="10"
                                class="quantity-input flex-1 h-10 sm:h-12 text-center border border-stone-300 rounded-lg font-medium text-stone-900 text-sm sm:text-base">
                            <button onclick="changeQuantity(1)"
                                class="quantity-plus w-10 h-10 sm:w-12 sm:h-12 rounded-lg border border-stone-300 flex items-center justify-center hover:bg-stone-50">
                                <iconify-icon icon="lucide:plus" width="14" class="sm:w-4"></iconify-icon>
                            </button>
                            <span class="text-xs sm:text-sm text-stone-500 ml-2 sm:ml-4"
                                id="stockCount">{{ $product['stock_quantity'] ?? 0 }} available</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 pt-4">
                    <button id="add-to-cart-btn"
                        class="product-detail-add-to-cart w-full h-12 sm:h-14 px-6 sm:px-8 rounded-xl bg-emerald-900 text-white font-semibold hover:bg-emerald-800 transition-all flex items-center justify-center gap-2 sm:gap-3 text-sm sm:text-base"
                        data-product-id="{{ $product['id'] }}"
                        data-variant-id="{{ $product['default_variant_id'] ?? $product['id'] }}" {{ !($product['is_in_stock'] ?? true) ? 'disabled' : '' }}>
                        <iconify-icon icon="lucide:shopping-bag" width="16" class="sm:w-5"></iconify-icon>
                        <span class="btn-text">Add to Cart</span>
                    </button>
                    <button id="wishlist-btn" onclick="addToWishlist({{ $product['id'] }})"
                        class="wishlist-btn w-full h-12 sm:h-14 px-6 sm:px-8 rounded-xl bg-white border-2 border-emerald-900 text-emerald-900 font-semibold hover:bg-emerald-50 transition-colors flex items-center justify-center gap-2 sm:gap-3 text-sm sm:text-base"
                        data-product-id="{{ $product['id'] }}">
                        <iconify-icon icon="lucide:heart" width="16" class="sm:w-5 heart-icon"></iconify-icon>
                        <span class="wishlist-text">Save to Wishlist</span>
                    </button>
                </div>

                <!-- Key Benefits -->
                <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                    <h3 class="font-semibold text-stone-900 mb-2 sm:mb-3 text-base sm:text-lg">
                        ✨ Key Benefits
                    </h3>

                    <ul class="space-y-1 sm:space-y-2">
                        <li class="flex items-start gap-2 sm:gap-3">
                            <iconify-icon icon="lucide:check-circle" width="14"
                                class="sm:w-4 text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                            <span class="text-sm sm:text-base text-stone-600">
                                Supports long-lasting performance
                            </span>
                        </li>

                        <li class="flex items-start gap-2 sm:gap-3">
                            <iconify-icon icon="lucide:check-circle" width="14"
                                class="sm:w-4 text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                            <span class="text-sm sm:text-base text-stone-600">
                                Enhances confidence and control
                            </span>
                        </li>

                        <li class="flex items-start gap-2 sm:gap-3">
                            <iconify-icon icon="lucide:check-circle" width="14"
                                class="sm:w-4 text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                            <span class="text-sm sm:text-base text-stone-600">
                                Herbal, skin-friendly formulation
                            </span>
                        </li>

                        <li class="flex items-start gap-2 sm:gap-3">
                            <iconify-icon icon="lucide:check-circle" width="14"
                                class="sm:w-4 text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                            <span class="text-sm sm:text-base text-stone-600">
                                Quick-absorbing & non-greasy gel
                            </span>
                        </li>

                        <li class="flex items-start gap-2 sm:gap-3">
                            <iconify-icon icon="lucide:check-circle" width="14"
                                class="sm:w-4 text-emerald-600 mt-0.5 flex-shrink-0"></iconify-icon>
                            <span class="text-sm sm:text-base text-stone-600">
                                Suitable for regular use
                            </span>
                        </li>
                    </ul>
                </div>

                <!-- Certifications -->
                <div class="pt-4 sm:pt-6 border-t border-stone-200">
                    <div class="flex flex-wrap gap-2 sm:gap-4">
                        <div class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm text-stone-500">
                            <iconify-icon icon="lucide:shield-check" width="12"
                                class="sm:w-4 text-emerald-600"></iconify-icon>
                            <span class="whitespace-nowrap">AYUSH Certified</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm text-stone-500">
                            <iconify-icon icon="lucide:shield-check" width="12"
                                class="sm:w-4 text-emerald-600"></iconify-icon>
                            <span class="whitespace-nowrap">USDA Organic</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm text-stone-500">
                            <iconify-icon icon="lucide:shield-check" width="12"
                                class="sm:w-4 text-emerald-600"></iconify-icon>
                            <span class="whitespace-nowrap">GMP Certified</span>
                        </div>
                        <div class="flex items-center gap-1 sm:gap-2 text-xs sm:text-sm text-stone-500">
                            <iconify-icon icon="lucide:shield-check" width="12"
                                class="sm:w-4 text-emerald-600"></iconify-icon>
                            <span class="whitespace-nowrap">ISO 9001:2015</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs for Detailed Information -->
        <div class="mb-12 sm:mb-20">
            <div class="border-b border-stone-200 overflow-x-auto">
                <nav class="-mb-px flex space-x-4 sm:space-x-8 min-w-max sm:min-w-0" id="product-tabs">
                    <button
                        class="tab-btn py-3 sm:py-4 px-1 border-b-2 border-emerald-900 text-emerald-900 font-medium text-xs sm:text-sm whitespace-nowrap"
                        data-tab="description">
                        Description
                    </button>
                    <button
                        class="tab-btn py-3 sm:py-4 px-1 text-stone-500 hover:text-stone-700 font-medium text-xs sm:text-sm whitespace-nowrap"
                        data-tab="how-to-use">
                        How to Use
                    </button>
                    <button
                        class="tab-btn py-3 sm:py-4 px-1 text-stone-500 hover:text-stone-700 font-medium text-xs sm:text-sm whitespace-nowrap"
                        data-tab="ingredients">
                        Ingredients
                    </button>
                    <button
                        class="tab-btn py-3 sm:py-4 px-1 text-stone-500 hover:text-stone-700 font-medium text-xs sm:text-sm whitespace-nowrap"
                        data-tab="reviews" id="reviews-tab">
                        Reviews ({{ count($reviews ?? []) }})
                    </button>
                </nav>
            </div>

            <div class="py-6 sm:py-8" id="tab-content">
                <!-- Description Tab Content -->
                <div class="tab-pane active space-y-6 sm:space-y-8" id="description-tab">
                    <div class="grid md:grid-cols-2 gap-6 sm:gap-8">
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Ayurvedic Perspective
                            </h3>
                            <p class="text-sm sm:text-base text-stone-600 leading-relaxed">
                                Power Gel is a carefully formulated Ayurvedic preparation based on centuries-old wisdom.
                                It combines herbs known for their rejuvenating and performance-enhancing properties. The
                                formulation follows the principles of Vajikarana therapy, focusing on enhancing
                                strength, endurance, and vitality through natural means.
                            </p>

                            <h4 class="font-semibold text-stone-900 mt-4 sm:mt-6 mb-2 sm:mb-3">Traditional Uses</h4>
                            <ul class="space-y-1 sm:space-y-2 text-stone-600">
                                <li class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:check" width="14"
                                        class="sm:w-4 text-emerald-600 mt-1"></iconify-icon>
                                    <span class="text-sm sm:text-base">Used in traditional Ayurvedic practices for
                                        enhancing performance</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:check" width="14"
                                        class="sm:w-4 text-emerald-600 mt=1"></iconify-icon>
                                    <span class="text-sm sm:text-base">Mentioned in ancient texts for promoting
                                        endurance and vitality</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:check" width="14"
                                        class="sm:w-4 text-emerald-600 mt=1"></iconify-icon>
                                    <span class="text-sm sm:text-base">Traditionally used by athletes and warriors for
                                        peak performance</span>
                                </li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Modern Benefits</h3>
                            <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                                <div class="space-y-3 sm:space-y-4">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <iconify-icon icon="lucide:zap" width="16"
                                                class="sm:w-5 text-emerald-700"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-900 text-sm sm:text-base">Instant Action</p>
                                            <p class="text-xs sm:text-sm text-stone-500">Works within minutes for immediate
                                                results</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <iconify-icon icon="lucide:clock" width="16"
                                                class="sm:w-5 text-emerald-700"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-900 text-sm sm:text-base">Long-Lasting</p>
                                            <p class="text-xs sm:text-sm text-stone-500">Provides extended performance
                                                support for hours</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <iconify-icon icon="lucide:shield" width="16"
                                                class="sm:w-5 text-emerald-700"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-900 text-sm sm:text-base">Safe & Natural</p>
                                            <p class="text-xs sm:text-sm text-stone-500">100% herbal formulation without
                                                side effects</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dosha Information -->
                    <div
                        class="bg-emerald-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 border border-emerald-200 mt-6 sm:mt-8">
                        <h3 class="text-xl sm:text-2xl font-serif font-medium text-emerald-900 mb-4 sm:mb-6">Dosha Balancing
                            Properties</h3>
                        <div class="grid md:grid-cols-3 gap-4 sm:gap-6">
                            <div class="bg-white rounded-xl p-4 sm:p-6 border border-emerald-100">
                                <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                                    <div
                                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-blue-100 flex items-center justify-center flex-shrink-0">
                                        <iconify-icon icon="lucide:wind" width="16"
                                            class="sm:w-5 text-blue-600"></iconify-icon>
                                    </div>
                                    <h4 class="font-semibold text-stone-900 text-sm sm:text-base">Vata Balancing</h4>
                                </div>
                                <p class="text-xs sm:text-sm text-stone-600">The warming and grounding herbs help
                                    balance excess Vata, reducing anxiety and promoting stability in performance
                                    situations.</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 sm:p-6 border border-emerald-100">
                                <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                                    <div
                                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                                        <iconify-icon icon="lucide:flame" width="16"
                                            class="sm:w-5 text-red-600"></iconify-icon>
                                    </div>
                                    <h4 class="font-semibold text-stone-900 text-sm sm:text-base">Pitta Enhancing</h4>
                                </div>
                                <p class="text-xs sm:text-sm text-stone-600">Increases healthy Pitta for enhanced
                                    performance while maintaining balance, promoting confidence and determination.</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 sm:p-6 border border-emerald-100">
                                <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                                    <div
                                        class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-yellow-100 flex items-center justify-center flex-shrink-0">
                                        <iconify-icon icon="lucide:droplet" width="16"
                                            class="sm:w-5 text-yellow-600"></iconify-icon>
                                    </div>
                                    <h4 class="font-semibold text-stone-900 text-sm sm:text-base">Kapha Energizing</h4>
                                </div>
                                <p class="text-xs sm:text-sm text-stone-600">Stimulates and energizes Kapha dosha,
                                    combating lethargy and promoting sustained energy and endurance.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- How to Use Tab Content -->
                <div class="tab-pane hidden space-y-6 sm:space-y-8" id="how-to-use-tab">
                    <div class="grid md:grid-cols-2 gap-6 sm:gap-8">
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Recommended Usage</h3>
                            <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                                <div class="space-y-3 sm:space-y-4">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <iconify-icon icon="lucide:clock" width="16"
                                                class="sm:w-5 text-emerald-700"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-900 text-sm sm:text-base">When to Apply</p>
                                            <p class="text-xs sm:text-sm text-stone-500">Apply 15-20 minutes before activity
                                                for best results</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <iconify-icon icon="lucide:droplet" width="16"
                                                class="sm:w-5 text-emerald-700"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-900 text-sm sm:text-base">Application Method
                                            </p>
                                            <p class="text-xs sm:text-sm text-stone-500">Apply a pea-sized amount and
                                                massage gently until absorbed</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                            <iconify-icon icon="lucide:repeat" width="16"
                                                class="sm:w-5 text-emerald-700"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-900 text-sm sm:text-base">Frequency</p>
                                            <p class="text-xs sm:text-sm text-stone-500">1-2 times daily as needed, or as
                                                directed by your healthcare practitioner</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Important Notes</h3>
                            <div class="space-y-3 sm:space-y-4">
                                <div class="p-3 sm:p-4 bg-amber-50 border border-amber-200 rounded-lg">
                                    <div class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:alert-circle" width="16"
                                            class="sm:w-5 text-amber-600 mt-0.5"></iconify-icon>
                                        <div>
                                            <p class="font-medium text-amber-800 text-sm sm:text-base">For External Use Only
                                            </p>
                                            <p class="text-amber-700 text-xs sm:text-sm mt-1">Avoid contact with eyes and
                                                sensitive areas. If irritation occurs, discontinue use.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 sm:p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                    <div class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:thermometer" width="16"
                                            class="sm:w-5 text-blue-600 mt-0.5"></iconify-icon>
                                        <div>
                                            <p class="font-medium text-blue-800 text-sm sm:text-base">Storage Instructions
                                            </p>
                                            <p class="text-blue-700 text-xs sm:text-sm mt-1">Store in a cool, dry place away
                                                from direct sunlight. Keep tightly closed when not in use.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 sm:p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                                    <div class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:check-circle" width="16"
                                            class="sm:w-5 text-emerald-600 mt-0.5"></iconify-icon>
                                        <div>
                                            <p class="font-medium text-emerald-800 text-sm sm:text-base">Best Results</p>
                                            <p class="text-emerald-700 text-xs sm:text-sm mt-1">For optimal results, combine
                                                with a healthy lifestyle, balanced diet, and regular exercise.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingredients Tab Content -->
                <div class="tab-pane hidden space-y-6 sm:space-y-8" id="ingredients-tab">
                    <div class="grid md:grid-cols-2 gap-6 sm:gap-8">
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Active Ingredients</h3>
                            <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                                <div class="space-y-4">
                                    <div class="pb-3 border-b border-stone-200">
                                        <p class="font-medium text-stone-900 text-sm sm:text-base">Ashwagandha Root Extract
                                            (Withania somnifera)</p>
                                        <p class="text-xs sm:text-sm text-stone-500 mt-1">Standardized to contain 2.5%
                                            withanolides - 300mg</p>
                                    </div>
                                    <div class="pb-3 border-b border-stone-200">
                                        <p class="font-medium text-stone-900 text-sm sm:text-base">Safed Musli (Chlorophytum
                                            borivilianum)</p>
                                        <p class="text-xs sm:text-sm text-stone-500 mt-1">Traditionally used for vitality
                                            and strength - 250mg</p>
                                    </div>
                                    <div class="pb-3 border-b border-stone-200">
                                        <p class="font-medium text-stone-900 text-sm sm:text-base">Shilajit (Purified)</p>
                                        <p class="text-xs sm:text-sm text-stone-500 mt-1">Rich in fulvic acid and minerals -
                                            200mg</p>
                                    </div>
                                    <div class="pb-3 border-b border-stone-200">
                                        <p class="font-medium text-stone-900 text-sm sm:text-base">Kaunch Beej (Mucuna
                                            pruriens)</p>
                                        <p class="text-xs sm:text-sm text-stone-500 mt-1">Natural source of L-DOPA - 150mg
                                        </p>
                                    </div>
                                    <div>
                                        <p class="font-medium text-stone-900 text-sm sm:text-base">Gokshura (Tribulus
                                            terrestris)</p>
                                        <p class="text-xs sm:text-sm text-stone-500 mt-1">Supports endurance and performance
                                            - 100mg</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Other Ingredients</h3>
                            <div class="space-y-2 sm:space-y-3">
                                <p class="text-sm sm:text-base text-stone-600">Aloe Vera Gel (base), Coconut Oil, Beeswax,
                                    Vitamin E, Natural Preservatives</p>

                                <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                                    <div class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:leaf" width="16"
                                            class="sm:w-5 text-emerald-600 mt-0.5"></iconify-icon>
                                        <div>
                                            <p class="font-medium text-emerald-800 text-sm sm:text-base">100% Natural &
                                                Herbal</p>
                                            <p class="text-emerald-700 text-xs sm:text-sm mt-1">No parabens, sulfates,
                                                artificial fragrances, or synthetic chemicals. Cruelty-free and
                                                vegan-friendly.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 sm:p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                    <div class="flex items-start gap-2">
                                        <iconify-icon icon="lucide:flask-conical" width="16"
                                            class="sm:w-5 text-blue-600 mt-0.5"></iconify-icon>
                                        <div>
                                            <p class="font-medium text-blue-800 text-sm sm:text-base">Scientific Backing</p>
                                            <p class="text-blue-700 text-xs sm:text-sm mt-1">Each ingredient is supported by
                                                traditional Ayurvedic knowledge and modern scientific research.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab Content -->
                <div class="tab-pane hidden space-y-6 sm:space-y-8" id="reviews-tab">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-0 mb-6 sm:mb-8">
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-1">Customer Reviews</h3>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center">
                                    <iconify-icon icon="lucide:star" width="16"
                                        class="sm:w-5 text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="16"
                                        class="sm:w-5 text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="16"
                                        class="sm:w-5 text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="16"
                                        class="sm:w-5 text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star-half" width="16"
                                        class="sm:w-5 text-yellow-600 fill-yellow-600"></iconify-icon>
                                </div>
                                <span class="text-sm sm:text-base text-stone-600">4.2 out of 5 • 42 reviews</span>
                            </div>
                        </div>
                        <button
                            class="px-4 sm:px-6 py-2 sm:py-3 bg-emerald-900 text-white font-medium rounded-lg hover:bg-emerald-800 transition-colors text-sm sm:text-base">
                            Write a Review
                        </button>
                    </div>

                    <!-- Reviews Grid (Dynamic) -->
                    <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
                        @forelse($reviews ?? [] as $review)
                            <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                        <span
                                            class="font-semibold text-emerald-800">{{ strtoupper(substr($review->user_name ?? 'A', 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-stone-900">{{ $review->user_name ?? 'Anonymous' }}</p>
                                        <div class="flex items-center gap-1 mt-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <iconify-icon icon="lucide:star" width="12"
                                                    class="{{ $i <= $review->rating ? 'text-yellow-600 fill-yellow-600' : 'text-stone-300' }}"></iconify-icon>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm sm:text-base text-stone-600">"{{ $review->review }}"</p>
                                <p class="text-xs text-stone-500 mt-3">Verified Purchase •
                                    {{ $review->created_at->diffForHumans() }}
                                </p>
                            </div>
                        @empty
                            <div class="col-span-full py-8 text-center text-stone-500">
                                No reviews yet for this product.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products (Dynamic) -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
        <div class="max-w-7xl mx-auto px-4 py-16">
            <h2 class="text-2xl sm:text-3xl font-serif font-semibold text-stone-900 mb-8 sm:mb-12 text-center">You May Also Like
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach($relatedProducts as $related)
                    <div
                        class="group h-full flex flex-col bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-stone-100">
                        <a href="{{ route('customer.products.details', $related['slug']) }}"
                            class="block aspect-square overflow-hidden rounded-t-xl bg-stone-50 relative">
                            <img src="{{ $related['main_image'] ? asset('storage/' . $related['main_image']) : asset('images/placeholder-product.jpg') }}"
                                alt="{{ $related['name'] }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                onerror="this.src='{{ asset('images/placeholder-product.jpg') }}'">
                            @if(($related['compare_price'] ?? 0) > ($related['price'] ?? 0))
                                <span
                                    class="absolute top-2 left-2 px-2 py-1 bg-red-600 text-white text-[10px] font-bold rounded uppercase tracking-wider">SALE</span>
                            @endif
                        </a>
                        <div class="p-3 sm:p-4 flex flex-col flex-1">
                            <a href="{{ route('customer.products.details', $related['slug']) }}" class="block">
                                <h3
                                    class="text-stone-900 font-medium text-sm sm:text-base mb-1 group-hover:text-emerald-800 transition-colors line-clamp-2 min-h-[2.5rem] sm:min-h-[3rem]">
                                    {{ $related['name'] }}
                                </h3>
                            </a>
                            <div class="flex items-center gap-1 mb-2">
                                @php $r_rating = $related['rating'] ?? 0; @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <iconify-icon icon="lucide:star" width="10"
                                        class="{{ $i <= floor($r_rating) ? 'text-yellow-600 fill-yellow-600' : 'text-stone-300' }}"></iconify-icon>
                                @endfor
                                <span class="text-[10px] text-stone-500">({{ $related['review_count'] ?? 0 }})</span>
                            </div>
                            <div class="mt-auto flex items-baseline gap-2">
                                <span class="text-emerald-900 font-bold">₹{{ number_format($related['price']) }}</span>
                                @if(($related['compare_price'] ?? 0) > ($related['price'] ?? 0))
                                    <span
                                        class="text-stone-400 text-xs line-through">₹{{ number_format($related['compare_price']) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <a href="{{ route('customer.products.list') }}"
                    class="inline-flex items-center py-3 px-8 rounded-full bg-stone-900 text-white font-medium hover:bg-stone-800 transition-all text-sm sm:text-base group">
                    View All Products
                    <iconify-icon icon="lucide:arrow-right" width="16"
                        class="ml-2 group-hover:translate-x-1 transition-transform"></iconify-icon>
                </a>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Product data from PHP
        const productData = @json($product);
        const availableVariants = @json($product['variants'] ?? []);
        const attributeGroups = @json($product['attribute_groups'] ?? []);
        let cartVariantIds = @json($cartVariantIds ?? []);
        let wishlistVariantIds = @json($wishlistVariantIds ?? []);

        // State
        let selectedAttributes = {};
        let selectedVariant = availableVariants.find(v => v.is_default) || availableVariants[0] || null;
        let currentQuantity = 1;

        document.addEventListener('DOMContentLoaded', function () {
            // Configure Axios
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (csrfToken) {
                axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
            }
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            axios.defaults.headers.common['Accept'] = 'application/json';

            // Initialize components
            initTabFunctionality();
            initVariantSelection();
            initQuantitySelector();
            initImageGallery();

            // Initial UI Update if variant selected
            if (selectedVariant) {
                updateVariantUI(selectedVariant);
            }
        });

        /* =====================
           VARIANT SELECTION
        ===================== */
        function initVariantSelection() {
            // Setup initial attributes based on default variant
            if (selectedVariant && selectedVariant.attributes) {
                selectedVariant.attributes.forEach(attr => {
                    selectedAttributes[attr.attribute_name] = attr.value;
                    const btn = document.querySelector(`.attribute-btn[data-attribute-name="${attr.attribute_name}"][data-attribute-value="${attr.value}"]`);
                    if (btn) {
                        updateAttributeButtonUI(btn, attr.attribute_name);
                    }
                });
            }

            // Ensure all attribute buttons have click listeners if not already handled by inline onclick
            // Although the current blade has inline onclick="selectAttribute(...)"
        }

        function selectAttribute(element, name, value) {
            selectedAttributes[name] = value;
            updateAttributeButtonUI(element, name);

            // Find matching variant
            const matched = availableVariants.find(v => {
                // Ensure the variant has all the required attributes matching the selection
                return v.attributes && v.attributes.every(attr => selectedAttributes[attr.attribute_name] === attr.value);
            });

            if (matched) {
                selectedVariant = matched;
                updateVariantUI(matched);
            } else {
                selectedVariant = null;
                // Update UI to show unavailable
                const stockCount = document.getElementById('stockCount');
                if (stockCount) stockCount.textContent = 'Not available for this selection';
                const cartBtn = document.getElementById('add-to-cart-btn');
                if (cartBtn) {
                    cartBtn.disabled = true;
                    const btnText = cartBtn.querySelector('.btn-text');
                    if (btnText) btnText.textContent = 'Unavailable';
                }
            }
        }

        function updateAttributeButtonUI(element, name) {
            // The element's parent is the flex container of buttons for this attribute
            const group = element.parentElement;
            if (group) {
                group.querySelectorAll('.attribute-btn').forEach(btn => {
                    btn.classList.remove('border-emerald-500', 'bg-emerald-50', 'text-emerald-800');
                    btn.classList.add('border-stone-300', 'text-stone-700');
                });
            }
            element.classList.remove('border-stone-300', 'text-stone-700');
            element.classList.add('border-emerald-500', 'bg-emerald-50', 'text-emerald-800');
        }

        function updateVariantUI(variant) {
            // Update prices
            const priceDisplay = document.querySelector('span.text-2xl.sm\\:text-3xl');
            if (priceDisplay) priceDisplay.textContent = `₹${new Intl.NumberFormat().format(variant.price)}`;

            const comparePriceDisplay = document.querySelector('span.text-stone-400.text-base.line-through');
            if (comparePriceDisplay) {
                if (variant.compare_price && variant.compare_price > variant.price) {
                    comparePriceDisplay.textContent = `₹${new Intl.NumberFormat().format(variant.compare_price)}`;
                    comparePriceDisplay.style.display = 'inline';
                } else {
                    comparePriceDisplay.style.display = 'none';
                }
            }

            // Update stock
            const stockCount = document.getElementById('stockCount');
            if (stockCount) {
                stockCount.textContent = `${variant.stock_quantity ?? 0} available`;
            }

            // Update Add to Cart button
            const cartBtn = document.getElementById('add-to-cart-btn');
            if (cartBtn) {
                const btnText = cartBtn.querySelector('.btn-text');
                const isInCart = cartVariantIds.includes(variant.id); // Check if variant ID is in array based on type

                if (isInCart) {
                    cartBtn.disabled = true;
                    if (btnText) btnText.textContent = 'Added to Cart';
                    cartBtn.classList.add('bg-emerald-800', 'opacity-70', 'cursor-not-allowed');
                } else {
                    cartBtn.disabled = !(variant.stock_quantity > 0);
                    if (btnText) btnText.textContent = (variant.stock_quantity > 0) ? 'Add to Cart' : 'Out of Stock';
                    cartBtn.classList.remove('bg-emerald-800', 'opacity-70', 'cursor-not-allowed');
                }

                cartBtn.setAttribute('data-variant-id', variant.id);
            }

            // Update Wishlist button
            const wishlistBtn = document.getElementById('wishlist-btn');
            if (wishlistBtn) {
                const isInWishlist = wishlistVariantIds.includes(variant.id);
                const heartIcon = wishlistBtn.querySelector('.heart-icon');
                const wishlistText = wishlistBtn.querySelector('.wishlist-text');

                if (isInWishlist) {
                    wishlistBtn.classList.add('active');
                    if (heartIcon) {
                        heartIcon.style.color = '#dc2626';
                        heartIcon.style.fill = '#dc2626';
                    }
                    if (wishlistText) wishlistText.textContent = 'Saved to Wishlist';
                } else {
                    wishlistBtn.classList.remove('active');
                    if (heartIcon) {
                        heartIcon.style.color = '';
                        heartIcon.style.fill = 'none';
                    }
                    if (wishlistText) wishlistText.textContent = 'Save to Wishlist';
                }
            }


            // Update image if variant has one
            if (variant.images && variant.images.length > 0) {
                // Find primary image or use first one
                const primaryImg = variant.images.find(img => img.is_primary) || variant.images[0];

                if (primaryImg) {
                    const mainImg = document.getElementById('main-product-image');
                    if (mainImg) {
                        mainImg.src = `{{ asset('storage/') }}/${primaryImg.url}`;
                    }
                }
            } else if (variant.main_image) {
                const mainImg = document.getElementById('main-product-image');
                if (mainImg) {
                    mainImg.src = `{{ asset('storage/') }}/${variant.main_image}`;
                }
            }
        }

        /* =====================
           QUANTITY SELECTOR
        ===================== */
        function initQuantitySelector() {
            const input = document.getElementById('quantity');
            if (input) {
                input.addEventListener('change', function () {
                    let val = parseInt(this.value);
                    if (isNaN(val) || val < 1) val = 1;
                    const max = selectedVariant ? (selectedVariant.stock_quantity || 10) : 10;
                    if (val > max) val = max;
                    this.value = val;
                    currentQuantity = val;
                });
            }
        }

        function changeQuantity(delta) {
            const input = document.getElementById('quantity');
            if (!input) return;
            let val = parseInt(input.value) + delta;
            if (val < 1) val = 1;
            const max = selectedVariant ? (selectedVariant.stock_quantity || 10) : 10;
            if (val > max) val = max;
            input.value = val;
            currentQuantity = val;
        }

        /* =====================
           CART & WISHLIST
        ===================== */
        async function addToCart() {
            if (!selectedVariant) {
                showToast('Error', 'Please select product options', 'error');
                return;
            }

            const btn = document.getElementById('add-to-cart-btn');
            if (!btn) return;

            const btnText = btn.querySelector('.btn-text');
            const originalText = btnText ? btnText.textContent : 'Add to Cart';

            try {
                btn.disabled = true;
                if (btnText) btnText.textContent = 'Adding...';

                const response = await axios.post('{{ route('customer.cart.add') }}', {
                    variant_id: selectedVariant.id,
                    quantity: currentQuantity
                });

                if (response.data.success) {
                    showToast('Success', 'Added to cart successfully!', 'success');
                    // Add to local array
                    if (!cartVariantIds.includes(selectedVariant.id)) {
                        cartVariantIds.push(selectedVariant.id);
                    }
                    // Update UI immediately
                    updateVariantUI(selectedVariant);

                    // Update cart count in header if the function exists
                    if (typeof window.updateCartBadge === 'function') {
                        window.updateCartBadge(response.data.cart_count);
                    }
                }
            } catch (error) {
                console.error('Cart Error:', error);
                const msg = error.response?.data?.message || 'Failed to add to cart';
                showToast('Error', msg, 'error');
                // Revert button if failed
                btn.disabled = false;
                if (btnText) btnText.textContent = originalText;
            }
        }

        async function addToWishlist(productId) {
            // Use selected variant for wishlist if available
            const variantId = selectedVariant ? selectedVariant.id : productId;

            try {
                const response = await axios.post('{{ route('customer.wishlist.add') }}', {
                    product_variant_id: variantId
                });

                if (response.data.success) {
                    showToast('Success', 'Added to wishlist!', 'success');

                    if (!wishlistVariantIds.includes(variantId)) {
                        wishlistVariantIds.push(variantId);
                    }

                    const heartIcon = document.querySelector('.wishlist-btn .heart-icon');
                    // Update UI
                    updateVariantUI(selectedVariant);
                }
            } catch (error) {
                console.error('Wishlist Error:', error);
                const message = error.response?.data?.message || 'Failed to add to wishlist';
                // If already in wishlist, maybe treat as success or info
                showToast(error.response?.status === 400 ? 'Info' : 'Error', message, error.response?.status === 400 ? 'info' : 'error');
            }
        }

        /* =====================
           TABS
        ===================== */
        function initTabFunctionality() {
            const buttons = document.querySelectorAll('.tab-btn');
            const panes = document.querySelectorAll('.tab-pane');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabName = btn.getAttribute('data-tab');

                    // Update buttons
                    buttons.forEach(b => {
                        b.classList.remove('border-emerald-900', 'text-emerald-900');
                        b.classList.add('text-stone-500');
                    });
                    btn.classList.add('border-emerald-900', 'text-emerald-900');
                    btn.classList.remove('text-stone-500');

                    // Update panes
                    panes.forEach(p => p.classList.add('hidden'));
                    const targetPane = document.getElementById(`${tabName}-tab`);
                    if (targetPane) targetPane.classList.remove('hidden');
                });
            });
        }

        /* =====================
           IMAGE GALLERY
        ===================== */
        function initImageGallery() {
            const mainImg = document.getElementById('main-product-image');
            const thumbnails = document.querySelectorAll('.thumbnail-btn');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    const src = thumb.getAttribute('data-image-src');
                    const index = thumb.getAttribute('data-image-index');

                    if (mainImg) {
                        mainImg.src = src;
                        mainImg.setAttribute('data-current-index', index);
                    }

                    // Update thumbnail active state
                    thumbnails.forEach(t => t.classList.remove('border-emerald-500', 'border-2'));
                    thumb.classList.add('border-emerald-500', 'border-2');
                });
            });

            // Prev/Next handlers
            document.getElementById('prev-image-btn')?.addEventListener('click', () => {
                let idx = parseInt(mainImg.getAttribute('data-current-index')) || 0;
                idx = (idx - 1 + thumbnails.length) % thumbnails.length;
                thumbnails[idx].click();
            });

            document.getElementById('next-image-btn')?.addEventListener('click', () => {
                let idx = parseInt(mainImg.getAttribute('data-current-index')) || 0;
                idx = (idx + 1) % thumbnails.length;
                thumbnails[idx].click();
            });
        }

        /* =====================
           TOAST NOTIFICATION
        ===================== */
        function showToast(title, message, type) {
            // Check for existing container
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                container.className = 'fixed top-4 right-4 z-[9999] space-y-2';
                document.body.appendChild(container);
            }

            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-emerald-600' : (type === 'error' ? 'bg-red-600' : 'bg-blue-600');
            toast.className = `${bgColor} text-white p-4 rounded-lg shadow-lg flex items-center gap-3 animate-slide-in-right transform transition-all duration-300 min-w-[250px]`;

            const icon = type === 'success' ? 'lucide:check-circle' : (type === 'error' ? 'lucide:alert-circle' : 'lucide:info');

            toast.innerHTML = `
                                        <iconify-icon icon="${icon}" width="20"></iconify-icon>
                                        <div class="flex-1">
                                            <p class="font-bold text-sm">${title}</p>
                                            <p class="text-xs opacity-90">${message}</p>
                                        </div>
                                        <button class="opacity-70 hover:opacity-100" onclick="this.parentElement.remove()">
                                            <iconify-icon icon="lucide:x" width="16"></iconify-icon>
                                        </button>
                                    `;

            container.appendChild(toast);

            // Auto-remove after 5 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }

        // Attach global listener for Add to Cart button as it's defined in HTML
        const cartBtn = document.getElementById('add-to-cart-btn');
        if (cartBtn) {
            cartBtn.addEventListener('click', addToCart);
        }
    </script>
@endpush