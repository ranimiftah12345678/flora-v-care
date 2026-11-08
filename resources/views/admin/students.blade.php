<x-admin-layout title="Manajemen Data Siswi" active="students">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">AKUN PESERTA</span><h1>Manajemen Data Siswi</h1><p>Akun siswi tidak dapat dihapus. Nonaktifkan akun untuk mencabut akses.</p></div><div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="#impor-siswi">Impor Excel</a><a class="admin-button" href="{{ route('admin.students.create') }}">＋ Tambah siswi</a></div></section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if (session('temporary_password'))<section class="admin-feedback admin-temporary-password" role="status"><strong>Sandi sementara (hanya tampil sekali):</strong><code>{{ session('temporary_password') }}</code><span>Salin dan sampaikan melalui kanal aman. Siswi wajib menggantinya saat masuk.</span></section>@endif
    <section class="admin-stat-grid admin-stat-grid-four"><article class="admin-stat-card"><span>Total akun siswi</span><strong>{{ $students->total() }}</strong></article><article class="admin-stat-card"><span>Akun aktif</span><strong>{{ $activeCount }}</strong></article><article class="admin-stat-card"><span>Akun nonaktif</span><strong>{{ $inactiveCount }}</strong></article><article class="admin-stat-card"><span>Penghapusan</span><strong>Dinonaktifkan</strong><small>Untuk menjaga jejak data</small></article></section>
    <section class="admin-panel">
        <form id="impor-siswi" class="admin-form" method="POST" action="{{ route('admin.students.import') }}" enctype="multipart/form-data">
            @csrf
            <h2>Impor akun siswi</h2>
            <p class="admin-muted">Kolom wajib: name, username, email, password, inisial, kelas, usia, sekolah. Sandi pada file minimal 12 karakter dan akan diwajibkan berubah saat login.</p>
            <label for="student-import-file">File Excel atau CSV</label><input id="student-import-file" name="file" type="file" accept=".xlsx,.xls,.csv" required>
            @error('file')<small class="admin-field-error">{{ $message }}</small>@enderror
            <button class="admin-button admin-button-outline" type="submit">Impor siswi</button>
        </form>
        <form class="admin-filter-row" method="GET" action="{{ route('admin.students') }}"><label for="student-search">Cari siswi</label><input id="student-search" class="admin-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Nama, username, sekolah"><select name="status" aria-label="Status akun"><option value="">Semua status</option><option value="active" @selected(request('status') === 'active')>Aktif</option><option value="inactive" @selected(request('status') === 'inactive')>Nonaktif</option></select><button class="admin-button admin-button-outline" type="submit">Filter</button></form>
        <div class="admin-table-wrap"><table class="admin-table admin-student-table"><thead><tr><th>Siswi</th><th>Inisial</th><th>Kelas</th><th>Usia</th><th>Sekolah</th><th>Aktivitas terakhir</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
            @forelse ($students as $student)
                <tr><td><strong>{{ $student->name }}</strong><small>{{ $student->username }}</small></td><td>{{ $student->studentProfile?->inisial ?? '—' }}</td><td>{{ $student->studentProfile?->kelas ?? '—' }}</td><td>{{ $student->studentProfile?->usia ?? '—' }}</td><td>{{ $student->studentProfile?->sekolah ?? '—' }}</td><td>{{ $student->last_activity_at?->diffForHumans() ?? 'Belum aktif' }}</td><td><span class="admin-status {{ $student->is_active ? '' : 'admin-status-soft' }}">{{ $student->is_active ? 'Aktif' : 'Nonaktif' }}</span></td><td><div class="admin-row-actions"><a class="admin-text-link" href="{{ route('admin.student-detail', $student) }}">Detail</a><a class="admin-text-link" href="{{ route('admin.students.edit', $student) }}">Ubah</a><form method="POST" action="{{ route('admin.students.status', $student) }}">@csrf @method('PATCH')<input type="hidden" name="is_active" value="{{ $student->is_active ? 0 : 1 }}"><button class="admin-text-button" type="submit">{{ $student->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button></form></div></td></tr>
            @empty
                <tr><td colspan="8">Belum ada akun siswi.</td></tr>
            @endforelse
        </tbody></table></div>
        <div class="admin-pagination">{{ $students->links() }}</div>
    </section>
    <aside class="admin-callout"><strong>Privasi siswi</strong><p>Gunakan data hanya untuk kebutuhan pendidikan yang disetujui. Akun dihapus dengan menonaktifkannya, bukan menghapus riwayat secara permanen.</p></aside>
</x-admin-layout>
