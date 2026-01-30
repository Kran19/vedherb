@extends('admin.layouts.master')

@section('title', 'Videos')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Videos</h2>
            <a href="{{ route('admin.videos.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Video
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Video URL
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($videos as $video)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($video->thumbnail_path)
                                    <img src="{{ asset('storage/' . $video->thumbnail_path) }}" alt="{{ $video->title }}"
                                        class="h-16 w-24 object-cover rounded shadow-sm border">
                                @else
                                    <div
                                        class="h-16 w-24 bg-gray-100 rounded flex items-center justify-center text-gray-400 text-xs shadow-sm border">
                                        No Img</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $video->title }}
                                    @if($video->is_featured)
                                        <span
                                            class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Featured
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ $video->video_url }}" target="_blank"
                                    class="text-blue-600 hover:underline truncate block max-w-xs">{{ $video->video_url }}</a>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button onclick="toggleStatus({{ $video->id }})" id="status-btn-{{ $video->id }}"
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $video->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $video->status ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.videos.edit', $video->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.videos.destroy', $video->id) }}" method="POST"
                                    class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this video?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                No videos found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $videos->links() }}
        </div>
    </div>

    <script>
        function toggleStatus(id) {
            if (!confirm('Are you sure you want to subscribe to change status?')) return;

            fetch(`/admin/videos/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const btn = document.getElementById(`status-btn-${id}`);
                        if (data.status) {
                            btn.classList.remove('bg-red-100', 'text-red-800');
                            btn.classList.add('bg-green-100', 'text-green-800');
                            btn.innerText = 'Active';
                        } else {
                            btn.classList.remove('bg-green-100', 'text-green-800');
                            btn.classList.add('bg-red-100', 'text-red-800');
                            btn.innerText = 'Inactive';
                        }
                    }
                });
        }
    </script>
@endsection