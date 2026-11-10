<x-student-layout title="Profil Siswi" active="profile">
    <div class="student-container student-page student-profile-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><span>Profil dan pengaturan</span></nav>
        <section class="profile-hero"><span class="student-eyebrow"><span class="status-dot"></span> Akun Flora-V Care</span><h1>Profil &amp; Pengaturan Akun</h1><p>Kelola informasi akun yang tersedia dan periksa pengaturan privasimu.</p></section>

        @if (session('status') === 'avatar-updated')<div class="auth-status" role="status">Foto profil berhasil diperbarui.</div>@endif
        <section class="profile-summary">
            <form id="avatar-form" method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data">
                @csrf
                <label class="avatar-upload" for="avatar-input" title="Ubah foto profil">
                    @if ($avatar = $user->avatarUrl())
                        <img src="{{ $avatar }}" alt="Foto profil {{ $user->name }}" class="profile-avatar-photo">
                    @else
                        <span class="profile-large-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                    @endif
                    <span class="avatar-upload-hint"><span aria-hidden="true">✎</span> Ubah foto</span>
                </label>
                <input id="avatar-input" type="file" name="avatar" accept="image/jpeg,image/png,image/webp" hidden onchange="document.getElementById('avatar-form').submit()">
            </form>
            <div class="profile-name"><span class="student-eyebrow">Akun belajar</span><h2>{{ $user->name }}</h2><p>{{ $user->email }}</p><span class="preview-pill">{{ $user->studentProfile?->inisial ?? '—' }} · Kelas {{ $user->studentProfile?->kelas ?? '—' }}</span></div>
            <div class="profile-summary-stat"><span>Profil sekolah</span><strong>{{ $user->studentProfile?->sekolah ?? '—' }}</strong><small>Usia {{ $user->studentProfile?->usia ?? '—' }} tahun</small></div>
            <div class="profile-summary-stat"><span>Aktivitas belajar</span><strong>{{ $user->last_activity_at?->timezone('Asia/Jakarta')->translatedFormat('d M Y H:i') ?? '—' }}</strong><small>Terakhir tercatat · WIB</small></div>
            <div class="profile-summary-stat"><span>Sesi belajar</span><strong>Aktif</strong><small>Akun ini</small></div>
        </section>

        <div class="profile-settings-grid">
            <div class="profile-settings-main">
                <section class="student-card profile-edit-card">
                    <div class="student-section-heading"><div><span class="student-eyebrow">Informasi akun</span><h2>Data Akun yang Tersedia</h2></div><span class="preview-pill">Dapat diperbarui</span></div>
                    <aside class="student-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Profil siswi tersimpan</strong><p>Aplikasi menyimpan inisial, kelas, usia, dan sekolah yang didaftarkan saat pembuatan akun. Perubahan data profil dilakukan melalui guru pendamping atau administrator.</p></div></aside>
                    <div class="profile-edit-form">@include('profile.partials.update-profile-information-form')</div>
                </section>
            </div>

            <aside class="profile-settings-side">
                <section class="student-card password-settings-card"><span class="student-eyebrow">Keamanan akun</span><h2>Perbarui kata sandi</h2><p>Gunakan kata sandi yang kuat dan tidak dibagikan dengan orang lain.</p>@include('profile.partials.update-password-form')</section>
                <section class="student-card session-history-card"><div class="student-section-heading"><div><span class="student-eyebrow">Riwayat keamanan</span><h2>Sesi masuk terakhir</h2></div><span class="preview-pill">Tersimpan</span></div>@if ($loginHistories->isNotEmpty())<div class="lesson-list">@foreach ($loginHistories as $history)<div class="lesson-list-item"><span aria-hidden="true">◷</span><span><strong>{{ $history->logged_in_at->timezone('Asia/Jakarta')->translatedFormat('d M Y H:i') }} WIB</strong><small>Masuk berhasil · IP {{ $history->ip_address ?? 'tidak tercatat' }}</small></span><b>Berhasil</b></div>@endforeach</div>@else<div class="empty-state"><span class="empty-state-icon">◷</span><strong>Belum ada riwayat masuk</strong><p>Riwayat sesi akan tampil setelah kamu masuk kembali.</p></div>@endif<a class="student-text-link" href="{{ route('privacy') }}">Tentang data sesi <span aria-hidden="true">→</span></a></section>
            </aside>
        </div>

        <section class="student-card profile-delete-card"><span class="student-eyebrow">Tutup akun</span><h2>Penghapusan akun</h2><p>Penghapusan akun bersifat permanen. Pastikan kamu memahami dampaknya sebelum melanjutkan.</p>@include('profile.partials.delete-user-form')</section>
        <div class="lesson-pager"><a class="button button-outline" href="{{ route('dashboard') }}"><span aria-hidden="true">←</span> Kembali ke Dasbor</a><a class="button" href="{{ route('privacy') }}">Baca panduan privasi <span aria-hidden="true">→</span></a></div>
    </div>
</x-student-layout>
