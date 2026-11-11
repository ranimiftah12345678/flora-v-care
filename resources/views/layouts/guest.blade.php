@props(['title' => 'Flora-V Care — Kenali, Pahami, Cegah'])

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fff5f7">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <meta name="description" content="Masuk atau daftar untuk memulai belajar di Flora-V Care, ruang belajar kesehatan reproduksi remaja.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }}</title>
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
        <a class="skip-link" href="#main-content">Langsung ke konten</a>
            <div class="announcement">
                <div class="container announcement-inner">
                    <p>🌸 Media Edukasi Kesehatan Reproduksi Remaja Putri — Bebas Stigma, Ilmiah &amp; Tepercaya</p>
                    <span class="announcement-links"><a href="{{ route('home') }}">Beranda Publik</a><span aria-hidden="true">|</span><a href="{{ route('admin.login') }}">Masuk Admin</a></span>
                </div>
            </div>

            <header class="site-header">
                <div class="container nav-wrap">
                    <a class="brand" href="{{ route('home') }}" aria-label="Flora-V Care, beranda">
                        <span class="brand-logos" aria-hidden="true">
                            <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="36" height="36">
                            <span class="brand-logo-divider" aria-hidden="true"></span>
                            <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="36" height="36">
                        </span>
                        <span class="brand-copy"><strong>Flora-V Care</strong><small>Kenali · Pahami · Cegah</small></span>
                    </a>

                    <nav class="desktop-nav" aria-label="Navigasi utama">
                        <a href="{{ route('home') }}">Beranda</a>
                        <a href="{{ route('public.jenis') }}">Jenis</a>
                        <a href="{{ route('public.tanda-gejala') }}">Tanda Gejala</a>
                        <a href="{{ route('public.cara-pencegahan') }}">Cara Pencegahan</a>
                        <a href="{{ route('public.video') }}">Video</a>
                    </nav>

                    <div class="nav-actions">
                        <x-theme-toggle />
                        <a class="button button-small button-outline" href="{{ route('admin.login') }}">Portal Admin <span aria-hidden="true">↗</span></a>
                    </div>

                    <details class="mobile-menu">
                        <summary aria-label="Buka menu navigasi"><span></span><span></span><span></span></summary>
                        <nav aria-label="Navigasi seluler">
                            <a href="{{ route('home') }}">Beranda</a>
                            <a href="{{ route('public.jenis') }}">Jenis</a>
                            <a href="{{ route('public.tanda-gejala') }}">Tanda Gejala</a>
                            <a href="{{ route('public.cara-pencegahan') }}">Cara Pencegahan</a>
                            <a href="{{ route('public.video') }}">Video</a>
                            <hr style="margin: 8px 0; border: 0; border-top: 1px solid var(--border);">
                            <a href="{{ route('admin.login') }}">Masuk Admin</a>
                        </nav>
                    </details>
                </div>
            </header>

        <main id="main-content" class="guest-main">
            {{ $slot }}
        </main>

        <footer class="site-footer">
            <div class="container footer-grid">
                <div class="footer-about">
                    <a class="brand brand-footer" href="{{ route('home') }}">
                        <span class="brand-logos" aria-hidden="true">
                            <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="32" height="32">
                            <span class="brand-logo-divider" aria-hidden="true"></span>
                            <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="32" height="32">
                        </span>
                        <span class="brand-copy"><strong>Flora-V Care</strong><small>Kenali, Pahami, Cegah</small></span>
                    </a>
                    <p>Platform media edukasi kesehatan reproduksi dan higienitas kewanitaan remaja yang ilmiah, tepercaya, ramah, dan berbasis bukti klinis.</p>
                    <strong class="footer-motto">Flora-V Care · Kenali, Pahami, Cegah</strong>
                </div>
                <div><h2>Menu Edukasi</h2><a href="{{ route('home') }}">Beranda</a><a href="{{ route('public.jenis') }}">Jenis Keputihan</a><a href="{{ route('public.tanda-gejala') }}">Tanda &amp; Gejala</a><a href="{{ route('public.cara-pencegahan') }}">Cara Pencegahan</a><a href="{{ route('public.video') }}">Video Edukasi</a></div>
                <div><h2>Pengelola</h2><a href="{{ route('admin.login') }}">Masuk Admin</a><a href="{{ route('privacy') }}">Kebijakan Privasi</a></div>
                <div><h2>Institusi</h2><p style="color: rgba(255,255,255,0.7); font-size: 13px; line-height: 1.6;">SMK Arga Husada &amp;<br>STIKes Karya Husada Kediri</p></div>
            </div>
            <div class="container footer-bottom"><span>Materi ini bersifat edukasi, bukan diagnosis medis.</span><span>© {{ now()->year }} Flora-V Care. Hak Cipta Dilindungi.</span></div>
        </footer>
    </body>
</html>
