<x-student-layout :title="$material->title" active="lessons">
    <div class="student-container student-page lesson-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><a href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a><span aria-hidden="true">/</span><span>{{ \App\Models\Material::CATEGORIES[$material->category] ?? 'Materi' }}</span></nav>
        <section class="lesson-heading"><div><span class="student-eyebrow">{{ \App\Models\Material::CATEGORIES[$material->category] ?? 'Materi edukasi' }}</span><h1>{{ $material->title }}</h1><p>Materi edukasi umum. Untuk keluhan pribadi, konsultasikan dengan tenaga kesehatan tepercaya.</p>@if ($isCompleted)<span class="preview-pill">Materi selesai</span>@endif</div></section>
        <div class="lesson-layout">
            <main class="lesson-article">
                <aside class="student-disclaimer lesson-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Informasi edukasi — bukan diagnosis medis</strong><p>Materi ini membantu pembelajaran umum dan tidak menggantikan pemeriksaan tenaga kesehatan.</p></div></aside>
                @if ($material->image)<img class="lesson-image" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($material->image) }}" alt="Ilustrasi materi {{ $material->title }}">@endif
                <section class="lesson-content-section"><p>{!! nl2br(e($material->body)) !!}</p></section>
                <div id="lesson-completion-sentinel" aria-hidden="true"></div>
                <p id="lesson-progress-status" class="student-muted" role="status" aria-live="polite">{{ $isCompleted ? 'Progres tersimpan.' : 'Gulir sampai akhir materi untuk mencatat penyelesaian.' }}</p>
                <div class="lesson-pager"><a class="button button-outline" href="{{ route('dashboard') }}"><span aria-hidden="true">←</span> Dasbor belajar</a><a class="button" href="{{ route('student.video') }}">Lanjut ke Video <span aria-hidden="true">→</span></a></div>
            </main>
        </div>
    </div>
    @unless ($isCompleted)
        <script>
            const sentinel = document.getElementById('lesson-completion-sentinel');
            let completionSent = false;

            async function markLessonComplete() {
                if (completionSent) {
                    return;
                }
                completionSent = true;

                try {
                    const response = await fetch(@json(route('student.lesson.complete', $material)), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify({ completed: true }),
                    });
                    if (!response.ok) {
                        throw new Error(`Progres gagal disimpan (${response.status}).`);
                    }
                    document.getElementById('lesson-progress-status').textContent = 'Materi selesai dan progres tersimpan.';
                } catch (error) {
                    completionSent = false;
                    document.getElementById('lesson-progress-status').textContent = error.message;
                }
            }

            if ('IntersectionObserver' in window) {
                new IntersectionObserver((entries) => {
                    if (entries.some((entry) => entry.isIntersecting)) {
                        markLessonComplete();
                    }
                }).observe(sentinel);
            } else {
                window.addEventListener('scroll', () => {
                    if (window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 80) {
                        markLessonComplete();
                    }
                });
            }
        </script>
    @endunless
</x-student-layout>
