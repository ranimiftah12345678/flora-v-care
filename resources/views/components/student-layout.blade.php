@props([
    'active' => 'dashboard',
    'title' => 'Dasbor Siswi',
])

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fff5f7">
        <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
        <meta name="description" content="Ruang belajar siswi Flora-V Care: pretest, materi edukasi, video, dan posttest.">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }} · Flora-V Care</title>
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
    <body class="student-portal">
        <a class="skip-link" href="#main-content">Langsung ke konten</a>
        <div class="portal-notice">
            <div class="student-container portal-notice-inner">
                <span>PLATFORM EDUKASI SISWI · INFORMASI INI BUKAN PENGGANTI KONSULTASI KESEHATAN</span>
                <span>Flora-V Care <b>·</b> Kenali, Pahami, Cegah</span>
            </div>
        </div>

        <header class="student-header">
            <div class="student-container student-nav">
                <a class="brand student-brand" href="{{ route('dashboard') }}" aria-label="Flora-V Care, dasbor">
                    <span class="brand-logos" aria-hidden="true">
                        <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="38" height="38">
                        <span class="brand-logo-divider" aria-hidden="true"></span>
                        <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="38" height="38">
                    </span>
                    <span class="brand-copy"><strong>Flora-V Care</strong><small>Ruang belajar siswi</small></span>
                </a>

                <nav class="student-desktop-nav" aria-label="Navigasi siswi">
                    <a @class(['current' => $active === 'dashboard']) href="{{ route('dashboard') }}">Dasbor</a>
                    <a @class(['current' => $active === 'pretest']) href="{{ route('student.pretest') }}">Pretest</a>
                    <a @class(['current' => $active === 'lessons']) href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a>
                    <a @class(['current' => $active === 'video']) href="{{ route('student.video') }}">Video</a>
                    <a @class(['current' => $active === 'posttest']) href="{{ route('student.posttest') }}">Posttest</a>
                    <a @class(['current' => $active === 'results']) href="{{ route('student.results') }}">Hasil belajar</a>
                </nav>

                <div class="student-nav-actions">
                    <x-theme-toggle />
                    <a class="profile-nav-link" href="{{ route('profile.edit') }}"><span class="student-avatar">@if ($avatar = auth()->user()->avatarUrl())<img src="{{ $avatar }}" alt="Foto profil" class="nav-avatar-photo">@else{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}@endif</span><span class="profile-nav-name">{{ auth()->user()->name }}</span></a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="logout-button" type="submit">Keluar</button>
                    </form>
                </div>

                <details class="mobile-menu student-mobile-menu">
                    <summary aria-label="Buka menu siswi"><span></span><span></span><span></span></summary>
                    <nav aria-label="Navigasi siswi seluler">
                        <a href="{{ route('dashboard') }}">Dasbor</a>
                        <a href="{{ route('student.pretest') }}">Pretest</a>
                        <a href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a>
                        <a href="{{ route('student.video') }}">Video</a>
                        <a href="{{ route('student.posttest') }}">Posttest</a>
                        <a href="{{ route('student.results') }}">Hasil belajar</a>
                        <a href="{{ route('profile.edit') }}">Profil saya</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Keluar</button></form>
                    </nav>
                </details>
            </div>
        </header>

        <main id="main-content" class="student-main">
            {{ $slot }}
        </main>

        <footer class="student-footer">
            <div class="student-container student-footer-grid">
                <div>
                    <a class="brand brand-footer" href="{{ route('dashboard') }}">
                        <span class="brand-logos" aria-hidden="true">
                            <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="32" height="32">
                            <span class="brand-logo-divider" aria-hidden="true"></span>
                            <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="32" height="32">
                        </span>
                        <span class="brand-copy"><strong>Flora-V Care</strong><small>Kenali, Pahami, Cegah</small></span>
                    </a>
                    <p>Ruang belajar kesehatan reproduksi remaja yang ramah, aman, dan berbasis informasi tepercaya.</p>
                </div>
                <div><h2>Navigasi siswi</h2><a href="{{ route('dashboard') }}">Dasbor belajar</a><a href="{{ route('student.pretest') }}">Pretest</a><a href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a><a href="{{ route('student.video') }}">Video</a><a href="{{ route('student.posttest') }}">Posttest</a></div>
                <div><h2>Privasi &amp; bantuan</h2><a href="{{ route('privacy') }}">Kebijakan privasi</a><a href="{{ route('profile.edit') }}">Pengaturan akun</a><a href="{{ route('home') }}#video">Bantuan kesehatan</a><p>Jika ada keluhan, bicarakan dengan tenaga kesehatan tepercaya.</p></div>
            </div>
            <div class="student-container student-footer-bottom"><span>Materi edukasi, bukan diagnosis medis.</span><span>© {{ now()->year }} Flora-V Care</span></div>
        </footer>
    </body>
</html>
