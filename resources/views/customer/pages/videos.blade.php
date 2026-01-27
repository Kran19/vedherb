@extends('customer.layouts.master')

@section('title', 'Videos - Ved Herbs & Ayurveda')

@push('styles')
<style>
/* Videos Page Critical CSS */
.videos-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 1.5rem 1rem;
}

.videos-breadcrumb {
    display: flex;
    font-size: 0.875rem;
    color: #78716c;
    margin-bottom: 2rem;
}

.videos-breadcrumb ol {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.videos-breadcrumb li {
    display: inline-flex;
    align-items: center;
}

.videos-breadcrumb a {
    display: inline-flex;
    align-items: center;
    transition: color 0.2s;
}

.videos-breadcrumb a:hover {
    color: #047857;
}

.videos-hero {
    text-align: center;
    margin-bottom: 4rem;
}

.videos-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    background-color: #d1fae5;
    color: #047857;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 1.5rem;
}

.videos-title {
    font-size: 2.25rem;
    font-family: serif;
    font-weight: 600;
    color: #1c1917;
    margin-bottom: 1.5rem;
}

@media (min-width: 768px) {
    .videos-title {
        font-size: 3rem;
    }
}

.videos-description {
    font-size: 1.25rem;
    color: #57534e;
    max-width: 48rem;
    margin: 0 auto 2rem;
}

.videos-search-container {
    max-width: 32rem;
    margin: 0 auto;
}

.videos-search-form {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.videos-search-input-wrapper {
    flex: 1;
    position: relative;
}

.videos-search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #a8a29e;
}

.videos-search-input {
    width: 100%;
    background-color: white;
    border: 1px solid #d6d3d1;
    border-radius: 0.75rem;
    padding: 0.75rem 1rem 0.75rem 3rem;
    outline: none;
    transition: all 0.2s;
}

.videos-search-input:focus {
    border-color: #059669;
    box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.2);
}

.videos-search-btn {
    padding: 0.75rem 1.5rem;
    background-color: #064e3b;
    color: white;
    font-weight: 500;
    border-radius: 0.75rem;
    transition: background-color 0.2s;
}

.videos-search-btn:hover {
    background-color: #047857;
}

.videos-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
}

.videos-category-btn {
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
}

.videos-category-btn.active {
    background-color: #064e3b;
    color: white;
}

.videos-category-btn:not(.active) {
    background-color: #f5f5f4;
    color: #57534e;
}

.videos-category-btn:not(.active):hover {
    background-color: #e7e5e4;
}

.videos-featured {
    margin-bottom: 4rem;
}

.videos-section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.videos-section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1c1917;
}

.videos-view-all {
    font-size: 0.875rem;
    color: #047857;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: color 0.2s;
}

.videos-view-all:hover {
    color: #059669;
}

.videos-featured-card {
    background: linear-gradient(to bottom right, #ecfdf5, white);
    border: 1px solid #d1fae5;
    border-radius: 1rem;
    overflow: hidden;
}

.videos-featured-content {
    display: flex;
    flex-direction: column;
}

@media (min-width: 768px) {
    .videos-featured-content {
        flex-direction: row;
    }
}

.videos-featured-video {
    width: 100%;
}

@media (min-width: 768px) {
    .videos-featured-video {
        width: 66.666667%;
    }
}

.videos-featured-thumbnail {
    aspect-ratio: 16/9;
    background: linear-gradient(to bottom right, rgba(6, 78, 59, 0.8), rgba(4, 120, 87, 0.8));
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.videos-play-btn {
    width: 5rem;
    height: 5rem;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    cursor: pointer;
    border: none;
}

.videos-play-btn:hover {
    background-color: white;
    transform: scale(1.05);
}

.videos-duration {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    font-size: 0.875rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

.videos-featured-info {
    width: 100%;
    padding: 2rem;
}

@media (min-width: 768px) {
    .videos-featured-info {
        width: 33.333333%;
    }
}

.videos-featured-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    background-color: #d1fae5;
    color: #047857;
    font-size: 0.75rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

.videos-featured-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1c1917;
    margin-bottom: 1rem;
}

.videos-featured-desc {
    color: #57534e;
    margin-bottom: 1.5rem;
}

.videos-featured-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.875rem;
    color: #78716c;
    margin-bottom: 1.5rem;
}

.videos-featured-meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.videos-featured-watch-btn {
    width: 100%;
    background-color: #047857;
    color: white;
    font-weight: 500;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    transition: background-color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
}

.videos-featured-watch-btn:hover {
    background-color: #059669;
}

.videos-grid-section {
    margin-bottom: 3rem;
}

.videos-grid-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2rem;
}

