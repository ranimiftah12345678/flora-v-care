<x-admin-layout title="{{ $video->exists ? 'Ubah Video' : 'Unggah Video' }}" active="videos">
    <div class="admin-breadcrumb"><a href="{{ route('admin.videos') }}">Video</a><span>/</span><span>{{ $video->exists ? 'Ubah' : 'Unggah' }}</span></div>
    <section class="admin-page-heading"><div><span class="admin-eyebrow">MEDIA EDUKASI</span><h1>{{ $video->exists ? 'Ubah Video' : 'Unggah Video MP4' }}</h1><p>Hanya berkas MP4 hingga 200 MB yang diterima. Draf tidak ditampilkan kepada siswi.</p></div></section>
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-panel admin-form" method="POST" enctype="multipart/form-data" action="{{ $video->exists ? route('admin.videos.update', $video) : route('admin.videos.store') }}">
        @csrf @if ($video->exists) @method('PATCH') @endif
        <label for="title">Judul video</label><input id="title" name="title" value="{{ old('title', $video->title) }}" required maxlength="255">
        <label for="description">Deskripsi</label><textarea id="description" name="description" rows="4" maxlength="5000">{{ old('description', $video->description) }}</textarea>
        @if ($video->exists)<p class="admin-muted">Berkas saat ini: {{ basename($video->file_path) }} · {{ number_format($video->file_size / 1048576, 1) }} MB</p>@endif
        <label for="video_file">{{ $video->exists ? 'Ganti berkas MP4 (opsional)' : 'Berkas MP4' }}</label><input id="video_file" name="video_file" type="file" accept="video/mp4,.mp4" @required(!$video->exists)>
        <label for="sort_order">Urutan tampil</label><input id="sort_order" name="sort_order" type="number" min="0" max="10000" value="{{ old('sort_order', $video->sort_order ?? 0) }}" required>
        <label class="admin-checkbox-field"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $video->is_published))><span>Terbitkan kepada siswi</span></label>
        <div class="admin-form-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.videos') }}">Batal</a><button class="admin-button" type="submit">Simpan video</button></div>
    </form>
</x-admin-layout>
