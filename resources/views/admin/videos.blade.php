<x-admin-layout title="Manajemen Video Edukasi" active="videos">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">KONTEN MULTIMEDIA</span><h1>Manajemen Video Edukasi</h1><p>Unggah MP4, tinjau, lalu pilih apakah video ditampilkan pada portal siswi.</p></div><div class="admin-heading-actions"><a class="admin-button" href="{{ route('admin.videos.create') }}">＋ Unggah video</a></div></section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <section class="admin-video-list">
        @forelse ($videos as $video)
            <article class="admin-panel admin-video-card"><div class="admin-video-placeholder"><video controls preload="metadata"><source src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($video->file_path) }}" type="video/mp4"></video></div><div class="admin-video-info"><div><span class="admin-eyebrow">VIDEO EDUKASI</span><h2>{{ $video->title }}</h2><p>{{ $video->description }}</p></div><div class="admin-video-meta"><span>{{ number_format($video->file_size / 1048576, 1) }} MB</span><span>{{ $video->mime_type }}</span><span>{{ $video->is_published ? 'Terbit' : 'Draf' }}</span></div><div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.videos.edit', $video) }}">Ubah</a><form method="POST" action="{{ route('admin.videos.destroy', $video) }}" onsubmit="return confirm('Hapus video ini?')">@csrf @method('DELETE')<button class="admin-text-button" type="submit">Hapus</button></form></div></div></article>
        @empty
            <section class="admin-panel"><p>Belum ada video. Unggah MP4 yang telah ditinjau sebelum menerbitkannya kepada siswi.</p></section>
        @endforelse
    </section>
    <div class="admin-pagination">{{ $videos->links() }}</div>
    <aside class="admin-callout"><strong>Standar publikasi media</strong><p>Pastikan hak penggunaan, persetujuan subjek, keamanan berkas, aksesibilitas, dan persetujuan etik diperiksa sebelum media digunakan.</p></aside>
</x-admin-layout>
