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
                <a @class(['active' => $active === 'activity']) href="{{ route('admin.activity') }}"><span aria-hidden="true">◴</span> Aktivitas</a>
                <a @class(['active' => $active === 'content']) href="{{ route('admin.content') }}"><span aria-hidden="true">✎</span> Kelola Konten</a>
            </nav>
            <div class="admin-sidebar-note"><span aria-hidden="true">◇</span><div><strong>SMK Arga Husada</strong><small>Karya Husada Partner</small></div></div>
        </aside>

        <div class="admin-workspace">
            <header class="admin-topbar">
                <span class="admin-search-placeholder">⌕ <span>Cari siswi, materi, skor kuesioner…</span></span>
                <span class="admin-date">◷ <span>{{ now()->timezone('Asia/Jakarta')->translatedFormat('l, j F Y') }} · WIB</span></span>
                <span class="admin-notification" aria-label="Notifikasi">♧</span>
                <x-theme-toggle />
                <a class="admin-user" href="{{ route('admin.profile') }}" title="Kelola Profil & Keamanan">
                    <span class="admin-user-avatar">
                        @if ($avatar = auth()->user()->avatarUrl())
                            <img src="{{ $avatar }}" alt="Foto profil {{ auth()->user()->name }}" class="nav-avatar-photo admin-nav-avatar-photo" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%; border-radius: 50%;">
                        @else
                            {{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}
                        @endif
                    </span>
                    <span class="admin-user-info">
                        <span class="admin-user-name">{{ auth()->user()->name }}</span>
                        <span class="admin-user-role">Administrator</span>
                    </span>
                </a>
                <form method="POST" action="{{ route('logout') }}" style="margin: 0; display: inline-flex;">
                    @csrf
                    <button type="submit" class="admin-button admin-button-outline" title="Keluar dari akun admin" style="min-height: 34px; padding: 0 12px; font-size: 12px; border-radius: 8px;">
                        Keluar ⎋
                    </button>
                </form>
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