.videos-sort {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.videos-sort-label {
    font-size: 0.875rem;
    color: #57534e;
}

.videos-sort-select {
    font-size: 0.875rem;
    border: 1px solid #d6d3d1;
    border-radius: 0.5rem;
    padding: 0.375rem 0.75rem;
    outline: none;
    transition: all 0.2s;
}

.videos-sort-select:focus {
    border-color: #059669;
    box-shadow: 0 0 0 2px rgba(5, 150, 105, 0.2);
}

.videos-search-results {
    margin-bottom: 1.5rem;
    display: none;
}

.videos-search-results.show {
    display: block;
}

.videos-search-results p {
    font-size: 0.875rem;
    color: #57534e;
}

.videos-no-results {
    text-align: center;
    padding: 3rem 0;
    display: none;
}

.videos-no-results.show {
    display: block;
}

.videos-no-results-icon {
    width: 5rem;
    height: 5rem;
    border-radius: 50%;
    background-color: #f5f5f4;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.videos-no-results h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1c1917;
    margin-bottom: 0.75rem;
}

.videos-no-results p {
    color: #57534e;
    margin-bottom: 1.5rem;
}

.videos-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
}

@media (min-width: 768px) {
    .videos-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .videos-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.videos-card {
    background-color: white;
    border: 1px solid #e7e5e4;
    border-radius: 0.75rem;
    overflow: hidden;
    transition: all 0.3s;
}

.videos-card:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.videos-card-thumbnail {
    aspect-ratio: 16/9;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.videos-card-play-btn {
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    cursor: pointer;
    border: none;
}

.videos-card-play-btn:hover {
    background-color: white;
    transform: scale(1.05);
}

.videos-card-duration {
    position: absolute;
    bottom: 0.75rem;
    right: 0.75rem;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    font-size: 0.75rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}

.videos-card-badge {
    position: absolute;
    top: 0.75rem;
    left: 0.75rem;
}

.videos-card-badge span {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    background-color: rgba(255, 255, 255, 0.9);
    font-size: 0.75rem;
    font-weight: 500;
}

.videos-card-info {
    padding: 1.25rem;
}

.videos-card-title {
    font-weight: 600;
    color: #1c1917;
    margin-bottom: 0.75rem;
    transition: color 0.2s;
}

.videos-card:hover .videos-card-title {
    color: #047857;
}

.videos-card-desc {
    font-size: 0.875rem;
    color: #57534e;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.videos-card-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.875rem;
    color: #78716c;
}

.videos-card-meta-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.videos-card-meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.videos-bookmark-btn {
    color: #047857;
    transition: color 0.2s;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
}

.videos-bookmark-btn:hover {
    color: #059669;
}

.videos-load-more {
    text-align: center;
    margin-top: 3rem;
}

.videos-load-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    background-color: white;
    border: 1px solid #d6d3d1;
    color: #57534e;
    border-radius: 0.75rem;
    font-weight: 500;
    transition: all 0.2s;
    cursor: pointer;
}

.videos-load-more-btn:hover {
    background-color: #fafaf9;
    border-color: #a8a29e;
}

.videos-modal {
    position: fixed;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 50;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    display: none;
}

.videos-modal.show {
    display: flex;
}

.videos-modal-content {
    position: relative;
    width: 100%;
    max-width: 56rem;
    background-color: white;
    border-radius: 1rem;
    overflow: hidden;
}

.videos-modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    z-index: 10;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.2s;
    border: none;
    cursor: pointer;
}

