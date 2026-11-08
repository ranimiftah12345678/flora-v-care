<x-student-layout title="Profil Siswi" active="profile">
    <div class="student-container student-page student-profile-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><span>Profil dan pengaturan</span></nav>
        <section class="profile-hero"><span class="student-eyebrow"><span class="status-dot"></span> Akun Flora-V Care</span><h1>Profil &amp; Pengaturan Akun</h1><p>Kelola informasi akun yang tersedia dan periksa pengaturan privasimu.</p></section>

        <section class="profile-summary">
            <span class="profile-large-avatar">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
            <div class="profile-name"><span class="student-eyebrow">Akun belajar</span><h2>{{ $user->name }}</h2><p>{{ $user->email }}</p><span class="preview-pill">Profil siswi belum terhubung</span></div>
            <div class="profile-summary-stat"><span>Profil sekolah</span><strong>Belum tersedia</strong><small>Belum tersimpan</small></div>
            <div class="profile-summary-stat"><span>Aktivitas belajar</span><strong>—</strong><small>Belum tercatat</small></div>
            <div class="profile-summary-stat"><span>Sesi belajar</span><strong>Aktif</strong><small>Akun ini</small></div>
        </section>

        <div class="profile-settings-grid">
            <div class="profile-settings-main">
                <section class="student-card profile-edit-card">
                    <div class="student-section-heading"><div><span class="student-eyebrow">Informasi akun</span><h2>Data Akun yang Tersedia</h2></div><span class="preview-pill">Dapat diperbarui</span></div>
                    <aside class="student-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Profil siswi belum tersimpan</strong><p>Aplikasi saat ini hanya mengelola nama dan email akun. NIS, usia, kelas, jurusan, dan data profil lainnya belum terhubung.</p></div></aside>
                    <div class="profile-edit-form">@include('profile.partials.update-profile-information-form')</div>
                </section>

                <section class="student-card profile-privacy-card">
                    <div class="student-section-heading"><div><span class="student-eyebrow">Kendalikan data</span><h2>Privasi &amp; Preferensi</h2></div><span class="outline-icon" aria-hidden="true">♧</span></div>
                    <div class="privacy-preference-notice"><strong>Pengaturan berikut belum tersedia</strong><p>Preferensi komunikasi, pengingat belajar, dan pengelolaan persetujuan belum diaktifkan. Tidak ada perubahan yang disimpan dari panel ini.</p></div>
                    <label class="preference-row"><span><strong>Pengingat pembelajaran</strong><small>Atur pemberitahuan tentang aktivitas materi belajar.</small></span><input type="checkbox" disabled aria-label="Pengingat pembelajaran belum tersedia"></label>
                    <label class="preference-row"><span><strong>Ringkasan perkembangan belajar</strong><small>Lihat ringkasan progres materi yang telah dipelajari.</small></span><input type="checkbox" disabled aria-label="Ringkasan perkembangan belum tersedia"></label>
                    <label class="preference-row"><span><strong>Informasi edukasi pilihan</strong><small>Preferensi informasi edukasi yang ingin kamu lihat.</small></span><input type="checkbox" disabled aria-label="Preferensi edukasi belum tersedia"></label>
                    <a class="student-text-link" href="{{ route('privacy') }}">Baca kebijakan privasi <span aria-hidden="true">→</span></a>
                </section>
            </div>

            <aside class="profile-settings-side">
                <section class="student-card password-settings-card"><span class="student-eyebrow">Keamanan akun</span><h2>Perbarui kata sandi</h2><p>Gunakan kata sandi yang kuat dan tidak dibagikan dengan orang lain.</p>@include('profile.partials.update-password-form')</section>
                <section class="student-card session-history-card"><div class="student-section-heading"><div><span class="student-eyebrow">Riwayat keamanan</span><h2>Sesi masuk terakhir</h2></div><span class="preview-pill">Pratinjau</span></div><div class="empty-state"><span class="empty-state-icon">◷</span><strong>Riwayat sesi belum tersedia</strong><p>Daftar perangkat atau aktivitas masuk belum dicatat oleh aplikasi.</p></div><a class="student-text-link" href="{{ route('privacy') }}">Tentang data sesi <span aria-hidden="true">→</span></a></section>
            </aside>
        </div>

        <section class="student-card profile-delete-card"><span class="student-eyebrow">Tutup akun</span><h2>Penghapusan akun</h2><p>Penghapusan akun bersifat permanen. Pastikan kamu memahami dampaknya sebelum melanjutkan.</p>@include('profile.partials.delete-user-form')</section>
        <div class="lesson-pager"><a class="button button-outline" href="{{ route('dashboard') }}"><span aria-hidden="true">←</span> Kembali ke Dasbor</a><a class="button" href="{{ route('privacy') }}">Baca panduan privasi <span aria-hidden="true">→</span></a></div>
    </div>
</x-student-layout>
