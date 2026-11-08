<x-admin-layout title="Profil Administrator" active="profile">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">AKUN &amp; PENGATURAN / PROFIL</span><h1>Profil Administrator &amp; Keamanan</h1><p>Perbarui informasi akun dan tinjau riwayat sesi masuk.</p></div><span class="admin-status">Administrator aktif</span></section>
    @if (session('status'))<div class="admin-feedback" role="status">Profil berhasil diperbarui.</div>@endif
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <div class="admin-profile-grid">
        <div class="admin-editor-main">
            <section class="admin-panel admin-form"><div class="admin-panel-heading"><div><span class="admin-eyebrow">PROFIL ADMIN</span><h2>Informasi akun</h2></div><span class="admin-profile-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span></div>
                <form method="POST" action="{{ route('profile.update') }}">@csrf @method('PATCH')
                    <label for="admin-name">Nama tampilan</label><input id="admin-name" name="name" type="text" value="{{ old('name', $user->name) }}" maxlength="255" required>
                    <label for="admin-email">Email</label><input id="admin-email" name="email" type="email" value="{{ old('email', $user->email) }}" maxlength="255" required>
                    <button class="admin-button" type="submit">Simpan profil</button>
                </form>
            </section>
            <section class="admin-panel admin-form"><span class="admin-eyebrow">KEAMANAN AKUN</span><h2>Perbarui kata sandi</h2><form method="POST" action="{{ route('password.update') }}">@csrf @method('PUT')
                <label for="current_password">Kata sandi saat ini</label><input id="current_password" name="current_password" type="password" autocomplete="current-password" required>
                <label for="password">Kata sandi baru</label><input id="password" name="password" type="password" autocomplete="new-password" required>
                <label for="password_confirmation">Konfirmasi kata sandi baru</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required>
                <button class="admin-button" type="submit">Perbarui kata sandi</button>
            </form></section>
        </div>
        <aside class="admin-editor-side"><section class="admin-panel"><span class="admin-eyebrow">RIWAYAT MASUK</span><h2>Sesi terakhir</h2>
            @forelse ($loginHistories as $history)
                <p><strong>{{ $history->logged_in_at?->format('d M Y H:i') ?? 'Waktu tidak tersedia' }}</strong><br><span class="admin-muted">{{ $history->logged_out_at ? 'Keluar '.$history->logged_out_at->format('d M Y H:i') : 'Sesi belum ditutup' }}</span></p>
            @empty
                <p class="admin-muted">Belum ada riwayat masuk tersimpan.</p>
            @endforelse
        </section><section class="admin-callout"><strong>Keamanan akun</strong><p>Jangan bagikan kata sandi. Gunakan perangkat tepercaya dan keluar setelah selesai mengelola data penelitian.</p></section></aside>
    </div>
</x-admin-layout>
