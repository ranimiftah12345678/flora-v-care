<x-admin-layout title="Pengaturan Tes" active="tests">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">PRETEST &amp; POSTTEST</span><h1>Pengaturan Tes</h1><p>Tes tidak dapat dibuka sebelum berisi lebih dari 30 pertanyaan. Daftar pertanyaan terkunci setelah jawaban pertama dikirim.</p></div></section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    @foreach ($tests as $test)
        @php($hasAnswers = $test->attempts()->whereHas('answers')->exists())
        <form class="admin-panel admin-form" method="POST" action="{{ route('admin.tests.update', $test->type) }}">
            @csrf @method('PUT')
            <div class="admin-panel-heading"><div><span class="admin-eyebrow">{{ strtoupper($test->type) }}</span><h2>{{ $test->title }}</h2></div><span class="admin-status {{ $test->is_open ? '' : 'admin-status-soft' }}">{{ $test->is_open ? 'Terbuka' : 'Tertutup' }}</span></div>
            <label for="title-{{ $test->type }}">Nama tes</label>
            <input id="title-{{ $test->type }}" name="title" value="{{ old('title', $test->title) }}" required maxlength="255">
            <label for="instructions-{{ $test->type }}">Instruksi</label>
            <textarea id="instructions-{{ $test->type }}" name="instructions" rows="3" maxlength="5000">{{ old('instructions', $test->instructions) }}</textarea>
            <div class="admin-form-grid">
                <div><label for="max-attempts-{{ $test->type }}">Jumlah percobaan maksimum</label><input id="max-attempts-{{ $test->type }}" name="max_attempts" type="number" min="1" max="10" value="{{ old('max_attempts', $test->max_attempts) }}" required></div>
                <div><label for="threshold-{{ $test->type }}">Ambang sikap (opsional)</label><input id="threshold-{{ $test->type }}" name="attitude_threshold" type="number" min="30" max="120" value="{{ old('attitude_threshold', $test->attitude_threshold) }}"></div>
            </div>
            <fieldset class="admin-question-picker">
                <legend>Pertanyaan ({{ $test->questions_count }})</legend>
                @if ($hasAnswers)<p class="admin-muted">Daftar terkunci karena jawaban sudah diterima.</p>@endif
                <div class="admin-question-picker-list">
                    @foreach ($questions as $question)
                        <label class="admin-checkbox-field"><input type="checkbox" name="question_ids[]" value="{{ $question->id }}" @checked(in_array($question->id, old('question_ids', $test->questions->modelKeys()))) @disabled($hasAnswers)><span>{{ $question->question_text }}</span></label>
                    @endforeach
                </div>
            </fieldset>
            @if ($hasAnswers)
                @foreach ($test->questions as $question)<input type="hidden" name="question_ids[]" value="{{ $question->id }}">@endforeach
            @endif
            <label class="admin-checkbox-field"><input type="checkbox" name="is_open" value="1" @checked(old('is_open', $test->is_open))><span>Buka tes untuk siswi (memerlukan minimal 31 pertanyaan)</span></label>
            <div class="admin-form-actions"><button class="admin-button" type="submit">Simpan pengaturan {{ $test->type }}</button></div>
        </form>
    @endforeach
</x-admin-layout>
