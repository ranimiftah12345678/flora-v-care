<x-public-layout title="Beranda" active="home">
    <!-- 1. Hero Section (Split Modern Layout Sesuai Referensi, Konten Asli Tetap) -->
    <section class="public-hero" style="padding: 40px 0 60px; position: relative;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: clamp(36px, 5vw, 64px); align-items: center;">
                <!-- Left Hero Copy -->
                <div>
                    <!-- Badges Row -->
                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-bottom: 20px;">
                        <span class="home-tag">
                            <span>🎓</span> STIKES KARYA HUSADA KEDIRI
                        </span>
                        <span class="home-tag">
                            <span>🌸</span> kenali • pahami • cegah
                        </span>
                    </div>

                    <h1 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(38px, 5.2vw, 56px); margin: 0 0 12px; line-height: 1.15; font-weight: 800; letter-spacing: -0.8px;">
                        Flora-V Care
                    </h1>

                    <div style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 18px; font-weight: 600;">
                        Oleh: Nur Elis Safi'Una <span style="margin: 0 6px;">•</span> Edukasi Klinis Remaja
                    </div>

                    <p style="font-size: 15.5px; line-height: 1.75; color: var(--text-muted); max-width: 490px; margin: 0 0 30px;">
                        Media edukasi kesehatan reproduksi bagi remaja putri untuk memahami kesehatan organ kewanitaan dengan tenang, nyaman, dan terpercaya.
                    </p>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 14px;">
                        <a href="#modul" class="button" style="border-radius: 99px; padding: 0 28px; min-height: 48px; font-size: 14px; font-weight: 600;">
                            Jelajahi Edukasi <span aria-hidden="true" style="margin-left: 6px;">↓</span>
                        </a>
                        <span class="home-badge-outline">
                            PANDUAN TERVERIFIKASI MEDIS
                        </span>
                    </div>
                </div>

                <!-- Right Hero Image with Floating Card (Sesuai Referensi) -->
                <div style="position: relative; text-align: center;">
                    <div style="position: relative; display: inline-block; max-width: 480px; width: 100%;">
                        <div style="border-radius: 28px; overflow: hidden; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.12); border: 1px solid var(--border); aspect-ratio: 4/3.5; background: var(--surface-2);">
                            <img src="{{ asset('assets/image 1.jpg') }}" alt="Ilustrasi Edukasi Flora-V Care" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Floating Card Overlay -->
                        <div class="card" style="position: absolute; bottom: -20px; right: clamp(10px, 3vw, 24px); left: clamp(10px, 3vw, 24px); background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 16px 22px; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16); text-align: left;">
                            <span class="home-card-eyebrow">
                                <span>🌸</span> RUANG AMAN REMAJA
                            </span>
                            <p style="font-size: 13.5px; line-height: 1.5; color: var(--text); margin: 0; font-weight: 500;">
                                Merawat diri berawal dari pengetahuan yang benar tanpa rasa takut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Section Filosofi & Nilai Inti (Split Layout + 3 Pilar) -->
    <section id="filosofi" style="padding: 70px 0 60px; background: var(--surface-2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <!-- Split Row: Image Left + Copy Right -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: clamp(36px, 5vw, 64px); align-items: center; margin-bottom: 46px;">
                <div>
                    <div class="card" style="border-radius: 28px; overflow: hidden; box-shadow: 0 18px 40px rgba(0,0,0,0.06); border: 1px solid var(--border); aspect-ratio: 4/3.2; background: var(--surface);">
                        <img src="{{ asset('assets/image 3.jpg') }}" alt="Konsultasi Tenaga Medis" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>

                <div>
                    <span class="home-section-eyebrow">
                        — FILOSOFI INTI KAMI
                    </span>
                    <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(26px, 3.6vw, 38px); margin: 0 0 16px; font-weight: 800; line-height: 1.2; letter-spacing: -0.5px;">
                        Fondasi Edukasi Berbasis Kasih dan Bukti Klinis
                    </h2>
                    <div class="home-accent-bar"></div>
                    <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); margin: 0 0 24px;">
                        Flora-V Care merupakan media edukasi berbasis website yang dapat diakses oleh remaja putri untuk meningkatkan pemahaman dan kepedulian dalam menjaga kesehatan organ reproduksi serta mencegah fluor albus atau keputihan patologis.
                    </p>

                    <!-- Pesan Sahabat V (Compact Card) -->
                    <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 18px; padding: 18px 20px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                            <span class="home-tag">
                                ♡ PESAN SAHABAT V
                            </span>
                            <span style="font-size: 12.5px; font-weight: 600; color: var(--heading); font-style: italic;">"kenali • pahami • cegah"</span>
                        </div>
                        <p style="font-size: 13px; line-height: 1.6; color: var(--text-muted); margin: 0;">
                            Langkah sederhana dan penuh kepedulian untuk kesehatan organ reproduksi masa kini hingga masa depan. — <strong style="color: var(--heading);">Sahabat Edukasi (Flora-V Care System)</strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- 3 Pilar Kartu (Flora, V, Care) -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 22px;">
                <!-- Pilar 1: FLORA -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                        <div class="home-icon-box home-icon-flora">
                            🍃
                        </div>
                        <span class="home-pilar-tag">
                            Pilar 01
                        </span>
                    </div>
                    <h3 class="home-card-heading">
                        FLORA
                    </h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 18px;">
                        Flora merujuk pada flora normal, yaitu mikroorganisme alami yang membantu menjaga keseimbangan lingkungan vagina.
                    </p>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: var(--heading);">
                        <span style="color: var(--ok);">✔</span> Keseimbangan Mikroba Baik
                    </div>
                </div>

                <!-- Pilar 2: V -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                        <div class="home-icon-box home-icon-v">
                            🛡️
                        </div>
                        <span class="home-pilar-tag">
                            Pilar 02
                        </span>
                    </div>
                    <h3 class="home-card-heading">
                        V
                    </h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 18px;">
                        V merujuk pada V-area atau vagina sebagai fokus kesehatan reproduksi remaja putri yang perlu dipahami secara benar.
                    </p>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: var(--heading);">
                        <span style="color: var(--ok);">✔</span> Kesehatan Organ Intim
                    </div>
                </div>

                <!-- Pilar 3: CARE -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                        <div class="home-icon-box home-icon-care">
                            🤲
                        </div>
                        <span class="home-pilar-tag">
                            Pilar 03
                        </span>
                    </div>
                    <h3 class="home-card-heading">
                        CARE
                    </h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 18px;">
                        Care berarti kepedulian dan perawatan diri sebagai bentuk kesadaran remaja putri dalam menjaga kesehatan reproduksinya.
                    </p>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; font-weight: 600; color: var(--heading);">
                        <span style="color: var(--ok);">✔</span> Kesadaran &amp; Perawatan Mandiri
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Section Menu Utama Edukasi (4 Modul Terintegrasi) -->
    <section id="modul" style="padding: 70px 0 80px;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; max-width: 650px; margin: 0 auto 46px;">
                <span class="home-tag" style="margin-bottom: 12px;">
                    4 MODUL TERINTEGRASI
                </span>
                <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(28px, 3.8vw, 40px); margin: 0 0 12px; font-weight: 800; letter-spacing: -0.5px;">
                    Menu Utama Edukasi
                </h2>
                <p style="font-size: 14.5px; line-height: 1.7; color: var(--text-muted); margin: 0;">
                    Pilih modul pembelajaran di bawah ini untuk memahami setiap tahapan klinis secara terstruktur dan tenang.
                </p>
            </div>

            <!-- Grid 4 Kartu Modul Bersih Sesuai Referensi -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 24px;">
                <!-- Modul 01: Jenis Keputihan -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="home-icon-box home-icon-m1" style="margin-bottom: 20px;">
                            🧬
                        </div>
                        <span class="home-card-eyebrow">
                            MODUL 01
                        </span>
                        <h3 class="home-card-heading">
                            {{ $materials['jenis-keputihan']->title ?? 'Jenis Keputihan' }}
                        </h3>
                        <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 20px;">
                            Pahami definisi Fluor Albus dan kenali pengelompokannya berdasarkan karakteristik klinis serta penyebab mikrobiologis.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('public.jenis') }}" class="button button-small" style="border-radius: 99px; justify-content: center; width: 100%; font-weight: 600;">
                            Buka Menu Jenis <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <!-- Modul 02: Tanda & Gejala -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="home-icon-box home-icon-m2" style="margin-bottom: 20px;">
                            🔬
                        </div>
                        <span class="home-card-eyebrow">
                            MODUL 02
                        </span>
                        <h3 class="home-card-heading">
                            {{ $materials['tanda-gejala']->title ?? 'Tanda & Gejala' }}
                        </h3>
                        <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 20px;">
                            Kenali perbedaan keputihan normal (fisiologis) dan tidak normal (patologis), serta kenali arti dari setiap warna cairan.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('public.tanda-gejala') }}" class="button button-small" style="border-radius: 99px; justify-content: center; width: 100%; font-weight: 600;">
                            Buka Tanda &amp; Gejala <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <!-- Modul 03: Cara Pencegahan -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="home-icon-box home-icon-m3" style="margin-bottom: 20px;">
                            🛡️
                        </div>
                        <span class="home-card-eyebrow">
                            MODUL 03
                        </span>
                        <h3 class="home-card-heading">
                            {{ $materials['pencegahan']->title ?? 'Cara Pencegahan' }}
                        </h3>
                        <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 20px;">
                            Langkah terpadu vulva hygiene: membasuh yang benar, pemilihan pakaian dalam katun, hingga kebiasaan cuci tangan.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('public.cara-pencegahan') }}" class="button button-small" style="border-radius: 99px; justify-content: center; width: 100%; font-weight: 600;">
                            Buka Cara Pencegahan <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <!-- Modul 04: Video Edukasi -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div class="home-icon-box home-icon-m4" style="margin-bottom: 20px;">
                            ▶
                        </div>
                        <span class="home-card-eyebrow">
                            MODUL 04
                        </span>
                        <h3 class="home-card-heading">
                            {{ $materials['video']->title ?? 'Video Edukasi' }}
                        </h3>
                        <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0 0 20px;">
                            Media visual interaktif dan video pembelajaran seputar kesehatan organ reproduksi remaja putri secara jelas.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('public.video') }}" class="button button-small" style="border-radius: 99px; justify-content: center; width: 100%; font-weight: 600;">
                            Tonton Video <span aria-hidden="true">⊙</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Section Bottom Feature Callout (Split Layout Sesuai Referensi) -->
    <section style="padding: 70px 0 80px; background: linear-gradient(180deg, var(--surface-2) 0%, var(--bg) 100%); border-top: 1px solid var(--border);">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: clamp(36px, 5vw, 64px); align-items: center;">
                <div class="card" style="border-radius: 28px; overflow: hidden; box-shadow: 0 18px 40px rgba(0,0,0,0.06); border: 1px solid var(--border); aspect-ratio: 4/3.2; background: var(--surface);">
                    <img src="{{ asset('assets/image 6.jpg') }}" alt="Konsultasi Kesehatan Reproduksi" style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <div>
                    <span class="home-tag" style="margin-bottom: 14px;">
                        <span>⊙</span> CEK PEMAHAMAN MANDIRI
                    </span>
                    <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(26px, 3.6vw, 38px); margin: 0 0 16px; font-weight: 800; line-height: 1.2; letter-spacing: -0.5px;">
                        Ingin Tahu Kapan Waktu Tepat Berkonsultasi?
                    </h2>
                    <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); margin: 0 0 28px;">
                        Jangan ragu untuk mencari tahu perbedaan antara reaksi alami tubuh dan gejala yang memerlukan perhatian bidan atau dokter. Kami mendampingi setiap langkah Anda.
                    </p>
                    <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                        <a href="{{ route('public.tanda-gejala') }}" class="button" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                            <span>▦</span> Cek Panduan Gejala
                        </a>
                        <a href="{{ route('public.cara-pencegahan') }}" class="button button-outline" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                            <span>✔</span> Panduan Higienitas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
