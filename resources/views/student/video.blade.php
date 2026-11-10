<x-student-layout title="Video Edukasi" active="video">
    <div class="student-container student-page video-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><span>Video edukasi</span></nav>
        <section class="video-heading"><span class="student-eyebrow"><span class="status-dot"></span> Media pembelajaran</span><h1>Video Panduan Kesehatan Reproduksi Remaja</h1><p>Materi audiovisual yang telah diterbitkan oleh admin.</p></section>
        <div class="video-layout">
            <main>
                @forelse ($videos as $video)
                    <section class="video-player-card">
                        <video class="student-video-player" data-video-id="{{ $video->id }}" controls preload="metadata">
                            <source src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($video->file_path) }}" type="video/mp4">
                            Perambanmu tidak mendukung pemutaran video.
                        </video>
                        <div class="video-player-caption"><strong>{{ $video->title }}</strong><span>{{ in_array($video->id, $playedVideoIds, true) ? 'Sudah diputar' : number_format($video->file_size / 1048576, 1).' MB' }}</span></div>
                        @if ($video->description)<p class="video-info-description">{{ $video->description }}</p>@endif
                    </section>
                @empty
                    <section class="video-player-card"><div class="video-poster"><div class="video-unavailable"><span aria-hidden="true">▷</span><strong>Video belum tersedia</strong><small>Belum ada video yang diterbitkan.</small></div></div><div class="video-player-caption"><strong>Panduan kesehatan reproduksi remaja</strong><span>Media edukasi</span></div></section>
                @endforelse
                <section class="video-transcript"><div class="student-section-heading"><div><span class="student-eyebrow">Pendamping teks</span><h2>Pokok Pembelajaran</h2></div><span class="preview-pill">Ringkasan</span></div><ol><li><span>01</span><div><strong>Kenali tubuhmu</strong><p>Tubuh setiap orang berbeda. Perhatikan hal-hal yang terasa tidak biasa bagimu.</p></div></li><li><span>02</span><div><strong>Rawat diri dengan lembut</strong><p>Utamakan kebersihan sederhana dan hindari produk yang tidak disarankan tenaga kesehatan.</p></div></li><li><span>03</span><div><strong>Cari bantuan jika khawatir</strong><p>Bicarakan perubahan atau keluhan dengan tenaga kesehatan tepercaya.</p></div></li></ol></section>
                <aside class="student-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Konten ini tidak menggantikan panduan profesional</strong><p>Video dan ringkasan bersifat edukasi umum dan bukan diagnosis. Untuk keluhan pribadi, konsultasikan dengan tenaga kesehatan tepercaya.</p></div></aside>
                <div class="lesson-pager"><a class="button button-outline" href="{{ route('student.lesson.show', 'higienitas') }}"><span aria-hidden="true">←</span> Kembali ke materi</a><a class="button" href="{{ route('student.posttest') }}">Lihat Posttest <span aria-hidden="true">→</span></a></div>
            </main>
            <aside class="video-sidebar"><section class="student-card video-course-card"><div class="student-section-heading"><div><span class="student-eyebrow">Program belajar</span><h2>Materi Pilihan</h2></div><span class="preview-pill">Edukasi</span></div><a href="{{ route('student.lesson.show', 'keputihan') }}"><span>01</span><span><strong>Mengenal Keputihan</strong><small>Materi edukasi</small></span><b>›</b></a><a href="{{ route('student.lesson.show', 'jenis-keputihan') }}"><span>02</span><span><strong>Jenis &amp; Perubahan</strong><small>Materi edukasi</small></span><b>›</b></a><a href="{{ route('student.lesson.show', 'pencegahan') }}"><span>03</span><span><strong>Kebiasaan Sehat</strong><small>Materi edukasi</small></span><b>›</b></a></section><section class="student-card video-help-card"><span class="student-eyebrow">Butuh bantuan?</span><h2>Bicarakan dengan orang tepercaya</h2><p>Jika ada pertanyaan kesehatan pribadi, kamu dapat berbicara dengan tenaga kesehatan.</p><a href="{{ route('privacy') }}">Panduan privasi <span aria-hidden="true">→</span></a></section></aside>
        </div>
    </div>
    <script>
        document.querySelectorAll('.student-video-player').forEach((player) => {
            const markProgress = () => {
                fetch(@json(route('student.video.playback')), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({ video_id: player.dataset.videoId }),
                }).then((response) => {
                    if (!response.ok) {
                        throw new Error(`Pencatatan progres video gagal (${response.status}).`);
                    }
                }).catch((error) => console.error(error));
            };

            player.addEventListener('play', markProgress);
            player.addEventListener('ended', markProgress);
        });
    </script>
</x-student-layout>
