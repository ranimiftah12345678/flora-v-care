<x-admin-layout title="Analisis Hasil Tes" active="results">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">TES &amp; EVALUASI / DATA BERPASANGAN</span><h1>Hasil Evaluasi &amp; Analisis Data</h1><p>Menampilkan siswi yang telah menyelesaikan pretest dan posttest. Skor dihitung dari jawaban yang tersimpan.</p></div><div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.reports.excel', request()->query()) }}">Ekspor Excel</a><a class="admin-button" href="{{ route('admin.reports.pdf', request()->query()) }}">Ekspor PDF</a></div></section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    <section class="admin-stat-grid admin-stat-grid-four"><article class="admin-stat-card"><span>Pasangan data</span><strong>{{ $rows->count() }}</strong><small>Pretest dan posttest lengkap</small></article><article class="admin-stat-card"><span>Rerata pretest</span><strong>{{ $meanPretest ?? '—' }}</strong><small>Skor aktual</small></article><article class="admin-stat-card"><span>Rerata posttest</span><strong>{{ $meanPosttest ?? '—' }}</strong><small>Skor aktual</small></article><article class="admin-stat-card"><span>Rerata perubahan</span><strong>{{ $meanDifference === null ? '—' : ($meanDifference > 0 ? '+' : '').$meanDifference }}</strong><small>Posttest dikurangi pretest</small></article></section>
    <section class="admin-panel">
        <form class="admin-filter-row" method="GET" action="{{ route('admin.paired-results') }}"><label for="result-search">Cari siswi</label><input id="result-search" class="admin-search-input" type="search" name="q" value="{{ request('q') }}" placeholder="Nama atau inisial"><select name="kelas" aria-label="Filter kelas"><option value="">Semua kelas</option>@foreach (['X', 'XI', 'XII'] as $class)<option value="{{ $class }}" @selected(request('kelas') === $class)>{{ $class }}</option>@endforeach</select><button class="admin-button admin-button-outline" type="submit">Filter</button></form>
        <div class="admin-panel-heading"><div><span class="admin-eyebrow">DATA BERPASANGAN</span><h2>Ringkasan Responden</h2></div></div>
        <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Inisial</th><th>Kelas</th><th>Usia</th><th>Pretest</th><th>Posttest</th><th>Selisih</th><th>Waktu selesai</th><th>Detail</th></tr></thead><tbody>
            @forelse ($rows as $row)
                <tr><td>{{ $row['inisial'] ?: '—' }}</td><td>{{ $row['kelas'] }}</td><td>{{ $row['usia'] ?? '—' }}</td><td>{{ $row['pretest'] }}</td><td>{{ $row['posttest'] }}</td><td>{{ $row['difference'] > 0 ? '+' : '' }}{{ $row['difference'] }}</td><td>{{ $row['posttest_at'] }}</td><td><a class="admin-text-link" href="{{ route('admin.student-detail', $row['user_id']) }}">Buka detail</a></td></tr>
            @empty
                <tr><td colspan="8">Belum ada data pretest dan posttest yang berpasangan.</td></tr>
            @endforelse
        </tbody></table></div>
    </section>
    <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">ANALISIS PER PERTANYAAN</span><h2>Rerata Skor Item</h2></div></div><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Pertanyaan</th><th>Domain</th><th>Rerata pretest</th><th>Rerata posttest</th><th>Jumlah respons</th></tr></thead><tbody>
        @forelse ($itemAnalysis as $item)
            <tr><td>{{ $item['question']->question_text }}</td><td>{{ ucfirst($item['question']->aspect ?? '—') }}</td><td>{{ $item['pretest'] ?? '—' }}</td><td>{{ $item['posttest'] ?? '—' }}</td><td>{{ $item['responses'] }}</td></tr>
        @empty
            <tr><td colspan="5">Belum ada respons untuk dianalisis.</td></tr>
        @endforelse
    </tbody></table></div></section>
    <section class="admin-panel"><span class="admin-eyebrow">UJI WILCOXON BERPASANGAN</span><h2>Pretest vs. Posttest</h2>
        @if ($wilcoxon['n'] > 0)
            <p>Pasangan dengan selisih bukan nol: <strong>{{ $wilcoxon['n'] }}</strong> · statistik W: <strong>{{ number_format($wilcoxon['statistic'], 2) }}</strong> · nilai p exact dua sisi: <strong>{{ number_format($wilcoxon['p_value'], 6) }}</strong></p>
        @else
            <p class="admin-muted">Belum ada pasangan dengan perubahan skor bukan nol.</p>
        @endif
        <p class="admin-muted">Hasil uji perlu dicocokkan dengan SPSS atau JASP menggunakan kumpulan data berpasangan dan aturan ties yang sama sebelum ditafsirkan atau dilaporkan.</p>
    </section>
    <aside class="admin-callout"><strong>Perlindungan data</strong><p>Gunakan data sesuai protokol dan izin penelitian. Tampilan ini membatasi identitas ke inisial; ekspor tetap harus disimpan dan dibagikan secara aman.</p></aside>
</x-admin-layout>
