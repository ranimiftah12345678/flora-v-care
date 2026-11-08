<x-student-layout :title="$lesson['title']" active="lessons">
    @php
        $lessonSlugs = ['keputihan', 'jenis-keputihan', 'tanda-gejala', 'pencegahan', 'higienitas'];
        $lessonLabels = ['Mengenal Keputihan', 'Jenis & Perubahan', 'Tanda & Gejala', 'Perawatan Diri', 'Higienitas Harian'];
    @endphp

    <div class="student-container student-page lesson-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><a href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a><span aria-hidden="true">/</span><span>{{ $lesson['module'] }}</span></nav>
        <section class="lesson-heading">
            <div><span class="student-eyebrow">{{ $lesson['module'] }}</span><h1>{{ $lesson['title'] }}</h1><p>{{ $lesson['summary'] }}</p><div class="lesson-meta"><span>◷ {{ $lesson['minutes'] }} menit baca</span><span>Materi edukasi</span><span>● Belum ada progres tersimpan</span></div></div>
        </section>

        <div class="lesson-layout">
            <main class="lesson-article">
                <figure class="lesson-cover"><img src="{{ $lesson['image'] }}" alt="Ilustrasi pendampingan edukasi kesehatan" fetchpriority="high"><figcaption>Ilustrasi pembelajaran Flora-V Care · Informasi edukasi umum</figcaption></figure>
                <aside class="student-disclaimer lesson-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Informasi edukasi — bukan diagnosis medis</strong><p>Materi ini membantu pembelajaran umum. Untuk keluhan atau pertanyaan kesehatan pribadi, konsultasikan dengan tenaga kesehatan tepercaya.</p></div></aside>

                @foreach ($lesson['sections'] as $index => $section)
                    <section class="lesson-content-section">
                        <div class="lesson-section-title"><span>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><h2>{{ $section['heading'] }}</h2></div>
                        <p>{{ $section['body'] }}</p>
                        <div class="lesson-points">@foreach ($section['points'] as $point)<div><span aria-hidden="true">✓</span><p>{{ $point }}</p></div>@endforeach</div>
                    </section>
                @endforeach

                <aside class="care-callout"><span aria-hidden="true">♡</span><div><strong>Kamu berhak mendapat jawaban yang aman dan tidak menghakimi.</strong><p>Sampaikan pertanyaan kepada tenaga kesehatan atau orang dewasa yang kamu percaya.</p></div></aside>

                <div class="lesson-pager">
                    @if ($previousSlug)
                        <a class="button button-outline" href="{{ route('student.lesson.show', $previousSlug) }}"><span aria-hidden="true">←</span> Materi sebelumnya</a>
                    @else
                        <a class="button button-outline" href="{{ route('dashboard') }}"><span aria-hidden="true">←</span> Dasbor belajar</a>
                    @endif
                    <a class="button" href="{{ $nextSlug ? route('student.lesson.show', $nextSlug) : route('student.video') }}">{{ $nextSlug ? 'Materi berikutnya' : 'Lanjut ke Video' }} <span aria-hidden="true">→</span></a>
                </div>
            </main>

            <aside class="lesson-sidebar">
                <section class="student-card lesson-outline"><div class="student-section-heading"><div><span class="student-eyebrow">Program belajar</span><h2>Progres Modul</h2></div><span class="preview-pill">Pratinjau</span></div>
                    <div class="lesson-list">@foreach ($lessonSlugs as $index => $lessonSlug)<a @class(['lesson-list-item', 'is-current' => $lessonSlug === $slug]) href="{{ route('student.lesson.show', $lessonSlug) }}"><span>{{ $index + 1 }}</span><span><strong>{{ $lessonLabels[$index] }}</strong><small>Materi edukasi</small></span><b aria-hidden="true">›</b></a>@endforeach</div>
                    <p class="sidebar-note">Kemajuan membaca belum disimpan di akun.</p>
                    <a class="button button-small sidebar-button" href="{{ route('student.posttest') }}">Lihat Posttest <span aria-hidden="true">→</span></a>
                </section>

                <section class="student-card expert-note"><span class="student-eyebrow">Pendampingan</span><h2>Jangan ragu bertanya</h2><p>Bila ada perubahan atau keluhan yang membuatmu khawatir, tenaga kesehatan dapat membantu menilainya.</p><a class="student-text-link" href="{{ route('privacy') }}">Lihat panduan privasi <span aria-hidden="true">→</span></a></section>
                <section class="student-card module-summary"><span class="student-eyebrow">Tentang materi</span><strong>{{ $lesson['minutes'] }} menit</strong><p>Perkiraan waktu membaca materi edukasi ini.</p><span>Informasi kesehatan umum · Perlu tinjauan klinis</span></section>
            </aside>
        </div>
    </div>
</x-student-layout>
