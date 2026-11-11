<x-admin-layout title="Profil Administrator" active="profile">
    <section class="admin-page-heading" style="margin-bottom: 24px;">
        <div>
            <span class="home-tag" style="margin-bottom: 8px;">
                <span>⚙️</span> AKUN &amp; PENGATURAN
            </span>
            <h1 class="home-title" style="font-family: 'Poppins', sans-serif; font-size: clamp(24px, 3vw, 32px); font-weight: 800; margin: 0 0 6px; letter-spacing: -0.5px;">
                Profil Administrator &amp; Keamanan
            </h1>
            <p style="font-size: 13.5px; color: var(--text-muted); margin: 0;">
                Kelola foto profil, informasi akun administrator, dan perbarui kata sandi dengan aman.
            </p>
        </div>
        <span class="home-tag" style="background: #eaf7ee; color: #166534; border-color: #bbf7d0;">
            ● Administrator Aktif
        </span>
    </section>

    @if (session('status'))
        <div class="card" style="padding: 14px 20px; border-radius: 16px; background: #eaf7ee; border: 1px solid #bbf7d0; color: #166534; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;" role="status">
            <span>✓</span>
            <span>
                @if (session('status') === 'avatar-updated')
                    Foto profil berhasil diperbarui!
                @elseif (session('status') === 'password-updated')
                    Kata sandi berhasil diperbarui!
                @else
                    Profil berhasil diperbarui.
                @endif
            </span>
        </div>
    @endif

    @if ($errors->any())
        <div class="card" style="padding: 14px 20px; border-radius: 16px; background: #fff1f2; border: 1px solid #fecdd3; color: #be123c; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;" role="alert">
            <span>⚠️</span>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: minmax(0, 1.8fr) minmax(280px, 1fr); gap: 24px; align-items: start;">
        
        <!-- KOLOM UTAMA (Foto, Informasi Akun, & Ubah Password) -->
        <div style="display: grid; gap: 24px;">
            
            <!-- SECTION 1: FOTO PROFIL & INFORMASI AKUN -->
            <section class="card" style="background: var(--surface); border-radius: 24px; padding: 28px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="margin-bottom: 20px;">
                    <span class="home-card-eyebrow">IDENTITAS ADMIN</span>
                    <h2 class="home-card-heading" style="margin: 0; font-size: 18px;">Informasi Akun & Foto Profil</h2>
                </div>

                <!-- Bagian Unggah Foto Profil -->
                <div style="display: flex; align-items: center; gap: 20px; padding: 18px; border-radius: 18px; background: var(--surface-2); border: 1px solid var(--border); margin-bottom: 24px; flex-wrap: wrap;">
                    <div style="position: relative; width: 76px; height: 76px; border-radius: 50%; overflow: hidden; border: 3px solid var(--surface); box-shadow: 0 4px 14px rgba(0,0,0,0.1); flex-shrink: 0;">
                        @if ($avatar = $user->avatarUrl())
                            <img src="{{ $avatar }}" alt="Foto profil {{ $user->name }}" style="width: 100%; height: 100%; object-fit: cover; object-position: center 20%;">
                        @else
                            <div style="width: 100%; height: 100%; background: #850d3d; color: white; display: grid; place-items: center; font-size: 26px; font-weight: 700;">
                                {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div style="flex: 1; min-width: 200px;">
                        <strong style="display: block; font-size: 14px; color: var(--heading); margin-bottom: 4px;">Ubah Foto Profil</strong>
                        <p style="margin: 0 0 10px; font-size: 12px; color: var(--text-muted); line-height: 1.5;">
                            Format yang didukung: JPG, PNG, atau WebP. Maksimal ukuran 2 MB.
                        </p>
                        <form id="admin-avatar-form" method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="admin-avatar-input" type="file" name="avatar" accept="image/jpeg,image/png,image/webp" style="display: none;" onchange="document.getElementById('admin-avatar-form').submit()">
                            <button type="button" onclick="document.getElementById('admin-avatar-input').click()" class="button button-outline" style="min-height: 36px; padding: 0 18px; font-size: 12px; border-radius: 99px; cursor: pointer;">
                                📷 Pilih Foto Baru
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Form Nama & Email -->
                <form method="POST" action="{{ route('profile.update') }}" style="display: grid; gap: 16px;">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="admin-name" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                            Nama Lengkap Administrator
                        </label>
                        <input id="admin-name" name="name" type="text" value="{{ old('name', $user->name) }}" maxlength="255" required style="width: 100%; height: 44px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                    </div>

                    <div>
                        <label for="admin-email" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                            Alamat Email
                        </label>
                        <input id="admin-email" name="email" type="email" value="{{ old('email', $user->email) }}" maxlength="255" required style="width: 100%; height: 44px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                    </div>

                    <div style="margin-top: 6px;">
                        <button class="button" type="submit" style="min-height: 42px; border-radius: 99px; padding: 0 24px; font-size: 13px; font-weight: 600;">
                            Simpan Profil 💾
                        </button>
                    </div>
                </form>
            </section>

            <!-- SECTION 2: PERBARUI KATA SANDI -->
            <section class="card" style="background: var(--surface); border-radius: 24px; padding: 28px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="margin-bottom: 20px;">
                    <span class="home-card-eyebrow">KEAMANAN AKSES</span>
                    <h2 class="home-card-heading" style="margin: 0; font-size: 18px;">Perbarui Kata Sandi Administrator</h2>
                    <p style="margin: 4px 0 0; font-size: 12.5px; color: var(--text-muted);">
                        Pastikan menggunakan kombinasi kata sandi yang aman dan tidak digunakan di situs lain.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.update') }}" style="display: grid; gap: 16px;">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                            Kata Sandi Saat Ini
                        </label>
                        <input id="current_password" name="current_password" type="password" autocomplete="current-password" required style="width: 100%; height: 44px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px;">
                        <div>
                            <label for="password" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                                Kata Sandi Baru
                            </label>
                            <input id="password" name="password" type="password" autocomplete="new-password" required style="width: 100%; height: 44px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                        </div>

                        <div>
                            <label for="password_confirmation" style="display: block; font-size: 12.5px; font-weight: 700; color: var(--heading); margin-bottom: 6px;">
                                Konfirmasi Kata Sandi Baru
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required style="width: 100%; height: 44px; border-radius: 12px; border: 1px solid var(--border); padding: 0 16px; font-size: 13.5px; background: var(--surface-2); color: var(--text); outline: none;">
                        </div>
                    </div>

                    <div style="margin-top: 6px;">
                        <button class="button" type="submit" style="min-height: 42px; border-radius: 99px; padding: 0 24px; font-size: 13px; font-weight: 600;">
                            Perbarui Kata Sandi 🔒
                        </button>
                    </div>
                </form>
            </section>

        </div>

        <!-- KOLOM KANAN (Riwayat Masuk & Tips Keamanan) -->
        <div style="display: grid; gap: 24px;">
            
            <section class="card" style="background: var(--surface); border-radius: 24px; padding: 24px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="margin-bottom: 16px;">
                    <span class="home-card-eyebrow">AUDIT SESI</span>
                    <h2 class="home-card-heading" style="margin: 0; font-size: 16px;">Riwayat Sesi Masuk</h2>
                </div>

                <div style="display: grid; gap: 10px;">
                    @forelse ($loginHistories as $history)
                        <div style="padding: 10px 14px; border-radius: 12px; background: var(--surface-2); border: 1px solid var(--border);">
                            <strong style="display: block; font-size: 12.5px; color: var(--heading); margin-bottom: 2px;">
                                {{ $history->logged_in_at?->timezone('Asia/Jakarta')->format('d M Y, H:i') ?? 'Waktu tidak tersedia' }} WIB
                            </strong>
                            <span style="font-size: 11px; color: var(--text-muted);">
                                {{ $history->logged_out_at ? 'Keluar: '.$history->logged_out_at->timezone('Asia/Jakarta')->format('d M Y, H:i').' WIB' : '● Sesi sedang aktif' }}
                            </span>
                        </div>
                    @empty
                        <p style="margin: 0; font-size: 12px; color: var(--text-muted);">Belum ada riwayat masuk tersimpan.</p>
                    @endforelse
                </div>
            </section>

            <section class="card" style="background: var(--surface); border-radius: 24px; padding: 24px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                    <span style="font-size: 20px;">🛡️</span>
                    <strong style="font-size: 14px; color: var(--heading);">Keamanan Data Penelitian</strong>
                </div>
                <p style="margin: 0; font-size: 12.5px; color: var(--text-muted); line-height: 1.6;">
                    Jangan bagikan kata sandi kepada siapa pun. Selalu gunakan perangkat tepercaya dan pastikan untuk menekan tombol <strong>Keluar</strong> setelah selesai mengelola konten atau meninjau aktivitas.
                </p>
            </section>

        </div>

    </div>
</x-admin-layout>
