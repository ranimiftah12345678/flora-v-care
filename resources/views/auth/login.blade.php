<x-guest-layout>
    <x-slot name="title">Masuk Akun Siswi</x-slot>

    <div class="login-layout">
        <div class="login-topline">
            <a class="back-link" href="{{ route('home') }}"><span aria-hidden="true">←</span> Kembali ke Beranda</a>
            <div class="login-meta"><span>◉ Tahun Ajaran {{ now()->month >= 7 ? now()->year.'/'.(now()->year + 1) : (now()->year - 1).'/'.now()->year }}</span><span>✦ Portal Masuk Siswi SMK Arga Husada</span></div>
        </div>

        <div class="auth-columns login-columns">
            <aside class="auth-story story-login">
                <div class="story-content">
                    <span class="eyebrow eyebrow-white"><span class="eyebrow-dot"></span> Kenali, Pahami, Cegah</span>
                    <h1>Selamat Datang Kembali, Siswi Mandiri &amp; Sehat</h1>
                    <p>Masuk untuk melanjutkan modul pembelajaran vulva hygiene, kuis pretest/posttest, dan pantau progres pengetahuan kesehatan reproduksimu secara aman dan bermartabat.</p>
                    <div class="educator-card">
                        <span class="educator-avatar" aria-hidden="true">F</span>
                        <span><strong>Flora-V Care</strong><small>Siswi Perawatan · SMK Arga Husada</small></span>
                        <p>“Edukasi kesehatan yang nyaman tanpa rasa canggung, didukung khusus oleh akademisi STIKes Karya Husada.”</p>
                    </div>
                    <ul class="story-benefits">
                        <li><span aria-hidden="true">♙</span><span><strong>Privasi Data Terjamin</strong><small>Data identitas dan skor evaluasi belajar dikelola secara aman.</small></span></li>
                        <li><span aria-hidden="true">◉</span><span><strong>Progress Tersimpan Otomatis</strong><small>Lanjutkan materi belajar dan video kapan saja sesuai ritme.</small></span></li>
                        <li><span aria-hidden="true">♧</span><span><strong>Akses Guru Pendamping &amp; UKS</strong><small>Dukungan konseling aman saat membutuhkan klarifikasi.</small></span></li>
                    </ul>
                    <div class="story-footnote"><span>STIKes Karya Husada &amp; SMK Arga Husada</span><span>Terverifikasi Ilmiah</span></div>
                </div>
            </aside>

            <section class="auth-panel login-panel" aria-labelledby="login-title">
                <div class="panel-topline"><span class="form-eyebrow"><span aria-hidden="true">♧</span> Autentikasi siswi</span><span class="secure-label">♢ Aman &amp; Terlindungi</span></div>
                <h2 id="login-title">Masuk ke Akun Siswi</h2>
                <p class="form-intro">Gunakan nama pengguna dan kata sandi yang telah kamu daftarkan untuk melanjutkan pembelajaran.</p>

                <x-auth-session-status class="auth-status" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="auth-form login-form">
                    @csrf
                    <div class="form-field">
                        <label for="username">Nama Pengguna <span>*</span></label>
                        <input id="username" name="username" type="text" value="{{ old('username') }}" placeholder="nama.pengguna" autocomplete="username" required autofocus aria-describedby="username-help username-error">
                        <x-input-error id="username-error" :messages="$errors->get('username')" class="field-error" />
                        <small id="username-help" class="field-help">Masukkan nama pengguna yang kamu gunakan saat mendaftar.</small>
                    </div>
                    <div class="form-field">
                        <div class="label-row"><label for="password">Kata Sandi <span>*</span></label><span class="secure-label">Akses aman</span></div>
                        <input id="password" name="password" type="password" placeholder="Masukkan kata sandi akunmu" autocomplete="current-password" required aria-describedby="password-error">
                        <x-input-error id="password-error" :messages="$errors->get('password')" class="field-error" />
                    </div>
                    <div class="remember-row">
                        <label for="remember_me"><input id="remember_me" type="checkbox" name="remember"><span>Ingat saya di perangkat ini</span></label>
                        <span class="field-help">Lupa kata sandi? Hubungi guru pendamping.</span>
                    </div>
                    <button class="button auth-submit" type="submit">Masuk ke Dasbor Pembelajaran <span aria-hidden="true">→</span></button>
                </form>

                <div class="login-notice"><span aria-hidden="true">✿</span><p><strong>Pemberitahuan Khusus:</strong> Akses akun ini diperuntukkan khusus bagi siswi SMK Arga Husada yang terdaftar dalam program edukasi kesehatan reproduksi Flora-V Care.</p></div>
                <div class="auth-switch"><span>Belum memiliki akun siswi?</span><a href="{{ route('register') }}">Daftar Akun Baru di Sini</a></div>
                <a class="admin-link" href="{{ route('admin.login') }}">Masuk sebagai Admin Sekolah <span aria-hidden="true">♙</span></a>
            </section>
        </div>

        <aside class="support-strip login-support">
            <span class="support-icon" aria-hidden="true">✚</span>
            <div><strong>Dukungan Tenaga Kesehatan &amp; Konseling Guru <small>Layanan Rahasia</small></strong><p>Jika kamu memiliki pertanyaan atau memerlukan klarifikasi kesehatan, hubungi guru pendamping atau UKS.</p></div>
            <a href="{{ route('privacy') }}">Panduan Privasi <span aria-hidden="true">→</span></a>
        </aside>
        <div class="page-note"><span>ⓘ Kendala masuk akun? Temui Guru UKS atau kirim pesan melalui jalur bantuan sekolah.</span><span>● Flora-V Care · Edukasi siswi mandiri</span></div>
    </div>
</x-guest-layout>
