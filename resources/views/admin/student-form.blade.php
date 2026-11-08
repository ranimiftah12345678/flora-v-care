<x-admin-layout title="{{ $student->exists ? 'Ubah Data Siswi' : 'Tambah Siswi' }}" active="students">
    <div class="admin-breadcrumb"><a href="{{ route('admin.students') }}">Siswi</a><span>/</span><span>{{ $student->exists ? 'Ubah' : 'Tambah' }}</span></div>
    <section class="admin-page-heading"><div><span class="admin-eyebrow">DATA PESERTA</span><h1>{{ $student->exists ? 'Ubah Data Siswi' : 'Tambah Siswi' }}</h1><p>Akun baru menerima sandi sementara dan wajib menggantinya saat masuk pertama kali.</p></div></section>
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if (session('temporary_password'))<section class="admin-feedback admin-temporary-password" role="status"><strong>Sandi sementara (hanya tampil sekali):</strong><code>{{ session('temporary_password') }}</code><span>Salin dan sampaikan melalui kanal aman.</span></section>@endif
    <form class="admin-panel admin-form" method="POST" action="{{ $student->exists ? route('admin.students.update', $student) : route('admin.students.store') }}">
        @csrf @if ($student->exists) @method('PATCH') @endif
        <label for="name">Nama</label><input id="name" name="name" value="{{ old('name', $student->name) }}" required maxlength="255">
        <label for="username">Username</label><input id="username" name="username" value="{{ old('username', $student->username) }}" required minlength="3" maxlength="50" pattern="[A-Za-z0-9._-]+">
        <label for="email">Email (opsional)</label><input id="email" name="email" type="email" value="{{ old('email', $student->email) }}" maxlength="255">
        <div class="admin-form-grid">
            <div><label for="inisial">Inisial</label><input id="inisial" name="inisial" value="{{ old('inisial', $student->studentProfile?->inisial) }}" required maxlength="10"></div>
            <div><label for="kelas">Kelas</label><select id="kelas" name="kelas" required>@foreach (['X', 'XI', 'XII'] as $grade)<option value="{{ $grade }}" @selected(old('kelas', $student->studentProfile?->kelas) === $grade)>{{ $grade }}</option>@endforeach</select></div>
            <div><label for="usia">Usia</label><input id="usia" name="usia" type="number" min="10" max="25" value="{{ old('usia', $student->studentProfile?->usia) }}" required></div>
        </div>
        <label for="sekolah">Sekolah</label><input id="sekolah" name="sekolah" value="{{ old('sekolah', $student->studentProfile?->sekolah) }}" required maxlength="150">
        <div class="admin-form-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.students') }}">Kembali</a><button class="admin-button" type="submit">Simpan data siswi</button></div>
    </form>
    @if ($student->exists)
        <section class="admin-panel admin-account-actions">
            <h2>Akses akun</h2>
            <form method="POST" action="{{ route('admin.students.status', $student) }}">@csrf @method('PATCH')<input type="hidden" name="is_active" value="{{ $student->is_active ? 0 : 1 }}"><button class="admin-button admin-button-outline" type="submit">{{ $student->is_active ? 'Nonaktifkan akun' : 'Aktifkan akun' }}</button></form>
            <form method="POST" action="{{ route('admin.students.reset-password', $student) }}" onsubmit="return confirm('Buat sandi sementara baru dan keluarkan semua sesi siswi?')">@csrf<button class="admin-button" type="submit">Atur ulang sandi sementara</button></form>
            <p class="admin-muted">Akun tidak dapat dihapus. Pengaturan ulang sandi mengeluarkan sesi aktif dan mewajibkan sandi baru.</p>
        </section>
    @endif
</x-admin-layout>
