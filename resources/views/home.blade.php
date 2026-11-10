<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fff5f7">
        <meta name="description" content="Flora-V Care adalah ruang belajar kesehatan reproduksi remaja yang aman, mudah dipahami, dan bebas stigma.">

        <title>Flora-V Care — Kenali. Pahami. Cegah.</title>

        <script>
            (function() {
                var saved = localStorage.getItem('theme');
                if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            })();
        </script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="announcement">
            <div class="container announcement-inner">
                <p>Edukasi kesehatan reproduksi remaja, dengan cara yang nyaman dan tepercaya</p>
                <div class="announcement-links">
                    <span>Flora-V Care · Edukasi Kesehatan Reproduksi</span>
                </div>
            </div>
        </div>

        <header class="site-header" id="top">
            <div class="container nav-wrap">
                <a class="brand" href="#top" aria-label="Flora-V Care, beranda">
                    <span class="brand-logos" aria-hidden="true">
                        <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="38" height="38">
                        <span class="brand-logo-divider" aria-hidden="true"></span>
                        <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="38" height="38">
                    </span>
                    <span class="brand-copy"><strong>Flora-V Care</strong><small>Ruang belajar remaja</small></span>
                </a>

                <nav class="desktop-nav" aria-label="Navigasi utama">
                    <a class="active" href="#top">Beranda</a>
                    <a href="#tentang">Tentang</a>
                    <a href="#alur">Cara Belajar</a>
                    <a href="#materi">Materi</a>
                    <a href="#video">Video</a>
                </nav>

                <div class="nav-actions">
                    <x-theme-toggle />
                    <a class="button button-small" href="{{ route('admin.login') }}">Dasbor Admin <span aria-hidden="true">↗</span></a>
                </div>

                <details class="mobile-menu">
                    <summary aria-label="Buka menu navigasi"><span></span><span></span><span></span></summary>
                    <nav aria-label="Navigasi seluler">
                        <a href="#tentang">Tentang</a>
                        <a href="#alur">Cara Belajar</a>
                        <a href="#materi">Materi</a>
                        <a href="#video">Video</a>
                        <a href="{{ route('login') }}">Mulai Belajar</a>
                        <a href="{{ route('admin.login') }}">Masuk Admin</a>
                    </nav>
                </details>
            </div>
        </header>

        <main>
            <section class="hero section-shell">
                <div class="container hero-grid">
                    <div class="hero-copy">
                        <span class="eyebrow"><span class="eyebrow-dot"></span> Edukasi kesehatan reproduksi</span>
                        <h1>Kenali. Pahami.<br><em>Cegah.</em></h1>
                        <p class="hero-lead">Situs edukasi kesehatan reproduksi remaja untuk mengenali fisiologi tubuh, memahami gejala, dan mencegah keputihan patologis melalui pembiasaan higienitas mandiri yang benar.</p>
                        <div class="hero-actions">
                            <a class="button" href="{{ route('login') }}">Mulai Belajar <span aria-hidden="true">→</span></a>
                            <a class="button button-outline" href="#video"><span class="play-icon" aria-hidden="true">▶</span> Lihat cara belajar</a>
                        </div>
                        <div class="hero-trust">
                            <span><b aria-hidden="true">✓</b> Berbasis riset klinis</span>
                            <span><b aria-hidden="true">✓</b> Bahasa ramah remaja</span>
                            <span><b aria-hidden="true">✓</b> Privasi terjaga</span>
                        </div>
                    </div>

                    <div class="hero-art" aria-label="Remaja belajar bersama dalam suasana yang nyaman">
                        <div class="photo-main">
                            <img src="{{ asset('assets/image 1.jpg') }}" alt="Para remaja berdiskusi dalam suasana belajar yang nyaman">
                        </div>
                        <div class="photo-top">
                            <img src="{{ asset('assets/image 2.jpg') }}" alt="Siswi membaca buku di ruang belajar">
                        </div>
                        <div class="photo-bottom">
                            <img src="{{ asset('assets/image 3.jpg') }}" alt="Teman-teman belajar dan bertukar pikiran">
                        </div>
                        <div class="floating-note">
                            <span class="note-icon" aria-hidden="true">✦</span>
                            <span><strong>Belajar tanpa canggung</strong><small>Ruang aman untuk bertumbuh</small></span>
                        </div>
                        <span class="art-sparkle sparkle-one" aria-hidden="true">✳</span>
                        <span class="art-sparkle sparkle-two" aria-hidden="true">✦</span>
                    </div>
                </div>

                <div class="container">
                    <div class="feature-ribbon">
                        <div class="ribbon-item"><span class="ribbon-icon" aria-hidden="true">♡</span><span><strong>Kenali</strong><small>Anatomi &amp; fungsi tubuh</small></span></div>
                        <div class="ribbon-item"><span class="ribbon-icon" aria-hidden="true">⌕</span><span><strong>Pahami</strong><small>Perubahan yang terjadi</small></span></div>
                        <div class="ribbon-item"><span class="ribbon-icon" aria-hidden="true">✿</span><span><strong>Cegah</strong><small>Rawat diri dengan tepat</small></span></div>
                        <div class="ribbon-item"><span class="ribbon-icon" aria-hidden="true">▣</span><span><strong>Pre &amp; Posttest</strong><small>Ukur pemahamanmu</small></span></div>
                        <div class="ribbon-item"><span class="ribbon-icon" aria-hidden="true">♧</span><span><strong>Aman &amp; Privat</strong><small>Belajar tanpa stigma</small></span></div>
                    </div>
                </div>
            </section>

            <section class="section about-section" id="tentang">
                <div class="container">
                    <div class="section-heading centered">
                        <span class="section-kicker">Filosofi platform</span>
                        <h2>Apa Itu Flora-V Care?</h2>
                        <p>Pendekatan edukatif berbasis nilai ilmiah untuk melatih kebiasaan merawat kesehatan organ reproduksi dengan cara percaya diri, tanpa rasa cemas dan tabu.</p>
                    </div>

                    <div class="about-grid">
                        <div class="about-panel">
                            <div class="value-cards">
                                <article class="value-card">
                                    <span class="mini-icon" aria-hidden="true">❀</span>
                                    <h3>Flora</h3>
                                    <p>Keseimbangan mikroorganisme baik alami di area kewanitaan yang menjaga lingkungan tetap optimal.</p>
                                </article>
                                <article class="value-card">
                                    <span class="mini-icon" aria-hidden="true">♡</span>
                                    <h3>V</h3>
                                    <p>Area organ reproduksi wanita yang perlu dirawat dengan pengetahuan praktis dan kebiasaan sehat.</p>
                                </article>
                                <article class="value-card">
                                    <span class="mini-icon" aria-hidden="true">✧</span>
                                    <h3>Care</h3>
                                    <p>Kepedulian, kebiasaan bersih, serta tindakan preventif aktif sejak awal untuk tubuh dan kesehatanmu.</p>
                                </article>
                            </div>
                            <div class="about-note">
                                <span class="note-round" aria-hidden="true">✦</span>
                                <p><strong>Dikembangkan melalui riset akademik</strong><br>Disusun secara komprehensif oleh tim Flora-V Care (STIKes Karya Husada) dengan tinjauan klinis untuk siswi SMK Arga Husada.</p>
                            </div>
                        </div>

                        <div class="impact-cards">
                            <article class="impact-card impact-primary">
                                <div><span class="section-kicker">Instrumen evaluasi</span><h3>Pengetahuan Kuesioner</h3><p>Uji validitas dan reliabilitas untuk mengukur tingkat pengetahuan siswi.</p></div>
                                <strong class="impact-number">30<small>Butir Soal</small></strong>
                            </article>
                            <article class="impact-card">
                                <div><span class="section-kicker">Langkah pencegahan</span><h3>Pilar Pencegahan Praktis</h3><p>Praktik menjaga kebersihan dan kesehatan organ kewanitaan.</p></div>
                                <strong class="impact-number">6<small>Langkah</small></strong>
                            </article>
                            <article class="impact-card">
                                <div><span class="section-kicker">Sasaran satuan edukasi</span><h3>Jenjang Tingkat Kelas</h3><p>Menjangkau siswi kelas X, XI, dan XII SMK Arga Husada.</p></div>
                                <strong class="impact-number">3<small>Tingkatan</small></strong>
                            </article>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section pathway-section" id="alur">
                <div class="container">
                    <div class="section-heading pathway-heading">
                        <span class="section-kicker">Metodologi interaktif</span>
                        <h2>Alur Pembelajaran Mandiri</h2>
                    </div>

                    <div class="pathway-grid">
                        <article class="path-card">
                            <div class="path-top"><span class="step-number">01</span><span class="path-icon" aria-hidden="true">▣</span></div>
                            <h3>Pretest</h3><p>Uji pemahaman dasar awal dengan berbagai pertanyaan sebelum memulai materi.</p><span class="path-link">30 Pertanyaan <b aria-hidden="true">→</b></span>
                        </article>
                        <article class="path-card">
                            <div class="path-top"><span class="step-number">02</span><span class="path-icon" aria-hidden="true">◫</span></div>
                            <h3>Materi</h3><p>Pelajari modul terstruktur seputar jenis, tanda, dan mekanisme keputihan.</p><span class="path-link">5 Modul Terarah <b aria-hidden="true">→</b></span>
                        </article>
                        <article class="path-card" id="video">
                            <div class="path-top"><span class="step-number">03</span><span class="path-icon" aria-hidden="true">▻</span></div>
                            <h3>Video</h3><p>Tonton tutorial visual cara membersihkan area kewanitaan dengan benar.</p><span class="path-link">Video Demonstrasi <b aria-hidden="true">→</b></span>
                        </article>
                        <article class="path-card">
                            <div class="path-top"><span class="step-number">04</span><span class="path-icon" aria-hidden="true">▣</span></div>
                            <h3>Posttest</h3><p>Evaluasi pemahaman setelah menyelesaikan seluruh materi pembelajaran.</p><span class="path-link">Tes Akhir <b aria-hidden="true">→</b></span>
                        </article>
                        <article class="path-card">
                            <div class="path-top"><span class="step-number step-gold">05</span><span class="path-icon path-gold" aria-hidden="true">⌁</span></div>
                            <h3>Hasil</h3><p>Lihat profil perkembangan nilai dan rekomendasi personal kesehatanmu.</p><span class="path-link">Grafik Evaluasi <b aria-hidden="true">→</b></span>
                        </article>
                    </div>

                    <p class="pathway-lead">Selesaikan setiap tahapan secara berurutan untuk memaksimalkan retensi materi dan memahami indikasi gangguan kesehatan reproduksi.</p>
                </div>
            </section>

            <section class="section materials-section" id="materi">
                <div class="container">
                    <div class="section-heading heading-row">
                        <div><span class="section-kicker">Syllabus pembelajaran</span><h2>Materi Edukasi Komprehensif</h2></div>
                        <a class="text-link" href="{{ route('register') }}">Lihat Semua Silabus <span aria-hidden="true">→</span></a>
                    </div>

                    <div class="materials-grid">
                        <article class="material-card material-feature">
                            <a href="{{ route('register') }}" class="material-image">
                                <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=85" alt="Ilustrasi pelayanan kesehatan dan edukasi">
                                <span class="image-label">Selesaikan Modul 1 Flora-V Care</span>
                            </a>
                            <div class="material-copy"><span class="module-label">Modul 01 · Dasar</span><h3>Apa Itu Keputihan?</h3><p>Membedakan cairan fisiologis alami sebagai sistem pembersih tubuh yang normal dengan keputihan patologis.</p><div class="material-meta"><span>5 Menit Baca</span><a href="{{ route('register') }}">Pelajari <b aria-hidden="true">→</b></a></div></div>
                        </article>
                        <article class="material-card">
                            <a href="{{ route('register') }}" class="material-image">
                                <img src="https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=900&q=85" alt="Peralatan laboratorium untuk mengenali jenis mikroorganisme">
                                <span class="image-label">Modul 02 · Klasifikasi</span>
                            </a>
                            <div class="material-copy"><h3>Jenis &amp; Klasifikasi</h3><p>Mengenal perbedaan karakteristik keputihan karena bakteri (Vaginosis), jamur (Candida), maupun parasit.</p><div class="material-meta"><span>8 Menit Baca</span><a href="{{ route('register') }}">Pelajari <b aria-hidden="true">→</b></a></div></div>
                        </article>
                        <article class="material-card">
                            <a href="{{ route('register') }}" class="material-image">
                                <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=900&q=85" alt="Seseorang membaca materi kesehatan di ruang yang terang">
                                <span class="image-label">Modul 03 · Faktor Risiko</span>
                            </a>
                            <div class="material-copy"><h3>Penyebab &amp; Pemicu</h3><p>Kenali faktor seperti perubahan hormon, stres, kelembapan, dan penggunaan sabun antiseptik berlebih.</p><div class="material-meta"><span>6 Menit Baca</span><a href="{{ route('register') }}">Pelajari <b aria-hidden="true">→</b></a></div></div>
                        </article>
                        <article class="material-card material-wide">
                            <a href="{{ route('register') }}" class="material-image">
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=85" alt="Materi pembelajaran kesehatan dibuka di tablet">
                                <span class="image-label">Modul 04 · Observasi Mandiri</span>
                            </a>
                            <div class="material-copy"><h3>Tanda &amp; Gejala Klinis</h3><p>Perhatikan perubahan warna dan aroma, serta gejala seperti gatal, rasa perih, atau nyeri.</p><div class="symptom-tags"><span>Warna Cairan</span><span>Aroma Khas</span><span>Rasa Gatal</span></div><div class="material-meta"><span>7 Menit Baca</span><a href="{{ route('register') }}">Buka Modul Gejala <b aria-hidden="true">→</b></a></div></div>
                        </article>
                        <article class="material-card material-cta">
                            <span class="module-label">Modul 05 · Solusi Utama</span><h3>6 Cara Pencegahan Efektif</h3><p>Praktik kebersihan vulva harian: teknik membasuh dari depan ke belakang, mengganti pembalut teratur, pemilihan pakaian dalam tepat.</p><div class="prevention-list"><span>Air bersih</span><span>Bahan katun</span><span>Ganti teratur</span></div><a class="button button-light" href="{{ route('register') }}">Baca 6 Langkah <span aria-hidden="true">→</span></a>
                        </article>
                    </div>
                </div>
            </section>

            <section class="section proof-section" aria-label="Keunggulan Flora-V Care">
                <div class="container">
                    <div class="proof-bar">
                        <div><strong>100%</strong><span>Edukasi Ilmiah</span><small>Sesuai pedoman medis Indonesia</small></div>
                        <div><strong>30</strong><span>Soal Kuesioner Valid</span><small>Uji reliabilitas terstandar</small></div>
                        <div><strong>5</strong><span>Modul Terpadu</span><small>Mencakup topik praktis mandiri</small></div>
                        <div><strong>6</strong><span>Langkah Higienis</span><small>Praktik sehari-hari berkesadaran</small></div>
                    </div>
                </div>
            </section>

            <section class="section cta-section" id="mulai">
                <div class="container">
                    <div class="cta-card">
                        <div class="cta-copy">
                            <span class="eyebrow eyebrow-white"><span class="eyebrow-dot"></span> Siap untuk bertumbuh?</span>
                            <h2>Mulai Perjalanan<br>Belajarmu Sekarang</h2>
                            <p>Ambil langkah awal dengan mengerjakan pretest untuk mengetahui wawasan awalmu, ikuti seluruh materi terstruktur, dan rasakan peningkatan pemahaman yang terukur.</p>
                            <div class="hero-actions">
                                <a class="button button-white" href="{{ route('login') }}">Mulai Belajar Siswi <span aria-hidden="true">→</span></a>
                                <a class="button button-ghost" href="{{ route('register') }}">Daftar Baru <span aria-hidden="true">↗</span></a>
                            </div>
                            <div class="privacy-note"><span aria-hidden="true">ⓘ</span><p><strong>Catatan Medis:</strong> Seluruh materi di Flora-V Care bersifat edukatif (promotif dan preventif), bukan diagnosis klinis. Jika kamu mengalami keluhan yang menetap atau mengkhawatirkan, segera konsultasikan dengan bidan, dokter, atau tenaga kesehatan profesional.</p></div>
                        </div>
                        <div class="cta-decoration" aria-hidden="true">
                            <img class="cta-image" src="{{ asset('assets/image 4.jpg') }}" alt="Mulai Belajar Flora-V Care">
                            <div class="cta-gradient-overlay"></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer">
            <div class="container footer-grid">
                <div class="footer-about">
                    <a class="brand brand-footer" href="#top">
                        <span class="brand-logos" aria-hidden="true">
                            <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="32" height="32">
                            <span class="brand-logo-divider" aria-hidden="true"></span>
                            <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="32" height="32">
                        </span>
                        <span class="brand-copy"><strong>Flora-V Care</strong><small>Kenali, Pahami, Cegah</small></span>
                    </a>
                    <p>Platform media edukasi kesehatan reproduksi dan higienitas kewanitaan remaja yang ilmiah, terpercaya, aman, dan bebas stigma.</p>
                    <strong class="footer-motto">Dikembangkan oleh tim Flora-V Care</strong>
                </div>
                <div><h2>Menu Cepat</h2><a href="#top">Beranda</a><a href="#tentang">Apa Itu Keputihan</a><a href="#materi">Jenis Keputihan</a><a href="#materi">Tanda &amp; Gejala</a><a href="#materi">Cara Pencegahan</a><a href="#video">Video Edukasi</a></div>
                <div><h2>Portal Edukasi</h2><a href="{{ route('login') }}">Masuk Siswi</a><a href="{{ route('admin.login') }}">Masuk Admin</a><a href="{{ route('register') }}">Daftar Baru</a><a href="{{ route('privacy') }}">Kebijakan Privasi</a></div>
                <div><h2>Informasi &amp; Bantuan</h2><a href="#tentang">SMK Arga Husada</a><a href="#tentang">STIKes Karya Husada</a><a href="#tentang">Konsultasi dan Pengaduan</a><a href="#tentang">Ketentuan Pengguna</a></div>
            </div>
            <div class="container footer-bottom"><span>© 2025 Flora-V Care. Hak Cipta Dilindungi.</span><span>Materi ini bersifat edukasi, bukan diagnosis medis.</span></div>
        </footer>
    </body>
</html>
