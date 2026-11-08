<x-student-layout :title="$quizType.' Edukasi Siswi'" :active="$test->type">
    <div class="student-container student-page quiz-page">
        <nav class="student-breadcrumb" aria-label="Breadcrumb"><a href="{{ route('dashboard') }}">Dasbor</a><span aria-hidden="true">/</span><span>{{ $quizType }}</span></nav>

        <section class="quiz-hero">
            <div><span class="student-eyebrow"><span class="status-dot"></span> Kuesioner pembelajaran</span><h1>{{ $quizType }}: Kuesioner Sikap &amp; Pengetahuan</h1><p>{{ $test->instructions }}</p><div class="quiz-meta"><span>{{ $test->questions->count() }} pertanyaan</span><span>Jawaban tersimpan otomatis</span><span>Tanpa penilaian klinis</span></div></div>
            <div class="quiz-symbol" aria-hidden="true"><span>✿</span><small>{{ $attempt->submitted_at ? 'Selesai' : 'Jawabanmu' }}</small></div>
        </section>

        <aside class="student-disclaimer quiz-disclaimer"><span aria-hidden="true">ⓘ</span><div><strong>Hasil belajar bukan diagnosis medis</strong><p>Jawab sesuai pemahamanmu. Hasil evaluasi ini tidak digunakan untuk menentukan kondisi kesehatan pribadi.</p></div></aside>

        @if ($attempt->submitted_at)
            <section class="student-card"><h2>{{ $quizType }} sudah selesai</h2><p>Skor tersimpan: {{ $attempt->total_score }}. Percobaan tambahan tidak tersedia.</p><a class="button" href="{{ route('student.results') }}">Lihat hasil belajar</a></section>
        @else
            @if ($errors->any())<div class="student-disclaimer" role="alert">{{ $errors->first() }}</div>@endif
            <section class="quiz-toolbar">
                <div><strong>Navigasi Pertanyaan</strong><span>Perubahan disimpan otomatis</span></div>
                <div class="quiz-number-grid" aria-label="Navigasi pertanyaan">
                    @foreach ($test->questions as $index => $question)
                        <a href="#question-{{ $question->id }}" @class(['answered' => $answers->has($question->id)])>{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</a>
                    @endforeach
                </div>
                <div class="quiz-progress-copy"><span><b id="answered-count">{{ $answers->count() }}</b> dari {{ $test->questions->count() }} terjawab</span><div class="quiz-progress-track"><span id="quiz-progress" style="width: {{ $test->questions->count() ? ($answers->count() / $test->questions->count()) * 100 : 0 }}%"></span></div></div>
            </section>

            <p id="save-status" class="student-muted" role="status" aria-live="polite"></p>
            <div id="save-error" class="student-disclaimer" role="alert" hidden></div>
            <div class="quiz-questions">
                @foreach ($test->questions as $index => $question)
                    @php($answer = $answers->get($question->id)?->answer_value)
                    <article class="quiz-question" id="question-{{ $question->id }}">
                        <div class="question-heading"><span class="question-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><span class="question-type">{{ ucfirst($question->aspect ?? 'Pertanyaan') }}</span></div>
                        <h2>{{ $question->question_text }}</h2>
                        <fieldset>
                            <legend class="sr-only">Pilih satu jawaban</legend>
                            @foreach ([1 => 'Sangat tidak setuju', 2 => 'Tidak setuju', 3 => 'Setuju', 4 => 'Sangat setuju'] as $value => $label)
                                <label><input type="radio" name="question-{{ $question->id }}" value="{{ $value }}" data-question-id="{{ $question->id }}" @checked((int) $answer === $value)><span>{{ $label }}</span></label>
                            @endforeach
                        </fieldset>
                    </article>
                @endforeach
            </div>

            <aside class="student-disclaimer quiz-note"><span aria-hidden="true">▣</span><div><strong>Catatan penting</strong><p>Pastikan semua jawaban telah tersimpan sebelum mengirim. Jawaban yang sudah dikirim tidak dapat diubah.</p></div></aside>
            <div class="quiz-actions"><a class="button button-outline" href="{{ route('dashboard') }}">Kembali ke Dasbor</a><form method="POST" action="{{ route('student.test.complete', ['testType' => $test->type]) }}">@csrf<button class="button" type="submit">Kirim {{ $quizType }} <span aria-hidden="true">→</span></button></form></div>
        @endif
    </div>
    @if (! $attempt->submitted_at)
        <script>
            const answerEndpoint = @json(route('student.test.answer', ['testType' => $test->type]));
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const answeredQuestions = new Set(@json($answers->keys()->map(fn ($id) => (string) $id)->values()));
            const questionLinks = document.querySelectorAll('.quiz-number-grid a');

            function updateAnswerProgress() {
                document.getElementById('answered-count').textContent = answeredQuestions.size;
                document.getElementById('quiz-progress').style.width = `${(answeredQuestions.size / {{ max(1, $test->questions->count()) }}) * 100}%`;
                questionLinks.forEach((link) => {
                    const id = link.getAttribute('href').replace('#question-', '');
                    link.classList.toggle('answered', answeredQuestions.has(id));
                });
            }

            document.querySelectorAll('input[type="radio"][data-question-id]').forEach((input) => {
                input.addEventListener('change', async () => {
                    const status = document.getElementById('save-status');
                    const error = document.getElementById('save-error');
                    status.textContent = 'Menyimpan jawaban…';
                    error.hidden = true;

                    try {
                        const response = await fetch(answerEndpoint, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                question_id: input.dataset.questionId,
                                answer_value: input.value,
                            }),
                        });
                        if (!response.ok) {
                            const payload = await response.json();
                            throw new Error(payload.message || 'Jawaban gagal disimpan. Coba lagi.');
                        }
                        answeredQuestions.add(input.dataset.questionId);
                        status.textContent = 'Jawaban tersimpan.';
                        updateAnswerProgress();
                    } catch (saveError) {
                        status.textContent = '';
                        error.textContent = saveError.message;
                        error.hidden = false;
                    }
                });
            });
        </script>
    @endif
</x-student-layout>
