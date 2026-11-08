<x-student-layout title="Dasbor Siswi" active="dashboard">
    <div class="student-container student-page">
        <section class="student-welcome">
            <div>
                <span class="student-eyebrow"><span class="status-dot"></span> Akun belajar siswi</span>
                <h1>Halo, {{ auth()->user()->name }} <span aria-hidden="true">🌷</span></h1>
                <p>Selamat datang di ruang belajarmu. Pelajari materi secara bertahap dan tanyakan kepada tenaga kesehatan bila ada hal yang membuatmu khawatir.</p>
                <div class="welcome-meta"><span>Informasi edukasi</span><span>Privasi belajar dijaga</span><span>Progres belum tersedia</span></div>
            </div>
            <a class="button" href="{{ route('student.pretest') }}">Lihat Pretest <span aria-hidden="true">→</span></a>
        </section>

        <section class="student-progress-section" aria-labelledby="journey-title">
            <div class="student-section-heading">
                <div><span class="student-eyebrow">Alur kurikulum</span><h2 id="journey-title">Tahapan Belajar Siswi</h2></div>
                <span class="preview-pill">Progres akan muncul setelah fitur belajar aktif</span>
            </div>
            <div class="journey-grid">
                <a class="journey-card" href="{{ route('student.pretest') }}"><span class="journey-step">01</span><span class="journey-content"><small>Mulai di sini</small><strong>Pretest</strong><span>Contoh instrumen awal</span></span><span class="journey-state">Lihat <b aria-hidden="true">→</b></span></a>
                <a class="journey-card journey-current" href="{{ route('student.lesson.show', 'keputihan') }}"><span class="journey-step">02</span><span class="journey-content"><small>5 modul edukasi</small><strong>Pelajari Materi</strong><span>Kenali tubuh dan perawatan diri</span></span><span class="journey-state">Buka <b aria-hidden="true">→</b></span></a>
                <a class="journey-card" href="{{ route('student.video') }}"><span class="journey-step">03</span><span class="journey-content"><small>Materi audiovisual</small><strong>Video</strong><span>Panduan edukasi pilihan</span></span><span class="journey-state">Buka <b aria-hidden="true">→</b></span></a>
                <a class="journey-card" href="{{ route('student.posttest') }}"><span class="journey-step">04</span><span class="journey-content"><small>Refleksi belajar</small><strong>Posttest</strong><span>Contoh evaluasi akhir</span></span><span class="journey-state">Lihat <b aria-hidden="true">→</b></span></a>
            </div>
        </section>

        <section class="dashboard-overview-grid">
            <article class="student-card progress-summary">
                <div class="student-section-heading"><div><span class="student-eyebrow">Ringkasan belajar</span><h2>Progres Pembelajaran</h2></div><span class="outline-icon" aria-hidden="true">◉</span></div>
                <div class="empty-progress">
                    <div class="progress-ring" aria-label="Belum ada progres tersimpan"><span>—<small>tersedia</small></span></div>
                    <div><strong>Progres belum tercatat</strong><p>Aktivitas belajar belum terhubung ke penyimpanan. Modul bisa dibuka untuk membaca materi edukasi.</p></div>
                </div>
                <a class="button button-outline" href="{{ route('student.lesson.show', 'keputihan') }}">Jelajahi materi <span aria-hidden="true">→</span></a>
            </article>

            <article class="student-card learning-activity">
                <div class="student-section-heading"><div><span class="student-eyebrow">Aktivitas belajar</span><h2>Jadwalmu</h2></div><span class="outline-icon" aria-hidden="true">▦</span></div>
                <div class="empty-state"><span class="empty-state-icon" aria-hidden="true">✦</span><strong>Belum ada aktivitas tercatat</strong><p>Setelah fitur belajar tersambung, jadwal dan riwayat modul yang telah dibuka akan tampil di sini.</p></div>
            </article>

            <article class="student-card start-card">
                <span class="student-eyebrow">Mulai perjalananmu</span><h2>Belajar dengan nyaman</h2><p>Pilih materi yang ingin kamu baca. Kamu dapat kembali kapan saja dan menghubungi tenaga kesehatan jika perlu bantuan.</p><a class="button button-light" href="{{ route('student.lesson.show', 'keputihan') }}">Lihat materi <span aria-hidden="true">→</span></a>
            </article>
        </section>

        <section class="student-section materials-preview">
            <div class="student-section-heading"><div><span class="student-eyebrow">Belajar mandiri</span><h2>Materi Edukasi</h2></div><a class="student-text-link" href="{{ route('student.lesson.show', 'keputihan') }}">Buka materi <span aria-hidden="true">→</span></a></div>
            <div class="student-module-grid">
                <a class="student-module-card" href="{{ route('student.lesson.show', 'keputihan') }}"><img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=700&q=80" alt="" loading="lazy"><div><span class="module-chip">Modul 1 · Dasar</span><h3>Mengenal Keputihan</h3><p>Pahami variasi tubuh dan kapan perlu bertanya kepada tenaga kesehatan.</p><span class="module-meta">Bacaan edukasi <b aria-hidden="true">→</b></span></div></a>
                <a class="student-module-card" href="{{ route('student.lesson.show', 'jenis-keputihan') }}"><img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=700&q=80" alt="" loading="lazy"><div><span class="module-chip">Modul 2 · Memahami perubahan</span><h3>Jenis &amp; Perubahan</h3><p>Kenali perubahan tubuh tanpa mencoba mendiagnosis diri sendiri.</p><span class="module-meta">Bacaan edukasi <b aria-hidden="true">→</b></span></div></a>
                <a class="student-module-card" href="{{ route('student.lesson.show', 'tanda-gejala') }}"><img src="https://images.unsplash.com/photo-1559757175-0eb30cd8c063?auto=format&fit=crop&w=700&q=80" alt="" loading="lazy"><div><span class="module-chip">Modul 3 · Mengenali gejala</span><h3>Tanda &amp; Gejala</h3><p>Ketahui kapan sebaiknya meminta saran tenaga kesehatan.</p><span class="module-meta">Bacaan edukasi <b aria-hidden="true">→</b></span></div></a>
                <a class="student-module-card" href="{{ route('student.lesson.show', 'pencegahan') }}"><img src="https://images.unsplash.com/photo-1584515933487-779824d29309?auto=format&fit=crop&w=700&q=80" alt="" loading="lazy"><div><span class="module-chip">Modul 4 · Perawatan diri</span><h3>Kebiasaan Sehat</h3><p>Perawatan sederhana yang mendukung kenyamanan sehari-hari.</p><span class="module-meta">Bacaan edukasi <b aria-hidden="true">→</b></span></div></a>
                <a class="student-module-card" href="{{ route('student.lesson.show', 'higienitas') }}"><img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=700&q=80" alt="" loading="lazy"><div><span class="module-chip">Modul 5 · Kebiasaan sehari-hari</span><h3>Higienitas &amp; Menstruasi</h3><p>Rutinitas yang mudah dipahami dan nyaman untuk diikuti.</p><span class="module-meta">Bacaan edukasi <b aria-hidden="true">→</b></span></div></a>
            </div>
        </section>

        <section class="student-help-grid">
            <article class="student-card safe-community"><span class="help-icon" aria-hidden="true">♡</span><div><span class="student-eyebrow">Komunitas belajar</span><h2>Belajar tanpa rasa canggung</h2><p>Materi dibuat sebagai ruang informasi yang ramah. Jika ada pertanyaan kesehatan pribadi, konsultasikan secara privat dengan orang dewasa atau tenaga kesehatan yang kamu percaya.</p><a href="{{ route('privacy') }}">Pelajari privasi dan batasan materi <span aria-hidden="true">→</span></a></div></article>
            <article class="student-card daily-reminder"><span class="student-eyebrow">Catatan penting</span><h2>Tubuhmu, waktumu</h2><ul><li>Setiap tubuh memiliki pola yang berbeda.</li><li>Informasi ini tidak menggantikan pemeriksaan.</li><li>Jangan ragu mencari bantuan profesional.</li></ul></article>
        </section>

        <aside class="student-disclaimer"><span aria-hidden="true">✚</span><div><strong>Butuh bantuan kesehatan?</strong><p>Informasi di halaman ini untuk edukasi umum dan bukan diagnosis. Untuk keluhan atau kekhawatiran, konsultasikan dengan bidan, dokter, atau tenaga kesehatan tepercaya.</p></div><a href="{{ route('privacy') }}">Baca panduan privasi</a></aside>
    </div>
</x-student-layout>
