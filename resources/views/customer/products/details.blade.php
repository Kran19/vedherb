@extends('customer.layouts.master')

@section('title', 'Power Gel - Product Details')

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
                <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700 py-1">
                    <iconify-icon icon="lucide:home" width="14" class="sm:w-4"></iconify-icon>
                    <span class="ml-1 sm:ml-2">Home</span>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                    <a href="{{ route('customer.products.shop') }}" class="ml-1 sm:ml-2 hover:text-emerald-700 py-1">Shop</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="14" class="sm:w-4"></iconify-icon>
                    <span class="ml-1 sm:ml-2 text-stone-900 font-medium py-1 truncate max-w-[150px] sm:max-w-none">Power Gel</span>
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
                    <img src="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG" alt="Power Gel"
                        class="main-image-zoom" id="main-product-image" loading="lazy" data-current-index="0">
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
            
            <!-- Thumbnail Gallery -->
            <div class="grid grid-cols-4 gap-2 sm:gap-3" id="thumbnail-gallery">
                <button
                    class="thumbnail-btn aspect-square rounded-lg overflow-hidden border-2 border-emerald-500 hover:border-emerald-600 transition-colors p-1 sm:p-2"
                    data-image-index="0"
                    data-image-src="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG"
                    data-image-alt="Power Gel Front">
                    <img src="https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG" alt="Power Gel Front"
                        class="w-full h-full object-contain object-center mix-blend-multiply" loading="lazy">
                </button>

                <button
                    class="thumbnail-btn aspect-square rounded-lg overflow-hidden border border-stone-300 hover:border-emerald-500 transition-colors p-1 sm:p-2"
                    data-image-index="1"
                    data-image-src="https://www.vedherbsandayurveda.com/products-img/Veerya-Shakti.PNG"
                    data-image-alt="Power Gel Application">
                    <img src="https://www.vedherbsandayurveda.com/products-img/Veerya-Shakti.PNG"
                        alt="Power Gel Application"
                        class="w-full h-full object-contain object-center mix-blend-multiply" loading="lazy">
                </button>

                <button
                    class="thumbnail-btn aspect-square rounded-lg overflow-hidden border border-stone-300 hover:border-emerald-500 transition-colors p-1 sm:p-2"
                    data-image-index="2"
                    data-image-src="https://www.vedherbsandayurveda.com/products-img/Prime-Time.PNG"
                    data-image-alt="Power Gel Packaging">
                    <img src="https://www.vedherbsandayurveda.com/products-img/Prime-Time.PNG"
                        alt="Power Gel Packaging"
                        class="w-full h-full object-contain object-center mix-blend-multiply" loading="lazy">
                </button>

                <button
                    class="thumbnail-btn aspect-square rounded-lg overflow-hidden border border-stone-300 hover:border-emerald-500 transition-colors p-1 sm:p-2"
                    data-image-index="3"
                    data-image-src="https://www.vedherbsandayurveda.com/products-img/Ayushakti.jpeg"
                    data-image-alt="Power Gel Ingredients">
                    <img src="https://www.vedherbsandayurveda.com/products-img/Ayushakti.jpeg"
                        alt="Power Gel Ingredients"
                        class="w-full h-full object-contain object-center mix-blend-multiply" loading="lazy">
                </button>
            </div>
        </div>

        <!-- Product Info -->
        <div class="space-y-6 sm:space-y-8">
            <!-- Header -->
            <div>
                <!-- Dosha Badges -->
                <div class="flex flex-wrap gap-2 mb-3 sm:mb-4">
                    <span
                        class="px-2 sm:px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-medium border border-emerald-200 whitespace-nowrap">
                        Pain Relief
                    </span>
                    <span
                        class="px-2 sm:px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-medium border border-emerald-200 whitespace-nowrap">
                        Fast Absorbing
                    </span>
                    <span
                        class="px-2 sm:px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium border border-green-200 whitespace-nowrap">
                        <iconify-icon icon="lucide:check-circle" width="10" class="sm:w-3 mr-1"></iconify-icon>
                        In Stock
                    </span>
                </div>

                <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-semibold text-stone-900 mb-1 sm:mb-2">
                    Power Gel
                </h1>
                <p class="text-base sm:text-lg font-medium text-emerald-700 italic mb-2 sm:mb-3">
                    Herbal Performance Gel
                </p>

                <!-- Rating -->
                <div class="flex items-center gap-2 sm:gap-3 mb-3 sm:mb-4">
                    <div class="flex items-center gap-1">
                        <iconify-icon icon="lucide:star" width="14"
                            class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                        <iconify-icon icon="lucide:star" width="14"
                            class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                        <iconify-icon icon="lucide:star" width="14"
                            class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                        <iconify-icon icon="lucide:star" width="14"
                            class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                        <iconify-icon icon="lucide:star-half" width="14"
                            class="sm:w-4 text-yellow-600 fill-yellow-600"></iconify-icon>
                        <span class="ml-1 sm:ml-2 text-xs sm:text-sm font-medium text-stone-700">4.2</span>
                    </div>
                    <span class="text-stone-300 sm:text-stone-400">•</span>
                    <a href="#reviews"
                        class="text-xs sm:text-sm text-emerald-700 hover:text-emerald-800 font-medium">
                        42 reviews
                    </a>
                </div>
            </div>

            <!-- Price -->
            <div class="flex flex-wrap items-center gap-2 sm:gap-4">
                <span class="text-2xl sm:text-3xl font-semibold text-stone-900">₹599</span>
                <span class="text-base sm:text-lg text-stone-400 line-through">₹1499</span>
                <span
                    class="px-2 sm:px-3 py-1 bg-red-100 text-red-700 text-xs sm:text-sm font-medium rounded-full whitespace-nowrap">
                    Save 85%
                </span>
            </div>

            <!-- Short Description -->
            <p class="text-base sm:text-lg text-stone-600 leading-relaxed">
                Power Gel Herbal Performance Gel is a carefully crafted herbal formulation designed to support
                endurance, confidence, and overall performance. Enriched with traditional Ayurvedic herbs, this
                fast-absorbing gel works naturally with your body to promote long-lasting comfort and satisfaction,
                without harsh chemicals or synthetic additives.
            </p>

            <!-- Product Options -->
            <div class="space-y-4 sm:space-y-6">
                <!-- Weight Options -->
                <div>
                    <h4 class="font-medium text-stone-900 mb-2 sm:mb-3">Select Weight</h4>
                    <div class="flex flex-wrap gap-2">
                        <button
                            class="weight-option px-3 sm:px-4 py-2 rounded-lg border border-emerald-500 bg-emerald-50 text-emerald-800 transition-all text-sm sm:text-base"
                            data-weight="50g">
                            4 ML
                        </button>
                        <button
                            class="weight-option px-3 sm:px-4 py-2 rounded-lg border border-stone-300 hover:border-emerald-500 hover:bg-emerald-50 text-stone-700 hover:text-emerald-800 transition-all text-sm sm:text-base"
                            data-weight="100g">
                            8 ML
                        </button>
                        <button
                            class="weight-option px-3 sm:px-4 py-2 rounded-lg border border-stone-300 hover:border-emerald-500 hover:bg-emerald-50 text-stone-700 hover:text-emerald-800 transition-all text-sm sm:text-base"
                            data-weight="250g">
                            12 ML
                        </button>
                    </div>
                </div>

                <!-- Quantity -->
                <div>
                    <h4 class="font-medium text-stone-900 mb-2 sm:mb-3">Quantity</h4>
                    <div class="flex items-center gap-2 sm:gap-3 max-w-xs">
                        <button
                            class="quantity-minus w-10 h-10 sm:w-12 sm:h-12 rounded-lg border border-stone-300 flex items-center justify-center hover:bg-stone-50">
                            <iconify-icon icon="lucide:minus" width="14" class="sm:w-4"></iconify-icon>
                        </button>
                        <input type="number" value="1" min="1" max="10"
                            class="quantity-input flex-1 h-10 sm:h-12 text-center border border-stone-300 rounded-lg font-medium text-stone-900 text-sm sm:text-base">
                        <button
                            class="quantity-plus w-10 h-10 sm:w-12 sm:h-12 rounded-lg border border-stone-300 flex items-center justify-center hover:bg-stone-50">
                            <iconify-icon icon="lucide:plus" width="14" class="sm:w-4"></iconify-icon>
                        </button>
                        <span class="text-xs sm:text-sm text-stone-500 ml-2 sm:ml-4">125 available</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 pt-4">
                <button id="add-to-cart-btn"
                    class="add-to-cart-btn w-full h-12 sm:h-14 px-6 sm:px-8 rounded-xl bg-emerald-900 text-white font-semibold hover:bg-emerald-800 transition-all flex items-center justify-center gap-2 sm:gap-3 text-sm sm:text-base"
                    data-product-id="1">
                    <iconify-icon icon="lucide:shopping-bag" width="16" class="sm:w-5"></iconify-icon>
                    <span class="btn-text">Add to Cart</span>
                </button>
                <button id="wishlist-btn"
                    class="wishlist-btn w-full h-12 sm:h-14 px-6 sm:px-8 rounded-xl bg-white border-2 border-emerald-900 text-emerald-900 font-semibold hover:bg-emerald-50 transition-colors flex items-center justify-center gap-2 sm:gap-3 text-sm sm:text-base"
                    data-product-id="1">
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
                    Reviews (42)
                </button>
            </nav>
        </div>

        <div class="py-6 sm:py-8" id="tab-content">
            <!-- Description Tab Content -->
            <div class="tab-pane active space-y-6 sm:space-y-8" id="description-tab">
                <div class="grid md:grid-cols-2 gap-6 sm:gap-8">
                    <div>
                        <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Ayurvedic Perspective</h3>
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
                                        <p class="text-xs sm:text-sm text-stone-500">Works within minutes for immediate results</p>
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
                                        <p class="text-xs sm:text-sm text-stone-500">Provides extended performance support for hours</p>
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
                                        <p class="text-xs sm:text-sm text-stone-500">100% herbal formulation without side effects</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dosha Information -->
                <div
                    class="bg-emerald-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 md:p-8 border border-emerald-200 mt-6 sm:mt-8">
                    <h3 class="text-xl sm:text-2xl font-serif font-medium text-emerald-900 mb-4 sm:mb-6">Dosha Balancing Properties</h3>
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
                                        <p class="text-xs sm:text-sm text-stone-500">Apply 15-20 minutes before activity for best results</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div
                                        class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                        <iconify-icon icon="lucide:droplet" width="16"
                                            class="sm:w-5 text-emerald-700"></iconify-icon>
                                    </div>
                                    <div>
                                        <p class="font-medium text-stone-900 text-sm sm:text-base">Application Method</p>
                                        <p class="text-xs sm:text-sm text-stone-500">Apply a pea-sized amount and massage gently until absorbed</p>
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
                                        <p class="text-xs sm:text-sm text-stone-500">1-2 times daily as needed, or as directed by your healthcare practitioner</p>
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
                                        <p class="font-medium text-amber-800 text-sm sm:text-base">For External Use Only</p>
                                        <p class="text-amber-700 text-xs sm:text-sm mt-1">Avoid contact with eyes and sensitive areas. If irritation occurs, discontinue use.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 sm:p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:thermometer" width="16"
                                        class="sm:w-5 text-blue-600 mt-0.5"></iconify-icon>
                                    <div>
                                        <p class="font-medium text-blue-800 text-sm sm:text-base">Storage Instructions</p>
                                        <p class="text-blue-700 text-xs sm:text-sm mt-1">Store in a cool, dry place away from direct sunlight. Keep tightly closed when not in use.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 sm:p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:check-circle" width="16"
                                        class="sm:w-5 text-emerald-600 mt-0.5"></iconify-icon>
                                    <div>
                                        <p class="font-medium text-emerald-800 text-sm sm:text-base">Best Results</p>
                                        <p class="text-emerald-700 text-xs sm:text-sm mt-1">For optimal results, combine with a healthy lifestyle, balanced diet, and regular exercise.</p>
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
                                    <p class="font-medium text-stone-900 text-sm sm:text-base">Ashwagandha Root Extract (Withania somnifera)</p>
                                    <p class="text-xs sm:text-sm text-stone-500 mt-1">Standardized to contain 2.5% withanolides - 300mg</p>
                                </div>
                                <div class="pb-3 border-b border-stone-200">
                                    <p class="font-medium text-stone-900 text-sm sm:text-base">Safed Musli (Chlorophytum borivilianum)</p>
                                    <p class="text-xs sm:text-sm text-stone-500 mt-1">Traditionally used for vitality and strength - 250mg</p>
                                </div>
                                <div class="pb-3 border-b border-stone-200">
                                    <p class="font-medium text-stone-900 text-sm sm:text-base">Shilajit (Purified)</p>
                                    <p class="text-xs sm:text-sm text-stone-500 mt-1">Rich in fulvic acid and minerals - 200mg</p>
                                </div>
                                <div class="pb-3 border-b border-stone-200">
                                    <p class="font-medium text-stone-900 text-sm sm:text-base">Kaunch Beej (Mucuna pruriens)</p>
                                    <p class="text-xs sm:text-sm text-stone-500 mt-1">Natural source of L-DOPA - 150mg</p>
                                </div>
                                <div>
                                    <p class="font-medium text-stone-900 text-sm sm:text-base">Gokshura (Tribulus terrestris)</p>
                                    <p class="text-xs sm:text-sm text-stone-500 mt-1">Supports endurance and performance - 100mg</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg sm:text-xl font-semibold text-stone-900 mb-3 sm:mb-4">Other Ingredients</h3>
                        <div class="space-y-2 sm:space-y-3">
                            <p class="text-sm sm:text-base text-stone-600">Aloe Vera Gel (base), Coconut Oil, Beeswax, Vitamin E, Natural Preservatives</p>

                            <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:leaf" width="16"
                                        class="sm:w-5 text-emerald-600 mt-0.5"></iconify-icon>
                                    <div>
                                        <p class="font-medium text-emerald-800 text-sm sm:text-base">100% Natural & Herbal</p>
                                        <p class="text-emerald-700 text-xs sm:text-sm mt-1">No parabens, sulfates, artificial fragrances, or synthetic chemicals. Cruelty-free and vegan-friendly.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 sm:p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-start gap-2">
                                    <iconify-icon icon="lucide:flask-conical" width="16"
                                        class="sm:w-5 text-blue-600 mt-0.5"></iconify-icon>
                                    <div>
                                        <p class="font-medium text-blue-800 text-sm sm:text-base">Scientific Backing</p>
                                        <p class="text-blue-700 text-xs sm:text-sm mt-1">Each ingredient is supported by traditional Ayurvedic knowledge and modern scientific research.</p>
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

                <!-- Reviews Grid -->
                <div class="grid md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Review 1 -->
                    <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <span class="font-semibold text-emerald-800">RS</span>
                            </div>
                            <div>
                                <p class="font-medium text-stone-900">Rajesh Sharma</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm sm:text-base text-stone-600">"Excellent product! Works within minutes and lasts longer than expected. The herbal formulation feels much safer than chemical alternatives."</p>
                        <p class="text-xs text-stone-500 mt-3">Verified Purchase • 2 weeks ago</p>
                    </div>

                    <!-- Review 2 -->
                    <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <span class="font-semibold text-emerald-800">AP</span>
                            </div>
                            <div>
                                <p class="font-medium text-stone-900">Anjali Patel</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm sm:text-base text-stone-600">"My husband has been using this for 3 months. It's natural, effective, and doesn't have any side effects. Highly recommend!"</p>
                        <p class="text-xs text-stone-500 mt-3">Verified Purchase • 1 month ago</p>
                    </div>

                    <!-- Review 3 -->
                    <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <span class="font-semibold text-emerald-800">SK</span>
                            </div>
                            <div>
                                <p class="font-medium text-stone-900">Suresh Kumar</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm sm:text-base text-stone-600">"I was skeptical about herbal products, but this one really works. The quality is excellent and it's worth every penny."</p>
                        <p class="text-xs text-stone-500 mt-3">Verified Purchase • 3 months ago</p>
                    </div>

                    <!-- Review 4 -->
                    <div class="bg-stone-50 rounded-xl p-4 sm:p-6 border border-stone-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <span class="font-semibold text-emerald-800">MP</span>
                            </div>
                            <div>
                                <p class="font-medium text-stone-900">Meera P.</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                    <iconify-icon icon="lucide:star-half" width="12"
                                        class="text-yellow-600 fill-yellow-600"></iconify-icon>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm sm:text-base text-stone-600">"Good product overall. Takes a bit longer to show effect compared to chemical ones, but feels much safer for regular use."</p>
                        <p class="text-xs text-stone-500 mt-3">Verified Purchase • 2 months ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Preload all images for smoother zoom experience
        function preloadImages() {
            const thumbnailBtns = document.querySelectorAll('.thumbnail-btn');
            thumbnailBtns.forEach(btn => {
                const img = new Image();
                img.src = btn.getAttribute('data-image-src');
            });
        }

        preloadImages();
        
        /* =====================
           AMAZON-STYLE HOVER ZOOM FUNCTIONALITY
        ===================== */
        class AmazonHoverZoom {
            constructor() {
                this.mainImage = document.getElementById('main-product-image');
                this.zoomPreview = document.getElementById('zoomPreview');
                this.zoomPreviewContainer = document.getElementById('zoomPreviewContainer');
                this.mainImageWrapper = document.getElementById('main-image-wrapper');
                this.zoomLoading = document.getElementById('zoomLoading');

                this.zoomFactor = 2; // 2x zoom
                this.lensSize = 150; // Lens size in pixels
                this.isHovering = false;
                this.currentImageSrc = '';
                this.mousemoveTimeout = null;
                this.imageNaturalWidth = 0;
                this.imageNaturalHeight = 0;
                this.imageDisplayWidth = 0;
                this.imageDisplayHeight = 0;

                this.init();
            }

            init() {
                this.setupEventListeners();
                this.preloadCurrentImage();
            }

            preloadCurrentImage() {
                const img = new Image();
                img.src = this.mainImage.src;
                
                img.onload = () => {
                    this.imageNaturalWidth = img.naturalWidth;
                    this.imageNaturalHeight = img.naturalHeight;
                    
                    // Get displayed dimensions
                    const rect = this.mainImage.getBoundingClientRect();
                    this.imageDisplayWidth = rect.width;
                    this.imageDisplayHeight = rect.height;
                };
            }

            setupEventListeners() {
                // Mouse enter/leave events for main image
                this.mainImageWrapper.addEventListener('mouseenter', (e) => {
                    if (window.innerWidth > 1024) {
                        this.startHoverZoom(e);
                    }
                });

                this.mainImageWrapper.addEventListener('mouseleave', () => {
                    this.stopHoverZoom();
                });

                // Mouse move for lens movement
                this.mainImageWrapper.addEventListener('mousemove', (e) => {
                    if (!this.isHovering) return;

                    clearTimeout(this.mousemoveTimeout);
                    this.mousemoveTimeout = setTimeout(() => {
                        this.moveLens(e);
                    }, 10);
                });

                // Recalculate dimensions on window resize
                window.addEventListener('resize', () => {
                    if (this.isHovering) {
                        const rect = this.mainImage.getBoundingClientRect();
                        this.imageDisplayWidth = rect.width;
                        this.imageDisplayHeight = rect.height;
                        // Trigger a move to update positioning
                        this.moveLens({ clientX: rect.left + rect.width / 2, clientY: rect.top + rect.height / 2 });
                    }
                });

                // Update dimensions when images change
                this.mainImage.addEventListener('load', () => {
                    this.preloadCurrentImage();
                    if (this.isHovering) {
                        this.updateZoomImage();
                    }
                });

                // Touch events for mobile
                this.setupTouchEvents();
            }

            setupTouchEvents() {
                let touchActive = false;

                this.mainImageWrapper.addEventListener('touchstart', (e) => {
                    if (window.innerWidth > 1024) {
                        e.preventDefault();
                        touchActive = true;
                        const touch = e.touches[0];
                        this.startHoverZoom(touch);
                    }
                });

                this.mainImageWrapper.addEventListener('touchmove', (e) => {
                    if (touchActive && window.innerWidth > 1024) {
                        e.preventDefault();
                        const touch = e.touches[0];
                        this.moveLens(touch);
                    }
                });

                this.mainImageWrapper.addEventListener('touchend', () => {
                    touchActive = false;
                    this.stopHoverZoom();
                });
            }

            startHoverZoom(e) {
                if (window.innerWidth <= 1024) return;

                this.isHovering = true;
                this.currentImageSrc = this.mainImage.src;

                // Show loading indicator
                if (this.zoomLoading) {
                    this.zoomLoading.style.display = 'block';
                }

                // Get current image dimensions
                const img = new Image();
                img.src = this.currentImageSrc;

                img.onload = () => {
                    this.imageNaturalWidth = img.naturalWidth;
                    this.imageNaturalHeight = img.naturalHeight;
                    
                    const rect = this.mainImage.getBoundingClientRect();
                    this.imageDisplayWidth = rect.width;
                    this.imageDisplayHeight = rect.height;

                    // Hide loading indicator
                    if (this.zoomLoading) {
                        this.zoomLoading.style.display = 'none';
                    }

                    // Calculate the actual displayed aspect ratio vs natural aspect ratio
                    const displayAspect = this.imageDisplayWidth / this.imageDisplayHeight;
                    const naturalAspect = this.imageNaturalWidth / this.imageNaturalHeight;

                    let bgWidth, bgHeight;
                    
                    // Calculate background size based on which dimension is limiting
                    if (displayAspect > naturalAspect) {
                        // Image is height-limited (letterboxing on sides)
                        bgHeight = this.imageNaturalHeight * this.zoomFactor;
                        bgWidth = bgHeight * displayAspect;
                    } else {
                        // Image is width-limited (letterboxing top/bottom)
                        bgWidth = this.imageNaturalWidth * this.zoomFactor;
                        bgHeight = bgWidth / displayAspect;
                    }

                    // Set up preview background
                    this.zoomPreview.style.backgroundImage = `url('${this.currentImageSrc}')`;
                    this.zoomPreview.style.backgroundSize = `${bgWidth}px ${bgHeight}px`;
                    this.zoomPreview.style.backgroundRepeat = 'no-repeat';

                    // Show preview
                    this.zoomPreviewContainer.style.display = 'block';

                    // Position preview container
                    const containerRect = this.mainImageWrapper.getBoundingClientRect();
                    this.zoomPreviewContainer.style.top = `${containerRect.top}px`;
                    this.zoomPreviewContainer.style.left = `${containerRect.right + 20}px`;

                    // Force initial move
                    this.moveLens(e);
                };

                img.onerror = () => {
                    if (this.zoomLoading) {
                        this.zoomLoading.style.display = 'none';
                    }
                    this.stopHoverZoom();
                };
            }

            stopHoverZoom() {
                this.isHovering = false;
                this.zoomPreviewContainer.style.display = 'none';
            }

            moveLens(e) {
                if (!this.isHovering || this.imageNaturalWidth === 0) return;

                const imgRect = this.mainImage.getBoundingClientRect();
                let x, y;

                if (e.type.includes('touch')) {
                    x = e.touches[0].clientX;
                    y = e.touches[0].clientY;
                } else {
                    x = e.clientX;
                    y = e.clientY;
                }

                // Calculate relative position within the image (0 to 1)
                const relX = (x - imgRect.left) / this.imageDisplayWidth;
                const relY = (y - imgRect.top) / this.imageDisplayHeight;

                // Clamp values between 0 and 1
                const clampedX = Math.max(0, Math.min(relX, 1));
                const clampedY = Math.max(0, Math.min(relY, 1));

                // Calculate display aspect ratio vs natural aspect ratio
                const displayAspect = this.imageDisplayWidth / this.imageDisplayHeight;
                const naturalAspect = this.imageNaturalWidth / this.imageNaturalHeight;

                let bgWidth, bgHeight;
                
                if (displayAspect > naturalAspect) {
                    // Image is height-limited
                    bgHeight = this.imageNaturalHeight * this.zoomFactor;
                    bgWidth = bgHeight * displayAspect;
                    
                    // Calculate the offset caused by letterboxing
                    const displayedNaturalWidth = this.imageDisplayHeight * naturalAspect;
                    const horizontalOffset = (this.imageDisplayWidth - displayedNaturalWidth) / 2;
                    
                    // Adjust relative X based on actual image display area
                    const adjustedRelX = (clampedX * this.imageDisplayWidth - horizontalOffset) / displayedNaturalWidth;
                    
                    // Calculate background position
                    const bgPosX = -Math.max(0, Math.min(adjustedRelX, 1)) * (bgWidth - this.zoomPreviewContainer.clientWidth);
                    const bgPosY = -clampedY * (bgHeight - this.zoomPreviewContainer.clientHeight);
                    
                    this.zoomPreview.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
                    
                } else {
                    // Image is width-limited
                    bgWidth = this.imageNaturalWidth * this.zoomFactor;
                    bgHeight = bgWidth / displayAspect;
                    
                    // Calculate the offset caused by letterboxing
                    const displayedNaturalHeight = this.imageDisplayWidth / naturalAspect;
                    const verticalOffset = (this.imageDisplayHeight - displayedNaturalHeight) / 2;
                    
                    // Adjust relative Y based on actual image display area
                    const adjustedRelY = (clampedY * this.imageDisplayHeight - verticalOffset) / displayedNaturalHeight;
                    
                    // Calculate background position
                    const bgPosX = -clampedX * (bgWidth - this.zoomPreviewContainer.clientWidth);
                    const bgPosY = -Math.max(0, Math.min(adjustedRelY, 1)) * (bgHeight - this.zoomPreviewContainer.clientHeight);
                    
                    this.zoomPreview.style.backgroundPosition = `${bgPosX}px ${bgPosY}px`;
                }
            }

            updateZoomImage() {
                this.stopHoverZoom();
                
                // Force a reflow before restarting hover zoom
                setTimeout(() => {
                    if (this.isHovering) {
                        this.startHoverZoom({
                            clientX: this.mainImage.getBoundingClientRect().left + this.imageDisplayWidth / 2,
                            clientY: this.mainImage.getBoundingClientRect().top + this.imageDisplayHeight / 2
                        });
                    }
                }, 100);
            }
        }

        /* =====================
           AMAZON-STYLE CLICK-TO-ZOOM FUNCTIONALITY
        ===================== */
        class SimpleImageZoom {
            constructor() {
                this.zoomModal = document.getElementById('zoomModal');
                this.zoomImage = document.getElementById('zoomModalImage');
                this.thumbnailBtns = document.querySelectorAll('.thumbnail-btn');

                this.currentZoomIndex = 0;
                this.zoomLevel = 1;
                this.maxZoom = 3;
                this.isDragging = false;
                this.startX = 0;
                this.startY = 0;
                this.lastPinchDistance = null;

                this.init();
            }

            init() {
                this.setupEventListeners();
            }

            setupEventListeners() {
                // Click on main image to open zoom modal
                const mainImageWrapper = document.getElementById('main-image-wrapper');
                const mainImage = document.getElementById('main-product-image');

                mainImageWrapper.addEventListener('click', (e) => {
                    if (e.target.tagName === 'IMG' || e.target === mainImageWrapper) {
                        this.openZoomModal();
                    }
                });

                mainImage.addEventListener('click', (e) => {
                    this.openZoomModal();
                });

                // Close modal
                const closeBtn = document.getElementById('zoomModalClose');
                closeBtn?.addEventListener('click', () => this.closeZoomModal());

                // Close modal on overlay click
                this.zoomModal.addEventListener('click', (e) => {
                    if (e.target === this.zoomModal) {
                        this.closeZoomModal();
                    }
                });

                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (!this.zoomModal.style.display || this.zoomModal.style.display === 'none') return;

                    if (e.key === 'Escape') this.closeZoomModal();
                    if (e.key === 'ArrowRight') this.showNextImage();
                    if (e.key === 'ArrowLeft') this.showPrevImage();
                });

                // Modal navigation
                const prevBtn = document.getElementById('zoomModalPrev');
                const nextBtn = document.getElementById('zoomModalNext');
                prevBtn?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.showPrevImage();
                });
                nextBtn?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.showNextImage();
                });

                // Zoom with mouse wheel
                this.zoomImage.addEventListener('wheel', (e) => {
                    e.preventDefault();
                    const zoomIn = e.deltaY < 0;

                    if (zoomIn) {
                        this.zoomLevel = Math.min(this.zoomLevel + 0.5, this.maxZoom);
                    } else {
                        this.zoomLevel = Math.max(this.zoomLevel - 0.5, 1);
                    }

                    this.zoomImage.style.transform = `scale(${this.zoomLevel})`;
                    this.zoomImage.style.cursor = this.zoomLevel > 1 ? 'grab' : 'zoom-out';
                });

                // Pan image in zoom modal
                this.zoomImage.addEventListener('mousedown', (e) => {
                    if (this.zoomLevel > 1) {
                        this.startDragging(e);
                    }
                });

                document.addEventListener('mousemove', (e) => {
                    if (this.isDragging) {
                        this.dragImage(e);
                    }
                });

                document.addEventListener('mouseup', () => {
                    this.isDragging = false;
                    this.zoomImage.style.cursor = this.zoomLevel > 1 ? 'grab' : 'zoom-out';
                });

                // Touch events for mobile
                this.setupTouchEvents();
            }

            setupTouchEvents() {
                // Touch events for zoom modal
                let touchStartX = 0;
                let touchStartY = 0;
                let touchStartTime = 0;

                this.zoomImage.addEventListener('touchstart', (e) => {
                    if (e.touches.length === 1) {
                        touchStartX = e.touches[0].clientX;
                        touchStartY = e.touches[0].clientY;
                        touchStartTime = Date.now();
                    } else if (e.touches.length === 2) {
                        e.preventDefault();
                    }
                });

                this.zoomImage.addEventListener('touchmove', (e) => {
                    if (e.touches.length === 1 && this.zoomLevel > 1) {
                        e.preventDefault();
                        const touch = e.touches[0];
                        const deltaX = touch.clientX - touchStartX;
                        const deltaY = touch.clientY - touchStartY;

                        this.zoomImage.style.transform = `scale(${this.zoomLevel}) translate(${deltaX / this.zoomLevel}px, ${deltaY / this.zoomLevel}px)`;
                    } else if (e.touches.length === 2) {
                        e.preventDefault();
                        this.handlePinchZoom(e);
                    }
                });

                this.zoomImage.addEventListener('touchend', (e) => {
                    if (e.changedTouches.length === 1) {
                        const touchEndX = e.changedTouches[0].clientX;
                        const touchEndY = e.changedTouches[0].clientY;
                        const touchEndTime = Date.now();
                        const deltaX = touchEndX - touchStartX;
                        const deltaY = touchEndY - touchStartY;
                        const deltaTime = touchEndTime - touchStartTime;

                        // Check if it's a swipe
                        if (deltaTime < 300 && Math.abs(deltaX) > 50 && Math.abs(deltaY) < 100) {
                            if (deltaX > 0) {
                                this.showPrevImage();
                            } else {
                                this.showNextImage();
                            }
                        }
                    }
                });

                // Double tap to zoom in/out
                let lastTap = 0;
                this.zoomImage.addEventListener('touchend', (e) => {
                    const currentTime = new Date().getTime();
                    const tapLength = currentTime - lastTap;

                    if (tapLength < 300 && tapLength > 0) {
                        e.preventDefault();
                        if (this.zoomLevel === 1) {
                            this.zoomLevel = 2;
                        } else {
                            this.zoomLevel = 1;
                        }
                        this.zoomImage.style.transform = `scale(${this.zoomLevel})`;
                        this.zoomImage.style.cursor = this.zoomLevel > 1 ? 'grab' : 'zoom-in';
                    }

                    lastTap = currentTime;
                });
            }

            handlePinchZoom(e) {
                const touch1 = e.touches[0];
                const touch2 = e.touches[1];

                const distance = Math.sqrt(
                    Math.pow(touch2.clientX - touch1.clientX, 2) +
                    Math.pow(touch2.clientY - touch1.clientY, 2)
                );

                if (!this.lastPinchDistance) {
                    this.lastPinchDistance = distance;
                    return;
                }

                const zoomIn = distance > this.lastPinchDistance;

                if (zoomIn) {
                    this.zoomLevel = Math.min(this.zoomLevel + 0.5, this.maxZoom);
                } else {
                    this.zoomLevel = Math.max(this.zoomLevel - 0.5, 1);
                }

                this.zoomImage.style.transform = `scale(${this.zoomLevel})`;
                this.zoomImage.style.cursor = this.zoomLevel > 1 ? 'grab' : 'zoom-in';
                this.lastPinchDistance = distance;
            }

            openZoomModal() {
                const mainImage = document.getElementById('main-product-image');
                const currentIndex = parseInt(mainImage.getAttribute('data-current-index')) || 0;
                const thumbnailBtn = document.querySelector(`.thumbnail-btn[data-image-index="${currentIndex}"]`);
                const imageSrc = thumbnailBtn?.getAttribute('data-image-src') || mainImage.src;

                this.currentZoomIndex = currentIndex;
                this.zoomImage.src = imageSrc;
                this.zoomLevel = 1;
                this.zoomImage.style.transform = 'scale(1)';
                this.zoomImage.style.cursor = 'zoom-in';

                this.updateZoomCounter();
                this.zoomModal.style.display = 'block';

                // Prevent body scroll
                document.body.style.overflow = 'hidden';
            }

            closeZoomModal() {
                this.zoomModal.style.display = 'none';
                this.zoomLevel = 1;
                this.lastPinchDistance = null;
                document.body.style.overflow = '';
            }

            startDragging(e) {
                this.isDragging = true;
                this.startX = e.clientX - this.zoomImage.offsetLeft;
                this.startY = e.clientY - this.zoomImage.offsetTop;
                this.zoomImage.style.cursor = 'grabbing';
            }

            dragImage(e) {
                if (!this.isDragging) return;

                e.preventDefault();
                const x = e.clientX - this.startX;
                const y = e.clientY - this.startY;

                // Calculate max drag based on zoom level
                const maxDrag = (this.zoomLevel - 1) * 100;
                const constrainedX = Math.max(-maxDrag, Math.min(x, maxDrag));
                const constrainedY = Math.max(-maxDrag, Math.min(y, maxDrag));

                this.zoomImage.style.transform = `scale(${this.zoomLevel}) translate(${constrainedX}px, ${constrainedY}px)`;
            }

            showNextImage() {
                const totalImages = this.thumbnailBtns.length;
                this.currentZoomIndex = (this.currentZoomIndex + 1) % totalImages;
                this.updateZoomImage();
            }

            showPrevImage() {
                const totalImages = this.thumbnailBtns.length;
                this.currentZoomIndex = (this.currentZoomIndex - 1 + totalImages) % totalImages;
                this.updateZoomImage();
            }

            updateZoomImage() {
                const thumbnailBtn = document.querySelector(`.thumbnail-btn[data-image-index="${this.currentZoomIndex}"]`);
                if (thumbnailBtn) {
                    const imageSrc = thumbnailBtn.getAttribute('data-image-src');
                    this.zoomImage.src = imageSrc;
                    this.zoomLevel = 1;
                    this.zoomImage.style.transform = 'scale(1)';
                    this.updateZoomCounter();
                }
            }

            updateZoomCounter() {
                const counter = document.getElementById('zoomModalCounter');
                if (counter) {
                    counter.textContent = `${this.currentZoomIndex + 1} / ${this.thumbnailBtns.length}`;
                }
            }
        }

        /* =====================
           WISHLIST FUNCTIONALITY
        ===================== */
        function initWishlist() {
            const wishlistBtn = document.getElementById('wishlist-btn');
            const imageWishlistBtn = document.getElementById('image-wishlist-btn');
            const productId = wishlistBtn?.getAttribute('data-product-id') || '1';

            // Get product details
            const productName = document.querySelector('h1')?.textContent || 'Power Gel';
            const productImage = document.getElementById('main-product-image')?.src || 'https://www.vedherbsandayurveda.com/products-img/Power-Gel.PNG';
            const productPrice = document.querySelector('span.text-2xl')?.textContent || '₹599';
            const selectedWeight = document.querySelector('.weight-option.border-emerald-500')?.textContent.trim() || '4 ML';

            // Load wishlist from localStorage
            let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

            // Check if product is already in wishlist
            const isInWishlist = wishlist.some(item => item.id === productId);

            // Update button state
            function updateWishlistButtonState(isAdded) {
                const wishlistText = document.querySelector('.wishlist-text');
                const heartIcon = document.querySelector('.heart-icon');

                if (isAdded) {
                    wishlistBtn.classList.add('active');
                    if (imageWishlistBtn) imageWishlistBtn.classList.add('active');
                    wishlistText.textContent = 'In Wishlist';
                    heartIcon.setAttribute('icon', 'lucide:heart');
                    heartIcon.style.color = '#dc2626';
                    heartIcon.style.fill = '#dc2626';
                } else {
                    wishlistBtn.classList.remove('active');
                    if (imageWishlistBtn) imageWishlistBtn.classList.remove('active');
                    wishlistText.textContent = 'Save to Wishlist';
                    heartIcon.setAttribute('icon', 'lucide:heart');
                    heartIcon.style.color = '';
                    heartIcon.style.fill = '';
                }
            }

            // Initialize button state
            updateWishlistButtonState(isInWishlist);

            // Add/Remove from wishlist
            function toggleWishlist() {
                const productData = {
                    id: productId,
                    name: productName,
                    image: productImage,
                    price: productPrice.replace(/[^0-9.]/g, ''),
                    formattedPrice: productPrice,
                    weight: selectedWeight,
                    dateAdded: new Date().toISOString()
                };

                const index = wishlist.findIndex(item => item.id === productId);

                if (index === -1) {
                    // Add to wishlist
                    wishlist.push(productData);
                    showWishlistNotification('added', productName);
                    updateWishlistButtonState(true);
                } else {
                    // Remove from wishlist
                    wishlist.splice(index, 1);
                    showWishlistNotification('removed', productName);
                    updateWishlistButtonState(false);
                }

                // Save to localStorage
                localStorage.setItem('wishlist', JSON.stringify(wishlist));

                // Trigger custom event for header update
                window.dispatchEvent(new CustomEvent('wishlistUpdated', {
                    detail: { wishlist }
                }));
            }

            // Show wishlist notification
            function showWishlistNotification(action, productName) {
                // Remove existing notifications
                document.querySelectorAll('.wishlist-notification').forEach(el => el.remove());

                const notification = document.createElement('div');
                notification.className = 'wishlist-notification fixed top-4 right-4 sm:right-6 z-50 bg-white rounded-lg shadow-lg border border-emerald-200 p-4 max-w-xs animate-slide-in';

                const isAdded = action === 'added';
                const icon = isAdded ? 'lucide:heart' : 'lucide:heart-off';
                const iconColor = isAdded ? 'text-red-600' : 'text-stone-600';
                const message = isAdded ? 'Added to Wishlist!' : 'Removed from Wishlist';

                notification.innerHTML = `
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded overflow-hidden bg-red-50 flex items-center justify-center flex-shrink-0">
                            <iconify-icon icon="${icon}" width="20" class="${iconColor}"></iconify-icon>
                        </div>
                        <div class="flex-1">
                            <p class="font-medium text-stone-900">${message}</p>
                            <p class="text-sm text-stone-600 mt-1">${productName}</p>
                            <div class="flex items-center justify-between mt-3">
                                <a href="{{ route('customer.wishlist') }}" class="text-emerald-700 hover:text-emerald-800 font-medium text-sm">
                                    ${isAdded ? 'View Wishlist →' : 'Browse Products →'}
                                </a>
                                <button class="close-notification text-stone-400 hover:text-stone-600 bg-transparent border-none p-1 cursor-pointer">
                                    <iconify-icon icon="lucide:x" width="14"></iconify-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                document.body.appendChild(notification);

                notification.querySelector('.close-notification').addEventListener('click', () => {
                    notification.remove();
                });

                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }

            // Add event listeners
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', toggleWishlist);
            }

            if (imageWishlistBtn) {
                imageWishlistBtn.addEventListener('click', toggleWishlist);
            }
        }

        /* =====================
           IMAGE GALLERY FUNCTIONALITY WITH SLIDING EFFECT
        ===================== */
        function initImageGallery() {
            const mainImage = document.getElementById('main-product-image');
            const prevBtn = document.getElementById('prev-image-btn');
            const nextBtn = document.getElementById('next-image-btn');
            const thumbnailBtns = document.querySelectorAll('.thumbnail-btn');
            const imageContainer = document.getElementById('main-image-container');
            const imageWrapper = imageContainer.querySelector('.relative');

            // Get all images from thumbnails
            const imageSources = [];
            const imageAlts = [];

            thumbnailBtns.forEach((btn, index) => {
                const src = btn.getAttribute('data-image-src');
                const alt = btn.getAttribute('data-image-alt');
                if (src) {
                    imageSources.push(src);
                    imageAlts.push(alt || `Power Gel Image ${index + 1}`);
                }
            });

            let currentIndex = parseInt(mainImage.getAttribute('data-current-index')) || 0;
            const totalImages = imageSources.length;
            let isAnimating = false;

            // Function to show image with sliding effect
            function showImage(index, direction = 'next') {
                if (index < 0 || index >= totalImages || isAnimating) return;

                isAnimating = true;

                // Create new image element
                const newImage = document.createElement('img');
                newImage.src = imageSources[index];
                newImage.alt = imageAlts[index];
                newImage.className = 'main-image-zoom absolute top-0 left-0';
                newImage.style.width = '100%';
                newImage.style.height = '100%';
                newImage.style.zIndex = '1';
                newImage.style.backgroundColor = '#F0EFEC';

                // Set initial position based on direction
                if (direction === 'next') {
                    newImage.style.transform = 'translateX(100%)';
                } else {
                    newImage.style.transform = 'translateX(-100%)';
                }
                newImage.style.opacity = '0';
                newImage.style.transition = 'transform 0.3s ease, opacity 0.3s ease';

                // Add new image to container
                imageWrapper.appendChild(newImage);

                // Force reflow
                newImage.getBoundingClientRect();

                // Set current image styles
                mainImage.style.zIndex = '2';
                mainImage.style.transition = 'transform 0.3s ease, opacity 0.3s ease';

                // Animate both images simultaneously
                requestAnimationFrame(() => {
                    // Animate new image in
                    newImage.style.transform = 'translateX(0)';
                    newImage.style.opacity = '1';

                    // Animate old image out
                    if (direction === 'next') {
                        mainImage.style.transform = 'translateX(-100%)';
                    } else {
                        mainImage.style.transform = 'translateX(100%)';
                    }
                    mainImage.style.opacity = '0';
                });

                // After animation completes, clean up and update
                setTimeout(() => {
                    // Remove transition from old image
                    mainImage.style.transition = 'none';
                    mainImage.style.transform = 'translateX(0)';
                    mainImage.style.opacity = '1';
                    mainImage.style.zIndex = '1';

                    // Remove old image source and attributes
                    mainImage.src = newImage.src;
                    mainImage.alt = newImage.alt;
                    mainImage.setAttribute('data-current-index', index);

                    // Update hover zoom with new image
                    if (window.hoverZoom) {
                        window.hoverZoom.updateImage(newImage.src);
                    }

                    // Remove the temporary new image
                    newImage.remove();

                    // Update current index
                    currentIndex = index;

                    // Update thumbnail selection
                    updateThumbnailSelection(index);

                    isAnimating = false;
                }, 300);
            }

            // Function to update thumbnail selection
            function updateThumbnailSelection(index) {
                thumbnailBtns.forEach((btn, i) => {
                    if (i === index) {
                        btn.classList.remove('border-stone-300', 'hover:border-emerald-500');
                        btn.classList.add('border-2', 'border-emerald-500');
                    } else {
                        btn.classList.remove('border-2', 'border-emerald-500');
                        btn.classList.add('border', 'border-stone-300', 'hover:border-emerald-500');
                    }
                });
            }

            // Function to show next image
            function showNextImage() {
                const nextIndex = (currentIndex + 1) % totalImages;
                showImage(nextIndex, 'next');
            }

            // Function to show previous image
            function showPrevImage() {
                const prevIndex = (currentIndex - 1 + totalImages) % totalImages;
                showImage(prevIndex, 'prev');
            }

            // Function to show specific image
            function showSpecificImage(index) {
                if (index !== currentIndex && !isAnimating) {
                    const direction = index > currentIndex ? 'next' : 'prev';
                    showImage(index, direction);
                }
            }

            // Add event listeners
            if (nextBtn) {
                nextBtn.addEventListener('click', showNextImage);
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', showPrevImage);
            }

            // Add event listeners to thumbnails
            thumbnailBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const index = parseInt(this.getAttribute('data-image-index'));
                    showSpecificImage(index);
                });
            });

            // Add keyboard navigation
            document.addEventListener('keydown', function (e) {
                if (e.key === 'ArrowRight') {
                    showNextImage();
                } else if (e.key === 'ArrowLeft') {
                    showPrevImage();
                }
            });

            // Add touch/swipe support
            let touchStartX = 0;
            const swipeThreshold = 50;

            function handleTouchStart(e) {
                touchStartX = e.touches[0].clientX;
            }

            function handleTouchEnd(e) {
                const touchEndX = e.changedTouches[0].clientX;
                const diff = touchStartX - touchEndX;

                if (Math.abs(diff) > swipeThreshold && !isAnimating) {
                    if (diff > 0) {
                        // Swipe left - next image
                        showNextImage();
                    } else {
                        // Swipe right - previous image
                        showPrevImage();
                    }
                }
            }

            // Add touch events to image container
            if (imageContainer) {
                imageContainer.addEventListener('touchstart', handleTouchStart, { passive: true });
                imageContainer.addEventListener('touchend', handleTouchEnd, { passive: true });
            }

            // Initialize
            updateThumbnailSelection(currentIndex);
        }

        /* =====================
           TAB FUNCTIONALITY
        ===================== */
        const tabButtons = document.querySelectorAll('.tab-btn');
        const tabPanes = document.querySelectorAll('.tab-pane');

        // Function to show a specific tab
        function showTab(tabName) {
            // Hide all tab panes
            tabPanes.forEach(pane => {
                pane.classList.remove('active');
                pane.classList.add('hidden');
            });

            // Remove active class from all tab buttons
            tabButtons.forEach(button => {
                button.classList.remove('border-b-2', 'border-emerald-900', 'text-emerald-900');
                button.classList.add('text-stone-500');
            });

            // Show the selected tab pane
            const selectedPane = document.getElementById(tabName + '-tab');
            if (selectedPane) {
                selectedPane.classList.remove('hidden');
                selectedPane.classList.add('active');
            }

            // Activate the corresponding button
            const selectedButton = document.querySelector(`.tab-btn[data-tab="${tabName}"]`);
            if (selectedButton) {
                selectedButton.classList.remove('text-stone-500');
                selectedButton.classList.add('border-b-2', 'border-emerald-900', 'text-emerald-900');
            }
        }

        // Set initial tab
        showTab('description');

        // Add click event to all tab buttons
        tabButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const tabName = this.getAttribute('data-tab');
                showTab(tabName);
            });
        });

        /* =====================
           PRODUCT SELECTION FUNCTIONS
        ===================== */
        // Weight Selection
        const weightButtons = document.querySelectorAll('.weight-option');
        if (weightButtons.length > 0) {
            // Set first weight as selected by default
            weightButtons[0].classList.add('border-emerald-500', 'bg-emerald-50', 'text-emerald-800');
            weightButtons[0].classList.remove('border-stone-300');

            weightButtons.forEach(button => {
                button.addEventListener('click', function () {
                    weightButtons.forEach(btn => {
                        btn.classList.remove('border-emerald-500', 'bg-emerald-50', 'text-emerald-800');
                        btn.classList.add('border-stone-300');
                    });
                    this.classList.remove('border-stone-300');
                    this.classList.add('border-emerald-500', 'bg-emerald-50', 'text-emerald-800');
                });
            });
        }

        // Quantity Selector
        const minusBtn = document.querySelector('.quantity-minus');
        const plusBtn = document.querySelector('.quantity-plus');
        const quantityInput = document.querySelector('.quantity-input');

        minusBtn?.addEventListener('click', function () {
            let value = parseInt(quantityInput.value);
            if (value > 1) {
                quantityInput.value = value - 1;
            }
        });

        plusBtn?.addEventListener('click', function () {
            let value = parseInt(quantityInput.value);
            if (value < 10) {
                quantityInput.value = value + 1;
            }
        });

        quantityInput?.addEventListener('change', function () {
            let value = parseInt(this.value);
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > 10) {
                this.value = 10;
            }
        });

        /* =====================
           ADD TO CART FUNCTIONALITY
        ===================== */
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        if (addToCartBtn) {
            const btnText = addToCartBtn.querySelector('.btn-text');
            const btnIcon = addToCartBtn.querySelector('iconify-icon');

            addToCartBtn.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                const productName = document.querySelector('h1').textContent;
                const selectedWeight = document.querySelector('.weight-option.border-emerald-500')?.textContent.trim() || '4 ML';
                const quantity = document.querySelector('.quantity-input').value;

                // Get price safely
                let price = 0;
                const priceElement = document.querySelector('span.text-2xl');
                if (priceElement) {
                    const priceText = priceElement.textContent.replace(/[^0-9.]/g, '');
                    price = parseFloat(priceText) || 599;
                }

                // Button state change
                const originalText = btnText.textContent;
                const originalIcon = btnIcon.getAttribute('icon');

                btnText.textContent = 'Added to Cart';
                btnIcon.setAttribute('icon', 'lucide:check');
                addToCartBtn.classList.remove('bg-emerald-900', 'hover:bg-emerald-800');
                addToCartBtn.classList.add('bg-emerald-700');
                addToCartBtn.disabled = true;

                // Animation
                addToCartBtn.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    addToCartBtn.style.transform = 'scale(1)';
                }, 150);

                // Create cart item
                const cartItem = {
                    id: productId,
                    name: productName,
                    weight: selectedWeight,
                    quantity: parseInt(quantity),
                    price: price,
                    total: price * parseInt(quantity),
                    image: document.querySelector('.aspect-square img')?.src || ''
                };

                // Save to localStorage
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                const existingItemIndex = cart.findIndex(item =>
                    item.id === cartItem.id && item.weight === cartItem.weight
                );

                if (existingItemIndex !== -1) {
                    cart[existingItemIndex].quantity += cartItem.quantity;
                    cart[existingItemIndex].total = cart[existingItemIndex].price * cart[existingItemIndex].quantity;
                } else {
                    cart.push(cartItem);
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                // Show notification
                showCartNotification(cartItem);

                // Reset button after 3 seconds
                setTimeout(() => {
                    btnText.textContent = originalText;
                    btnIcon.setAttribute('icon', originalIcon);
                    addToCartBtn.classList.remove('bg-emerald-700');
                    addToCartBtn.classList.add('bg-emerald-900', 'hover:bg-emerald-800');
                    addToCartBtn.disabled = false;
                }, 3000);
            });

            function showCartNotification(item) {
                // Remove existing notifications
                document.querySelectorAll('.cart-notification').forEach(el => el.remove());

                const notification = document.createElement('div');
                notification.className = 'cart-notification fixed top-4 right-4 sm:right-6 z-50 bg-white rounded-lg shadow-lg border border-emerald-200 p-4 max-w-xs animate-slide-in';
                notification.innerHTML = `
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded overflow-hidden bg-emerald-100 flex items-center justify-center flex-shrink-0">
                        <iconify-icon icon="lucide:check-circle" width="20" class="text-emerald-600"></iconify-icon>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium text-stone-900">Added to Cart!</p>
                        <p class="text-sm text-stone-600 mt-1">${item.quantity}x ${item.name} (${item.weight})</p>
                        <div class="flex items-center justify-between mt-3">
                            <a href="{{ route('customer.cart') }}" class="text-emerald-700 hover:text-emerald-800 font-medium text-sm">
                                View Cart →
                            </a>
                            <button class="close-notification text-stone-400 hover:text-stone-600 bg-transparent border-none p-1 cursor-pointer">
                                <iconify-icon icon="lucide:x" width="14"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            `;

                document.body.appendChild(notification);

                notification.querySelector('.close-notification').addEventListener('click', () => {
                    notification.remove();
                });

                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 5000);
            }
        }

        /* =====================
           MOBILE SCROLL FOR TABS
        ===================== */
        const tabsContainer = document.querySelector('#product-tabs');
        if (tabsContainer && window.innerWidth < 640) {
            let isDown = false;
            let startX;
            let scrollLeft;

            tabsContainer.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - tabsContainer.offsetLeft;
                scrollLeft = tabsContainer.scrollLeft;
                tabsContainer.style.cursor = 'grabbing';
            });

            tabsContainer.addEventListener('mouseleave', () => {
                isDown = false;
                tabsContainer.style.cursor = 'grab';
            });

            tabsContainer.addEventListener('mouseup', () => {
                isDown = false;
                tabsContainer.style.cursor = 'grab';
            });

            tabsContainer.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - tabsContainer.offsetLeft;
                const walk = (x - startX) * 2;
                tabsContainer.scrollLeft = scrollLeft - walk;
            });

            // Touch events
            tabsContainer.addEventListener('touchstart', (e) => {
                isDown = true;
                startX = e.touches[0].pageX - tabsContainer.offsetLeft;
                scrollLeft = tabsContainer.scrollLeft;
            });

            tabsContainer.addEventListener('touchend', () => {
                isDown = false;
            });

            tabsContainer.addEventListener('touchmove', (e) => {
                if (!isDown) return;
                const x = e.touches[0].pageX - tabsContainer.offsetLeft;
                const walk = (x - startX) * 2;
                tabsContainer.scrollLeft = scrollLeft - walk;
            });
        }

        // Initialize all functionalities
        window.hoverZoom = new AmazonHoverZoom();
        window.simpleZoom = new SimpleImageZoom();
        initWishlist();
        initImageGallery();
    });
</script>
@endpush