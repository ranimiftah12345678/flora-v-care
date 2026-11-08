<x-admin-layout title="{{ $question->exists ? 'Ubah Pertanyaan' : 'Tambah Pertanyaan' }}" active="questions">
    <div class="admin-breadcrumb"><a href="{{ route('admin.questions') }}">Pertanyaan</a><span>/</span><span>{{ $question->exists ? 'Ubah' : 'Tambah' }}</span></div>
    <section class="admin-page-heading"><div><span class="admin-eyebrow">BUTIR KUESIONER</span><h1>{{ $question->exists ? 'Ubah Pertanyaan' : 'Tambah Pertanyaan' }}</h1><p>Setiap butir harus ditulis dalam bentuk pertanyaan dan diakhiri tanda tanya.</p></div></section>
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-panel admin-form" method="POST" action="{{ $question->exists ? route('admin.questions.update', $question) : route('admin.questions.store') }}">
        @csrf
        @if ($question->exists) @method('PATCH') @endif
        <label for="question_text">Pertanyaan</label>
        <textarea id="question_text" name="question_text" rows="4" required maxlength="2000" placeholder="Contoh: Seberapa yakin kamu dapat mencari informasi kesehatan dari sumber tepercaya?">{{ old('question_text', $question->question_text) }}</textarea>
        @error('question_text')<small class="admin-field-error">{{ $message }}</small>@enderror
        <label for="aspect">Domain</label>
        <select id="aspect" name="aspect" required>
            @foreach ($aspects as $aspect)<option value="{{ $aspect }}" @selected(old('aspect', $question->aspect) === $aspect)>{{ ucfirst($aspect) }}</option>@endforeach
        </select>
        <label for="sort_order">Urutan tampil</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="10000" value="{{ old('sort_order', $question->sort_order ?? 0) }}" required>
        <label class="admin-checkbox-field">
            <input name="is_unfavorable" type="checkbox" value="1" @checked(old('is_unfavorable', $question->is_unfavorable)) @disabled($question->exists && $question->attempt_answers_count > 0)>
            <span>Pertanyaan bernada negatif (skor dibalik)</span>
        </label>
        @if ($question->exists && $question->attempt_answers_count > 0)
            <input type="hidden" name="is_unfavorable" value="{{ (int) $question->is_unfavorable }}">
            <p class="admin-muted">Pertanyaan sudah dijawab; arah skornya tidak dapat diubah.</p>
        @endif
        <p class="admin-muted">Pertanyaan baru otomatis dimasukkan ke pretest. Pertanyaan yang sudah dijawab tidak dapat dihapus.</p>
        <div class="admin-form-actions"><a class="admin-button admin-button-outline" href="{{ route('admin.questions') }}">Batal</a><button class="admin-button" type="submit">Simpan pertanyaan</button></div>
    </form>
</x-admin-layout>
