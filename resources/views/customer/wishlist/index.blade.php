@extends('customer.layouts.master')

@section('title', 'My Wishlist - Ayurvedic Products')

@push('styles')
<style>
    .wishlist-item {
        transition: all 0.3s ease;
    }
    .wishlist-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .empty-wishlist {
        animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .remove-btn {
        transition: all 0.2s ease;
    }
    .remove-btn:hover {
        transform: scale(1.1);
        color: #dc2626;
    }
    .demo-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #f59e0b;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 600;
        z-index: 10;
    }
</style>
@endpush

@section('content')
    <!-- Main Content -->
    <div class="min-h-screen">
        <!-- Breadcrumb -->
        <div class="bg-white border-b border-stone-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <nav class="flex text-sm text-stone-600">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                                <iconify-icon icon="lucide:home" width="16" class="mr-2"></iconify-icon>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                                <span class="ml-1 md:ml-2 text-stone-900 font-medium">My Wishlist</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Wishlist Header -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-serif font-semibold text-stone-900">My Wishlist</h1>
                    <p class="text-stone-600 mt-2">Your saved Ayurvedic products</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-stone-500" id="item-count">0 items</span>
                    <button onclick="clearWishlist()" class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                        <iconify-icon icon="lucide:trash-2" width="16" class="mr-2"></iconify-icon>
                        Clear All
                    </button>
                </div>
            </div>

            <!-- Wishlist Content -->
            <div id="wishlist-content">
                <!-- Items will be loaded here dynamically -->
            </div>

            <!-- Demo Products Section -->
            <div id="demo-wishlist" class="hidden">
                <div class="mb-10">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-medium text-stone-800">Sample Ayurvedic Products</h2>
                        <span class="text-sm text-amber-600 bg-amber-50 px-3 py-1 rounded-full">For Demonstration</span>
                    </div>
                    
                    <!-- Demo Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <!-- Demo Product 1 -->
                        <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden relative">
                            <div class="demo-badge">DEMO</div>
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <div class="w-full sm:w-32 h-32 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1576045057995-568f588f82fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
                                             alt="Ashwagandha Powder" 
                                             class="w-full h-full object-contain object-center mix-blend-multiply">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-stone-900 mb-2">Organic Ashwagandha Powder</h3>
                                        <p class="text-stone-600 text-sm mb-4">Pure Withania Somnifera root powder for stress relief, energy boost, and better sleep</p>
                                        
                                        <div class="flex items-center gap-2 text-sm text-stone-600 mb-3">
                                            <span class="flex items-center">
                                                <iconify-icon icon="lucide:star" width="12" class="text-yellow-600 fill-yellow-600 mr-1"></iconify-icon>
                                                4.8 (156 reviews)
                                            </span>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                AYUSH Certified
                                            </span>
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                Organic
                                            </span>
                                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">
                                                Stress Relief
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-xl font-bold text-emerald-900">₹899.00</div>
                                                <div class="text-sm text-stone-400 line-through">₹1,299.00</div>
                                                <span class="text-xs text-emerald-600 font-medium">30% OFF</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button onclick="addDemoToCart('demo-ashwagandha')" 
                                                        class="px-4 py-2 bg-emerald-900 text-white text-sm font-medium rounded-lg hover:bg-emerald-800 transition-colors flex items-center gap-2">
                                                    <iconify-icon icon="lucide:shopping-bag" width="14"></iconify-icon>
                                                    Add to Cart
                                                </button>
                                                <button onclick="removeDemoItem('demo-ashwagandha')" 
                                                        class="remove-btn w-10 h-10 flex items-center justify-center text-stone-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                                    <iconify-icon icon="lucide:x" width="16"></iconify-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Demo Product 2 -->
                        <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden relative">
                            <div class="demo-badge">DEMO</div>
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <div class="w-full sm:w-32 h-32 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
                                             alt="Turmeric Capsules" 
                                             class="w-full h-full object-contain object-center mix-blend-multiply">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-stone-900 mb-2">Turmeric & Curcumin Capsules</h3>
                                        <p class="text-stone-600 text-sm mb-4">High potency turmeric with black pepper for better absorption and anti-inflammatory benefits</p>
                                        
                                        <div class="flex items-center gap-2 text-sm text-stone-600 mb-3">
                                            <span class="flex items-center">
                                                <iconify-icon icon="lucide:star" width="12" class="text-yellow-600 fill-yellow-600 mr-1"></iconify-icon>
                                                4.7 (89 reviews)
                                            </span>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                AYUSH Certified
                                            </span>
                                            <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">
                                                Anti-Inflammatory
                                            </span>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                                95% Curcumin
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-xl font-bold text-emerald-900">₹1,299.00</div>
                                                <div class="text-sm text-stone-400 line-through">₹1,999.00</div>
                                                <span class="text-xs text-emerald-600 font-medium">35% OFF</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button onclick="addDemoToCart('demo-turmeric')" 
                                                        class="px-4 py-2 bg-emerald-900 text-white text-sm font-medium rounded-lg hover:bg-emerald-800 transition-colors flex items-center gap-2">
                                                    <iconify-icon icon="lucide:shopping-bag" width="14"></iconify-icon>
                                                    Add to Cart
                                                </button>
                                                <button onclick="removeDemoItem('demo-turmeric')" 
                                                        class="remove-btn w-10 h-10 flex items-center justify-center text-stone-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                                    <iconify-icon icon="lucide:x" width="16"></iconify-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Demo Product 3 -->
                        <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden relative">
                            <div class="demo-badge">DEMO</div>
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <div class="w-full sm:w-32 h-32 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1594736797933-d0a71b6e5f1c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
                                             alt="Brahmi Oil" 
                                             class="w-full h-full object-contain object-center mix-blend-multiply">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-stone-900 mb-2">Brahmi (Bacopa) Memory Oil</h3>
                                        <p class="text-stone-600 text-sm mb-4">Traditional herbal hair oil for memory enhancement, concentration, and scalp health</p>
                                        
                                        <div class="flex items-center gap-2 text-sm text-stone-600 mb-3">
                                            <span class="flex items-center">
                                                <iconify-icon icon="lucide:star" width="12" class="text-yellow-600 fill-yellow-600 mr-1"></iconify-icon>
                                                4.9 (234 reviews)
                                            </span>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                AYUSH Certified
                                            </span>
                                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 text-xs font-medium rounded-full">
                                                Memory Boost
                                            </span>
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                                Hair Growth
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-xl font-bold text-emerald-900">₹699.00</div>
                                                <div class="text-sm text-stone-400 line-through">₹999.00</div>
                                                <span class="text-xs text-emerald-600 font-medium">30% OFF</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button onclick="addDemoToCart('demo-brahmi')" 
                                                        class="px-4 py-2 bg-emerald-900 text-white text-sm font-medium rounded-lg hover:bg-emerald-800 transition-colors flex items-center gap-2">
                                                    <iconify-icon icon="lucide:shopping-bag" width="14"></iconify-icon>
                                                    Add to Cart
                                                </button>
                                                <button onclick="removeDemoItem('demo-brahmi')" 
                                                        class="remove-btn w-10 h-10 flex items-center justify-center text-stone-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                                    <iconify-icon icon="lucide:x" width="16"></iconify-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Demo Product 4 -->
                        <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden relative">
                            <div class="demo-badge">DEMO</div>
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row gap-6">
                                    <div class="w-full sm:w-32 h-32 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1584302179602-e9e2f7c8e073?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
                                             alt="Triphala Powder" 
                                             class="w-full h-full object-contain object-center mix-blend-multiply">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-lg text-stone-900 mb-2">Triphala Digestive Powder</h3>
                                        <p class="text-stone-600 text-sm mb-4">Classic Ayurvedic formula of three fruits for digestion, detoxification, and overall wellness</p>
                                        
                                        <div class="flex items-center gap-2 text-sm text-stone-600 mb-3">
                                            <span class="flex items-center">
                                                <iconify-icon icon="lucide:star" width="12" class="text-yellow-600 fill-yellow-600 mr-1"></iconify-icon>
                                                4.6 (178 reviews)
                                            </span>
                                        </div>
                                        
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span class="px-2 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                                AYUSH Certified
                                            </span>
                                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                                Detox
                                            </span>
                                            <span class="px-2 py-1 bg-teal-100 text-teal-800 text-xs font-medium rounded-full">
                                                Digestive Aid
                                            </span>
                                        </div>
                                        
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <div class="text-xl font-bold text-emerald-900">₹499.00</div>
                                                <div class="text-sm text-stone-400 line-through">₹749.00</div>
                                                <span class="text-xs text-emerald-600 font-medium">33% OFF</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button onclick="addDemoToCart('demo-triphala')" 
                                                        class="px-4 py-2 bg-emerald-900 text-white text-sm font-medium rounded-lg hover:bg-emerald-800 transition-colors flex items-center gap-2">
                                                    <iconify-icon icon="lucide:shopping-bag" width="14"></iconify-icon>
                                                    Add to Cart
                                                </button>
                                                <button onclick="removeDemoItem('demo-triphala')" 
                                                        class="remove-btn w-10 h-10 flex items-center justify-center text-stone-400 hover:text-red-600 rounded-full hover:bg-red-50">
                                                    <iconify-icon icon="lucide:x" width="16"></iconify-icon>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add All Demo Products Button -->
                    <div class="text-center">
                        <button onclick="addAllDemoToWishlist()" 
                                class="px-6 py-3 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition-colors flex items-center gap-2 mx-auto">
                            <iconify-icon icon="lucide:heart" width="16"></iconify-icon>
                            Add All Demo Products to Wishlist
                        </button>
                        <p class="text-sm text-stone-500 mt-2">Click to add these sample Ayurvedic products to your wishlist</p>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div id="empty-wishlist" class="hidden empty-wishlist">
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-emerald-100 flex items-center justify-center">
                        <iconify-icon icon="lucide:heart" width="48" class="text-emerald-600"></iconify-icon>
                    </div>
                    <h3 class="text-2xl font-semibold text-stone-900 mb-3">Your wishlist is empty</h3>
                    <p class="text-stone-600 max-w-md mx-auto mb-8">
                        Save your favorite Ayurvedic products here to easily find them later.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('customer.products.shop') }}" 
                           class="inline-flex items-center px-6 py-3 bg-emerald-900 text-white font-medium rounded-lg hover:bg-emerald-800 transition-colors">
                            <iconify-icon icon="lucide:shopping-bag" width="18" class="mr-2"></iconify-icon>
                            Start Shopping
                        </a>
                        <button onclick="addSampleData()" 
                                class="inline-flex items-center px-6 py-3 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition-colors">
                            <iconify-icon icon="lucide:sparkles" width="18" class="mr-2"></iconify-icon>
                            Load Sample Products
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Dummy data for demonstration
    const dummyProducts = [
        {
            id: 'prod-ashwagandha',
            name: 'Organic Ashwagandha Powder',
            price: 899.00,
            originalPrice: 1299.00,
            image: 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80',
            category: 'Stress Relief',
            rating: 4.8,
            reviews: 156,
            description: 'Pure Withania Somnifera root powder for stress relief, energy boost, and better sleep',
            tags: ['AYUSH Certified', 'Organic', 'Stress Relief'],
            inStock: true,
            stock: 125
        },
        {
            id: 'prod-turmeric',
            name: 'Turmeric & Curcumin Capsules',
            price: 1299.00,
            originalPrice: 1999.00,
            image: 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80',
            category: 'Anti-Inflammatory',
            rating: 4.7,
            reviews: 89,
            description: 'High potency turmeric with black pepper for better absorption',
            tags: ['AYUSH Certified', '95% Curcumin', 'Anti-Inflammatory'],
            inStock: true,
            stock: 85
        },
        {
            id: 'prod-brahmi',
            name: 'Brahmi (Bacopa) Memory Oil',
            price: 699.00,
            originalPrice: 999.00,
            image: 'https://images.unsplash.com/photo-1594736797933-d0a71b6e5f1c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80',
            category: 'Brain Health',
            rating: 4.9,
            reviews: 234,
            description: 'Traditional herbal hair oil for memory enhancement and concentration',
            tags: ['AYUSH Certified', 'Memory Boost', 'Hair Growth'],
            inStock: true,
            stock: 200
        },
        {
            id: 'prod-triphala',
            name: 'Triphala Digestive Powder',
            price: 499.00,
            originalPrice: 749.00,
            image: 'https://images.unsplash.com/photo-1584302179602-e9e2f7c8e073?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80',
            category: 'Digestive Health',
            rating: 4.6,
            reviews: 178,
            description: 'Classic Ayurvedic formula for digestion and detoxification',
            tags: ['AYUSH Certified', 'Detox', 'Digestive Aid'],
            inStock: true,
            stock: 150
        },
        {
            id: 'prod-neem',
            name: 'Neem & Tulsi Face Wash',
            price: 349.00,
            originalPrice: 499.00,
            image: 'https://images.unsplash.com/photo-1556228578-9c360e1c0c59?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80',
            category: 'Skin Care',
            rating: 4.5,
            reviews: 92,
            description: 'Natural anti-acne face wash with neem and tulsi extracts',
            tags: ['Herbal', 'Anti-Acne', 'Skin Care'],
            inStock: true,
            stock: 300
        },
        {
            id: 'prod-shilajit',
            name: 'Pure Himalayan Shilajit Resin',
            price: 1899.00,
            originalPrice: 2499.00,
            image: 'https://images.unsplash.com/photo-1629734701361-4b7b2f2c5b0a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80',
            category: 'Energy & Vitality',
            rating: 4.8,
            reviews: 67,
            description: 'Authentic Himalayan Shilajit for energy, stamina, and vitality',
            tags: ['Himalayan', 'Energy Boost', 'Mineral Rich'],
            inStock: false,
            stock: 0
        }
    ];

    document.addEventListener('DOMContentLoaded', function() {
        loadWishlist();
        showDemoIfEmpty();
        
        window.addEventListener('storage', function(e) {
            if (e.key === 'wishlist') {
                loadWishlist();
                showDemoIfEmpty();
            }
        });
    });

    function loadWishlist() {
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const container = document.getElementById('wishlist-content');
        const emptyState = document.getElementById('empty-wishlist');
        const demoState = document.getElementById('demo-wishlist');
        const itemCount = document.getElementById('item-count');
        
        const totalItems = wishlist.length;
        itemCount.textContent = `${totalItems} ${totalItems === 1 ? 'item' : 'items'}`;
        
        if (wishlist.length === 0) {
            container.innerHTML = '';
            return;
        }
        
        emptyState.classList.add('hidden');
        demoState.classList.add('hidden');
        
        container.innerHTML = `
            <div class="bg-white rounded-xl shadow-sm border border-stone-200 overflow-hidden">
                <div class="hidden sm:grid grid-cols-12 gap-4 p-4 bg-stone-50 border-b border-stone-200 text-sm font-medium text-stone-700">
                    <div class="col-span-5">Product</div>
                    <div class="col-span-2 text-center">Price</div>
                    <div class="col-span-3 text-center">Status</div>
                    <div class="col-span-2 text-center">Actions</div>
                </div>
                <div id="wishlist-items"></div>
            </div>
        `;
        
        const itemsContainer = document.getElementById('wishlist-items');
        wishlist.forEach(item => {
            const itemElement = createWishlistItem(item);
            itemsContainer.appendChild(itemElement);
        });
    }

    function showDemoIfEmpty() {
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const emptyState = document.getElementById('empty-wishlist');
        const demoState = document.getElementById('demo-wishlist');
        
        if (wishlist.length === 0) {
            emptyState.classList.remove('hidden');
            demoState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
            demoState.classList.add('hidden');
        }
    }

    function createWishlistItem(item) {
        const product = dummyProducts.find(p => p.id === item.id) || item;
        const discount = product.originalPrice ? Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100) : 0;
        
        const div = document.createElement('div');
        div.className = 'wishlist-item p-4 border-b border-stone-200 last:border-b-0 hover:bg-stone-50';
        div.setAttribute('data-id', item.id);
        
        const statusHtml = product.inStock ? `
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm font-medium">
                <iconify-icon icon="lucide:check-circle" width="12" class="mr-1"></iconify-icon>
                In Stock
            </span>
            <p class="text-xs text-stone-500 mt-1">${product.stock || '125'} available</p>
        ` : `
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm font-medium">
                <iconify-icon icon="lucide:x-circle" width="12" class="mr-1"></iconify-icon>
                Out of Stock
            </span>
            <p class="text-xs text-stone-500 mt-1">Will be back soon</p>
        `;
        
        div.innerHTML = `
            <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                <div class="col-span-5">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                            <img src="${product.image}" alt="${product.name}" 
                                 class="w-full h-full object-contain object-center mix-blend-multiply">
                        </div>
                        <div>
                            <h3 class="font-medium text-stone-900 mb-1">${product.name}</h3>
                            <p class="text-sm text-stone-600 mb-2">${product.description || 'Ayurvedic wellness product'}</p>
                            <div class="flex items-center gap-2 text-sm text-stone-600">
                                <span class="flex items-center">
                                    <iconify-icon icon="lucide:star" width="12" class="text-yellow-600 fill-yellow-600 mr-1"></iconify-icon>
                                    ${product.rating || '4.2'} (${product.reviews || '42'} reviews)
                                </span>
                            </div>
                            <div class="mt-2 flex flex-wrap gap-2">
                                ${(product.tags || ['AYUSH Certified']).slice(0, 2).map(tag => `
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-800 text-xs font-medium rounded-full">
                                        ${tag}
                                    </span>
                                `).join('')}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="text-center">
                        <div class="text-lg font-semibold text-stone-900">₹${product.price.toFixed(2)}</div>
                        ${product.originalPrice ? `
                            <div class="text-sm text-stone-400 line-through">₹${product.originalPrice.toFixed(2)}</div>
                            <span class="text-xs text-emerald-600 font-medium">${discount}% OFF</span>
                        ` : ''}
                    </div>
                </div>
                <div class="col-span-3">
                    <div class="text-center">
                        ${statusHtml}
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
                        <button onclick="addToCartFromWishlist('${product.id}')" 
                                class="w-full sm:w-auto px-4 py-2 bg-emerald-900 text-white text-sm font-medium rounded-lg hover:bg-emerald-800 transition-colors flex items-center justify-center gap-2 ${!product.inStock ? 'opacity-50 cursor-not-allowed' : ''}"
                                ${!product.inStock ? 'disabled' : ''}>
                            <iconify-icon icon="lucide:shopping-bag" width="14"></iconify-icon>
                            ${product.inStock ? 'Add to Cart' : 'Out of Stock'}
                        </button>
                        <button onclick="removeFromWishlist('${product.id}')" 
                                class="remove-btn w-8 h-8 flex items-center justify-center text-stone-400 hover:text-red-600 rounded-full hover:bg-red-50">
                            <iconify-icon icon="lucide:x" width="16"></iconify-icon>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        return div;
    }

    function addSampleData() {
        // Add first 4 dummy products to wishlist
        const sampleProducts = dummyProducts.slice(0, 4);
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        
        sampleProducts.forEach(product => {
            if (!wishlist.find(item => item.id === product.id)) {
                wishlist.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    originalPrice: product.originalPrice
                });
            }
        });
        
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        showNotification('Sample products added to wishlist!', 'success');
        loadWishlist();
        showDemoIfEmpty();
        updateWishlistCount();
    }

    function addAllDemoToWishlist() {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        let addedCount = 0;
        
        dummyProducts.forEach(product => {
            if (!wishlist.find(item => item.id === product.id)) {
                wishlist.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image: product.image,
                    originalPrice: product.originalPrice
                });
                addedCount++;
            }
        });
        
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        showNotification(`${addedCount} demo products added to wishlist!`, 'success');
        loadWishlist();
        showDemoIfEmpty();
        updateWishlistCount();
    }

    function removeDemoItem(productId) {
        const demoProducts = document.querySelectorAll('#demo-wishlist .bg-white');
        demoProducts.forEach(product => {
            if (product.querySelector('button[onclick*="' + productId + '"]')) {
                product.remove();
            }
        });
        
        // If all demo products are removed, show empty state
        const remainingDemoProducts = document.querySelectorAll('#demo-wishlist .bg-white');
        if (remainingDemoProducts.length === 0) {
            document.getElementById('demo-wishlist').innerHTML = `
                <div class="text-center py-8">
                    <p class="text-stone-600">All demo products have been removed.</p>
                    <button onclick="location.reload()" class="mt-4 px-4 py-2 bg-stone-200 text-stone-700 rounded-lg hover:bg-stone-300">
                        Reload Demo
                    </button>
                </div>
            `;
        }
        
        showNotification('Demo item removed', 'error');
    }

    function addDemoToCart(productId) {
        const product = dummyProducts.find(p => p.id === productId);
        if (!product) return;
        
        const cartItem = {
            id: product.id,
            name: product.name,
            quantity: 1,
            price: product.price,
            total: product.price,
            image: product.image
        };
        
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItemIndex = cart.findIndex(item => item.id === cartItem.id);
        
        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += 1;
            cart[existingItemIndex].total = cart[existingItemIndex].price * cart[existingItemIndex].quantity;
        } else {
            cart.push(cartItem);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        showNotification(`${product.name} added to cart`, 'success');
        updateCartCount();
    }

    function removeFromWishlist(productId) {
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        wishlist = wishlist.filter(item => item.id !== productId);
        localStorage.setItem('wishlist', JSON.stringify(wishlist));
        
        showNotification('Removed from Wishlist', 'error');
        loadWishlist();
        showDemoIfEmpty();
        updateWishlistCount();
        updateProductPageButtons(productId, false);
    }

    function clearWishlist() {
        if (confirm('Are you sure you want to clear your entire wishlist?')) {
            localStorage.removeItem('wishlist');
            showNotification('Wishlist cleared', 'error');
            loadWishlist();
            showDemoIfEmpty();
            updateWishlistCount();
            updateAllProductButtons(false);
        }
    }

    function addToCartFromWishlist(productId) {
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const product = wishlist.find(item => item.id === productId);
        
        if (!product) return;
        
        const demoProduct = dummyProducts.find(p => p.id === productId);
        if (demoProduct && !demoProduct.inStock) {
            showNotification('This product is currently out of stock', 'error');
            return;
        }
        
        const cartItem = {
            id: product.id,
            name: product.name,
            quantity: 1,
            price: product.price,
            total: product.price,
            image: product.image
        };
        
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const existingItemIndex = cart.findIndex(item => item.id === cartItem.id);
        
        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += 1;
            cart[existingItemIndex].total = cart[existingItemIndex].price * cart[existingItemIndex].quantity;
        } else {
            cart.push(cartItem);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        showNotification('Added to Cart', 'success');
        removeFromWishlist(productId);
    }

    function showNotification(message, type) {
        document.querySelectorAll('.notification').forEach(el => el.remove());

        const notification = document.createElement('div');
        notification.className = `notification fixed top-4 right-4 sm:right-6 z-50 bg-white rounded-lg shadow-lg border p-4 max-w-xs animate-slide-in ${type === 'success' ? 'border-green-200' : 'border-red-200'}`;
        
        notification.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded overflow-hidden ${type === 'success' ? 'bg-green-100' : 'bg-red-100'} flex items-center justify-center flex-shrink-0">
                    <iconify-icon icon="${type === 'success' ? 'lucide:check-circle' : 'lucide:x-circle'}" width="20" class="${type === 'success' ? 'text-green-600' : 'text-red-600'}"></iconify-icon>
                </div>
                <div class="flex-1">
                    <p class="font-medium text-stone-900">${message}</p>
                    <div class="flex items-center justify-between mt-3">
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
        }, 3000);
    }

    function updateWishlistCount() {
        const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
        const countElements = document.querySelectorAll('.wishlist-count');
        
        countElements.forEach(element => {
            element.textContent = wishlist.length;
            element.style.display = wishlist.length > 0 ? 'flex' : 'none';
        });
    }

    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const countElements = document.querySelectorAll('.cart-count');
        
        countElements.forEach(element => {
            element.textContent = cart.reduce((total, item) => total + item.quantity, 0);
            element.style.display = cart.length > 0 ? 'flex' : 'none';
        });
    }

    function updateProductPageButtons(productId, isInWishlist) {
        console.log(`Product ${productId} wishlist status: ${isInWishlist}`);
    }

    function updateAllProductButtons(isInWishlist) {
        console.log(`All products wishlist status: ${isInWishlist}`);
    }
</script>
@endpush