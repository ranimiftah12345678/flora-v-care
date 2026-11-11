<x-admin-layout title="Ubah Konten: {{ ucfirst($section) }}" active="content">
    <div class="admin-breadcrumb">
        <a href="{{ route('admin.content') }}">Kelola Konten</a>
        <span>/</span>
        <span>{{ ucfirst(str_replace('-', ' ', $section)) }}</span>
    </div>

    <section class="admin-page-heading">
        <div>
            <span class="admin-eyebrow">EDITOR KONTEN</span>
            <h1>Edit Halaman: {{ ucfirst(str_replace('-', ' ', $section)) }}</h1>
            <p>Perbarui judul, uraian materi edukasi, dan gambar pendukung.</p>
        </div>
        <div class="admin-heading-actions">
            <a class="admin-button admin-button-outline" href="{{ route('admin.content') }}">
                Kembali ke Daftar
            </a>
            @php
                $publicUrl = match($section) {
                    'beranda' => route('home'),
                    'jenis' => route('public.jenis'),
                    'tanda-gejala' => route('public.tanda-gejala'),
                    'cara-pencegahan' => route('public.cara-pencegahan'),
                    'video' => route('public.video'),
                    default => route('home')
                };
            @endphp
            <a class="admin-button admin-button-outline" href="{{ $publicUrl }}" target="_blank">
                Lihat di Publik ↗
            </a>
        </div>
    </section>

    @if (session('status'))
        <div class="admin-feedback" role="status" style="margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px; align-items: start;">
        <!-- Form Editor -->
        <section class="admin-panel" style="margin-bottom: 0;">
            <div class="admin-panel-heading">
                <div>
                    <span class="admin-eyebrow">FORMULIR</span>
                    <h2>Teks dan Media</h2>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.content.update', $section) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 18px;">
                    <label for="title" style="display: block; font-weight: 600; font-size: 13.5px; margin-bottom: 6px;">Judul Halaman / Bagian:</label>
                    <input id="title" class="admin-text-input" type="text" name="title" value="{{ old('title', $material?->title ?? ucfirst($section)) }}" required style="width: 100%;">
                    @error('title') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <div style="margin-bottom: 18px;">
                    <label for="body" style="display: block; font-weight: 600; font-size: 13.5px; margin-bottom: 6px;">Uraian Teks / Materi Edukasi:</label>
                    <textarea id="body" class="admin-textarea" name="body" rows="14" required style="width: 100%; font-family: inherit; line-height: 1.6; resize: vertical;">{{ old('body', $material?->body) }}</textarea>
                    <small style="display: block; color: var(--text-muted); font-size: 11.5px; margin-top: 4px;">Pisahkan antarparagraf dengan baris baru ganda (Enter 2x).</small>
                    @error('body') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <div style="margin-bottom: 24px;">
                    <label for="image" style="display: block; font-weight: 600; font-size: 13.5px; margin-bottom: 4px;">Unggah / Ganti Gambar &amp; Thumbnail Modul (Opsional):</label>
                    <p style="font-size: 12px; color: var(--text-muted); margin: 0 0 8px;">
                        Gambar ini otomatis tampil sebagai thumbnail card modul di Beranda dan media edukasi di halaman publik.
                    </p>
                    @if ($material?->image)
                        <div style="margin-bottom: 10px;">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($material->image) }}" alt="Gambar saat ini" style="max-width: 180px; height: auto; border-radius: 8px; border: 1px solid var(--border);">
                        </div>
                    @endif
                    <input id="image" type="file" name="image" accept="image/*" style="font-size: 13px;">
                    @error('image') <p class="admin-error">{{ $message }}</p> @enderror
                </div>

                <!-- Tombol Aksi & Pratinjau Cepat -->
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button class="admin-button" type="submit">
                        Simpan Perubahan
                    </button>
                    <button class="admin-button admin-button-outline" type="button" onclick="previewContent()">
                        Pratinjau Langsung
                    </button>
                </div>
            </form>
        </section>

        <!-- Sidebar: Pratinjau & Riwayat Perubahan -->
        <div>
            <!-- Box Pratinjau Sebelum Simpan -->
            <section class="admin-panel" id="preview-box" style="margin-bottom: 24px;">
                <div class="admin-panel-heading">
                    <div>
                        <span class="admin-eyebrow">PRATINJAU REAL-TIME</span>
                        <h2 id="preview-heading">{{ $material?->title ?? 'Judul Pratinjau' }}</h2>
                    </div>
                </div>
                <div id="preview-body" style="font-size: 13.5px; line-height: 1.7; color: var(--text); white-space: pre-line; max-height: 300px; overflow-y: auto; padding: 12px; background: var(--surface-2); border-radius: 8px; border: 1px solid var(--border);">
                    {{ $material?->body ?? 'Teks pratinjau akan muncul di sini...' }}
                </div>
            </section>

            <!-- Box Riwayat Perubahan -->
            <section class="admin-panel">
                <div class="admin-panel-heading">
                    <div>
                        <span class="admin-eyebrow">AUDIT TRAIL</span>
                        <h2>Riwayat Perubahan</h2>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    @forelse ($history as $h)
                        <div style="padding: 10px 12px; border-radius: 8px; background: var(--surface-2); font-size: 12.5px; border-left: 3px solid var(--primary);">
                            <strong style="display: block; color: var(--heading);">{{ $h->user?->name ?? 'Admin' }}</strong>
                            <span style="color: var(--text-muted); font-size: 11px;">{{ $h->created_at->timezone('Asia/Jakarta')->format('d M Y H:i:s') }}</span>
                            <p style="margin: 4px 0 0; color: var(--text);">{{ $h->description }}</p>
                        </div>
                    @empty
                        <p class="admin-muted" style="margin: 0; font-size: 12.5px;">Belum ada riwayat tercatat untuk bagian ini.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>

    <script>
        function previewContent() {
            const titleVal = document.getElementById('title').value;
            const bodyVal = document.getElementById('body').value;

            document.getElementById('preview-heading').textContent = titleVal || 'Tanpa Judul';
            document.getElementById('preview-body').textContent = bodyVal || 'Tidak ada teks.';

            document.getElementById('preview-box').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</x-admin-layout>
