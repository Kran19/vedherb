@extends('admin.layouts.master')

@section('title', 'Edit Video')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Edit Video</h2>
            <a href="{{ route('admin.videos.index') }}" class="text-gray-600 hover:text-gray-900 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Videos
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
        <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Video Title <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Video URL -->
            <div class="mb-6">
                <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">YouTube Video URL <span
                        class="text-red-500">*</span></label>
                <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $video->video_url) }}" required
                    placeholder="https://www.youtube.com/watch?v=..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 @error('video_url') border-red-500 @enderror">
                @error('video_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span
                        class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $video->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail -->
            <div class="mb-6">
                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Thumbnail Image</label>
                @if($video->thumbnail_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="Current Thumbnail"
                            class="h-32 w-auto object-cover rounded border">
                    </div>
                @endif
                <div
                    class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition">
                    <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="space-y-2">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path
                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium text-blue-600 hover:text-blue-500">Upload a new file</span> or drag and
                            drop
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                    </div>
                </div>
                @error('thumbnail')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label for="status" class="flex items-center">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" name="status" id="status" value="1"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        {{ old('status', $video->status) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">Active</span>
                </label>
            </div>

            <!-- Featured -->
            <div class="mb-6">
                <label for="is_featured" class="flex items-center">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        {{ old('is_featured', $video->is_featured) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">Featured Video (Will replace currently featured video)</span>
                </label>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                    Update Video
                </button>
            </div>
        </form>
    </div>
@endsection