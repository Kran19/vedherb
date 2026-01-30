<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('videos', 'public');
            $data['thumbnail_path'] = $path;
        }

        // If this video is set to be featured, unfeature all others
        if ($request->has('is_featured') && $request->is_featured) {
            Video::query()->update(['is_featured' => false]);
            $data['is_featured'] = true;
        } else {
            $data['is_featured'] = false;
        }

        Video::create($data);

        return redirect()->route('admin.videos.index')->with('success', 'Video created successfully.');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->except('thumbnail');

        if ($request->hasFile('thumbnail')) {
            // Delete old image
            if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }

            $path = $request->file('thumbnail')->store('videos', 'public');
            $data['thumbnail_path'] = $path;
        }

        // If this video is set to be featured, unfeature all others
        if ($request->has('is_featured') && $request->is_featured) {
            Video::where('id', '!=', $id)->update(['is_featured' => false]);
            $data['is_featured'] = true;
        } else {
            // If we are unchecking featured, just set it to false
            if (!$request->has('is_featured')) {
                $data['is_featured'] = false;
            }
        }

        $video->update($data);

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->thumbnail_path && Storage::disk('public')->exists($video->thumbnail_path)) {
            Storage::disk('public')->delete($video->thumbnail_path);
        }

        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $video = Video::findOrFail($id);
        $video->status = !$video->status;
        $video->save();

        return response()->json(['success' => true, 'status' => $video->status, 'message' => 'Status updated successfully.']);
    }
}
