<x-admin-layout title="Manajemen Pertanyaan Kuesioner" active="questions">
    <section class="admin-page-heading">
        <div><span class="admin-eyebrow">INSTRUMEN KUESIONER</span><h1>Manajemen Pertanyaan Kuesioner</h1><p>Kelola butir pertanyaan secara langsung (tambah, ubah, dan hapus) atau gunakan fitur impor/ekspor file.</p></div>
        <div class="admin-heading-actions">
            <a class="admin-button" href="{{ route('admin.questions.create') }}">＋ Tambah Pertanyaan</a>
            <a class="admin-button admin-button-outline" href="#impor-pertanyaan">Impor File</a>
            <a class="admin-button admin-button-outline" href="{{ route('admin.questions.export') }}">Ekspor Analisis</a>
            <a class="admin-button admin-button-outline" href="{{ route('admin.tests') }}">Pengaturan Tes</a>
        </div>
    </section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if ($errors->has('question'))<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first('question') }}</div>@endif
    @if ($errors->has('file'))<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first('file') }}</div>@endif
    <div id="impor-pertanyaan" class="admin-panel" x-data="{ open: false }" style="margin-bottom: 16px;">
        <div class="admin-panel-heading" style="cursor: pointer; user-select: none;" @click="open = !open">
            <div>
                <span class="admin-eyebrow">OPSIONAL</span>
                <h2 style="display: flex; align-items: center; gap: 8px;">
                    Impor Pertanyaan dari File
                    <small style="font-size: 12px; font-weight: normal; color: var(--text-muted);" x-text="open ? '(Klik untuk sembunyikan)' : '(Klik untuk membuka formulir impor)'"></small>
                </h2>
            </div>
            <button type="button" class="admin-button admin-button-outline" style="min-height: 30px; padding: 0 12px; font-size: 11px;" x-text="open ? 'Tutup' : 'Buka Impor'"></button>
        </div>
        <div x-show="open" x-cloak style="margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border);">
            <form class="admin-form" method="POST" action="{{ route('admin.questions.import') }}" enctype="multipart/form-data">
                @csrf
                <p class="admin-muted" style="margin-bottom: 12px;">Kolom wajib: question_text (berakhir tanda tanya), aspect (kognitif/afektif/konatif), is_unfavorable (positif/negatif), sort_order. Impor ditolak jika pretest sudah memiliki jawaban.</p>
                <label for="question-import-file">File Excel atau CSV</label>
                <input id="question-import-file" name="file" type="file" accept=".xlsx,.xls,.csv" required>
                <div class="admin-form-actions">
                    <button class="admin-button" type="submit">Unggah &amp; Impor Pertanyaan</button>
                </div>
            </form>
        </div>
    </div>
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
                    <td><strong>{{ $question->sort_order }}</strong></td>
                    <td style="max-width: 380px;">{{ $question->question_text }}</td>
                    <td><span class="preview-pill" style="font-size: 10px;">{{ ucfirst($question->aspect) }}</span></td>
                    <td>{{ $question->is_unfavorable ? 'Negatif (dibalik)' : 'Positif' }}</td>
                    <td>{{ $question->attempt_answers_count }}</td>
                    <td>
                        <div class="admin-row-actions">
                            <a class="admin-button admin-button-outline" style="min-height: 28px; padding: 0 12px; font-size: 11px;" href="{{ route('admin.questions.edit', $question) }}">Ubah</a>
                            @if ($question->attempt_answers_count === 0)
                                <form method="POST" action="{{ route('admin.questions.destroy', $question) }}" onsubmit="return confirm('Hapus pertanyaan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="admin-button admin-button-danger" style="min-height: 28px; padding: 0 12px; font-size: 11px;" type="submit">Hapus</button>
                                </form>
                            @else
                                <span class="admin-muted" style="font-size: 11px; padding: 4px 8px; border-radius: 99px; background: rgba(0,0,0,0.04);">Terkunci</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada pertanyaan. Tambahkan pertanyaan baru untuk memasukkannya otomatis ke pretest.</td></tr>
            @endforelse
        </tbody></table></div>
        <div class="admin-pagination">{{ $questions->links() }}</div>
    </section>
    <aside class="admin-callout"><strong>Validasi instrumen</strong><p>Validitas, reliabilitas, skoring, dan prosedur penelitian harus ditetapkan serta diverifikasi oleh tim metodologi sebelum instrumen digunakan.</p></aside>
</x-admin-layout>
