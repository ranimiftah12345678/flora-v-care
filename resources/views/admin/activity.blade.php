<x-admin-layout title="Aktivitas dan Audit" active="activity">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">PEMANTAUAN / AKTIVITAS &amp; RIWAYAT</span><h1>Pemantauan Aktivitas &amp; Log</h1><p>Riwayat aktivitas aplikasi yang tersimpan untuk audit terbatas.</p></div><div class="admin-heading-actions"><span class="admin-chip">{{ $logs->total() }} catatan</span></div></section>
    <section class="admin-stat-grid admin-stat-grid-four"><article class="admin-stat-card"><span>Aktivitas hari ini</span><strong>{{ $todayCount }}</strong><small>Semua jenis pengguna</small></article><article class="admin-stat-card"><span>Pengguna hari ini</span><strong>{{ $userCount }}</strong><small>Pengguna dengan aktivitas</small></article><article class="admin-stat-card"><span>Jenis aktivitas</span><strong>{{ $actions->count() }}</strong><small>Aksi tercatat</small></article><article class="admin-stat-card"><span>Retensi</span><strong>Sesuai kebijakan</strong><small>Tetapkan sebelum penggunaan produksi</small></article></section>
    <section class="admin-panel">
        <form class="admin-filter-row" method="GET" action="{{ route('admin.activity') }}">
            <label for="activity-search">Cari aktivitas</label>
            <input id="activity-search" class="admin-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Nama pengguna atau keterangan">
            <select name="action" aria-label="Jenis aktivitas">
                <option value="">Semua jenis</option>
                @foreach ($actions as $action)
                    <option value="{{ $action }}" @selected(request('action') === $action)>{{ str_replace('_', ' ', ucfirst($action)) }}</option>
                @endforeach
            </select>
            <label for="activity-from">Dari</label>
            <input id="activity-from" type="date" name="from" value="{{ request('from') }}">
            <label for="activity-to">Sampai</label>
            <input id="activity-to" type="date" name="to" value="{{ request('to') }}">
            <button class="admin-button admin-button-outline" type="submit">Filter</button>
        </form>
        <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Waktu</th><th>Pengguna</th><th>Peran</th><th>Aktivitas</th><th>Keterangan</th></tr></thead><tbody>
            @forelse ($logs as $log)
                <tr><td>{{ $log->created_at->format('d M Y H:i:s') }}</td><td>{{ $log->user?->name ?? 'Tidak diketahui' }}</td><td>{{ $log->user?->role ?? '—' }}</td><td>{{ str_replace('_', ' ', ucfirst($log->action)) }}</td><td>{{ $log->description ?? '—' }}</td></tr>
            @empty
                <tr><td colspan="5">Tidak ada aktivitas pada filter ini.</td></tr>
            @endforelse
        </tbody></table></div>
        <div class="admin-pagination">{{ $logs->links() }}</div>
    </section>
    <aside class="admin-callout"><strong>Perlindungan log</strong><p>Log dapat memuat metadata sensitif. Batasi akses administrator, tentukan masa retensi, dan jangan tampilkan alamat IP pada laporan umum.</p></aside>
</x-admin-layout>
