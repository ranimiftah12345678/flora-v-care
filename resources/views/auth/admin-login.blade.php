<x-guest-layout>
    <x-slot name="title">Masuk Portal Admin</x-slot>

    <div class="admin-login-layout" style="padding: 20px 0 40px; max-width: 520px; margin: 0 auto;">
        <!-- Top Pill Meta -->
        <div style="display: flex; justify-content: center; margin-bottom: 24px;">
            <span class="home-tag">
                <span>🔐</span> SISTEM KEAMANAN TERPUSAT
            </span>
        </div>

        <section class="card" style="width: 100%; padding: clamp(28px, 5vw, 42px); border-radius: 28px; background: var(--surface); border: 1px solid var(--border); box-shadow: 0 16px 40px rgba(0, 0, 0, 0.06); text-align: center;">
            <div style="width: 52px; height: 52px; border-radius: 16px; background: rgba(168, 36, 63, 0.08); color: var(--primary); display: grid; place-items: center; font-size: 24px; margin: 0 auto 16px;">
                🏛️
            </div>

            <span class="home-card-eyebrow" style="margin-bottom: 8px;">
                PORTAL ADMINISTRASI
            </span>
            <h1 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(24px, 3.2vw, 32px); margin: 0 0 10px; font-weight: 800; letter-spacing: -0.5px;">
                Masuk Portal Admin
            </h1>
            <p style="font-size: 14px; line-height: 1.65; color: var(--text-muted); margin: 0 0 24px; max-width: 420px; margin-inline: auto;">
                Khusus untuk Guru Pendamping SMK Arga Husada, Tim Peneliti STIKes Karya Husada, dan Tenaga UKS terdaftar.
            </p>

            <x-auth-session-status class="auth-status" :status="session('status')" />

            <form method="POST" action="{{ route('admin.login') }}" class="auth-form admin-form" aria-label="Masuk administrator" style="text-align: left;">
                @csrf
                <div class="form-field" style="margin-bottom: 18px;">
                    <label for="username" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                        Nama Pengguna Administrator
                    </label>
                    <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required autofocus aria-describedby="username-error" style="width: 100%; height: 46px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 14px; background: var(--surface-2); color: var(--text); outline: none;">
                    <x-input-error id="username-error" :messages="$errors->get('username')" class="field-error" />
                </div>

                <div class="form-field" style="margin-bottom: 20px;">
                    <label for="password" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                        Kata Sandi Administrator
                    </label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required aria-describedby="password-error" style="width: 100%; height: 46px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 14px; background: var(--surface-2); color: var(--text); outline: none;">
                    <x-input-error id="password-error" :messages="$errors->get('password')" class="field-error" />
                </div>

                <div style="background: var(--surface-2); border: 1px solid var(--border); border-radius: 14px; padding: 12px 16px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                    <span style="font-size: 18px;">🛡️</span>
                    <p style="margin: 0; font-size: 12px; color: var(--text-muted); line-height: 1.5;">
                        <strong style="color: var(--heading);">Akses Terbatas:</strong> Hanya administrator aktif yang dapat masuk ke panel pengelolaan.
                    </p>
                </div>

                <button class="button auth-submit" type="submit" style="width: 100%; justify-content: center; min-height: 48px; border-radius: 99px; font-size: 14px; font-weight: 700;">
                    Masuk ke Dasbor Admin <span aria-hidden="true" style="margin-left: 6px;">→</span>
                </button>
            </form>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 28px; padding-top: 20px; border-top: 1px solid var(--border); text-align: center;">
                <article>
                    <strong style="display: block; font-size: 12px; color: var(--heading);">Enkripsi</strong>
                    <small style="font-size: 11px; color: var(--text-muted);">Hash SHA-256</small>
                </article>
                <article>
                    <strong style="display: block; font-size: 12px; color: var(--heading);">Audit</strong>
                    <small style="font-size: 11px; color: var(--text-muted);">Akses Terpantau</small>
                </article>
                <article>
                    <strong style="display: block; font-size: 12px; color: var(--heading);">Privasi</strong>
                    <small style="font-size: 11px; color: var(--text-muted);">Data Terlindungi</small>
                </article>
            </div>
        </section>

        <div style="text-align: center; margin-top: 20px;">
            <a class="button button-outline" href="{{ route('home') }}" style="border-radius: 99px; padding: 0 22px; min-height: 42px; font-size: 13px; font-weight: 600;">
                <span aria-hidden="true">←</span> Kembali ke Beranda Publik
            </a>
        </div>
    </div>
</x-guest-layout>
