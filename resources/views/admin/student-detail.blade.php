<x-admin-layout title="Detail Siswi" active="students">
    <div class="admin-breadcrumb"><a href="{{ route('admin.students') }}">Siswi</a><span>/</span><span>{{ $student->studentProfile?->inisial ?? $student->name }}</span></div>
    <section class="admin-profile-hero">
        <span class="admin-profile-avatar">{{ mb_strtoupper(mb_substr($student->studentProfile?->inisial ?? $student->name, 0, 2)) }}</span>
        <div><span class="admin-eyebrow">DETAIL AKUN SISWI</span><h1>{{ $student->name }}</h1><p>{{ $student->username }} · Inisial {{ $student->studentProfile?->inisial ?? '—' }} · Kelas {{ $student->studentProfile?->kelas ?? '—' }}</p><span class="admin-status {{ $student->is_active ? '' : 'admin-status-soft' }}">{{ $student->is_active ? 'Aktif' : 'Nonaktif' }}</span></div>
        <a class="admin-button admin-button-outline" href="{{ route('admin.students.edit', $student) }}">Ubah akun</a>
    </section>
    @php($pretest = $attempts->get('pretest'))
    @php($posttest = $attempts->get('posttest'))
    <section class="admin-stat-grid admin-stat-grid-four"><article class="admin-stat-card"><span>Skor pretest</span><strong>{{ $pretest?->total_score ?? '—' }}</strong><small>{{ $pretest?->submitted_at?->format('d M Y H:i') ?? 'Belum dikirim' }}</small></article><article class="admin-stat-card"><span>Skor posttest</span><strong>{{ $posttest?->total_score ?? '—' }}</strong><small>{{ $posttest?->submitted_at?->format('d M Y H:i') ?? 'Belum dikirim' }}</small></article><article class="admin-stat-card"><span>Perubahan skor</span><strong>{{ $pretest && $posttest ? (($posttest->total_score - $pretest->total_score) > 0 ? '+' : '').($posttest->total_score - $pretest->total_score) : '—' }}</strong><small>Posttest dikurangi pretest</small></article><article class="admin-stat-card"><span>Sekolah</span><strong>{{ $student->studentProfile?->sekolah ?? '—' }}</strong><small>Usia {{ $student->studentProfile?->usia ?? '—' }}</small></article></section>
    <div class="admin-dashboard-grid">
        <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">PROGRES BELAJAR</span><h2>Materi dan Video</h2></div></div>
            <div class="admin-progress-list">
                @forelse ($materials as $material)
                    @php($materialProgress = $progress->get('material:'.$material->id))
                    <div><span>{{ $material->title }} <b>{{ $materialProgress?->completed_at ? 'Selesai' : ($materialProgress?->opened_at ? 'Dibuka' : 'Belum dibuka') }}</b></span><i><em style="width: {{ $materialProgress?->completed_at ? 100 : ($materialProgress?->opened_at ? 40 : 0) }}%"></em></i></div>
                @empty
                    <p class="admin-muted">Belum ada materi terbit.</p>
                @endforelse
                @foreach ($videos as $video)
                    @php($videoProgress = $progress->get('video:'.$video->id))
                    <div><span>{{ $video->title }} <b>{{ $videoProgress?->played_at ? 'Diputar' : 'Belum diputar' }}</b></span><i><em style="width: {{ $videoProgress?->played_at ? 100 : 0 }}%"></em></i></div>
                @endforeach
            </div>
        </section>
        <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">INFORMASI AKUN</span><h2>Profil Responden</h2></div></div><p>Kelas: {{ $student->studentProfile?->kelas ?? '—' }}</p><p>Usia: {{ $student->studentProfile?->usia ?? '—' }}</p><p>Sekolah: {{ $student->studentProfile?->sekolah ?? '—' }}</p><p>Aktivitas terakhir: {{ $student->last_activity_at?->format('d M Y H:i') ?? 'Belum aktif' }}</p></section>
    </div>
    <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">RESPONS TERSIMPAN</span><h2>Detail Jawaban Terakhir</h2></div></div>
        @forelse ($attempts as $attempt)
            <h3>{{ $attempt->test->title }} · Skor {{ $attempt->total_score }}</h3>
            <div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Pertanyaan</th><th>Domain</th><th>Jawaban</th><th>Skor tersimpan</th></tr></thead><tbody>
                @foreach ($attempt->answers as $answer)
                    <tr><td>{{ $answer->question->question_text }}</td><td>{{ ucfirst($answer->question->aspect ?? '—') }}</td><td>{{ $answer->answer_value }}</td><td>{{ $answer->score }}</td></tr>
                @endforeach
            </tbody></table></div>
        @empty
            <p class="admin-muted">Belum ada tes yang diselesaikan.</p>
        @endforelse
    </section>
    <section class="admin-panel"><div class="admin-panel-heading"><div><span class="admin-eyebrow">RIWAYAT AKTIVITAS</span><h2>Aktivitas Belajar</h2></div></div><div class="admin-timeline">
        @forelse ($activities as $activity)
            <p><b>{{ str_replace('_', ' ', ucfirst($activity->action)) }}</b><span>{{ $activity->description ?? '—' }} · {{ $activity->created_at->format('d M Y H:i') }}</span></p>
        @empty
            <p class="admin-muted">Belum ada aktivitas tercatat.</p>
        @endforelse
    </div></section>
</x-admin-layout>
