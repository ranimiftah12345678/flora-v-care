<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function index(Request $request): View
    {
        $materials = Material::query()
            ->when($request->filled('q'), fn ($query) => $query->where('title', 'like', '%'.$request->string('q')->toString().'%'))
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->input('category')))
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.materials', [
            'materials' => $materials,
            'categories' => Material::CATEGORIES,
        ]);
    }

    public function create(): View
    {
        return view('admin.material-form', [
            'material' => new Material,
            'categories' => Material::CATEGORIES,
        ]);
    }

    public function store(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('materials', 'slug')],
            'category' => ['required', Rule::in(array_keys(Material::CATEGORIES))],
            'body' => ['required', 'string', 'max:50000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $material = Material::query()->create([
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?? Str::slug($validated['title']),
            'category' => $validated['category'],
            'body' => $validated['body'],
            'sort_order' => $validated['sort_order'],
            'is_published' => (bool) ($validated['is_published'] ?? false),
        ]);

        if ($request->hasFile('image')) {
            $material->update(['image' => $request->file('image')->storePublicly('materials', 'public')]);
        }

        $logger->log('buat_materi', $request->user(), $material->title, $material);

        return redirect()->route('admin.materials')->with('status', 'Materi berhasil disimpan.');
    }

    public function edit(Material $material): View
    {
        return view('admin.material-form', [
            'material' => $material,
            'categories' => Material::CATEGORIES,
        ]);
    }

    public function update(Request $request, Material $material, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys(Material::CATEGORIES))],
            'body' => ['required', 'string', 'max:50000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:10000'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $material->update([
                'image' => $request->file('image')->storePublicly('materials', 'public'),
            ]);
        }

        $material->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'body' => $validated['body'],
            'sort_order' => $validated['sort_order'],
            'is_published' => (bool) ($validated['is_published'] ?? false),
        ]);
        $logger->log('ubah_materi', $request->user(), $material->title, $material);

        return redirect()->route('admin.materials')->with('status', 'Materi berhasil diperbarui.');
    }

    public function destroy(Material $material, Request $request, ActivityLogger $logger): RedirectResponse
    {
        $title = $material->title;
        $material->delete();
        $logger->log('hapus_materi', $request->user(), $title);

        return redirect()->route('admin.materials')->with('status', 'Materi berhasil dihapus.');
    }
}
