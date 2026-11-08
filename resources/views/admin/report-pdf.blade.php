<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Tes Berpasangan</title>
    <style>
        body { color: #242424; font-family: DejaVu Sans, sans-serif; font-size: 10px; }
        h1, h2 { color: #284f43; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #d6ddd8; padding: 6px; text-align: left; }
        th { background: #edf4ef; }
        .note { color: #555; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Laporan Hasil Tes Berpasangan</h1>
    <p>Dicetak {{ now()->format('d-m-Y H:i') }} · Jumlah pasangan lengkap: {{ $rows->count() }}</p>
    <table>
        <thead><tr><th>Inisial</th><th>Kelas</th><th>Usia</th><th>Pretest</th><th>Posttest</th><th>Selisih</th></tr></thead>
        <tbody>
            @forelse ($rows as $row)
                <tr><td>{{ $row['inisial'] ?: '—' }}</td><td>{{ $row['kelas'] }}</td><td>{{ $row['usia'] ?? '—' }}</td><td>{{ $row['pretest'] }}</td><td>{{ $row['posttest'] }}</td><td>{{ $row['difference'] }}</td></tr>
            @empty
                <tr><td colspan="6">Belum ada data berpasangan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <h2>Uji Wilcoxon berpasangan</h2>
    @if ($wilcoxon['n'] > 0)
        <p>n bukan nol: {{ $wilcoxon['n'] }} · Statistik W: {{ number_format($wilcoxon['statistic'], 2) }} · Nilai p exact dua sisi: {{ number_format($wilcoxon['p_value'], 6) }}</p>
    @else
        <p>Tidak ada pasangan dengan selisih skor bukan nol.</p>
    @endif
    <p class="note">Hasil statistik harus dicocokkan dengan SPSS atau JASP menggunakan data berpasangan dan aturan ties yang sama. Laporan ini bukan diagnosis medis.</p>
</body>
</html>
