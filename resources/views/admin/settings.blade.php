<x-admin-layout title="Pengaturan Situs" active="settings">
    <section class="admin-page-heading"><div><span class="admin-eyebrow">TATA KELOLA &amp; REPRESENTASI PUBLIK</span><h1>Konfigurasi &amp; Identitas Situs</h1><p>Simpan identitas dan kontak resmi. Nilai publik sebaiknya hanya diisi setelah disetujui pemilik konten.</p></div><div class="admin-heading-actions"><a class="admin-button admin-button-outline" href="{{ route('home') }}">Pratinjau beranda ↗</a></div></section>
    @if (session('status'))<div class="admin-feedback" role="status">{{ session('status') }}</div>@endif
    @if ($errors->any())<div class="admin-feedback admin-feedback-error" role="alert">{{ $errors->first() }}</div>@endif
    <form class="admin-panel admin-settings-section admin-form" method="POST" action="{{ route('admin.settings.update') }}">
        @csrf @method('PUT')
        <span class="admin-eyebrow">PENGATURAN TERSIMPAN</span><h2>Identitas &amp; kontak situs</h2>
        @foreach ($fields as $key => $field)
            <label for="setting-{{ $key }}">{{ $field['label'] }}</label>
            @if ($key === 'education_philosophy')
                <textarea id="setting-{{ $key }}" name="settings[{{ $key }}]" rows="5" maxlength="{{ $field['max'] }}">{{ old('settings.'.$key, $settings->get($key)?->value) }}</textarea>
            @else
                <input id="setting-{{ $key }}" name="settings[{{ $key }}]" type="{{ $key === 'contact_email' ? 'email' : 'text' }}" value="{{ old('settings.'.$key, $settings->get($key)?->value) }}" maxlength="{{ $field['max'] }}">
            @endif
            @error('settings.'.$key)<small class="admin-field-error">{{ $message }}</small>@enderror
        @endforeach
        <div class="admin-form-actions"><button class="admin-button" type="submit">Simpan pengaturan situs</button></div>
    </form>
    <aside class="admin-callout"><strong>Konten penelitian</strong><p>Naskah kebijakan privasi, materi kesehatan, video, dan ilustrasi belum tersedia untuk diimpor ke aplikasi. Jangan mengganti konten yang telah disetujui tanpa izin pemilik materi.</p><a class="admin-text-link" href="{{ route('privacy') }}">Lihat halaman kebijakan privasi →</a></aside>
</x-admin-layout>
