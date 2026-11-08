<x-guest-layout>
    <x-slot name="title">Masuk Portal Admin</x-slot>

    <div class="admin-login-layout">
        <div class="login-meta"><span>♢ Sistem Keamanan Terpusat Flora-V Care</span><span>● Akses khusus petugas terdaftar</span></div>
        <section class="admin-auth-card" aria-labelledby="admin-title">
            <div class="admin-shield" aria-hidden="true">♧</div>
            <span class="form-eyebrow">Portal administrasi &amp; guru pendamping</span>
            <h1 id="admin-title">Masuk Portal Admin</h1>
            <p class="form-intro">Khusus untuk Guru Pendamping SMK Arga Husada, Tim Peneliti STIKes Karya Husada, dan Tenaga UKS terdaftar.</p>

            <x-auth-session-status class="auth-status" :status="session('status')" />

            <form method="POST" action="{{ route('admin.login') }}" class="auth-form admin-form" aria-label="Masuk administrator">
                @csrf
                <div class="form-field">
                    <label for="username">Nama Pengguna Administrator</label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required autofocus aria-describedby="username-error">
                    <x-input-error id="username-error" :messages="$errors->get('username')" class="field-error" />
                </div>
                <div class="form-field">
                    <label for="password">Kata Sandi Administrator</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required aria-describedby="password-error">
                    <x-input-error id="password-error" :messages="$errors->get('password')" class="field-error" />
                </div>
                <div class="security-callout"><span aria-hidden="true">✿</span><p><strong>Akses terbatas</strong><br>Hanya akun admin aktif yang dapat masuk. Kredensial yang salah akan menampilkan pesan umum.</p></div>
                <button class="button auth-submit" type="submit">Masuk ke Dasbor Admin <span aria-hidden="true">→</span></button>
            </form>

            <a class="admin-help" href="{{ route('login') }}">Masuk sebagai siswi di sini <span aria-hidden="true">→</span></a>
            <div class="admin-security-grid">
                <article><strong>Enkripsi</strong><p>Kata sandi disimpan dalam bentuk hash.</p></article>
                <article><strong>Audit Akses</strong><p>Akses admin dibatasi berdasarkan peran.</p></article>
                <article><strong>Privasi</strong><p>Jangan membagikan kredensial kepada siapa pun.</p></article>
            </div>
        </section>
        <a class="back-link admin-back" href="{{ route('home') }}"><span aria-hidden="true">←</span> Kembali ke Beranda Publik</a>
    </div>
</x-guest-layout>
