<x-public-layout title="Jenis Keputihan" active="jenis">
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
                            <span style="color: var(--primary); font-weight: 600;">Jenis Keputihan</span>
                        </nav>
                        <span class="home-tag">
                            <span>🧬</span> MODUL 01
                        </span>
                    </div>

                    <h1 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(32px, 4.5vw, 48px); margin: 0 0 14px; line-height: 1.18; font-weight: 800; letter-spacing: -0.6px;">
                        Jenis-Jenis Keputihan <br><span style="font-family: 'Playfair Display', Georgia, serif; font-weight: 600; font-style: italic; color: var(--primary);">(Fluor Albus)</span>
                    </h1>

                    <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); max-width: 500px; margin: 0 0 26px;">
                        Memahami konsep dasar cairan organ genitalia wanita, klasifikasi berdasarkan kondisi klinis alami, serta mengenali mikroorganisme penyebabnya tanpa rasa cemas.
                    </p>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 12px;">
                        <a href="#karakteristik-klinis" class="button" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                            Pelajari Karakteristik <span aria-hidden="true" style="margin-left: 6px;">↓</span>
                        </a>
                        <span class="home-badge-outline">
                            KLASIFIKASI &amp; DEFINISI KLINIS
                        </span>
                    </div>
                </div>

                <!-- Right Hero Image Frame -->
                <div style="position: relative; text-align: center;">
                    <div style="position: relative; display: inline-block; max-width: 460px; width: 100%;">
                        <div style="border-radius: 28px; overflow: hidden; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.12); border: 1px solid var(--border); aspect-ratio: 4/3.2; background: var(--surface-2);">
                            <img src="{{ asset('assets/image 5.jpg') }}" alt="Ilustrasi Edukasi Jenis Keputihan" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Floating Card Overlay Sesuai Referensi -->
                        <div class="card" style="position: absolute; bottom: -20px; right: clamp(10px, 3vw, 24px); left: clamp(10px, 3vw, 24px); background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 16px 22px; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16); text-align: left;">
                            <span class="home-card-eyebrow">
                                <span>💡</span> FAKTA KLINIS
                            </span>
                            <p style="font-size: 13.5px; line-height: 1.5; color: var(--text); margin: 0; font-weight: 500;">
                                Tidak semua keputihan berbahaya — tubuh secara alami memproduksi cairan pelindung setiap hari.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian 1: Pengertian Dasar (Split Card Section) -->
    <section style="padding: 60px 0; background: var(--surface-2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: clamp(26px, 4.5vw, 44px); box-shadow: 0 8px 30px rgba(0,0,0,0.04);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: clamp(30px, 4vw, 50px); align-items: center;">
                    <div>
                        <span class="home-section-eyebrow">
                            PENGERTIAN DASAR
                        </span>
                        <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(24px, 3.4vw, 34px); margin: 0 0 14px; font-weight: 800; line-height: 1.25;">
                            Apa Itu Keputihan (Fluor Albus)?
                        </h2>
                        <div class="home-accent-bar"></div>
                        <p style="font-size: 13.5px; line-height: 1.8; color: var(--text); margin: 0 0 14px;">
                            <strong>Fluor albus</strong> atau keputihan (<em>vaginal discharge</em> / <em>leucorrhea</em>) adalah keluarnya cairan dari organ genitalia wanita yang bukan berupa darah.
                        </p>
                        <p style="font-size: 14.5px; line-height: 1.8; color: var(--text-muted); margin: 0;">
                            Cairan ini memiliki konsistensi dan warna yang beragam: mulai dari cair hingga kental; serta berwarna jernih, putih, kekuningan, atau kehijauan, yang dapat timbul dengan atau tanpa bau.
                        </p>
                    </div>
                    <div style="text-align: center;">
                        @if (!empty($material?->image) && Storage::disk('public')->exists($material->image))
                            <img src="{{ Storage::disk('public')->url($material->image) }}" alt="Ilustrasi apa itu keputihan" style="max-width: 360px; width: 100%; height: auto; border-radius: 20px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08); display: inline-block; border: 1px solid var(--border);">
                        @else
                            <img src="{{ asset('assets/apa-itu-keputihan.png') }}" alt="Ilustrasi apa itu keputihan" style="max-width: 360px; width: 100%; height: auto; border-radius: 20px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08); display: inline-block; border: 1px solid var(--border);">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian 2: Karakteristik Klinis (Normal vs Tidak Normal) -->
    <section id="karakteristik-klinis" style="padding: 70px 0 60px;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; max-width: 650px; margin: 0 auto 46px;">
                <span class="home-tag" style="margin-bottom: 12px;">
                    KARAKTERISTIK KLINIS
                </span>
                <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(26px, 3.6vw, 36px); margin: 0 0 12px; font-weight: 800; letter-spacing: -0.5px;">
                    Klasifikasi Berdasarkan Kondisi Klinis
                </h2>
                <p style="font-size: 14.5px; line-height: 1.7; color: var(--text-muted); margin: 0;">
                    Karakteristik keputihan dibedakan menjadi dua kelompok besar: fisiologis (alami tubuh) dan patologis (tanda infeksi/gangguan).
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; margin-bottom: 50px;">
                <!-- Kartu Fisiologis -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 28px; position: relative; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                            <span style="display: inline-grid; width: 40px; height: 40px; place-items: center; border-radius: 12px; background: var(--ok-bg); color: var(--ok); font-weight: bold; font-size: 18px;">✓</span>
                            <span class="home-pilar-tag" style="color: var(--ok); border-color: var(--ok-border);">
                                Alami &amp; Sehat
                            </span>
                        </div>
                        <h3 class="home-card-heading" style="color: var(--ok) !important; font-size: 20px;">
                            1. Keputihan Normal (Fisiologis)
                        </h3>
                        <p style="font-size: 14px; line-height: 1.75; color: var(--text); margin: 0 0 16px;">
                            Cairan yang keluar dari organ genitalia wanita yang bukan berupa darah dan <strong>tidak disebabkan oleh penyakit</strong> (bukan karena infeksi atau peradangan).
                        </p>
                    </div>
                    <div style="background: var(--surface-2); border: 1px solid var(--border); border-radius: 14px; padding: 14px 16px; font-size: 13px; line-height: 1.6; color: var(--text-muted);">
                        💡 <strong>Fungsi Alami:</strong> Merupakan mekanisme alami tubuh untuk membersihkan dan melembapkan dinding organ reproduksi serta mencegah kekeringan.
                    </div>
                </div>

                <!-- Kartu Patologis -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 28px; position: relative; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div>
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                            <span style="display: inline-grid; width: 40px; height: 40px; place-items: center; border-radius: 12px; background: var(--bad-bg); color: var(--bad); font-weight: bold; font-size: 18px;">✕</span>
                            <span class="home-pilar-tag" style="color: var(--bad); border-color: var(--bad-border);">
                                Perlu Perhatian Medis
                            </span>
                        </div>
                        <h3 class="home-card-heading" style="color: var(--bad) !important; font-size: 20px;">
                            2. Keputihan Tidak Normal (Patologis)
                        </h3>
                        <p style="font-size: 14px; line-height: 1.75; color: var(--text); margin: 0 0 16px;">
                            Cairan yang keluar dari organ reproduksi wanita yang <strong>tidak normal</strong>, disebabkan oleh infeksi mikroorganisme patogen atau kondisi medis tertentu.
                        </p>
                    </div>
                    <div style="background: var(--surface-2); border: 1px solid var(--border); border-radius: 14px; padding: 14px 16px; font-size: 13px; line-height: 1.6; color: var(--text-muted);">
                        ⚠️ <strong>Gejala Khas:</strong> Umumnya disertai perubahan warna (kuning/hijau/keabuan), tekstur menggumpal/berbusa, bau menyengat, serta rasa gatal/perih.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian 3: Karakteristik Berdasarkan Mikrobiologis (Etiologi) -->
    <section style="padding: 70px 0 80px; background: var(--surface-2); border-top: 1px solid var(--border);">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="text-align: center; max-width: 650px; margin: 0 auto 46px;">
                <span class="home-tag" style="margin-bottom: 12px;">
                    PENYEBAB ETIOLOGI
                </span>
                <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(26px, 3.6vw, 36px); margin: 0 0 12px; font-weight: 800; letter-spacing: -0.5px;">
                    Jenis Keputihan Menurut Penyebab Mikrobiologis
                </h2>
                <p style="font-size: 14.5px; line-height: 1.7; color: var(--text-muted); margin: 0;">
                    Infeksi patologis umumnya dipicu oleh ketidakseimbangan mikrobiota atau masuknya mikroorganisme asing:
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px; margin-bottom: 50px;">
                <!-- 1. Jamur Candida -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <span class="home-icon-box home-icon-m1">🍄</span>
                        <div>
                            <h3 class="home-card-heading" style="margin: 0; font-size: 17px;">Jamur (Candida sp.)</h3>
                            <small style="color: var(--text-muted); font-size: 11.5px; font-weight: 600;">Kandidiasis Vulvovagina</small>
                        </div>
                    </div>
                    <ul style="margin: 0; padding-left: 18px; font-size: 13.5px; line-height: 1.7; color: var(--text);">
                        <li><strong>Warna &amp; Tekstur:</strong> Putih kental menyerupai gumpalan susu pecah atau keju cottage.</li>
                        <li><strong>Gejala Utama:</strong> Disertai rasa gatal yang sangat hebat di area bibir organ intim (vulva).</li>
                        <li><strong>Sensasi:</strong> Panas, perih, dan kemerahan akibat iritasi garukan.</li>
                    </ul>
                </div>

                <!-- 2. Bakteri Gardnerella -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <span class="home-icon-box home-icon-v">🧫</span>
                        <div>
                            <h3 class="home-card-heading" style="margin: 0; font-size: 17px;">Bakteri (Gardnerella / BV)</h3>
                            <small style="color: var(--text-muted); font-size: 11.5px; font-weight: 600;">Bacterial Vaginosis</small>
                        </div>
                    </div>
                    <ul style="margin: 0; padding-left: 18px; font-size: 13.5px; line-height: 1.7; color: var(--text);">
                        <li><strong>Warna &amp; Tekstur:</strong> Putih keabu-abuan atau abu-abu pucat, konsistensi encer dan merata.</li>
                        <li><strong>Aroma Khas:</strong> Mengeluarkan bau amis yang menyengat (<em>fishy odor</em>), terutama setelah dibilas atau berkeringat.</li>
                        <li><strong>Gejala Tambahan:</strong> Iritasi ringan, sensasi tidak nyaman pada celana dalam.</li>
                    </ul>
                </div>

                <!-- 3. Parasit Trichomonas -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <span class="home-icon-box home-icon-care">🦠</span>
                        <div>
                            <h3 class="home-card-heading" style="margin: 0; font-size: 17px;">Parasit (Trichomonas vaginalis)</h3>
                            <small style="color: var(--text-muted); font-size: 11.5px; font-weight: 600;">Trikomoniasis</small>
                        </div>
                    </div>
                    <ul style="margin: 0; padding-left: 18px; font-size: 13.5px; line-height: 1.7; color: var(--text);">
                        <li><strong>Warna &amp; Tekstur:</strong> Berwarna kuning kehijauan atau hijau pekat, berbusa (<em>frothy</em>), dan encer.</li>
                        <li><strong>Aroma:</strong> Berbau busuk atau sangat tajam menusuk hidung.</li>
                        <li><strong>Gejala Tambahan:</strong> Perih luar biasa saat buang air kecil, kemerahan di area vulva.</li>
                    </ul>
                </div>

                <!-- 4. Bakteri Gonore / Klamidia -->
                <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 22px; padding: 26px 22px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                        <span class="home-icon-box home-icon-m2">🔬</span>
                        <div>
                            <h3 class="home-card-heading" style="margin: 0; font-size: 17px;">Bakteri Menular Seksual</h3>
                            <small style="color: var(--text-muted); font-size: 11.5px; font-weight: 600;">N. gonorrhoeae / C. trachomatis</small>
                        </div>
                    </div>
                    <ul style="margin: 0; padding-left: 18px; font-size: 13.5px; line-height: 1.7; color: var(--text);">
                        <li><strong>Ciri Khas:</strong> Keputihan berwarna kuning kehijauan atau kekuningan, kadang disertai lendir dari leher rahim.</li>
                        <li><strong>Gejala Sering Muncul:</strong> Gatal, nyeri saat berkemih, dan bisa disertai nyeri pada perut bagian bawah.</li>
                        <li><strong>Faktor Risiko:</strong> Hubungan seksual tanpa pengaman, pasangan berganti-ganti, dan riwayat IMS.</li>
                    </ul>
                </div>
            </div>

            <!-- Navigasi Modul Bawah -->
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; padding-top: 20px; border-top: 1px solid var(--border);">
                <a class="button button-outline" href="{{ route('home') }}" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                    <span aria-hidden="true">←</span> Kembali ke Beranda
                </a>
                <a class="button" href="{{ route('public.tanda-gejala') }}" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                    Lanjut: Modul Tanda &amp; Gejala <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
