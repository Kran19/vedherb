@extends('admin.layouts.master')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-6">Create Testimonial</h2>

            <form action="{{ route('admin.testimonials.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Avatar/Image</label>
                    <div class="flex items-start space-x-4">
                        <div id="image-preview"
                            class="w-24 h-24 bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                            <i class="fas fa-image text-gray-300 text-2xl"></i>
                        </div>
                        <div class="flex-1">
                            <input type="hidden" name="image" id="image-url" value="{{ old('image') }}">
                            <button type="button" onclick="openMediaModal()"
                                class="bg-indigo-50 text-indigo-600 px-3 py-1.5 rounded border border-indigo-100 hover:bg-indigo-100 transition text-sm">
                                <i class="fas fa-images mr-2"></i>Select Image
                            </button>
                            <p class="text-[10px] text-gray-500 mt-1">Recommended: 1:1 aspect ratio (e.g. 200x200px)</p>
                            @error('image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Client Name
                    </label>
                    <input type="text" name="name" id="name"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="designation">
                        Designation
                    </label>
                    <input type="text" name="designation" id="designation"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('designation') }}">
                    @error('designation')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="rating">
                        Rating
                    </label>
                    <input type="number" name="rating" id="rating" step="1" min="1" max="5"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('rating', 5) }}">
                    @error('rating')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                        Message
                    </label>
                    <textarea name="message" id="message" rows="5"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="form-checkbox h-5 w-5 text-blue-600"
                            checked>
                        <span class="ml-2 text-gray-700">Active</span>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Create Testimonial
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    @include('admin.partials.media-modal')

@endsection

@push('scripts')
    <script>
        function openMediaModal() {
            window.mediaModal.open({
                onSelect: function (media) {
                    document.getElementById('image-url').value = media.url;
                    document.getElementById('image-preview').innerHTML = `<img src="${media.url}" class="w-full h-full object-cover">`;
                }
            });
        }
    </script>
@endpush