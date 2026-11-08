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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }} · Flora-V Care</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="student-portal">
        <div class="portal-notice">
            <div class="student-container portal-notice-inner">
                <span>PLATFORM EDUKASI SISWI · INFORMASI INI BUKAN PENGGANTI KONSULTASI KESEHATAN</span>
                <span>Flora-V Care <b>·</b> Kenali, Pahami, Cegah</span>
            </div>
        </div>

        <header class="student-header">
            <div class="student-container student-nav">
                <a class="brand student-brand" href="{{ route('dashboard') }}" aria-label="Flora-V Care, dasbor">
                    <span class="brand-mark" aria-hidden="true">
                        <svg viewBox="0 0 40 40" fill="none">
                            <path d="M20 20C10.8 18.9 8.4 12.2 12.3 8.5c3.2-3 7.3 1.1 7.7 11.5Z" fill="currentColor"/>
                            <path d="M20 20c1.1-9.2 7.8-11.6 11.5-7.7 3 3.2-1.1 7.3-11.5 7.7Z" fill="currentColor" opacity=".72"/>
                            <path d="M20 20c9.2 1.1 11.6 7.8 7.7 11.5-3.2 3-7.3-1.1-7.7-11.5Z" fill="currentColor" opacity=".52"/>
                            <path d="M20 20c-1.1 9.2-7.8 11.6-11.5 7.7-3-3.2 1.1-7.3 11.5-7.7Z" fill="currentColor" opacity=".82"/>
                            <circle cx="20" cy="20" r="3" fill="#FFF5F7"/>
                        </svg>
                    </span>
                    <span class="brand-copy"><strong>Flora-V Care</strong><small>Ruang belajar siswi</small></span>
                </a>

                <nav class="student-desktop-nav" aria-label="Navigasi siswi">
                    <a @class(['current' => $active === 'dashboard']) href="{{ route('dashboard') }}">Dasbor</a>
                    <a @class(['current' => $active === 'pretest']) href="{{ route('student.pretest') }}">Pretest</a>
                    <a @class(['current' => $active === 'lessons']) href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a>
                    <a @class(['current' => $active === 'video']) href="{{ route('student.video') }}">Video</a>
                    <a @class(['current' => $active === 'posttest']) href="{{ route('student.posttest') }}">Posttest</a>
                    <a @class(['current' => $active === 'results']) href="{{ route('student.results') }}">Hasil &amp; sertifikat</a>
                </nav>

                <div class="student-nav-actions">
                    <a class="profile-nav-link" href="{{ route('profile.edit') }}"><span class="student-avatar">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span><span class="profile-nav-name">{{ auth()->user()->name }}</span></a>
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
                        <a href="{{ route('student.results') }}">Hasil &amp; sertifikat</a>
                        <a href="{{ route('profile.edit') }}">Profil saya</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Keluar</button></form>
                    </nav>
                </details>
            </div>
        </header>

        <main class="student-main">
            {{ $slot }}
        </main>

        <footer class="student-footer">
            <div class="student-container student-footer-grid">
                <div>
                    <a class="brand brand-footer" href="{{ route('dashboard') }}"><span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 40 40" fill="none"><path d="M20 20C10.8 18.9 8.4 12.2 12.3 8.5c3.2-3 7.3 1.1 7.7 11.5Z" fill="currentColor"/><path d="M20 20c1.1-9.2 7.8-11.6 11.5-7.7 3 3.2-1.1 7.3-11.5 7.7Z" fill="currentColor" opacity=".72"/><path d="M20 20c9.2 1.1 11.6 7.8 7.7 11.5-3.2 3-7.3-1.1-7.7-11.5Z" fill="currentColor" opacity=".52"/><path d="M20 20c-1.1 9.2-7.8 11.6-11.5 7.7-3-3.2 1.1-7.3 11.5-7.7Z" fill="currentColor" opacity=".82"/></svg></span><span class="brand-copy"><strong>Flora-V Care</strong><small>Kenali, Pahami, Cegah</small></span></a>
                    <p>Ruang belajar kesehatan reproduksi remaja yang ramah, aman, dan berbasis informasi tepercaya.</p>
                </div>
                <div><h2>Navigasi siswi</h2><a href="{{ route('dashboard') }}">Dasbor belajar</a><a href="{{ route('student.pretest') }}">Pretest</a><a href="{{ route('student.lesson.show', 'keputihan') }}">Materi edukasi</a><a href="{{ route('student.video') }}">Video</a><a href="{{ route('student.posttest') }}">Posttest</a></div>
                <div><h2>Privasi &amp; bantuan</h2><a href="{{ route('privacy') }}">Kebijakan privasi</a><a href="{{ route('profile.edit') }}">Pengaturan akun</a><a href="{{ route('home') }}#video">Bantuan kesehatan</a><p>Jika ada keluhan, bicarakan dengan tenaga kesehatan tepercaya.</p></div>
            </div>
            <div class="student-container student-footer-bottom"><span>Materi edukasi, bukan diagnosis medis.</span><span>© 2025 Flora-V Care</span></div>
        </footer>
    </body>
</html>
