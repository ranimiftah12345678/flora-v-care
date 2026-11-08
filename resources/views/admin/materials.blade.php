<x-admin-layout title="Manajemen Materi Edukasi" active="materials">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">KONTEN EDUKASI</span><h1>Manajemen Materi Edukasi</h1><p>Materi berstatus terbit dapat diakses melalui halaman belajar siswi.</p></div><div class="admin-heading-actions"><a class="admin-button" href="{{ route('admin.materials.create') }}">＋ Tambah materi</a></div></section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-filter-row" method="GET" action="{{ route('admin.materials') }}"><label for="material-search">Cari materi</label><input id="material-search" class="admin-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Judul materi"><button class="admin-button admin-button-outline" type="submit">Cari</button></form>
    <section class="admin-material-list">
        @forelse ($materials as $material)
            <article class="admin-material-card"><span class="admin-material-number">{{ str_pad((string) $material->sort_order, 2, '0', STR_PAD_LEFT) }}</span><div class="admin-material-copy"><span class="admin-eyebrow">{{ $categories[$material->category] ?? $material->category }}</span><h2>{{ $material->title }}</h2><p>{{ \Illuminate\Support\Str::limit($material->body, 170) }}</p><small>/siswi/materi/{{ $material->slug }}</small></div><div class="admin-material-actions"><span class="admin-status {{ $material->is_published ? '' : 'admin-status-soft' }}">{{ $material->is_published ? 'Terbit' : 'Draf' }}</span><a class="admin-button admin-button-outline" href="{{ route('admin.materials.edit', $material) }}">Ubah</a><form method="POST" action="{{ route('admin.materials.destroy', $material) }}" onsubmit="return confirm('Hapus materi ini?')">@csrf @method('DELETE')<button class="admin-text-button" type="submit">Hapus</button></form></div></article>
        @empty
            <section class="admin-panel"><p>Belum ada materi. Tambahkan materi pertama untuk mengisi katalog.</p></section>
        @endforelse
    </section>
    <div class="admin-pagination">{{ $materials->links() }}</div>
</x-admin-layout>
