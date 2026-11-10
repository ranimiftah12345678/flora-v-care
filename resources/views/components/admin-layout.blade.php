@props([
    'active' => 'dashboard',
    'title' => 'Dasbor Admin',
])

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fff5f7">
        <meta name="description" content="Antarmuka administrasi Flora-V Care.">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <title>{{ $title }} · Flora-V Care Admin</title>
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
    <body class="admin-portal">
        <a class="skip-link" href="#main-content">Langsung ke konten</a>
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                <span class="admin-brand-logos" aria-hidden="true">
                    <img class="admin-brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="32" height="32">
                    <span class="admin-brand-logo-divider" aria-hidden="true"></span>
                    <img class="admin-brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="32" height="32">
                </span>
                <span><strong>Flora-V Care</strong><small>ADMIN PORTAL</small></span>
            </a>
            <span class="admin-nav-caption">EDUKASI &amp; TATA KELOLA</span>
            <nav class="admin-nav" aria-label="Navigasi admin">
                <a @class(['active' => $active === 'dashboard']) href="{{ route('admin.dashboard') }}"><span aria-hidden="true">▦</span> Dasbor</a>
                <a @class(['active' => $active === 'students']) href="{{ route('admin.students') }}"><span aria-hidden="true">♧</span> Siswi</a>
                <a @class(['active' => $active === 'materials']) href="{{ route('admin.materials') }}"><span aria-hidden="true">▤</span> Materi</a>
                <a @class(['active' => $active === 'videos']) href="{{ route('admin.videos') }}"><span aria-hidden="true">▷</span> Video</a>
                <a @class(['active' => $active === 'questions']) href="{{ route('admin.questions') }}"><span aria-hidden="true">☷</span> Pertanyaan Kuesioner</a>
                <a @class(['active' => $active === 'tests']) href="{{ route('admin.tests') }}"><span aria-hidden="true">☷</span> Pengaturan Tes</a>
                <a @class(['active' => $active === 'results']) href="{{ route('admin.paired-results') }}"><span aria-hidden="true">▣</span> Hasil Tes</a>
                <a @class(['active' => $active === 'activity']) href="{{ route('admin.activity') }}"><span aria-hidden="true">◴</span> Aktivitas</a>
                <a @class(['active' => $active === 'reports']) href="{{ route('admin.reports') }}"><span aria-hidden="true">▧</span> Laporan</a>
                <a @class(['active' => $active === 'settings']) href="{{ route('admin.settings') }}"><span aria-hidden="true">⚙</span> Pengaturan Situs</a>
            </nav>
            <div class="admin-sidebar-note"><span aria-hidden="true">◇</span><div><strong>SMK Arga Husada</strong><small>Karya Husada Partner</small></div></div>
        </aside>

        <div class="admin-workspace">
            <header class="admin-topbar">
                <a class="admin-mobile-brand" href="{{ route('admin.dashboard') }}">Flora-V Care <small>Admin</small></a>
                <details class="admin-mobile-menu">
                    <summary aria-label="Buka navigasi admin"><span>☰</span></summary>
                    <nav aria-label="Navigasi admin seluler">
                        <a href="{{ route('admin.dashboard') }}">Dasbor</a><a href="{{ route('admin.students') }}">Siswi</a><a href="{{ route('admin.materials') }}">Materi</a><a href="{{ route('admin.videos') }}">Video</a><a href="{{ route('admin.questions') }}">Pertanyaan</a><a href="{{ route('admin.tests') }}">Pengaturan tes</a><a href="{{ route('admin.paired-results') }}">Hasil tes</a><a href="{{ route('admin.activity') }}">Aktivitas</a><a href="{{ route('admin.reports') }}">Laporan</a><a href="{{ route('admin.settings') }}">Pengaturan situs</a><a href="{{ route('admin.profile') }}">Profil admin</a>
                    </nav>
                </details>
                <span class="admin-search-placeholder">⌕ <span>Cari siswi, materi, skor kuesioner…</span></span>
                <span class="admin-date">◷ <span>{{ now()->timezone('Asia/Jakarta')->translatedFormat('l, j F Y') }} · WIB</span></span>
                <span class="admin-notification" aria-label="Notifikasi">♧</span>
                <x-theme-toggle />
                <a class="admin-user" href="{{ route('admin.profile') }}">                <span class="admin-user-avatar">@if ($avatar = auth()->user()->avatarUrl())<img src="{{ $avatar }}" alt="Foto profil" class="nav-avatar-photo admin-nav-avatar-photo">@else{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}@endif</span><span>{{ auth()->user()->name }}<small>Administrator</small></span></a>
            </header>

            <main id="main-content" class="admin-main">
                <div class="admin-preview-banner" role="status">
                    <strong>PANEL ADMIN</strong>
                    <span>Perubahan akun dan konten tersimpan. Hasil dan aktivitas ditampilkan dari data yang telah dikirim atau dicatat.</span>
                    <a href="{{ route('privacy') }}">Kebijakan privasi</a>
                </div>
                {{ $slot }}
            </main>

            <footer class="admin-footer">
                <span>© {{ now()->year }} Flora-V Care · Kenali, Pahami, Cegah</span>
                <a href="{{ route('home') }}">Kembali ke beranda publik ↗</a>
            </footer>
        </div>
    </body>
</html>
