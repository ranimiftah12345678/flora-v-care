<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Material;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ContentController extends Controller
{
    public function index(): View
    {
        $sections = [
            [
                'key' => 'beranda',
                'title' => 'Konten Beranda',
                'description' => 'Edit filosofi Flora-V Care, teks maskot, dan ringkasan 4 kartu utama.',
                'route' => route('admin.content.edit', 'beranda'),
            ],
            [
                'key' => 'jenis',
                'title' => 'Halaman Jenis Keputihan',
                'description' => 'Kelola teks pengertian fluor albus, karakteristik klinis, dan mikrobiologis.',
                'route' => route('admin.content.edit', 'jenis'),
            ],
            [
                'key' => 'tanda-gejala',
                'title' => 'Halaman Tanda & Gejala',
                'description' => 'Kelola penyebab normal/patologis, panduan warna, dan tanda kapan harus ke nakes.',
                'route' => route('admin.content.edit', 'tanda-gejala'),
            ],
            [
                'key' => 'cara-pencegahan',
                'title' => 'Halaman Cara Pencegahan',
                'description' => 'Kelola panduan Vulva Hygiene: 4 langkah cuci, pakaian dalam, pantyliner, cuci tangan, dan handuk.',
                'route' => route('admin.content.edit', 'cara-pencegahan'),
            ],
            [
                'key' => 'video',
                'title' => 'Video Edukasi & Praktik',
                'description' => 'Kelola judul modul, thumbnail/cover, dan teks pengantar modul video.',
                'route' => route('admin.content.edit', 'video'),
            ],
            [
                'key' => 'video-list',
                'title' => 'Daftar Berkas & Tautan Video',
                'description' => 'Kelola daftar item video, pemutar tertanam YouTube/MP4, dan urutan putar.',
                'route' => route('admin.videos'),
            ],
        ];

        return view('admin.content.index', compact('sections'));
    }

    public function edit(string $section): View
    {
        $material = null;
        $slugMap = [
            'beranda' => 'keputihan',
            'jenis' => 'jenis-keputihan',
            'tanda-gejala' => 'tanda-gejala',
            'cara-pencegahan' => 'pencegahan',
            'video' => 'video',
        ];

        $slug = $slugMap[$section] ?? 'keputihan';
        $material = Material::where('slug', $slug)->first();

        $history = ActivityLog::query()
            ->where('action', 'edit_konten')
            ->where('description', 'like', "%{$section}%")
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.content.edit', compact('section', 'material', 'history'));
    }

    public function update(Request $request, string $section, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $slugMap = [
            'beranda' => 'keputihan',
            'jenis' => 'jenis-keputihan',
            'tanda-gejala' => 'tanda-gejala',
            'cara-pencegahan' => 'pencegahan',
            'video' => 'video',
        ];
        $slug = $slugMap[$section] ?? 'keputihan';

        $material = Material::firstOrNew(['slug' => $slug]);
        if (! $material->exists) {
            $material->category = $section;
            $material->sort_order = 1;
            $material->is_published = true;
        }

        $material->title = $validated['title'];
        $material->body = $validated['body'];

        if ($request->hasFile('image')) {
            if ($material->image && Storage::disk('public')->exists($material->image)) {
                Storage::disk('public')->delete($material->image);
            }
            $material->image = $request->file('image')->store('content-images', 'public');
        }

        $material->save();

        $logger->log('edit_konten', $request->user(), "Memperbarui konten bagian [{$section}]: {$material->title}");

        return redirect()->route('admin.content.edit', $section)->with('status', "Konten {$section} berhasil diperbarui.");
    }
}
