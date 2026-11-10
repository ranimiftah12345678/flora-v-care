<x-admin-layout title="{{ $question->exists ? 'Ubah Pertanyaan' : 'Tambah Pertanyaan' }}" active="questions">
    <div class="admin-breadcrumb"><a href="{{ route('admin.questions') }}">Pertanyaan</a><span>/</span><span>{{ $question->exists ? 'Ubah' : 'Tambah' }}</span></div>
    <section class="admin-page-heading"><div><span class="admin-eyebrow">FORMULIR KUESIONER</span><h1>{{ $question->exists ? 'Ubah Pertanyaan' : 'Tambah Pertanyaan Baru' }}</h1><p>Kelola butir kuesioner. Pertanyaan baru otomatis dimasukkan ke instrumen pretest dan posttest.</p></div></section>
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-panel admin-form" method="POST" action="{{ $question->exists ? route('admin.questions.update', $question) : route('admin.questions.store') }}">
        @csrf
        @if ($question->exists) @method('PATCH') @endif
        <label for="question_text">Kalimat Pertanyaan <small style="font-weight: normal; color: var(--text-muted);">(Wajib berakhiran tanda tanya ?)</small></label>
        <textarea id="question_text" name="question_text" rows="4" required maxlength="2000" placeholder="Contoh: Seberapa yakin kamu dapat mencari informasi kesehatan dari sumber tepercaya?">{{ old('question_text', $question->question_text) }}</textarea>
        @error('question_text')<small class="admin-field-error">{{ $message }}</small>@enderror
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
            <div>
                <label for="aspect">Domain / Dimensi</label>
                <select id="aspect" name="aspect" required>
                    @foreach ($aspects as $aspect)<option value="{{ $aspect }}" @selected(old('aspect', $question->aspect) === $aspect)>{{ ucfirst($aspect) }}</option>@endforeach
                </select>
            </div>
            <div>
                <label for="sort_order">Nomor Urutan Tampil</label>
                <input id="sort_order" name="sort_order" type="number" min="0" max="10000" value="{{ old('sort_order', $question->sort_order ?? 0) }}" required>
            </div>
        </div>

        <label class="admin-checkbox-field" style="margin-top: 14px;">
            <input name="is_unfavorable" type="checkbox" value="1" @checked(old('is_unfavorable', $question->is_unfavorable)) @disabled($question->exists && $question->attempt_answers_count > 0)>
            <span>Pertanyaan bernada negatif (skor dibalik otomatis oleh sistem)</span>
        </label>
        @if ($question->exists && $question->attempt_answers_count > 0)
            <input type="hidden" name="is_unfavorable" value="{{ (int) $question->is_unfavorable }}">
            <p class="admin-muted" style="color: #b08a28;">Pertanyaan ini telah memiliki respons dari siswi; arah skor dikunci demi validitas data.</p>
        @endif
        
        <div class="admin-form-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.questions') }}">Batal</a><button class="admin-button" type="submit">{{ $question->exists ? 'Simpan Perubahan' : 'Tambahkan Pertanyaan' }}</button></div>
    </form>
</x-admin-layout>
