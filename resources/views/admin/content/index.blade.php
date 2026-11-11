<x-admin-layout title="Kelola Konten" active="content">
    <section class="admin-page-heading">
        <div>
            <span class="admin-eyebrow">PENGELOLAAN TEKS &amp; VISUAL</span>
            <h1>Kelola Konten Publik</h1>
            <p>Pilih bagian halaman yang ingin diperbarui teks, gambar, dan keterangannya.</p>
        </div>
    </section>

    @if (session('status'))
        <div class="admin-feedback" role="status" style="margin-bottom: 20px;">
            {{ session('status') }}
        </div>
    @endif

    <!-- Windows File Explorer Style Grid for Admin Content Management -->
    <div style="background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: var(--wine);">
                <span aria-hidden="true">📁</span> Direktori Modul &amp; Berkas Konten
            </div>
            <span style="font-size: 11.5px; color: var(--text-muted);">{{ count($sections) }} Item</span>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 14px;">
            @foreach ($sections as $sec)
                <a href="{{ $sec['route'] }}" class="explorer-item" style="display: flex; align-items: flex-start; gap: 14px; padding: 14px; background: rgba(162, 14, 73, 0.02); border: 1px solid var(--border); border-radius: 12px; text-decoration: none; transition: all 0.15s ease;">
                    <div style="flex-shrink: 0; width: 42px; height: 38px;">
                        @if ($sec['key'] === 'video')
                            <!-- Videos Folder / Clapper icon -->
                            <svg viewBox="0 0 48 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                                <rect x="4" y="6" width="40" height="28" rx="5" fill="#8E24AA"/>
                                <rect x="8" y="10" width="7" height="6" rx="1" fill="#E1BEE7"/>
                                <rect x="20" y="10" width="7" height="6" rx="1" fill="#E1BEE7"/>
                                <rect x="32" y="10" width="7" height="6" rx="1" fill="#E1BEE7"/>
                                <path d="M20 20L28 25L20 30V20Z" fill="#FFFFFF"/>
                            </svg>
                        @else
                            <!-- Windows Explorer Folder Icon -->
                            <svg viewBox="0 0 48 40" fill="none" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                                <path d="M4 8C4 5.79086 5.79086 4 8 4H18L23 9H40C42.2091 9 44 10.7909 44 13V34C44 36.2091 42.2091 38 40 38H8C5.79086 38 4 36.2091 4 34V8Z" fill="#FFA726"/>
                                <path d="M4 14C4 11.7909 5.79086 10 8 10H40C42.2091 10 44 11.7909 44 14V34C44 36.2091 42.2091 38 40 38H8C5.79086 38 4 36.2091 4 34V14Z" fill="#FFB74D"/>
                                <rect x="10" y="16" width="14" height="2" rx="1" fill="#FFE0B2"/>
                            </svg>
                        @endif
                    </div>
                    <div style="overflow: hidden; flex: 1;">
                        <span style="display: block; font-size: 14px; font-weight: 600; color: var(--heading); margin-bottom: 2px;">
                            {{ $sec['title'] }}
                        </span>
                        <span style="display: block; font-size: 11px; color: var(--wine); font-weight: 500; margin-bottom: 4px;">
                            Modul Halaman · {{ strtoupper($sec['key']) }}
                        </span>
                        <p style="font-size: 12px; line-height: 1.45; color: var(--text-muted); margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $sec['description'] }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-admin-layout>
