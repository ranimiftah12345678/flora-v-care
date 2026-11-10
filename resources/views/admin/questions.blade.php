<x-admin-layout title="Manajemen Pertanyaan Kuesioner" active="questions">
    <section class="admin-page-heading">
        <div><span class="admin-eyebrow">INSTRUMEN PENELITIAN · BELUM DIVALIDASI</span><h1>Manajemen Pertanyaan Kuesioner</h1><p>Tulis setiap butir sebagai pertanyaan yang diakhiri tanda tanya. Pertanyaan baru otomatis dimasukkan ke pretest dan posttest.</p></div>
        <div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="#impor-pertanyaan">Impor Excel</a><a class="admin-button admin-button-outline" href="{{ route('admin.questions.export') }}">Ekspor analisis</a><a class="admin-button" href="{{ route('admin.questions.create') }}">＋ Tambah pertanyaan</a><a class="admin-button admin-button-outline" href="{{ route('admin.tests') }}">Pengaturan tes</a></div>
    </section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if ($errors->has('question'))<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first('question') }}</div>@endif
    @if ($errors->has('file'))<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first('file') }}</div>@endif
    <form id="impor-pertanyaan" class="admin-panel admin-form" method="POST" action="{{ route('admin.questions.import') }}" enctype="multipart/form-data">
        @csrf
        <h2>Impor pertanyaan</h2>
        <p class="admin-muted">Kolom wajib: question_text (berakhir tanda tanya), aspect (kognitif/afektif/konatif), is_unfavorable (positif/negatif), sort_order. Impor ditolak jika pretest sudah memiliki jawaban.</p>
        <label for="question-import-file">File Excel atau CSV</label><input id="question-import-file" name="file" type="file" accept=".xlsx,.xls,.csv" required>
        <button class="admin-button admin-button-outline" type="submit">Impor pertanyaan</button>
    </form>
    <section class="admin-stat-grid admin-stat-grid-four">
        <article class="admin-stat-card"><span>Jumlah pertanyaan</span><strong>{{ $questions->total() }}</strong><small>Belum tentu tervalidasi</small></article>
        <article class="admin-stat-card"><span>Sudah dijawab</span><strong>{{ $questions->sum('attempt_answers_count') }}</strong><small>Penanda negatifnya terkunci</small></article>
        <article class="admin-stat-card"><span>Domain tersedia</span><strong>3</strong><small>Kognitif, afektif, konatif</small></article>
        <article class="admin-stat-card"><span>Ambang pembukaan tes</span><strong>31+</strong><small>Jumlah pertanyaan harus lebih dari 30</small></article>
    </section>
    <section class="admin-panel">
        <div class="admin-panel-heading"><div><span class="admin-eyebrow">BANK SOAL</span><h2>Daftar Pertanyaan</h2></div></div>
        <div class="admin-table-wrap"><table class="admin-table admin-question-table"><thead><tr><th>Urutan</th><th>Pertanyaan</th><th>Domain</th><th>Arah skor</th><th>Respons</th><th>Aksi</th></tr></thead><tbody>
            @forelse ($questions as $question)
                <tr>
                    <td>{{ $question->sort_order }}</td>
                    <td>{{ $question->question_text }}</td>
                    <td>{{ ucfirst($question->aspect) }}</td>
                    <td>{{ $question->is_unfavorable ? 'Negatif (dibalik)' : 'Positif' }}</td>
                    <td>{{ $question->attempt_answers_count }}</td>
                    <td><div class="admin-row-actions"><a class="admin-text-link" href="{{ route('admin.questions.edit', $question) }}">Ubah</a>
                        @if ($question->attempt_answers_count === 0)
                            <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" onsubmit="return confirm('Hapus pertanyaan ini?')">@csrf @method('DELETE')<button class="admin-text-button" type="submit">Hapus</button></form>
                        @else
                            <span class="admin-muted">Terkunci</span>
                        @endif
                    </div></td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada pertanyaan. Tambahkan pertanyaan baru untuk memasukkannya otomatis ke pretest.</td></tr>
            @endforelse
        </tbody></table></div>
        <div class="admin-pagination">{{ $questions->links() }}</div>
    </section>
    <aside class="admin-callout"><strong>Validasi instrumen</strong><p>Validitas, reliabilitas, skoring, dan prosedur penelitian harus ditetapkan serta diverifikasi oleh tim metodologi sebelum instrumen digunakan.</p></aside>
</x-admin-layout>
