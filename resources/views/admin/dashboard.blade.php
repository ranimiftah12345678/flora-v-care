<x-admin-layout title="Dasbor Administrator" active="dashboard">
    <section class="admin-page-heading">
        <div><span class="admin-eyebrow">PORTAL INTERVENSI TERPADU</span><h1>Dasbor Utama Administrator</h1><p>Ringkasan akun, konten terbit, evaluasi berpasangan, dan aktivitas aktual.</p></div>
        <div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.reports') }}">Lihat laporan ↗</a><a class="admin-button" href="{{ route('admin.students') }}">Daftar siswi</a></div>
    </section>
    <section class="admin-stat-grid" aria-label="Statistik aktual">
        <article class="admin-stat-card"><span>Total siswi</span><strong>{{ $studentCount }}</strong><small>{{ $activeStudentCount }} akun aktif</small></article>
        <article class="admin-stat-card"><span>Aktivitas hari ini</span><strong>{{ $activityCount }}</strong><small>{{ now()->format('d M Y') }}</small></article>
        <article class="admin-stat-card"><span>Hasil berpasangan</span><strong>{{ $pairedCount }}</strong><small>Pretest dan posttest lengkap</small></article>
        <article class="admin-stat-card"><span>Konten terbit</span><strong>{{ $publishedMaterialCount + $publishedVideoCount }}</strong><small>{{ $publishedMaterialCount }} materi · {{ $publishedVideoCount }} video</small></article>
    </section>
    <div class="admin-dashboard-grid">
        <section class="admin-panel">
            <div class="admin-panel-heading"><div><span class="admin-eyebrow">SKOR TERKIRIM</span><h2>Rerata Evaluasi</h2></div></div>
            <div class="admin-stat-grid"><article class="admin-stat-card"><span>Rerata pretest</span><strong>{{ $pretestAverage === null ? '—' : number_format($pretestAverage, 2) }}</strong></article><article class="admin-stat-card"><span>Rerata posttest</span><strong>{{ $posttestAverage === null ? '—' : number_format($posttestAverage, 2) }}</strong></article></div>
            <p class="admin-muted">Rerata dihitung dari tes yang sudah dikirim. Untuk perbandingan statistik gunakan pasangan data pada halaman hasil tes.</p>
        </section>
        <section class="admin-panel">
            <div class="admin-panel-heading"><div><span class="admin-eyebrow">ALUR BELAJAR</span><h2>Konten Terbit</h2></div></div>
            <div class="admin-progress-list"><div><span>Materi edukasi <b>{{ $publishedMaterialCount }}</b></span><i><em style="width: {{ $publishedMaterialCount ? 100 : 0 }}%"></em></i></div><div><span>Video <b>{{ $publishedVideoCount }}</b></span><i><em style="width: {{ $publishedVideoCount ? 100 : 0 }}%"></em></i></div></div>
            <a class="admin-text-link" href="{{ route('admin.materials') }}">Kelola konten →</a>
        </section>
    </div>
    <section class="admin-panel">
        <div class="admin-panel-heading"><div><span class="admin-eyebrow">LOG TERSIMPAN</span><h2>Aktivitas Terbaru</h2></div><a class="admin-text-link" href="{{ route('admin.activity') }}">Buka semua aktivitas →</a></div>
        <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Pengguna</th><th>Aktivitas</th><th>Keterangan</th><th>Waktu</th></tr></thead><tbody>
            @forelse ($recentActivities as $activity)
                <tr><td>{{ $activity->user?->name ?? 'Tidak diketahui' }}</td><td>{{ str_replace('_', ' ', ucfirst($activity->action)) }}</td><td>{{ $activity->description ?? '—' }}</td><td>{{ $activity->created_at->format('d M Y H:i') }}</td></tr>
            @empty
                <tr><td colspan="4">Belum ada aktivitas.</td></tr>
            @endforelse
        </tbody></table></div>
    </section>
</x-admin-layout>
