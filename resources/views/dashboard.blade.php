<x-student-layout title="Dasbor Siswi" active="dashboard">
    <div class="student-container student-page">
        <section class="student-welcome">
            <div>
                <span class="student-eyebrow"><span class="status-dot"></span> Akun belajar siswi</span>
                <h1>Halo, {{ auth()->user()->name }} <span aria-hidden="true">🌷</span></h1>
                <p>Selamat datang di ruang belajarmu. Pelajari materi secara bertahap dan tanyakan kepada tenaga kesehatan bila ada hal yang membuatmu khawatir.</p>
                <div class="welcome-meta"><span>Informasi edukasi</span><span>Privasi belajar dijaga</span><span>Progres {{ $progressPercent }}%</span></div>
            </div>
            @if (! $pretestComplete)
                <a class="button" href="{{ route('student.pretest') }}">Mulai Pretest <span aria-hidden="true">→</span></a>
            @elseif (! $posttestComplete)
                <a class="button" href="{{ route('student.posttest') }}">Lanjutkan belajar <span aria-hidden="true">→</span></a>
            @else
                <a class="button" href="{{ route('student.results') }}">Lihat hasil <span aria-hidden="true">→</span></a>
            @endif
        </section>

        <section class="student-progress-section" aria-labelledby="journey-title">
            <div class="student-section-heading"><div><span class="student-eyebrow">Alur kurikulum</span><h2 id="journey-title">Tahapan Belajar Siswi</h2></div><span class="preview-pill">{{ $progressPercent }}% progres konten</span></div>
            <div class="journey-grid">
                <a class="journey-card {{ $pretestComplete ? 'journey-current' : '' }}" href="{{ route('student.pretest') }}"><span class="journey-step">01</span><span class="journey-content"><small>Mulai di sini</small><strong>Pretest</strong><span>{{ $pretestComplete ? 'Selesai' : 'Ukur pemahaman awal' }}</span></span><span class="journey-state">{{ $pretestComplete ? 'Selesai' : 'Mulai' }} <b aria-hidden="true">→</b></span></a>
                @foreach ($materials as $index => $material)
                    @php($lessonProgress = auth()->user()->learningProgress->first(fn ($progress) => $progress->content_type === 'material' && $progress->content_id === $material->id))
                    <a class="journey-card" href="{{ route('student.lesson.show', $material->slug) }}"><span class="journey-step">{{ str_pad((string) ($index + 2), 2, '0', STR_PAD_LEFT) }}</span><span class="journey-content"><small>{{ \App\Models\Material::CATEGORIES[$material->category] ?? 'Materi edukasi' }}</small><strong>{{ $material->title }}</strong><span>{{ $lessonProgress?->completed_at ? 'Selesai' : 'Belum selesai' }}</span></span><span class="journey-state">Buka <b aria-hidden="true">→</b></span></a>
                @endforeach
                @if ($videosCount > 0)
                    <a class="journey-card" href="{{ route('student.video') }}"><span class="journey-step">V</span><span class="journey-content"><small>Media audiovisual</small><strong>Video</strong><span>{{ auth()->user()->learningProgress->where('content_type', 'video')->whereNotNull('played_at')->count() }} dari {{ $videosCount }} diputar</span></span><span class="journey-state">Buka <b aria-hidden="true">→</b></span></a>
                @endif
                <a class="journey-card {{ $posttestComplete ? 'journey-current' : '' }}" href="{{ $posttestComplete ? route('student.results') : route('student.posttest') }}"><span class="journey-step">T</span><span class="journey-content"><small>Refleksi belajar</small><strong>Posttest</strong><span>{{ $posttestComplete ? 'Selesai' : 'Tersedia setelah seluruh konten selesai' }}</span></span><span class="journey-state">{{ $posttestComplete ? 'Hasil' : 'Terkunci' }} <b aria-hidden="true">→</b></span></a>
            </div>
        </section>

        <section class="dashboard-overview-grid">
            <article class="student-card progress-summary">
                <div class="student-section-heading"><div><span class="student-eyebrow">Ringkasan belajar</span><h2>Progres Pembelajaran</h2></div><span class="outline-icon" aria-hidden="true">◉</span></div>
                <div class="empty-progress"><div class="progress-ring" aria-label="Progres {{ $progressPercent }} persen"><span>{{ $progressPercent }}%<small>selesai</small></span></div><div><strong>{{ $progressPercent === 100 ? 'Semua konten selesai' : 'Lanjutkan alur belajar' }}</strong><p>Progres dihitung dari materi yang ditandai selesai dan video yang telah diputar.</p></div></div>
                <a class="button button-outline" href="{{ $materials->first() ? route('student.lesson.show', $materials->first()->slug) : route('student.video') }}">Lanjut belajar <span aria-hidden="true">→</span></a>
            </article>
            <article class="student-card learning-activity">
                <div class="student-section-heading"><div><span class="student-eyebrow">Hasil evaluasi</span><h2>Perkembangan Belajar</h2></div><span class="outline-icon" aria-hidden="true">▦</span></div>
                @forelse ($latestAttempts as $type => $attempt)
                    <p><strong>{{ $attempt->test->title }}:</strong> {{ $attempt->total_score }} · {{ $attempt->submitted_at->format('d M Y') }}</p>
                @empty
                    <div class="empty-state"><span class="empty-state-icon">✦</span><strong>Belum ada hasil tes</strong><p>Hasil akan muncul setelah tes selesai dikirim.</p></div>
                @endforelse
                <a class="student-text-link" href="{{ route('student.results') }}">Lihat hasil lengkap →</a>
            </article>
            <article class="student-card start-card"><span class="student-eyebrow">Mulai perjalananmu</span><h2>Belajar dengan nyaman</h2><p>Pilih materi yang ingin kamu baca. Kamu dapat kembali kapan saja dan menghubungi tenaga kesehatan jika perlu bantuan.</p><a class="button button-light" href="{{ $materials->first() ? route('student.lesson.show', $materials->first()->slug) : route('student.video') }}">Lihat materi <span aria-hidden="true">→</span></a></article>
        </section>

        <section class="student-section materials-preview">
            <div class="student-section-heading"><div><span class="student-eyebrow">Belajar mandiri</span><h2>Materi Edukasi</h2></div></div>
            <div class="student-module-grid">
                @forelse ($materials as $material)
                    <a class="student-module-card" href="{{ route('student.lesson.show', $material->slug) }}">
                        @if ($material->image)<img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($material->image) }}" alt="" loading="lazy">@endif
                        <div><span class="module-chip">{{ \App\Models\Material::CATEGORIES[$material->category] ?? 'Materi edukasi' }}</span><h3>{{ $material->title }}</h3><p>{{ \Illuminate\Support\Str::limit(strip_tags($material->body), 140) }}</p><span class="module-meta">Buka materi <b aria-hidden="true">→</b></span></div>
                    </a>
                @empty
                    <p>Belum ada materi yang diterbitkan.</p>
                @endforelse
            </div>
        </section>

        <section class="student-help-grid">
            <article class="student-card safe-community"><span class="help-icon" aria-hidden="true">♡</span><div><span class="student-eyebrow">Komunitas belajar</span><h2>Belajar tanpa rasa canggung</h2><p>Materi dibuat sebagai ruang informasi yang ramah. Jika ada pertanyaan kesehatan pribadi, konsultasikan secara privat dengan orang dewasa atau tenaga kesehatan yang kamu percaya.</p><a href="{{ route('privacy') }}">Pelajari privasi dan batasan materi <span aria-hidden="true">→</span></a></div></article>
            <article class="student-card daily-reminder"><span class="student-eyebrow">Catatan penting</span><h2>Tubuhmu, waktumu</h2><ul><li>Setiap tubuh memiliki pola yang berbeda.</li><li>Informasi ini tidak menggantikan pemeriksaan.</li><li>Jangan ragu mencari bantuan profesional.</li></ul></article>
        </section>
    </div>
</x-student-layout>
