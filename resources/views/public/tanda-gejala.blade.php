<x-public-layout title="Tanda & Gejala" active="tanda-gejala">
    <!-- Header Hero Modul (Sesuai Referensi & Beranda: Split Hero + Gambar) -->
    <section class="public-hero" style="padding: 40px 0 50px; position: relative;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: clamp(36px, 5vw, 64px); align-items: center;">
                <!-- Left Content -->
                <div>
                    <!-- Breadcrumbs & Badges -->
                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-bottom: 16px;">
                        <nav style="font-size: 12.5px; color: var(--text-muted); display: inline-flex; align-items: center; gap: 6px; margin-right: 8px;">
                            <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none;">⌂ Beranda</a>
                            <span>/</span>
                            <a href="{{ route('public.jenis') }}" style="color: var(--text-muted); text-decoration: none;">Jenis Keputihan</a>
                            <span>/</span>
                            <span style="color: var(--primary); font-weight: 600;">Tanda &amp; Gejala</span>
                        </nav>
                        <span class="home-tag">
                            <span>🔬</span> MODUL 02
                        </span>
                    </div>

                    <h1 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(32px, 4.5vw, 48px); margin: 0 0 14px; line-height: 1.18; font-weight: 800; letter-spacing: -0.6px;">
                        Tanda dan Gejala Keputihan <br><span style="font-family: 'Playfair Display', Georgia, serif; font-weight: 600; font-style: italic; color: var(--primary);">(Fluor Albus)</span>
                    </h1>

                    <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); max-width: 500px; margin: 0 0 26px;">
                        Pahami perbedaan tanda alami tubuh (fisiologis) dan tanda yang memerlukan kewaspadaan medis (patologis) secara tenang, ilmiah, dan tanpa rasa cemas. Tubuhmu memiliki sistem proteksi luar biasa yang berkomunikasi setiap hari.
                    </p>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 12px;">
                        <a href="#perbandingan-klinis" class="button" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                            Cek Perbandingan <span aria-hidden="true" style="margin-left: 6px;">↓</span>
                        </a>
                        <span class="home-badge-outline">
                            DETEKSI DINI &amp; SPEKTRUM WARNA
                        </span>
                    </div>
                </div>

                <!-- Right Hero Image Frame -->
                <div style="position: relative; text-align: center;">
                    <div style="position: relative; display: inline-block; max-width: 460px; width: 100%;">
                        <div style="border-radius: 28px; overflow: hidden; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.12); border: 1px solid var(--border); aspect-ratio: 4/3.2; background: var(--surface-2);">
                            <img src="{{ asset('assets/image 2.jpg') }}" alt="Pemeriksaan Medis & Identifikasi Tanda Gejala Keputihan" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Floating Card Overlay Sesuai Referensi -->
                        <div class="card" style="position: absolute; bottom: -20px; right: clamp(10px, 3vw, 24px); left: clamp(10px, 3vw, 24px); background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 16px 22px; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16); text-align: left;">
                            <span class="home-card-eyebrow">
                                <span>🔍</span> DETEKSI VISUAL
                            </span>
                            <p style="font-size: 13.5px; line-height: 1.5; color: var(--text); margin: 0; font-weight: 500;">
                                Warna, bau, dan rasa gatal adalah sinyal utama yang membedakan cairan sehat dan infeksi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BAGIAN 1: Penyebab & Mekanisme Terjadinya Keputihan (Perbandingan 2 Kolom) -->
    <section id="perbandingan-klinis" style="padding: 70px 0 60px; background: var(--surface-2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; max-width: 650px; margin: 0 auto 46px;">
                <span class="home-tag" style="margin-bottom: 12px;">
                    MEKANISME KLINIS
                </span>
                <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(26px, 3.6vw, 36px); margin: 0 0 12px; font-weight: 800; letter-spacing: -0.5px;">
                    Penyebab &amp; Mekanisme Terjadinya Keputihan
                </h2>
                <p style="font-size: 14.5px; line-height: 1.7; color: var(--text-muted); margin: 0;">
                    Tubuh perempuan secara berkala mengeluarkan cairan untuk membersihkan rahim dan liang vagina. Perhatikan dua respon mendasar berikut:
                </p>
            </div>

            <!-- 2 Kolom Card: Fisiologis Alami vs Patologis Perlu Waspada -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
                <!-- Card 1: Fisiologis (Alami) -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: 32px 28px; box-shadow: 0 6px 22px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px;">
                            <span class="home-tag" style="color: var(--ok); background: var(--ok-bg); border-color: var(--ok-border);">
                                🌸 FISIOLOGIS (ALAMI)
                            </span>
                            <span style="font-size: 12px; color: var(--text-muted); font-weight: 600;">
                                01 / Respon Alami
                            </span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                            <div class="home-icon-box home-icon-flora">
                                🌸
                            </div>
                            <h3 class="home-card-heading" style="margin: 0; font-size: 20px; color: var(--ok) !important;">
                                Keputihan Normal (Fisiologis)
                            </h3>
                        </div>

                        <p style="font-size: 14px; line-height: 1.7; color: var(--text-muted); margin: 0 0 20px;">
                            Merupakan proses pembersihan alami (<em>self-cleaning</em>) oleh epitel vagina yang dipengaruhi oleh hormon estrogen tubuh.
                        </p>

                        <!-- Pemicu & Waktu -->
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; color: var(--heading); display: flex; align-items: center; gap: 6px;">
                            <span>⏱</span> Pemicu &amp; Waktu Terjadinya:
                        </div>

                        <ul style="list-style: none; padding: 0; margin: 0 0 20px; font-size: 13.5px; line-height: 1.65; color: var(--text); display: flex; flex-direction: column; gap: 10px;">
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--ok); font-weight: bold;">✔</span>
                                <div><strong>Perubahan Hormon Alami:</strong> Berfluktuasi secara teratur sepanjang siklus reproduksi remaja.</div>
                            </li>
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--ok); font-weight: bold;">✔</span>
                                <div><strong>Peningkatan Estrogen:</strong> Dipicu saat berolahraga teratur, gairah alami, atau lonjakan hormon harian.</div>
                            </li>
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--ok); font-weight: bold;">✔</span>
                                <div><strong>Fase Pre/Post Menstruasi:</strong> Muncul sesaat sebelum haid atau beberapa hari setelah periode haid selesai.</div>
                            </li>
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--ok); font-weight: bold;">✔</span>
                                <div><strong>Stres Emosional / Kelelahan:</strong> Aktivitas sekolah yang padat dapat memicu pelepasan cairan tubuh lebih banyak namun tetap jernih.</div>
                            </li>
                        </ul>
                    </div>

                    <!-- Indikator Box -->
                    <div style="background: var(--surface-2); border: 1px solid var(--border); border-radius: 14px; padding: 14px 16px; font-size: 12.5px; line-height: 1.6; color: var(--text-muted);">
                        <strong style="color: var(--heading); display: block; margin-bottom: 2px;">Karakteristik Fisik:</strong>
                        Bening hingga putih jernih, konsistensi encer atau sedikit lengket saat ovulasi, <em>tidak menimbulkan rasa gatal</em>, dan tidak berbau tajam.
                    </div>
                </div>

                <!-- Card 2: Patologis (Perlu Kewaspadaan) -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: 32px 28px; box-shadow: 0 6px 22px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px;">
                            <span class="home-tag" style="color: var(--bad); background: var(--bad-bg); border-color: var(--bad-border);">
                                ⚠️ PATOLOGIS (INFEKSI)
                            </span>
                            <span style="font-size: 12px; color: var(--text-muted); font-weight: 600;">
                                02 / Perlu Penanganan
                            </span>
                        </div>

                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                            <div class="home-icon-box home-icon-m1">
                                🔬
                            </div>
                            <h3 class="home-card-heading" style="margin: 0; font-size: 20px; color: var(--bad) !important;">
                                Keputihan Tidak Normal (Patologis)
                            </h3>
                        </div>

                        <p style="font-size: 14px; line-height: 1.7; color: var(--text-muted); margin: 0 0 20px;">
                            Terjadi akibat terganggunya flora normal (<em>Lactobacillus</em>) di liang vagina sehingga kuman jahat berkembang biak.
                        </p>

                        <!-- Faktor Pemicu Utama -->
                        <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; color: var(--heading); display: flex; align-items: center; gap: 6px;">
                            <span>⚠️</span> Faktor Pemicu Utama:
                        </div>

                        <ul style="list-style: none; padding: 0; margin: 0 0 20px; font-size: 13.5px; line-height: 1.65; color: var(--text); display: flex; flex-direction: column; gap: 10px;">
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--bad); font-weight: bold;">✕</span>
                                <div><strong>Infeksi Jamur (Candida):</strong> Pemicu utama gatal hebat, cairan kental putih susu seperti tahu hancur.</div>
                            </li>
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--bad); font-weight: bold;">✕</span>
                                <div><strong>Ketidakseimbangan Bakteri (BV):</strong> Cairan abu-abu encer disertai bau amis khas (<em>fishy odor</em>).</div>
                            </li>
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--bad); font-weight: bold;">✕</span>
                                <div><strong>Parasit Trichomonas:</strong> Cairan berwarna kehijauan, berbusa, berbau busuk, serta nyeri berkemih.</div>
                            </li>
                            <li style="display: flex; align-items: flex-start; gap: 8px;">
                                <span style="color: var(--bad); font-weight: bold;">✕</span>
                                <div><strong>Higienitas Kurang Tepat:</strong> Cara cebok yang keliru (belakang ke depan), celana dalam lembap, atau sabun antiseptik wangi berlebih.</div>
                            </li>
                        </ul>
                    </div>

                    <!-- Indikator Box -->
                    <div style="background: var(--surface-2); border: 1px solid var(--border); border-radius: 14px; padding: 14px 16px; font-size: 12.5px; line-height: 1.6; color: var(--text-muted);">
                        <strong style="color: var(--bad); display: block; margin-bottom: 2px;">Tanda Bahaya Klinis:</strong>
                        Cairan berbau menyengat, perubahan warna (kuning kehijauan/abu-abu), disertai gatal hebat, sensasi terbakar, dan nyeri perut bawah.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BAGIAN 2: Spektrum Warna & Arti Klinisnya -->
    <section style="padding: 70px 0 80px;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; max-width: 650px; margin: 0 auto 46px;">
                <span class="home-tag" style="margin-bottom: 12px;">
                    SPEKTRUM WARNA
                </span>
                <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(26px, 3.6vw, 36px); margin: 0 0 12px; font-weight: 800; letter-spacing: -0.5px;">
                    Yuk Kenali Warna Keputihanmu
                </h2>
                <p style="font-size: 14.5px; line-height: 1.7; color: var(--text-muted); margin: 0;">
                    Warna cairan merupakan panduan visual penting untuk mengetahui kondisi kesehatan organ intimmu secara mandiri.
                </p>
            </div>

            <!-- Visual Chart Gambar dari public/assets/warna-chart.png -->
            <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: clamp(16px, 3vw, 24px); text-align: center; margin-bottom: 40px; box-shadow: 0 6px 24px rgba(0,0,0,0.03); overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <img src="{{ asset('assets/warna-chart.png') }}" alt="Panduan Spektrum Warna Keputihan" style="max-width: 100%; min-width: 280px; width: 100%; height: auto; border-radius: 16px; display: inline-block;" loading="lazy">
            </div>

            <!-- Grid 4 Kartu Panduan Warna Sesuai Desain Modern -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; margin-bottom: 50px;">
                <!-- 1. Bening Transparan -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; background: #e0f2fe; border: 2px solid #38bdf8; display: inline-block;"></span>
                        <span class="home-pilar-tag" style="color: var(--ok); border-color: var(--ok-border);">Normal</span>
                    </div>
                    <h3 class="home-card-heading" style="font-size: 17px; margin-bottom: 8px;">Bening / Transparan</h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0;">
                        Kondisi paling sehat. Muncul saat masa subur (ovulasi), setelah berolahraga, atau saat tubuh membutuhkan lubrikasi alami.
                    </p>
                </div>

                <!-- 2. Putih Susu Kental -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; background: #fdf2f8; border: 2px solid #f472b6; display: inline-block;"></span>
                        <span class="home-pilar-tag">Perlu Evaluasi</span>
                    </div>
                    <h3 class="home-card-heading" style="font-size: 17px; margin-bottom: 8px;">Putih Susu Kental</h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0;">
                        Normal di awal/akhir siklus. Namun jika menggumpal menyerupai butiran keju dan disertai rasa gatal menyengat, menandakan infeksi jamur <em>Candida</em>.
                    </p>
                </div>

                <!-- 3. Kuning Kehijauan / Berbusa -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; background: #fef9c3; border: 2px solid #eab308; display: inline-block;"></span>
                        <span class="home-pilar-tag" style="color: var(--bad); border-color: var(--bad-border);">Infeksi</span>
                    </div>
                    <h3 class="home-card-heading" style="font-size: 17px; margin-bottom: 8px;">Kuning Kehijauan</h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0;">
                        Cairan patologis yang mengindikasikan infeksi bakteri atau parasit trikomoniasis. Disertai bau tak sedap dan rasa terbakar.
                    </p>
                </div>

                <!-- 4. Abu-Abu Encer Berbau Amis -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 24px 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <span style="width: 28px; height: 28px; border-radius: 50%; background: #f1f5f9; border: 2px solid #94a3b8; display: inline-block;"></span>
                        <span class="home-pilar-tag" style="color: var(--bad); border-color: var(--bad-border);">Bacterial Vaginosis</span>
                    </div>
                    <h3 class="home-card-heading" style="font-size: 17px; margin-bottom: 8px;">Abu-Abu Encer</h3>
                    <p style="font-size: 13.5px; line-height: 1.65; color: var(--text-muted); margin: 0;">
                        Ciri khas ketidakseimbangan bakteri (Bacterial Vaginosis). Mengeluarkan aroma amis khas terutama pasca membasuh atau haid.
                    </p>
                </div>
            </div>

            <!-- Navigasi Modul Bawah -->
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; padding-top: 20px; border-top: 1px solid var(--border);">
                <a class="button button-outline" href="{{ route('public.jenis') }}" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                    <span aria-hidden="true">←</span> Kembali ke Modul Jenis
                </a>
                <a class="button" href="{{ route('public.cara-pencegahan') }}" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                    Lanjut: Cara Pencegahan <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
