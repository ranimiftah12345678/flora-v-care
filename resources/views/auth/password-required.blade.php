<x-guest-layout>
    <x-slot name="title">Perbarui Kata Sandi</x-slot>

    <div class="password-layout">
        <div class="login-meta"><span>♢ Sistem Keamanan Akun Flora-V Care</span><span>● Perbarui kata sandi untuk melindungi akun</span></div>
        <section class="password-card" aria-labelledby="password-title">
            <div class="admin-shield" aria-hidden="true">♧</div>
            <span class="form-eyebrow">Autentikasi &amp; keamanan akun</span>
            <h1 id="password-title">Perbarui Kata Sandi</h1>
            <p class="form-intro">Perbarui kata sandimu untuk menjaga keamanan dan privasi data pembelajaran.</p>

            <div class="login-notice"><span aria-hidden="true">✿</span><p><strong>Keamanan akun:</strong> Gunakan kata sandi yang kuat, unik, dan tidak dibagikan kepada siapa pun.</p></div>
            <x-auth-session-status class="auth-status" :status="session('status')" />

            <form method="POST" action="{{ route('password.update') }}" class="auth-form password-form">
                @csrf
                @method('PUT')
                <div class="form-field">
                    <label for="current_password">Kata Sandi Saat Ini <span>*</span></label>
                    <input id="current_password" name="current_password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi saat ini" required aria-describedby="current-password-error">
                    <x-input-error id="current-password-error" :messages="$errors->updatePassword->get('current_password')" class="field-error" />
                </div>
                <div class="form-field">
                    <label for="password">Kata Sandi Baru <span>*</span></label>
                    <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Minimal 8 karakter" required aria-describedby="password-error">
                    <x-input-error id="password-error" :messages="$errors->updatePassword->get('password')" class="field-error" />
                </div>
                <div class="password-rules"><span>○ Minimal 8 karakter</span><span>○ Kombinasi huruf besar &amp; kecil</span><span>○ Mengandung angka</span><span>○ Gunakan kata sandi unik</span></div>
                <div class="form-field">
                    <label for="password_confirmation">Konfirmasi Kata Sandi Baru <span>*</span></label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Ketik ulang kata sandi baru" required>
                </div>
                <button class="button auth-submit" type="submit">Simpan Kata Sandi Baru <span aria-hidden="true">→</span></button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="auth-form">
                @csrf
                <button class="admin-help" type="submit">Keluar dari akun <span aria-hidden="true">→</span></button>
            </form>
            <div class="security-callout"><span aria-hidden="true">✿</span><p>Setelah tersimpan, gunakan kata sandi baru untuk masuk ke akunmu.</p></div>
        </section>
    </div>
</x-guest-layout>
