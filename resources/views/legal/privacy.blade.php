<x-guest-layout>
    <x-slot name="title">Kebijakan Privasi &amp; Perlindungan Data Responden</x-slot>

    <article class="privacy-page">
        <header class="privacy-hero">
            <span class="eyebrow"><span class="eyebrow-dot"></span> Transparansi &amp; Etika Riset Kesehatan Reproduksi Remaja</span>
            <h1>Kebijakan Privasi &amp; Perlindungan Data Responden</h1>
            <p>Komitmen tim Flora-V Care, SMK Arga Husada, dan STIKes Karya Husada dalam menjaga kerahasiaan identitas, integritas instrumen kuesioner, dan catatan aktivitas pembelajaran siswi secara aman, beradab, dan bermartabat.</p>
            <div class="privacy-meta"><span>Dokumen pratinjau</span><span>Isi dan kontak perlu dikonfirmasi</span><span>Status: Rancangan UI</span></div>
        </header>

        <aside class="privacy-draft-note" role="note">
            <strong>Catatan sebelum publikasi</strong>
            <p>Halaman ini masih berupa rancangan. Kode aplikasi saat ini belum memiliki penyimpanan akun yang siap digunakan, profil siswi, data pretest/posttest, maupun autentikasi admin. Konfirmasi dasar etik, pengelolaan data, kontak petugas, dan mekanisme persetujuan sebelum kebijakan ini dipublikasikan.</p>
        </aside>

        <div class="privacy-layout">
            <aside class="privacy-index">
                <h2>Daftar Isi Kebijakan</h2>
                <a href="#etika">1. Landasan Etika Penelitian</a>
                <a href="#data">2. Data yang Dikumpulkan &amp; Diproses</a>
                <a href="#tujuan">3. Tujuan Penggunaan Data</a>
                <a href="#anonimisasi">4. Mekanisme Anonimisasi</a>
                <a href="#keamanan">5. Protokol Keamanan &amp; Enkripsi</a>
                <a href="#hak">6. Hak Siswi &amp; Perlindungan</a>
                <a href="#kontak">7. Kontak Petugas Perlindungan Data</a>
                <div class="index-note"><strong>Privasi Terlindungi</strong><p>Jawaban evaluasi tidak akan dipublikasikan sebagai identitas individu.</p></div>
            </aside>

            <div class="privacy-content">
                <section class="policy-section" id="etika">
                    <span class="policy-number">1</span>
                    <div><h2>Landasan Etika Penelitian &amp; Persetujuan Siswi (Informed Consent)</h2>
                        <div class="policy-card"><p>Bagian ini menjelaskan rancangan prinsip etika yang perlu ditinjau oleh sekolah dan institusi sebelum kegiatan penelitian atau pengumpulan data dimulai.</p>
                            <div class="policy-mini-grid"><article><h3>Persetujuan Institusional</h3><p>Rincian izin sekolah dan pembimbing perlu dilengkapi sebelum publikasi.</p></article><article><h3>Dasar Etik STIKes</h3><p>Nomor dan status persetujuan etik harus dikonfirmasi oleh institusi terkait.</p></article></div>
                            <p class="policy-small">Partisipasi penelitian harus bersifat sukarela dan tidak menimbulkan konsekuensi akademik.</p>
                        </div>
                    </div>
                </section>

                <section class="policy-section" id="data">
                    <span class="policy-number">2</span>
                    <div><h2>Data yang Dikumpulkan &amp; Diproses</h2><p class="policy-lead">Aplikasi belum memiliki penyimpanan akun atau fitur evaluasi yang siap digunakan. Daftar berikut adalah rancangan, bukan pernyataan bahwa data tersebut telah dikumpulkan.</p>
                        <div class="policy-data-grid">
                            <article class="policy-card"><h3>a. Data Identitas Akun</h3><ul><li>Formulir rancangan meminta nama dan email.</li><li>Nama pengguna, kelas, dan rentang usia belum terhubung ke penyimpanan.</li><li>Jangan mengirimkan data melalui halaman ini sebelum sistem siap.</li></ul></article>
                            <article class="policy-card"><h3>b. Data Pembelajaran &amp; Modul</h3><ul><li>Progress modul dan materi belum tersimpan.</li><li>Riwayat video belum tersambung ke akun.</li><li>Fitur evaluasi belum terhubung ke basis data.</li></ul></article>
                            <article class="policy-card"><h3>c. Evaluasi &amp; Instrumen Sikap</h3><ul><li>Instrumen pengetahuan masih berupa rancangan.</li><li>Skor pretest dan posttest belum dikumpulkan.</li><li>Mekanisme persetujuan harus disepakati sebelum penggunaan.</li></ul></article>
                            <article class="policy-card"><h3>d. Data Teknis Sesi</h3><ul><li>Pengelolaan sesi mengikuti konfigurasi Laravel.</li><li>Rincian log dan masa simpan belum ditetapkan.</li><li>Dokumentasikan retensi sebelum sistem digunakan.</li></ul></article>
                        </div>
                        <div class="policy-alert"><strong>Catatan Mutlak: Data Sensitif Tidak Dikumpulkan</strong><p>Platform tidak meminta informasi medis pribadi yang tidak relevan, lokasi presisi, kontak pribadi, maupun rekam medis.</p></div>
                    </div>
                </section>

                <section class="policy-section" id="tujuan">
                    <span class="policy-number">3</span>
                    <div><h2>Tujuan Penggunaan Data Siswi</h2><div class="policy-card"><p>Jika pengumpulan data diaktifkan, tujuan dan dasar penggunaannya perlu diinformasikan dengan jelas sebelum partisipasi:</p><ul><li>Membantu siswi memahami materi secara progresif dan aman.</li><li>Mengevaluasi efektivitas modul dan video edukasi.</li><li>Meningkatkan kualitas materi pembelajaran kesehatan reproduksi.</li><li>Mendukung evaluasi program pendidikan bersama pihak sekolah dan institusi akademik.</li></ul></div></div>
                </section>

                <section class="policy-section" id="anonimisasi">
                    <span class="policy-number">4</span>
                    <div><h2>Mekanisme Anonimisasi Data Responden (De-Identification)</h2><div class="policy-card"><p>Pemisahan identitas dan data evaluasi perlu dibangun dan diuji sebelum fitur penelitian digunakan.</p>
                        <div class="anonymization-flow"><span>Data Akun Terdaftar<small>Jika akun diaktifkan</small></span><b aria-hidden="true">→</b><span>Entri Evaluasi<small>Tanpa identitas langsung</small></span><b aria-hidden="true">→</b><span>Kode Responden<small>Metode perlu ditetapkan</small></span></div>
                        <h3>Analisis Agregat</h3><p>Rancangan pelaporan harus menggunakan ringkasan kelompok dan tidak mengaitkan jawaban dengan identitas individu.</p>
                    </div></div>
                </section>

                <section class="policy-section" id="keamanan">
                    <span class="policy-number">5</span>
                    <div><h2>Protokol Keamanan Penyimpanan &amp; Enkripsi Data</h2><div class="policy-mini-grid security-policy-grid">
                        <article class="policy-card"><h3>Enkripsi Koneksi</h3><p>Konfigurasi HTTPS perlu dipastikan pada lingkungan produksi.</p></article>
                        <article class="policy-card"><h3>Penyimpanan Terbatas</h3><p>Masa simpan dan hak akses perlu ditetapkan sebelum pengumpulan data.</p></article>
                        <article class="policy-card"><h3>Proteksi Akses</h3><p>Kontrol peran administrator belum tersedia dalam aplikasi saat ini.</p></article>
                    </div></div>
                </section>

                <section class="policy-section" id="hak">
                    <span class="policy-number">6</span>
                    <div><h2>Hak Siswi &amp; Perlindungan Kerahasiaan Medis UKS</h2><div class="policy-card"><p>Sebagai subjek pembelajaran dan responden edukasi, setiap siswi memiliki hak fundamental yang didukung oleh tim pengajar dan pihak sekolah.</p>
                        <div class="policy-mini-grid"><article><h3>Hak Akses &amp; Klarifikasi</h3><p>Siswi dapat bertanya dan menerima penjelasan mengenai materi yang dipelajari.</p></article><article><h3>Hak Penarikan Data (Opt-out)</h3><p>Partisipasi penelitian bersifat sukarela sesuai ketentuan institusi.</p></article></div>
                        <div class="policy-alert"><strong>Kerahasiaan Medis Konseling Personal UKS</strong><p>Informasi yang disampaikan saat konseling kepada tenaga kesehatan ditangani secara rahasia sesuai prosedur sekolah dan ketentuan yang berlaku.</p></div>
                    </div></div>
                </section>

                <section class="policy-section" id="kontak">
                    <span class="policy-number">7</span>
                    <div><h2>Kontak Petugas Perlindungan Data &amp; Komite Etik</h2><div class="policy-card"><p>Jika Anda memiliki pertanyaan, koreksi, atau permintaan mengenai privasi peserta, hubungi pihak sekolah atau institusi pembimbing.</p>
                        <div class="policy-mini-grid"><article><h3>Layanan UKS SMK Arga Husada</h3><p>Hubungi guru pendamping atau petugas UKS di lingkungan sekolah.</p></article><article><h3>Komisi Etik STIKes Karya Husada</h3><p>Ajukan pertanyaan penelitian melalui saluran resmi institusi.</p></article></div>
                        <div class="policy-actions"><a class="button button-small" href="{{ route('home') }}">Kembali ke Beranda <span aria-hidden="true">→</span></a><a href="{{ route('register') }}">Kembali ke Pendaftaran</a></div>
                    </div></div>
                </section>
            </div>
        </div>
    </article>
</x-guest-layout>
