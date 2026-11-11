<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fff5f7">
        <meta name="description" content="Flora-V Care — Media edukasi kesehatan reproduksi remaja putri dan pencegahan keputihan. Kenali, Pahami, Cegah.">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Flora-V Care' }} — Kenali, Pahami, Cegah</title>

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
    <body class="public-portal">
        <!-- Top Banner -->
        <div class="announcement">
            <div class="container announcement-inner">
                <p>✚ STIKES KARYA HUSADA KEDIRI</p>
                <div class="announcement-links">
                    <span style="color: #ffdce5; font-weight: 500;">Pendidikan Kesehatan Reproduksi Remaja</span>
                </div>
            </div>
        </div>

        <!-- Header & Navigasi Publik (Pill Navigation Style) -->
        <header class="site-header" id="top" style="border-bottom: 1px solid rgba(119,28,51,.06);">
            <div class="container nav-wrap" style="height: 76px;">
                <a class="brand" href="{{ route('home') }}" aria-label="Flora-V Care, beranda">
                    <span class="brand-logos" aria-hidden="true">
                        <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="36" height="36">
                        <span class="brand-logo-divider" aria-hidden="true"></span>
                        <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="36" height="36">
                    </span>
                    <span class="brand-copy">
                        <strong style="font-size: 14px; font-family: inherit; color: var(--wine);">kenali • pahami • cegah</strong>
                        <small style="font-size: 10.5px; text-transform: none; letter-spacing: 0; font-style: italic;">Flora-V Care</small>
                    </span>
                </a>

                <!-- Center Pill Navigation Container -->
                <nav class="desktop-nav" aria-label="Navigasi utama" style="background: var(--surface); border: 1px solid var(--border); padding: 4px 6px; border-radius: 99px; gap: 4px; box-shadow: 0 4px 16px rgba(119,28,51,0.04);">
                    <a @class(['pill-nav-link', 'active' => ($active ?? '') === 'home']) href="{{ route('home') }}">Beranda</a>
                    <a @class(['pill-nav-link', 'active' => ($active ?? '') === 'jenis']) href="{{ route('public.jenis') }}">Jenis</a>
                    <a @class(['active' => ($active ?? '') === 'tanda-gejala', 'pill-nav-link']) href="{{ route('public.tanda-gejala') }}">Tanda Gejala</a>
                    <a @class(['pill-nav-link', 'active' => ($active ?? '') === 'cara-pencegahan']) href="{{ route('public.cara-pencegahan') }}">Cara Pencegahan</a>
                    <a @class(['pill-nav-link', 'active' => ($active ?? '') === 'video']) href="{{ route('public.video') }}">Video</a>
                </nav>

                <div class="nav-actions" style="gap: 10px; display: flex; align-items: center;">
                    <x-theme-toggle />
                    @if (auth()->check() && auth()->user()->role === 'admin')
                        <a class="button button-small" href="{{ route('admin.dashboard') }}" title="Ke Dasbor Admin" style="background: #6b0f2b; border-color: #6b0f2b; border-radius: 99px; padding: 0 16px; min-height: 36px; font-size: 12px;">
                            <span aria-hidden="true">▦</span> Dasbor Admin
                        </a>
                    @else
                        <a class="button button-small" href="{{ route('admin.login') }}" title="Masuk Pengelola" style="background: #6b0f2b; border-color: #6b0f2b; border-radius: 99px; padding: 0 16px; min-height: 36px; font-size: 12px;">
                            <span aria-hidden="true">🔒</span> Portal Admin
                        </a>
                    @endif
                </div>

                <details class="mobile-menu">
                    <summary aria-label="Buka menu navigasi"><span></span><span></span><span></span></summary>
                    <nav aria-label="Navigasi seluler">
                        <a @class(['active' => ($active ?? '') === 'home']) href="{{ route('home') }}">Beranda</a>
                        <a @class(['active' => ($active ?? '') === 'jenis']) href="{{ route('public.jenis') }}">Jenis</a>
                        <a @class(['active' => ($active ?? '') === 'tanda-gejala']) href="{{ route('public.tanda-gejala') }}">Tanda Gejala</a>
                        <a @class(['active' => ($active ?? '') === 'cara-pencegahan']) href="{{ route('public.cara-pencegahan') }}">Cara Pencegahan</a>
                        <a @class(['active' => ($active ?? '') === 'video']) href="{{ route('public.video') }}">Video</a>
                        <hr style="margin: 8px 0; border: 0; border-top: 1px solid var(--border);">
                        @if (auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}">Dasbor Admin</a>
                        @else
                            <a href="{{ route('admin.login') }}">Masuk Admin</a>
                        @endif
                    </nav>
                </details>
            </div>
        </header>

        <main id="main-content">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="site-footer">
            <div class="container footer-grid">
                <div class="footer-about">
                    <a class="brand brand-footer" href="{{ route('home') }}">
                        <span class="brand-logos" aria-hidden="true">
                            <img class="brand-logo-img brand-logo-flora" src="{{ asset('assets/logo-flora-v-care.png') }}" alt="Logo Flora-V Care" width="32" height="32">
                            <span class="brand-logo-divider" aria-hidden="true"></span>
                            <img class="brand-logo-img brand-logo-stikes" src="{{ asset('assets/logo-stikes-karya-husada.png') }}" alt="Logo STIKes Karya Husada" width="32" height="32">
                        </span>
                        <span class="brand-copy">
                            <strong>Flora-V Care</strong>
                            <small>Kenali, Pahami, Cegah</small>
                        </span>
                    </a>
                    <p>Platform media edukasi kesehatan reproduksi dan higienitas kewanitaan remaja yang ilmiah, terpercaya, aman, dan bebas stigma.</p>
                    <strong class="footer-motto">Disusun oleh: Nur Elis Safi'Una · STIKes Karya Husada Kediri</strong>
                </div>
                <div>
                    <h2>Menu Edukasi</h2>
                    <a href="{{ route('home') }}">Beranda</a>
                    <a href="{{ route('public.jenis') }}">Jenis Keputihan</a>
                    <a href="{{ route('public.tanda-gejala') }}">Tanda &amp; Gejala</a>
                    <a href="{{ route('public.cara-pencegahan') }}">Cara Pencegahan</a>
                    <a href="{{ route('public.video') }}">Video Edukasi</a>
                </div>
                <div>
                    <h2>Mitra &amp; Sasaran</h2>
                    <a href="{{ route('home') }}#filosofi">SMK Arga Husada</a>
                    <a href="{{ route('home') }}#filosofi">STIKes Karya Husada</a>
                    <a href="{{ route('privacy') }}">Kebijakan Privasi</a>
                    <a href="{{ route('admin.login') }}">Portal Administrator</a>
                </div>
                <div>
                    <h2>Tentang Flora-V Care</h2>
                    <p style="font-size: 13px; line-height: 1.6; color: rgba(255, 255, 255, 0.85);">
                        Fokus pada peningkatan pemahaman dan perawatan vulva hygiene mandiri bagi remaja putri untuk mencegah keputihan patologis sejak dini.
                    </p>
                </div>
            </div>
            <div class="container footer-bottom">
                <span>© {{ now()->year }} Flora-V Care · Nur Elis Safi'Una. Hak Cipta Dilindungi.</span>
                <span>Informasi ini bersifat edukasi kesehatan, bukan diagnosis medis klinis.</span>
            </div>
        </footer>

        <!-- Modal Sambutan & Identifikasi Pengunjung (Username & Email) -->
        <div id="visitor-modal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0, 0, 0, 0.45); backdrop-filter: blur(4px); align-items: center; justify-content: center; padding: 20px;">
            <div style="background: var(--surface); max-width: 440px; width: 100%; border-radius: 20px; padding: 28px 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); border: 1px solid var(--border); position: relative; animation: modalPop 0.25s ease-out;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: #fff0f4; color: var(--wine); display: grid; place-items: center; font-size: 26px; margin: 0 auto 12px; box-shadow: 0 4px 12px rgba(162, 14, 73, 0.15);">
                        🌸
                    </div>
                    <h3 style="font-family: 'Playfair Display', Georgia, serif; font-size: 20px; color: var(--heading); margin: 0 0 6px;">
                        Selamat Datang di Flora-V Care
                    </h3>
                    <p style="font-size: 13px; line-height: 1.5; color: var(--text-muted); margin: 0;">
                        Masukkan nama/username dan email Anda agar kunjungan edukasi Anda tercatat di portal pengelola.
                    </p>
                </div>

                <form id="visitor-identify-form" onsubmit="submitVisitorIdentity(event)">
                    <div style="margin-bottom: 14px; text-align: left;">
                        <label for="v-name" style="display: block; font-size: 12px; font-weight: 600; color: var(--heading); margin-bottom: 6px;">
                            Nama Lengkap / Username <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="text" id="v-name" required placeholder="Contoh: Rina Aulia" style="width: 100%; height: 42px; border-radius: 10px; border: 1px solid var(--border); padding: 0 14px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                    </div>

                    <div style="margin-bottom: 20px; text-align: left;">
                        <label for="v-email" style="display: block; font-size: 12px; font-weight: 600; color: var(--heading); margin-bottom: 6px;">
                            Alamat Email <span style="color: var(--primary);">*</span>
                        </label>
                        <input type="email" id="v-email" required placeholder="Contoh: rina@gmail.com" style="width: 100%; height: 42px; border-radius: 10px; border: 1px solid var(--border); padding: 0 14px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="button" style="flex: 1; justify-content: center; min-height: 42px;">
                            Mulai Belajar ↗
                        </button>
                        <button type="button" onclick="closeVisitorModal(true)" class="button button-outline" style="min-height: 42px;">
                            Nanti
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            (function() {
                var vName = localStorage.getItem('flora_v_name');
                var vEmail = localStorage.getItem('flora_v_email');
                var dismissed = sessionStorage.getItem('flora_v_modal_dismissed');

                // Jika sudah ada identitas di localStorage tapi session baru, sync ke backend secara transparan
                if (vName && vEmail && !sessionStorage.getItem('flora_v_synced')) {
                    fetch("{{ route('public.visitor.identify') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ visitor_name: vName, visitor_email: vEmail })
                    }).then(function() {
                        sessionStorage.setItem('flora_v_synced', 'true');
                    });
                }

                if (!vName && !dismissed) {
                    setTimeout(function() {
                        var modal = document.getElementById('visitor-modal');
                        if (modal) modal.style.display = 'flex';
                    }, 800);
                }
            })();

            function closeVisitorModal(dismiss) {
                var modal = document.getElementById('visitor-modal');
                if (modal) modal.style.display = 'none';
                if (dismiss) sessionStorage.setItem('flora_v_modal_dismissed', 'true');
            }

            function submitVisitorIdentity(e) {
                e.preventDefault();
                var name = document.getElementById('v-name').value.trim();
                var email = document.getElementById('v-email').value.trim();
                if (!name || !email) return;

                fetch("{{ route('public.visitor.identify') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ visitor_name: name, visitor_email: email })
                }).then(function() {
                    localStorage.setItem('flora_v_name', name);
                    localStorage.setItem('flora_v_email', email);
                    closeVisitorModal(false);
                }).catch(function() {
                    closeVisitorModal(false);
                });
            }

            // Global Scroll Reveal Animation untuk semua section & card
            document.addEventListener('DOMContentLoaded', function() {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

                var targets = document.querySelectorAll('#main-content section, #main-content article, .cp-section, .cp-checklist-box, .cp-banner');
                if (!('IntersectionObserver' in window)) return;

                var observer = new IntersectionObserver(function(entries, obs) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-revealed');
                            obs.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.08, rootMargin: '0px 0px -30px 0px' });

                targets.forEach(function(el, index) {
                    // Jangan sembunyikan elemen paling atas (hero) agar langsung tampil saat load
                    var rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight * 0.9) {
                        el.classList.add('is-revealed');
                    } else {
                        el.classList.add('flora-reveal');
                        el.style.transitionDelay = ((index % 3) * 0.06) + 's';
                        observer.observe(el);
                    }
                });
            });
        </script>
    </body>
</html>
