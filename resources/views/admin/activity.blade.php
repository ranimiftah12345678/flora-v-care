<x-admin-layout title="Aktivitas Portal" active="activity">
    <section class="admin-page-heading">
        <div>
            <span class="admin-eyebrow">AUDIT &amp; ANALISIS KUNJUNGAN</span>
            <h1>Log Aktivitas Portal</h1>
            <p>Catatan kunjungan edukasi halaman dan pemutaran video tanpa menyimpan identitas pribadi responden.</p>
        </div>
        <div class="admin-heading-actions">
            <span class="preview-pill" style="font-weight: 600;">
                Hari Ini: {{ $todayCount }} Catatan
            </span>
        </div>
    </section>

    <!-- Filter Pencarian & Tanggal -->
    <section class="admin-panel">
        <div class="admin-panel-heading">
            <div>
                <span class="admin-eyebrow">FILTER LOG</span>
                <h2>Pencarian dan Rentang Tanggal</h2>
            </div>
        </div>

        <form class="admin-filter-row" method="GET" action="{{ route('admin.activity') }}">
            <input class="admin-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Cari halaman, video, atau aksi...">
            
            <select name="action" aria-label="Filter kategori aksi">
                <option value="">Semua Kategori</option>
                @foreach ($actions as $act)
                    <option value="{{ $act }}" @selected(request('action') === $act)>
                        {{ str_replace('_', ' ', strtoupper($act)) }}
                    </option>
                @endforeach
            </select>

            <input class="admin-search-input" type="date" name="from" value="{{ request('from') }}" title="Tanggal awal">
            <input class="admin-search-input" type="date" name="to" value="{{ request('to') }}" title="Tanggal akhir">

            <button class="admin-button admin-button-outline" type="submit">Terapkan</button>
            @if (request()->hasAny(['q', 'action', 'from', 'to']))
                <a class="admin-button admin-button-outline" href="{{ route('admin.activity') }}">Reset</a>
            @endif
        </form>
    </section>

    <!-- Tabel Log Aktivitas (Mobile Scrollable) -->
    <section class="admin-panel">
        <div class="admin-table-wrap" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="admin-table" style="min-width: 800px;">
                <thead>
                    <tr>
                        <th style="width: 160px;">Waktu (WIB)</th>
                        <th style="width: 220px;">Pengunjung / Akun</th>
                        <th style="width: 150px;">Kategori Aksi</th>
                        <th>Keterangan Aktivitas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td style="white-space: nowrap; font-size: 12.5px; color: var(--text-muted);">
                                {{ $log->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i:s') }}
                            </td>
                            <td>
                                @if ($log->user)
                                    <div style="font-weight: 600; color: var(--wine);">
                                        {{ $log->user->name }}
                                        <span style="font-size: 10px; background: rgba(162, 14, 73, 0.1); color: var(--wine); padding: 2px 6px; border-radius: 4px; margin-left: 4px;">{{ strtoupper($log->user->role) }}</span>
                                    </div>
                                    <div style="font-size: 11.5px; color: var(--text-muted);">{{ $log->user->email }}</div>
                                @elseif ($log->visitor_name || $log->visitor_email)
                                    <div style="font-weight: 600; color: var(--text);">
                                        {{ $log->visitor_name ?: 'Pengunjung Web' }}
                                    </div>
                                    <div style="font-size: 11.5px; color: var(--wine);">{{ $log->visitor_email ?: '—' }}</div>
                                @else
                                    <span style="font-size: 12px; color: var(--text-muted); font-style: italic;">Tamu Anonim</span>
                                @endif
                            </td>
                            <td>
                                <span class="admin-status" style="font-size: 11px;">
                                    {{ str_replace('_', ' ', strtoupper($log->action)) }}
                                </span>
                            </td>
                            <td style="font-size: 13.5px; color: var(--text);">
                                {{ $log->description ?: '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="admin-muted" style="text-align: center; padding: 24px;">
                                Belum ada aktivitas yang sesuai dengan filter pencarian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top: 18px;">
            {{ $logs->links() }}
        </div>
    </section>
</x-admin-layout>