.videos-modal-close:hover {
    background-color: rgba(0, 0, 0, 0.7);
}

.videos-modal-video {
    aspect-ratio: 16/9;
    background-color: black;
    display: flex;
    align-items: center;
    justify-content: center;
}

.videos-modal-placeholder {
    text-align: center;
}

.videos-modal-placeholder p {
    color: rgba(255, 255, 255, 0.7);
}

.videos-modal-info {
    padding: 1.5rem;
}

.videos-modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1c1917;
    margin-bottom: 0.75rem;
}

.videos-modal-desc {
    color: #57534e;
    margin-bottom: 1rem;
}

.videos-modal-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 0.875rem;
    color: #78716c;
}

.videos-modal-meta-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.videos-modal-meta-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.videos-modal-category {
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 500;
}
</style>
@endpush

@section('content')
<!-- Breadcrumb Navigation -->
<div class="videos-container">
    <nav class="videos-breadcrumb" aria-label="Breadcrumb">
        <ol>
            <li>
                <a href="{{ route('customer.home.index') }}">
                    <iconify-icon icon="lucide:home" width="16"></iconify-icon>
                    <span style="margin-left: 0.5rem;">Home</span>
                </a>
            </li>
            <li aria-current="page">
                <div style="display: flex; align-items: center;">
                    <iconify-icon icon="lucide:chevron-right" width="16"></iconify-icon>
                    <span style="margin-left: 0.5rem; color: #1c1917; font-weight: 500;">Videos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Videos Hero Section -->
    <div class="videos-hero">
        <div class="videos-badge">
            <iconify-icon icon="lucide:play-circle" width="16"></iconify-icon>
            Learn & Discover
        </div>
        <h1 class="videos-title">
            Ayurveda in Motion
        </h1>
        <p class="videos-description">
            Watch educational videos about Ayurvedic herbs, wellness tips, product usage, and traditional healing practices.
        </p>
        
        <!-- Video Search -->
        <div class="videos-search-container">
            <div class="videos-search-form">
                <div class="videos-search-input-wrapper">
                    <iconify-icon icon="lucide:search" 
                                 width="20" 
                                 class="videos-search-icon">
                    </iconify-icon>
                    <input type="text" 
                           id="video-search"
                           placeholder="Search videos..." 
                           class="videos-search-input">
                </div>
                <button class="videos-search-btn">
                    Search
                </button>
            </div>
            
            <!-- Video Categories -->
            <div class="videos-categories">
                <button class="videos-category-btn active" data-category="all">
                    All Videos
                </button>
                <button class="videos-category-btn" data-category="ayurveda">
                    Ayurveda Basics
                </button>
                <button class="videos-category-btn" data-category="herbs">
                    Herbs & Ingredients
                </button>
                <button class="videos-category-btn" data-category="products">
                    Product Usage
                </button>
                <button class="videos-category-btn" data-category="wellness">
                    Wellness Tips
                </button>
                <button class="videos-category-btn" data-category="recipes">
                    Ayurvedic Recipes
                </button>
            </div>
        </div>
    </div>

    <!-- Featured Video -->
    <div class="videos-featured">
        <div class="videos-section-header">
            <h2 class="videos-section-title">Featured Video</h2>
            <a href="#" class="videos-view-all">
                View All Featured
                <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
            </a>
        </div>
        
        <div class="videos-featured-card">
            <div class="videos-featured-content">
                <div class="videos-featured-video">
                    <!-- Video Thumbnail -->
                    <div class="videos-featured-thumbnail">
                        <button class="videos-play-btn video-play-btn">
                            <iconify-icon icon="lucide:play" width="32" style="color: #047857; margin-left: 0.25rem;"></iconify-icon>
                        </button>
                        <!-- Video Duration -->
                        <div class="videos-duration">
                            15:30
                        </div>
                    </div>
                </div>
                <div class="videos-featured-info">
                    <div class="videos-featured-badge">
                        Ayurveda Basics
                    </div>
                    <h3 class="videos-featured-title">Introduction to Ayurveda: The Science of Life</h3>
                    <p class="videos-featured-desc">
                        Learn about the ancient science of Ayurveda, its principles, and how it can transform your health and wellness journey.
                    </p>
                    <div class="videos-featured-meta">
                        <div class="videos-featured-meta-item">
                            <iconify-icon icon="lucide:eye" width="16"></iconify-icon>
                            <span>10,245 views</span>
                        </div>
                        <div class="videos-featured-meta-item">
                            <iconify-icon icon="lucide:calendar" width="16"></iconify-icon>
                            <span>2 weeks ago</span>
                        </div>
                    </div>
                    <button class="videos-featured-watch-btn">
                        <iconify-icon icon="lucide:play" width="18"></iconify-icon>
                        Watch Full Video
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Videos Grid -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-semibold text-stone-900">All Videos</h2>
            <div class="flex items-center gap-2">
                <span class="text-sm text-stone-600">Sort by:</span>
                <select class="text-sm border border-stone-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500">
                    <option>Most Recent</option>
                    <option>Most Popular</option>
                    <option>Duration</option>
                    <option>A-Z</option>
                </select>
            </div>
        </div>

        <!-- Search Results Count -->
        <div id="search-results" class="mb-6 hidden">
            <p class="text-sm text-stone-600">
                Found <span id="results-count" class="font-semibold text-emerald-700">0</span> videos for "<span id="search-query" class="font-medium"></span>"
            </p>
        </div>

        <!-- No Results Message -->
        <div id="no-results" class="hidden text-center py-12">
            <div class="w-20 h-20 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-6">
                <iconify-icon icon="lucide:video-off" width="32" class="text-stone-400"></iconify-icon>
            </div>
            <h3 class="text-xl font-semibold text-stone-900 mb-3">No videos found</h3>
            <p class="text-stone-600 mb-6">
                Try searching with different keywords or browse categories.
            </p>
        </div>

        <!-- Videos Grid -->
        <div id="videos-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Video Card 1 -->
            <div class="video-card group" data-category="ayurveda" data-title="ayurvedic doshas">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-amber-100 to-amber-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-amber-700 ml-1 group-hover:text-amber-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            08:45
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-amber-800 text-xs font-medium">
                                Ayurveda Basics
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Understanding Vata, Pitta & Kapha Doshas
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Learn about the three fundamental energies that govern our body and mind in Ayurvedic philosophy.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>8,542</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>1 month ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 2 -->
            <div class="video-card group" data-category="herbs" data-title="ashwagandha benefits">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-emerald-100 to-emerald-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-emerald-700 ml-1 group-hover:text-emerald-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            12:20
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-emerald-800 text-xs font-medium">
                                Herbs & Ingredients
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Ashwagandha: The Stress-Relieving Herb
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Discover the amazing benefits of Ashwagandha for stress relief, energy, and overall wellness.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>12,876</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>3 weeks ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 3 -->
            <div class="video-card group" data-category="products" data-title="product usage">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-blue-100 to-blue-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-blue-700 ml-1 group-hover:text-blue-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            06:15
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-blue-800 text-xs font-medium">
                                Product Usage
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            How to Use Our Triphala Powder Effectively
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Step-by-step guide on using Triphala powder for digestive health and detoxification.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>6,432</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>5 days ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 4 -->
            <div class="video-card group" data-category="wellness" data-title="daily routine">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-purple-100 to-purple-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-purple-700 ml-1 group-hover:text-purple-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            18:30
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-purple-800 text-xs font-medium">
                                Wellness Tips
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Ayurvedic Daily Routine (Dinacharya) for Modern Life
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Learn how to incorporate traditional Ayurvedic daily practices into your modern lifestyle.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>15,234</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>2 months ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 5 -->
            <div class="video-card group" data-category="testimonials" data-title="customer success">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-rose-100 to-rose-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-rose-700 ml-1 group-hover:text-rose-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            04:52
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-rose-800 text-xs font-medium">
                                Customer Stories
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Real Results: How Ved Herbs Changed My Life
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Hear from our customers about their wellness journey with Ved Herbs products.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>9,876</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>1 week ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 6 -->
            <div class="video-card group" data-category="recipes" data-title="ayurvedic tea">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-amber-100 to-amber-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-amber-700 ml-1 group-hover:text-amber-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            07:45
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-amber-800 text-xs font-medium">
                                Ayurvedic Recipes
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            How to Make Immunity-Boosting Golden Milk (Haldi Doodh)
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Traditional recipe for turmeric milk with modern twists for maximum health benefits.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>11,543</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>3 days ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 7 -->
            <div class="video-card group" data-category="herbs" data-title="tulsi benefits">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-emerald-100 to-emerald-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-emerald-700 ml-1 group-hover:text-emerald-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            10:20
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-emerald-800 text-xs font-medium">
                                Herbs & Ingredients
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Holy Basil (Tulsi): The Queen of Herbs
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Discover the spiritual and medicinal properties of Tulsi in Ayurvedic tradition.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>7,890</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>2 weeks ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 8 -->
            <div class="video-card group" data-category="products" data-title="oil massage">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-blue-100 to-blue-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-blue-700 ml-1 group-hover:text-blue-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            09:15
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-blue-800 text-xs font-medium">
                                Product Usage
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Ayurvedic Self-Massage with Herbal Oils
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Learn the proper technique for Abhyanga (self-massage) using our herbal oils.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>5,432</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>4 days ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Card 9 -->
            <div class="video-card group" data-category="wellness" data-title="detox tips">
                <div class="bg-white border border-stone-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300">
                    <!-- Video Thumbnail -->
                    <div class="aspect-video bg-gradient-to-br from-purple-100 to-purple-50 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <button class="video-play-btn w-16 h-16 rounded-full bg-white/90 hover:bg-white transition-all transform hover:scale-105 flex items-center justify-center group">
                                <iconify-icon icon="lucide:play" width="28" class="text-purple-700 ml-1 group-hover:text-purple-800"></iconify-icon>
                            </button>
                        </div>
                        <!-- Video Duration -->
                        <div class="absolute bottom-3 right-3 bg-black/70 text-white text-xs px-2 py-1 rounded">
                            14:30
                        </div>
                        <!-- Category Badge -->
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded bg-white/90 text-purple-800 text-xs font-medium">
                                Wellness Tips
                            </span>
                        </div>
                    </div>
                    
                    <!-- Video Info -->
                    <div class="p-5">
                        <h3 class="font-semibold text-stone-900 mb-3 group-hover:text-emerald-700 transition-colors">
                            Spring Detox: Ayurvedic Practices for Seasonal Cleansing
                        </h3>
                        <p class="text-sm text-stone-600 mb-4 line-clamp-2">
                            Ayurvedic detox methods to cleanse your body and mind during seasonal transitions.
                        </p>
                        
                        <div class="flex items-center justify-between text-sm text-stone-500">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                                    <span>8,765</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                    <span>1 month ago</span>
                                </div>
                            </div>
                            <button class="text-emerald-700 hover:text-emerald-800">
                                <iconify-icon icon="lucide:bookmark" width="16"></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button id="load-more" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-stone-300 text-stone-700 rounded-xl hover:bg-stone-50 hover:border-stone-400 transition-colors font-medium">
                <iconify-icon icon="lucide:refresh-cw" width="18"></iconify-icon>
                Load More Videos
            </button>
        </div>
    </div>

    <!-- Video Modal -->
    <div id="video-modal" class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 hidden">
        <div class="relative w-full max-w-4xl bg-white rounded-2xl overflow-hidden">
            <!-- Close Button -->
            <button id="close-modal" class="absolute top-4 right-4 z-10 w-10 h-10 rounded-full bg-black/50 hover:bg-black/70 text-white flex items-center justify-center transition-colors">
                <iconify-icon icon="lucide:x" width="20"></iconify-icon>
            </button>
            
            <!-- Modal Content -->
            <div class="aspect-video bg-black">
                <!-- Video Player Placeholder -->
                <div class="w-full h-full flex items-center justify-center">
                    <div class="text-center">
                        <iconify-icon icon="lucide:play-circle" width="64" class="text-white/50 mb-4"></iconify-icon>
                        <p class="text-white/70">Video player would load here</p>
                    </div>
                </div>
            </div>
            
            <!-- Video Info -->
            <div class="p-6">
                <h3 id="modal-title" class="text-xl font-semibold text-stone-900 mb-3"></h3>
                <p id="modal-description" class="text-stone-600 mb-4"></p>
                <div class="flex items-center justify-between text-sm text-stone-500">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            <iconify-icon icon="lucide:eye" width="14"></iconify-icon>
                            <span id="modal-views"></span>
                        </div>
                        <div class="flex items-center gap-1">
                            <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                            <span id="modal-date"></span>
                        </div>
                    </div>
                    <div id="modal-category" class="px-3 py-1 rounded-full text-xs font-medium"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Video Category Filtering
    const categoryButtons = document.querySelectorAll('[data-category]');
    const videoCards = document.querySelectorAll('.video-card');
    
    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedCategory = this.getAttribute('data-category');
            
            // Update active button
            categoryButtons.forEach(btn => {
                btn.classList.remove('bg-emerald-900', 'text-white', 'active-category');
                btn.classList.add('bg-stone-100', 'text-stone-700');
            });
            
            this.classList.remove('bg-stone-100', 'text-stone-700');
            this.classList.add('bg-emerald-900', 'text-white', 'active-category');
            
            // Show/hide videos based on category
            let visibleCount = 0;
            videoCards.forEach(card => {
                if (selectedCategory === 'all' || card.getAttribute('data-category') === selectedCategory) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Reset search
            const searchInput = document.getElementById('video-search');
            searchInput.value = '';
            document.getElementById('search-results').classList.add('hidden');
            document.getElementById('no-results').classList.add('hidden');
            
            // Update results count if searching
            if (visibleCount === 0) {
                document.getElementById('no-results').classList.remove('hidden');
            }
        });
    });

    // Video Search Functionality
    const searchInput = document.getElementById('video-search');
    const searchResults = document.getElementById('search-results');
    const resultsCount = document.getElementById('results-count');
    const searchQuery = document.getElementById('search-query');
    const noResults = document.getElementById('no-results');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        if (searchTerm.length < 2) {
            searchResults.classList.add('hidden');
            noResults.classList.add('hidden');
            
            // Show videos based on active category
            const activeCategory = document.querySelector('.active-category');
            const selectedCategory = activeCategory ? activeCategory.getAttribute('data-category') : 'all';
            
            videoCards.forEach(card => {
                if (selectedCategory === 'all' || card.getAttribute('data-category') === selectedCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            return;
        }
        
        let foundCount = 0;
        
        videoCards.forEach(card => {
            const title = card.getAttribute('data-title').toLowerCase();
            const category = card.getAttribute('data-category');
            
            if (title.includes(searchTerm)) {
                card.style.display = 'block';
                foundCount++;
            } else {
                // Also search in card content
                const cardTitle = card.querySelector('h3').textContent.toLowerCase();
                const cardDescription = card.querySelector('p').textContent.toLowerCase();
                
                if (cardTitle.includes(searchTerm) || cardDescription.includes(searchTerm)) {
                    card.style.display = 'block';
                    foundCount++;
                } else {
                    card.style.display = 'none';
                }
            }
        });
        
        // Show/hide search results info
        if (foundCount > 0) {
            searchResults.classList.remove('hidden');
            noResults.classList.add('hidden');
            resultsCount.textContent = foundCount;
            searchQuery.textContent = searchTerm;
        } else {
            searchResults.classList.add('hidden');
            noResults.classList.remove('hidden');
        }
    });

    // Video Modal Functionality
    const videoModal = document.getElementById('video-modal');
    const closeModal = document.getElementById('close-modal');
    const videoPlayBtns = document.querySelectorAll('.video-play-btn');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const modalViews = document.getElementById('modal-views');
    const modalDate = document.getElementById('modal-date');
    const modalCategory = document.getElementById('modal-category');
    
    // Play button click handler
    videoPlayBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('.video-card');
            const title = card.querySelector('h3').textContent;
            const description = card.querySelector('p').textContent;
            const views = card.querySelector('[icon="lucide:eye"]').nextSibling.textContent.trim();
            const date = card.querySelector('[icon="lucide:calendar"]').nextSibling.textContent.trim();
            const category = card.querySelector('[class*="bg-white/90"]').textContent.trim();
            const categoryColor = card.querySelector('.aspect-video').classList[1].split('-')[2]; // Get color from gradient
            
            // Set modal content
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalViews.textContent = views;
            modalDate.textContent = date;
            modalCategory.textContent = category;
            modalCategory.className = `px-3 py-1 rounded-full text-xs font-medium bg-${categoryColor}-100 text-${categoryColor}-800`;
            
            // Show modal
            videoModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal
    closeModal.addEventListener('click', function() {
        videoModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
    
    // Close modal on background click
    videoModal.addEventListener('click', function(e) {
        if (e.target === this) {
            videoModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !videoModal.classList.contains('hidden')) {
            videoModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });

    // Load More Button
    const loadMoreBtn = document.getElementById('load-more');
    let currentVideos = 9; // Starting with 9 videos displayed
    
    loadMoreBtn.addEventListener('click', function() {
        // In a real application, this would load more videos from a server
        // For demo, we'll simulate adding more videos
        
        // Show loading state
        loadMoreBtn.innerHTML = `
            <iconify-icon icon="lucide:loader-2" width="18" class="animate-spin"></iconify-icon>
            Loading...
        `;
        loadMoreBtn.disabled = true;
        
        // Simulate API call delay
        setTimeout(() => {
            // Add more video cards here in a real implementation
            // For now, just show a message
            loadMoreBtn.innerHTML = 'All Videos Loaded';
            loadMoreBtn.classList.remove('hover:bg-stone-50', 'hover:border-stone-400');
            loadMoreBtn.classList.add('opacity-50', 'cursor-not-allowed');
            
            // In a real app, you would:
            // 1. Make an AJAX request to get more videos
            // 2. Append the new video cards to the grid
            // 3. Update the currentVideos count
            // 4. Re-attach event listeners to new play buttons
        }, 1500);
    });

    // Bookmark functionality
    const bookmarkBtns = document.querySelectorAll('button:has(iconify-icon[icon="lucide:bookmark"])');
    
    bookmarkBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const icon = this.querySelector('iconify-icon');
            
            if (icon.getAttribute('icon') === 'lucide:bookmark') {
                icon.setAttribute('icon', 'lucide:bookmark-check');
                this.classList.remove('text-emerald-700');
                this.classList.add('text-emerald-800');
                
                // Show notification
                showNotification('Video added to saved list');
            } else {
                icon.setAttribute('icon', 'lucide:bookmark');
                this.classList.remove('text-emerald-800');
                this.classList.add('text-emerald-700');
                
                showNotification('Video removed from saved list');
            }
        });
    });

    // Sort functionality
    const sortSelect = document.querySelector('select');
    sortSelect.addEventListener('change', function() {
        // In a real application, this would sort videos based on selection
        // For demo, we'll just show a notification
        showNotification(`Sorted by: ${this.value}`);
    });

    // Helper function for notifications
    function showNotification(message) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'fixed bottom-4 right-4 bg-emerald-600 text-white px-4 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300';
        notification.innerHTML = `
            <div class="flex items-center gap-2">
                <iconify-icon icon="lucide:check-circle" width="18"></iconify-icon>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.classList.remove('translate-x-full', 'opacity-0');
            notification.classList.add('translate-x-0', 'opacity-100');
        }, 10);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.remove('translate-x-0', 'opacity-100');
            notification.classList.add('translate-x-full', 'opacity-0');
            
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Add line-clamp utility
    const style = document.createElement('style');
    style.textContent = `
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush