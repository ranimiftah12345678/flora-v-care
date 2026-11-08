<x-admin-layout title="Laporan dan Ekspor" active="reports">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">LAPORAN &amp; REKAPITULASI</span><h1>Pusat Laporan &amp; Ekspor</h1><p>Rekap hanya mencakup siswi dengan pretest dan posttest yang sudah dikirim.</p></div><div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.reports.excel', request()->query()) }}">Unduh Excel</a><a class="admin-button" href="{{ route('admin.reports.pdf', request()->query()) }}">Unduh PDF</a></div></section>
    <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">FILTER DATA</span><h2>Parameter Laporan</h2></div></div>
        <form class="admin-filter-row" method="GET" action="{{ route('admin.reports') }}"><label for="report-search">Cari siswi</label><input id="report-search" class="admin-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Nama atau inisial"><select name="kelas" aria-label="Filter kelas"><option value="">Semua kelas</option>@foreach (['X', 'XI', 'XII'] as $class)<option value="{{ $class }}" @selected(request('kelas') === $class)>{{ $class }}</option>@endforeach</select><button class="admin-button admin-button-outline" type="submit">Terapkan</button></form>
    </section>
    <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">DATA AKTUAL</span><h2>Ringkasan per Kelas</h2></div></div><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Kelas</th><th>Jumlah pasangan</th><th>Rerata pretest</th><th>Rerata posttest</th></tr></thead><tbody>
        @forelse ($classSummaries as $class => $summary)
            <tr><td>{{ $class }}</td><td>{{ $summary['count'] }}</td><td>{{ $summary['pretest'] }}</td><td>{{ $summary['posttest'] }}</td></tr>
        @empty
            <tr><td colspan="4">Belum ada data berpasangan.</td></tr>
        @endforelse
    </tbody></table></div></section>
    <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">EKSPOR TERKENDALI</span><h2>Unduh data berpasangan</h2></div></div><p>Spreadsheet menyertakan inisial, kelas, usia, skor, dan waktu pengiriman; tidak mencantumkan nama atau username.</p><div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.reports.excel', request()->query()) }}">Ekspor Excel</a><a class="admin-button" href="{{ route('admin.reports.pdf', request()->query()) }}">Ekspor PDF</a></div></section>
    <aside class="admin-callout"><strong>Analisis dan kerahasiaan</strong><p>Uji Wilcoxon berpasangan dan analisis item tersedia pada halaman hasil tes. Cocokkan hasil statistik dengan SPSS/JASP sebelum publikasi. Simpan ekspor sesuai prosedur perlindungan data penelitian.</p><a class="admin-text-link" href="{{ route('admin.paired-results') }}">Buka hasil dan analisis →</a></aside>
</x-admin-layout>
