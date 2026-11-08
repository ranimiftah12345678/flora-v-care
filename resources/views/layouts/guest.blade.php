@props(['title' => 'Flora-V Care — Kenali, Pahami, Cegah'])

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fff5f7">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="announcement">
            <div class="container announcement-inner">
                <p>SMK Arga Husada <span aria-hidden="true">·</span> STIKes Karya Husada</p>
                <span class="announcement-links"><a href="{{ route('login') }}">Masuk Siswi</a><span aria-hidden="true">|</span><a href="{{ route('admin.login') }}">Masuk Admin</a></span>
            </div>
        </div>

        <header class="site-header">
            <div class="container nav-wrap">
                <a class="brand" href="{{ route('home') }}" aria-label="Flora-V Care, beranda">
                    <span class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 40 40" fill="none">
                            <path d="M20 20C10.8 18.9 8.4 12.2 12.3 8.5c3.2-3 7.3 1.1 7.7 11.5Z" fill="currentColor"/>
                            <path d="M20 20c1.1-9.2 7.8-11.6 11.5-7.7 3 3.2-1.1 7.3-11.5 7.7Z" fill="currentColor" opacity=".72"/>
                            <path d="M20 20c9.2 1.1 11.6 7.8 7.7 11.5-3.2 3-7.3-1.1-7.7-11.5Z" fill="currentColor" opacity=".52"/>
                            <path d="M20 20c-1.1 9.2-7.8 11.6-11.5 7.7-3-3.2 1.1-7.3 11.5-7.7Z" fill="currentColor" opacity=".82"/>
                            <circle cx="20" cy="20" r="3" fill="#FFF5F7"/>
                        </svg>
                    </span>
                    <span class="brand-copy"><strong>Flora-V Care</strong><small>Edukasi kesehatan remaja</small></span>
                </a>

                <nav class="desktop-nav" aria-label="Navigasi utama">
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('home') }}#tentang">Jenis</a>
                    <a href="{{ route('home') }}#materi">Tanda dan Gejala</a>
                    <a href="{{ route('home') }}#materi">Cara Pencegahan</a>
                    <a href="{{ route('home') }}#video">Video</a>
                </nav>

                <div class="nav-actions">
                    <a class="button button-small" href="{{ route('register') }}">Mulai Belajar <span aria-hidden="true">↗</span></a>
                    <span class="nav-avatar" aria-hidden="true">F</span>
                </div>

                <details class="mobile-menu">
                    <summary aria-label="Buka menu navigasi"><span></span><span></span><span></span></summary>
                    <nav aria-label="Navigasi seluler">
                        <a href="{{ route('home') }}">Beranda</a>
                        <a href="{{ route('home') }}#tentang">Jenis</a>
                        <a href="{{ route('home') }}#materi">Tanda dan Gejala</a>
                        <a href="{{ route('home') }}#materi">Cara Pencegahan</a>
                        <a href="{{ route('home') }}#video">Video</a>
                        <a href="{{ route('privacy') }}">Kebijakan Privasi</a>
                    </nav>
                </details>
            </div>
        </header>

        <main class="guest-main">
            {{ $slot }}
        </main>

        <footer class="site-footer">
            <div class="container footer-grid">
                <div class="footer-about">
                    <a class="brand brand-footer" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 40 40" fill="none"><path d="M20 20C10.8 18.9 8.4 12.2 12.3 8.5c3.2-3 7.3 1.1 7.7 11.5Z" fill="currentColor"/><path d="M20 20c1.1-9.2 7.8-11.6 11.5-7.7 3 3.2-1.1 7.3-11.5 7.7Z" fill="currentColor" opacity=".72"/><path d="M20 20c9.2 1.1 11.6 7.8 7.7 11.5-3.2 3-7.3-1.1-7.7-11.5Z" fill="currentColor" opacity=".52"/><path d="M20 20c-1.1 9.2-7.8 11.6-11.5 7.7-3-3.2 1.1-7.3 11.5-7.7Z" fill="currentColor" opacity=".82"/></svg></span><span class="brand-copy"><strong>Flora-V Care</strong><small>Kenali, Pahami, Cegah</small></span></a>
                    <p>Platform media edukasi kesehatan reproduksi dan higienitas kewanitaan remaja yang ilmiah, tepercaya, ramah, dan berbasis bukti klinis.</p>
                    <strong class="footer-motto">Dikembangkan oleh tim Flora-V Care</strong>
                </div>
                <div><h2>Menu Cepat</h2><a href="{{ route('home') }}">Beranda</a><a href="{{ route('home') }}#tentang">Apa Itu Keputihan</a><a href="{{ route('home') }}#materi">Jenis Keputihan</a><a href="{{ route('home') }}#materi">Tanda &amp; Gejala</a><a href="{{ route('home') }}#materi">Cara Pencegahan</a><a href="{{ route('home') }}#video">Video Edukasi</a></div>
                <div><h2>Portal Siswi</h2><a href="{{ route('login') }}">Dasbor Belajar</a><a href="{{ route('register') }}">Pretest</a><a href="{{ route('login') }}">Posttest</a><a href="{{ route('login') }}">Hasil &amp; Evaluasi</a><a href="{{ route('privacy') }}">Kebijakan Privasi</a></div>
                <div><h2>Informasi &amp; Bantuan</h2><a href="{{ route('home') }}#tentang">SMK Arga Husada</a><a href="{{ route('home') }}#tentang">STIKes Karya Husada</a><a href="{{ route('privacy') }}">Konsultasi Guru Pendamping</a><a href="{{ route('privacy') }}">Pengingat Medis</a></div>
            </div>
            <div class="container footer-bottom"><span>Materi ini bersifat edukasi, bukan diagnosis medis.</span><span>© 2025 Flora-V Care. Hak Cipta Dilindungi.</span></div>
        </footer>
    </body>
</html>
