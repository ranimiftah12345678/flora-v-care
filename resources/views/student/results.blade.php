<x-student-layout title="Hasil Belajar" active="results">
    <div class="student-container student-page results-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><span>Hasil belajar</span></nav>
        @if (session('status'))<div class="student-disclaimer" role="status">{{ session('status') }}</div>@endif
        <section class="results-hero"><div><span class="student-eyebrow"><span class="status-dot"></span> Ringkasan pembelajaran</span><h1>Hasil Belajar &amp; Evaluasi</h1><p>Skor evaluasi pembelajaranmu dan progres konten edukasi.</p><span class="preview-pill">{{ $progressPercent }}% materi dan video selesai</span></div><span class="results-medal" aria-hidden="true">✦</span></section>

        <section class="results-stat-grid">
            @foreach (['pretest' => 'Evaluasi awal', 'posttest' => 'Evaluasi akhir'] as $type => $label)
                @php($attempt = $attempts->get($type))
                <article><span>{{ $label }}</span><strong>{{ $attempt?->total_score ?? '—' }}</strong><small>{{ $attempt?->submitted_at?->format('d M Y') ?? 'Belum ada hasil' }}</small></article>
            @endforeach
            <article><span>Materi selesai</span><strong>{{ $progressPercent }}%</strong><small>Progres materi dan video</small></article>
            <article><span>Sertifikat</span><strong>—</strong><small>Belum ditetapkan</small></article>
        </section>

        @if ($posttestAttempt && $pretestAttempt)
            <section class="student-card result-delta">
                <span class="student-eyebrow">Perkembangan evaluasi</span>
                <h2>Selisih evaluasi belajar</h2>
                <p>Skor posttest <strong>{{ $posttestAttempt->total_score }}</strong> dikurang skor pretest <strong>{{ $pretestAttempt->total_score }}</strong> menjadi <strong>{{ $scoreDelta > 0 ? '+' : '' }}{{ $scoreDelta }}</strong> poin.</p>
            </section>
        @endif

        @if ($posttestAttempt?->test?->attitude_threshold !== null)
            <section class="student-card result-category">
                <span class="student-eyebrow">Kategori sikap</span>
                <h2>{{ $attitudeCategory === 'mampu' ? 'Mampu memenuhi ambang sikap positif' : 'Belum memenuhi ambang sikap positif' }}</h2>
                <p>Skor posttest <strong>{{ $posttestAttempt->total_score }}</strong> dibandingkan ambang sikap <strong>{{ $posttestAttempt->test->attitude_threshold }}</strong>.</p>
            </section>
        @endif

        <div class="results-layout">
            <section class="student-card result-empty">
                <div class="empty-state-icon">▤</div><span class="student-eyebrow">Perkembangan belajar</span><h2>{{ $attempts->isEmpty() ? 'Belum ada hasil evaluasi' : 'Hasil Evaluasi Tersimpan' }}</h2>
                @if ($attempts->isEmpty())
                    <p>Skor akan ditampilkan setelah kamu menyelesaikan dan mengirim tes.</p>
                @else
                    <div class="result-chart-placeholder" aria-label="Ringkasan hasil skor">
                        @foreach (['pretest' => 'Pretest', 'posttest' => 'Posttest'] as $type => $label)
                            @if ($attempts->has($type))
                                <p><strong>{{ $label }}:</strong> {{ $attempts[$type]->total_score }} · {{ $attempts[$type]->submitted_at->format('d M Y H:i') }}</p>
                            @endif
                        @endforeach
                    </div>
                @endif
                <a class="button button-outline" href="{{ route('dashboard') }}">Kembali ke alur belajar <span aria-hidden="true">→</span></a>
            </section>
            <aside class="results-side"><section class="student-card certificate-card"><span class="student-eyebrow">Sertifikat pembelajaran</span><div class="certificate-blank"><span aria-hidden="true">♧</span><strong>Sertifikat belum tersedia</strong><small>Ketentuan sertifikat belum ditetapkan.</small></div><p>Sertifikat baru dapat dibuat ketika kriteria penyelesaian dan format penerbitan disetujui.</p></section><section class="student-card result-next"><span class="student-eyebrow">Langkah berikutnya</span><h2>Lanjutkan belajar dengan nyaman</h2><a href="{{ route('dashboard') }}">Buka dasbor belajar <span aria-hidden="true">→</span></a></section></aside>
        </div>
        <aside class="student-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Hasil belajar bukan hasil pemeriksaan medis</strong><p>Evaluasi pembelajaran tidak dapat digunakan untuk mendiagnosis kondisi kesehatan. Bicarakan keluhan dengan tenaga kesehatan.</p></div></aside>
        <div class="lesson-pager"><a class="button button-outline" href="{{ route('dashboard') }}"><span aria-hidden="true">←</span> Kembali ke Dasbor</a></div>
    </div>
</x-student-layout>
