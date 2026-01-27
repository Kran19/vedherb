@extends('customer.layouts.master')

@section('title', 'Blog - Ved Herbs & Ayurveda')

@section('content')
<!-- Breadcrumb Navigation -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <nav class="flex text-sm text-stone-500 mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('customer.home.index') }}" class="inline-flex items-center hover:text-emerald-700">
                    <iconify-icon icon="lucide:home" width="16"></iconify-icon>
                    <span class="ml-2">Home</span>
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                    <span class="ml-2 text-stone-900 font-medium">Blog</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Hero Section -->
    <section class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-serif font-semibold text-stone-900 mb-6">
            Ayurvedic Wisdom & Wellness
        </h1>
        <p class="text-xl text-stone-600 max-w-3xl mx-auto mb-8">
            Evidence-based articles, traditional knowledge, and practical tips for modern Ayurvedic living.
        </p>
        
        <!-- Search & Filter -->
        <div class="max-w-2xl mx-auto">
            <div class="flex gap-4 mb-8">
                <div class="flex-1 relative">
                    <iconify-icon icon="lucide:search" 
                                 width="20" 
                                 class="absolute left-4 top-1/2 transform -translate-y-1/2 text-stone-400">
                    </iconify-icon>
                    <input type="text" 
                           placeholder="Search articles..." 
                           class="w-full bg-white border border-stone-300 rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                </div>
                <button class="px-6 py-3 bg-emerald-900 text-white font-medium rounded-xl hover:bg-emerald-800 transition-colors">
                    Search
                </button>
            </div>
            
            <!-- Category Filters -->
            <div class="flex flex-wrap gap-2 justify-center">
                <button class="px-4 py-2 rounded-full bg-emerald-900 text-white text-sm font-medium">
                    All Topics
                </button>
                <button class="px-4 py-2 rounded-full bg-white border border-stone-200 text-stone-600 text-sm hover:border-stone-300">
                    Herbal Remedies
                </button>
                <button class="px-4 py-2 rounded-full bg-white border border-stone-200 text-stone-600 text-sm hover:border-stone-300">
                    Daily Routine
                </button>
                <button class="px-4 py-2 rounded-full bg-white border border-stone-200 text-stone-600 text-sm hover:border-stone-300">
                    Seasonal Guide
                </button>
                <button class="px-4 py-2 rounded-full bg-white border border-stone-200 text-stone-600 text-sm hover:border-stone-300">
                    Recipes
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Article -->
    <section class="mb-16">
        <div class="bg-gradient-to-r from-emerald-50 to-white rounded-3xl overflow-hidden border border-emerald-100">
            <div class="grid md:grid-cols-2">
                <div class="p-8 md:p-12">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-medium mb-4">
                        <span class="flex h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                        Featured Article
                    </div>
                    <h2 class="text-2xl md:text-3xl font-serif font-semibold text-stone-900 mb-4">
                        Ashwagandha: The Ancient Adaptogen for Modern Stress
                    </h2>
                    <p class="text-stone-600 mb-6">
                        Discover how this 3,000-year-old herb can help you manage stress, improve sleep, and boost immunity in today's fast-paced world. Clinical studies reveal its surprising benefits.
                    </p>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-stone-200"></div>
                            <span class="text-sm text-stone-700">Dr. Priya Sharma</span>
                        </div>
                        <span class="text-sm text-stone-500">•</span>
                        <span class="text-sm text-stone-500">Jan 15, 2024</span>
                        <span class="text-sm text-stone-500">•</span>
                        <span class="text-sm text-stone-500">8 min read</span>
                    </div>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 font-semibold">
                        Read Full Article
                        <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
                    </a>
                </div>
                <div class="relative h-64 md:h-auto">
                    <img src="https://images.unsplash.com/photo-1625772299848-391b6a87d7b3?auto=format&fit=crop&w=1000&q=80" 
                         alt="Ashwagandha Plant" 
                         class="absolute inset-0 w-full h-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="mb-16">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-2xl font-semibold text-stone-900">Latest Articles</h2>
            <a href="#" class="text-emerald-700 hover:text-emerald-800 font-medium flex items-center gap-2">
                View All Articles
                <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1623428187962-6fca787de7e3?auto=format&fit=crop&w=800&q=80" 
                         alt="Turmeric Benefits" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-stone-700">
                            Herbal Remedies
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs text-stone-500">Feb 2, 2024</span>
                        <span class="text-xs text-stone-500">•</span>
                        <span class="text-xs text-stone-500">6 min read</span>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-3 group-hover:text-emerald-800 transition-colors">
                        Turmeric vs. Curcumin: What's the Difference?
                    </h3>
                    <p class="text-stone-600 mb-4">
                        Not all turmeric is created equal. Learn about the key differences between whole turmeric root and isolated curcumin supplements.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 text-sm font-medium">
                        Read More
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?auto=format&fit=crop&w=800&q=80" 
                         alt="Ayurvedic Diet" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-stone-700">
                            Nutrition
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs text-stone-500">Jan 28, 2024</span>
                        <span class="text-xs text-stone-500">•</span>
                        <span class="text-xs text-stone-500">10 min read</span>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-3 group-hover:text-emerald-800 transition-colors">
                        The Ayurvedic Guide to Spring Detox
                    </h3>
                    <p class="text-stone-600 mb-4">
                        Kapha season is here. Discover traditional cleansing practices and seasonal foods to support your body's natural detoxification.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 text-sm font-medium">
                        Read More
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=800&q=80" 
                         alt="Meditation" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-stone-700">
                            Mindfulness
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs text-stone-500">Jan 22, 2024</span>
                        <span class="text-xs text-stone-500">•</span>
                        <span class="text-xs text-stone-500">5 min read</span>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-3 group-hover:text-emerald-800 transition-colors">
                        5-Minute Ayurvedic Meditation for Busy Days
                    </h3>
                    <p class="text-stone-600 mb-4">
                        You don't need hours to meditate. Try these quick techniques based on your dosha type to find calm amidst chaos.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 text-sm font-medium">
                        Read More
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </article>

            <!-- Article 4 -->
            <article class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1615485925763-867862f80904?auto=format&fit=crop&w=800&q=80" 
                         alt="Herbal Preparation" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-stone-700">
                            Traditional Wisdom
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs text-stone-500">Jan 18, 2024</span>
                        <span class="text-xs text-stone-500">•</span>
                        <span class="text-xs text-stone-500">12 min read</span>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-3 group-hover:text-emerald-800 transition-colors">
                        The Art of Making Ghee: A Complete Guide
                    </h3>
                    <p class="text-stone-600 mb-4">
                        Learn the traditional method of preparing medicinal ghee and discover its incredible health benefits in Ayurveda.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 text-sm font-medium">
                        Read More
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </article>

            <!-- Article 5 -->
            <article class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?auto=format&fit=crop&w=800&q=80" 
                         alt="Sleep" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-stone-700">
                            Sleep Health
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs text-stone-500">Jan 12, 2024</span>
                        <span class="text-xs text-stone-500">•</span>
                        <span class="text-xs text-stone-500">7 min read</span>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-3 group-hover:text-emerald-800 transition-colors">
                        Ayurvedic Tips for Deep, Restorative Sleep
                    </h3>
                    <p class="text-stone-600 mb-4">
                        Struggling with insomnia? Try these time-tested Ayurvedic routines to improve sleep quality naturally.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 text-sm font-medium">
                        Read More
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </article>

            <!-- Article 6 -->
            <article class="group bg-white rounded-2xl border border-stone-200 overflow-hidden hover:shadow-lg transition-shadow">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=800&q=80" 
                         alt="Ayurvedic Recipes" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm rounded-full text-xs font-medium text-stone-700">
                            Recipes
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-xs text-stone-500">Jan 5, 2024</span>
                        <span class="text-xs text-stone-500">•</span>
                        <span class="text-xs text-stone-500">9 min read</span>
                    </div>
                    <h3 class="text-xl font-semibold text-stone-900 mb-3 group-hover:text-emerald-800 transition-colors">
                        Golden Milk Latte: The Ultimate Immunity Drink
                    </h3>
                    <p class="text-stone-600 mb-4">
                        Our signature recipe for the perfect turmeric latte, packed with anti-inflammatory benefits and delicious flavor.
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-800 text-sm font-medium">
                        Read More
                        <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
                    </a>
                </div>
            </article>
        </div>
    </section>

    <!-- Popular Topics -->
    <section class="mb-16">
        <h2 class="text-2xl font-semibold text-stone-900 mb-8">Explore by Topic</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="#" class="group bg-emerald-50 rounded-2xl p-6 text-center hover:bg-emerald-100 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                    <iconify-icon icon="lucide:leaf" width="24" class="text-emerald-700"></iconify-icon>
                </div>
                <h3 class="font-semibold text-stone-900 mb-2">Herbal Medicine</h3>
                <p class="text-sm text-stone-600">14 articles</p>
            </a>
            
            <a href="#" class="group bg-stone-50 rounded-2xl p-6 text-center hover:bg-stone-100 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-stone-100 flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                    <iconify-icon icon="lucide:utensils" width="24" class="text-stone-700"></iconify-icon>
                </div>
                <h3 class="font-semibold text-stone-900 mb-2">Nutrition</h3>
                <p class="text-sm text-stone-600">22 articles</p>
            </a>
            
            <a href="#" class="group bg-blue-50 rounded-2xl p-6 text-center hover:bg-blue-100 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                    <iconify-icon icon="lucide:brain" width="24" class="text-blue-700"></iconify-icon>
                </div>
                <h3 class="font-semibold text-stone-900 mb-2">Mental Health</h3>
                <p class="text-sm text-stone-600">18 articles</p>
            </a>
            
            <a href="#" class="group bg-purple-50 rounded-2xl p-6 text-center hover:bg-purple-100 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center mx-auto mb-4 group-hover:bg-white transition-colors">
                    <iconify-icon icon="lucide:heart-pulse" width="24" class="text-purple-700"></iconify-icon>
                </div>
                <h3 class="font-semibold text-stone-900 mb-2">Women's Health</h3>
                <p class="text-sm text-stone-600">16 articles</p>
            </a>
        </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="bg-gradient-to-br from-emerald-900 to-emerald-800 rounded-3xl p-8 md:p-12 text-center">
        <div class="max-w-2xl mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-emerald-800 flex items-center justify-center mx-auto mb-6">
                <iconify-icon icon="lucide:mail" width="28" class="text-white"></iconify-icon>
            </div>
            <h2 class="text-2xl md:text-3xl font-semibold text-white mb-4">
                Join Our Wellness Circle
            </h2>
            <p class="text-emerald-100 mb-8">
                Get weekly Ayurvedic insights, recipes, and exclusive offers directly in your inbox.
            </p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                @csrf
                <input type="email" 
                       name="email"
                       placeholder="Enter your email" 
                       class="flex-1 bg-white border border-emerald-300 rounded-xl px-6 py-3 focus:outline-none focus:ring-2 focus:ring-white/20">
                <button type="submit" 
                        class="px-8 py-3 bg-white text-emerald-900 font-semibold rounded-xl hover:bg-emerald-50 transition-colors">
                    Subscribe
                </button>
            </form>
            <p class="text-xs text-emerald-200 mt-4">
                We respect your privacy. Unsubscribe at any time.
            </p>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Initialize any specific scripts for the blog page here
    document.addEventListener('DOMContentLoaded', function() {
        // Blog search functionality
        const searchInput = document.querySelector('input[placeholder="Search articles..."]');
        const searchButton = document.querySelector('button:contains("Search")');
        
        if (searchInput && searchButton) {
            searchButton.addEventListener('click', function() {
                const searchTerm = searchInput.value.trim();
                if (searchTerm) {
                    // Implement search functionality
                    console.log('Searching for:', searchTerm);
                    // You can redirect to search results page or filter articles
                }
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchButton.click();
                }
            });
        }
        
        // Category filter buttons
        const categoryButtons = document.querySelectorAll('.flex-wrap button');
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                categoryButtons.forEach(btn => {
                    btn.classList.remove('bg-emerald-900', 'text-white');
                    btn.classList.add('bg-white', 'border', 'border-stone-200', 'text-stone-600');
                });
                
                // Add active class to clicked button
                this.classList.remove('bg-white', 'border', 'border-stone-200', 'text-stone-600');
                this.classList.add('bg-emerald-900', 'text-white');
                
                // Filter articles by category (implement as needed)
                const category = this.textContent.trim();
                console.log('Filtering by category:', category);
            });
        });
    });
</script>
@endpush