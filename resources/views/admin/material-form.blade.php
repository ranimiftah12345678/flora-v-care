<x-admin-layout title="{{ $material->exists ? 'Ubah Materi' : 'Tambah Materi' }}" active="materials">
    <div class="admin-breadcrumb"><a href="{{ route('admin.materials') }}">Materi</a><span>/</span><span>{{ $material->exists ? 'Ubah' : 'Tambah' }}</span></div>
    <section class="admin-page-heading"><div><span class="admin-eyebrow">KONTEN EDUKASI · TINJAU SEBELUM TERBIT</span><h1>{{ $material->exists ? 'Ubah Materi' : 'Tambah Materi' }}</h1><p>Slug URL dibuat saat materi disimpan dan tidak dapat diubah sesudahnya.</p></div></section>
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-panel admin-form" method="POST" enctype="multipart/form-data" action="{{ $material->exists ? route('admin.materials.update', $material) : route('admin.materials.store') }}">
        @csrf @if ($material->exists) @method('PATCH') @endif
        <label for="title">Judul materi</label><input id="title" name="title" value="{{ old('title', $material->title) }}" required maxlength="255">
        <label for="slug">Slug URL</label><input id="slug" name="slug" value="{{ old('slug', $material->slug) }}" @readonly($material->exists) required maxlength="255" pattern="[a-z0-9]+(?:-[a-z0-9]+)*">
        <label for="category">Kategori</label>
        <select id="category" name="category" required>
            @foreach ($categories as $value => $label)<option value="{{ $value }}" @selected(old('category', $material->category) === $value)>{{ $label }}</option>@endforeach
        </select>
        <label for="body">Isi materi</label><textarea id="body" name="body" rows="14" maxlength="50000" required>{{ old('body', $material->body) }}</textarea>
        <label for="image">Gambar materi (opsional)</label>
        @if ($material->image)<p class="admin-muted">Gambar saat ini: {{ basename($material->image) }} — unggah gambar baru untuk menggantinya.</p>@endif
        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp">
        <label for="sort_order">Urutan tampil</label><input id="sort_order" name="sort_order" type="number" min="0" max="10000" value="{{ old('sort_order', $material->sort_order ?? 0) }}" required>
        <label class="admin-checkbox-field"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $material->is_published))><span>Terbitkan dan tampilkan kepada siswi</span></label>
        <p class="admin-muted">Pastikan materi memiliki sumber yang dapat diverifikasi dan telah ditinjau sebelum dipublikasikan.</p>
        <div class="admin-form-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.materials') }}">Batal</a><button class="admin-button" type="submit">Simpan materi</button></div>
    </form>
</x-admin-layout>
