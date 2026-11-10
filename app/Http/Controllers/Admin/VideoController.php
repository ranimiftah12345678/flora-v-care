<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        return view('admin.videos', [
            'videos' => Video::query()->orderBy('sort_order')->orderBy('id')->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.video-form', ['video' => new Video]);
    }

    public function store(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'video_file' => ['required', 'file', 'mimes:mp4', 'mimetypes:video/mp4', 'max:204800'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $file = $request->file('video_file');
        $video = Video::query()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'file_path' => $file->storePublicly('videos', 'public'),
            'mime_type' => 'video/mp4',
            'file_size' => $file->getSize(),
            'thumbnail' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->storePublicly('video-thumbnails', 'public') : null,
            'sort_order' => $validated['sort_order'],
            'is_published' => (bool) ($validated['is_published'] ?? false),
        ]);
        $logger->log('unggah_video', $request->user(), $video->title, $video);

        return redirect()->route('admin.videos')->with('status', 'Video MP4 berhasil diunggah.');
    }

    public function edit(Video $video): View
    {
        return view('admin.video-form', compact('video'));
    }

    public function update(Request $request, Video $video, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'video_file' => ['nullable', 'file', 'mimes:mp4', 'mimetypes:video/mp4', 'max:204800'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $oldVideoPath = $video->file_path;
        $oldThumbnailPath = $video->thumbnail;
        $attributes = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'],
            'is_published' => (bool) ($validated['is_published'] ?? false),
        ];

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $attributes['file_path'] = $file->storePublicly('videos', 'public');
            $attributes['mime_type'] = 'video/mp4';
            $attributes['file_size'] = $file->getSize();
        }
        if ($request->hasFile('thumbnail')) {
            $attributes['thumbnail'] = $request->file('thumbnail')->storePublicly('video-thumbnails', 'public');
        }

        $video->update($attributes);

        if ($request->hasFile('video_file') && isset($oldVideoPath)) {
            Storage::disk('public')->delete($oldVideoPath);
        }
        if ($request->hasFile('thumbnail') && isset($oldThumbnailPath)) {
            Storage::disk('public')->delete($oldThumbnailPath);
        }

        $logger->log('ubah_video', $request->user(), $video->title, $video);

        return redirect()->route('admin.videos')->with('status', 'Data video berhasil diperbarui.');
    }

    public function destroy(Video $video, Request $request, ActivityLogger $logger): RedirectResponse
    {
        $title = $video->title;
        Storage::disk('public')->delete($video->file_path);
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        $video->delete();
        $logger->log('hapus_video', $request->user(), $title);

        return redirect()->route('admin.videos')->with('status', 'Video berhasil dihapus.');
    }
}
