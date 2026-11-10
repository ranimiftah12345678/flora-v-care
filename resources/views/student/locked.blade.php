<x-student-layout title="Akses Belajar" active="pretest">
    <div class="student-container student-page locked-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><span>Akses belajar</span></nav>

        <section class="student-card locked-card">
            <span class="student-eyebrow">Akses Belajar</span>
            @if ($reason === 'pretest')
                <h1>Pretest belum selesai</h1>
                <p>Pretest belum dikirim. Selesaikan pretest sebelum membuka materi dan video edukasi.</p>
            @else
                <h1>Belum semua materi selesai</h1>
                <p>Semua materi dan video harus selesai sebelum membuka posttest.</p>
            @endif
            <div>
                <a class="button button-small" href="{{ route('dashboard') }}">Kembali ke Dasbor</a>
            </div>
        </section>
    </div>
</x-student-layout>
