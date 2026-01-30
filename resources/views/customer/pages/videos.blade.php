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
                Watch educational videos about Ayurvedic herbs, wellness tips, product usage, and traditional healing
                practices.
            </p>


        </div>

        <!-- Featured Video -->
        @if($videos->count() > 0)
            @php
                $featuredVideo = $videos->first();
                $otherVideos = $videos->skip(1);
            @endphp

            <div class="videos-featured">
                <div class="videos-section-header">
                    <h2 class="videos-section-title">Featured Video</h2>
                </div>

                <div class="videos-featured-card">
                    <div class="videos-featured-content">
                        <div class="videos-featured-video">
                            <div class="videos-featured-thumbnail">
                                @if($featuredVideo->thumbnail_path)
                                    <img src="{{ asset('storage/' . $featuredVideo->thumbnail_path) }}"
                                        alt="{{ $featuredVideo->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover; position: absolute;">
                                @endif
                                <a href="{{ $featuredVideo->video_url }}" target="_blank" class="videos-play-btn video-play-btn"
                                    style="position: relative; z-index: 10; display: flex; align-items: center; justify-content: center;">
                                    <iconify-icon icon="lucide:play" width="32"
                                        style="color: #047857; margin-left: 0.25rem;"></iconify-icon>
                                </a>
                            </div>
                        </div>
                        <div class="videos-featured-info">
                            <div class="videos-featured-badge">
                                Latest
                            </div>
                            <h3 class="videos-featured-title">{{ $featuredVideo->title }}</h3>
                            <p class="videos-featured-desc">
                                {{ Str::limit($featuredVideo->description, 150) }}
                            </p>
                            <a href="{{ $featuredVideo->video_url }}" target="_blank" class="videos-featured-watch-btn">
                                <iconify-icon icon="lucide:play-circle" width="18"></iconify-icon>
                                Watch on YouTube
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Videos Grid -->
            <div class="videos-grid-section">
                <div class="videos-grid-header">
                    <h2 class="videos-section-title">More Videos</h2>
                </div>

                <div class="videos-grid">
                    @foreach($otherVideos as $video)
                        <div class="videos-card">
                            <div class="videos-card-thumbnail">
                                @if($video->thumbnail_path)
                                    <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="{{ $video->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover; position: absolute;">
                                @endif
                                <a href="{{ $video->video_url }}" target="_blank" class="videos-card-play-btn"
                                    style="position: absolute; z-index: 10; display: flex; align-items: center; justify-content: center;">
                                    <iconify-icon icon="lucide:play" width="24"
                                        style="color: #047857; margin-left: 0.25rem;"></iconify-icon>
                                </a>
                            </div>
                            <div class="videos-card-info">
                                <a href="{{ $video->video_url }}" target="_blank">
                                    <h3 class="videos-card-title">{{ $video->title }}</h3>
                                </a>
                                <p class="videos-card-desc">
                                    {{ Str::limit($video->description, 100) }}
                                </p>
                                <div class="videos-card-meta">
                                    <div class="videos-card-meta-left">
                                        <span class="videos-card-meta-item">
                                            <iconify-icon icon="lucide:calendar" width="14"></iconify-icon>
                                            {{ $video->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($otherVideos->isEmpty())
                    <div class="videos-no-results show">
                        <div class="videos-no-results-icon">
                            <iconify-icon icon="lucide:film" width="32" style="color: #a8a29e;"></iconify-icon>
                        </div>
                        <h3>No more videos</h3>
                        <p>Check back later for more content!</p>
                    </div>
                @endif
            </div>
        @else
            <div class="videos-no-results show" style="padding: 5rem 0;">
                <div class="videos-no-results-icon">
                    <iconify-icon icon="lucide:video-off" width="48" style="color: #a8a29e;"></iconify-icon>
                </div>
                <h3>No Videos Available</h3>
                <p>We are currently updating our video library. Please check back soon!</p>
            </div>
        @endif

    </div>
@endsection