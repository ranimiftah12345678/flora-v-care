<x-public-layout title="Video Pembelajaran" active="video">
    <!-- Header Hero Modul (Sesuai Referensi & Beranda: Split Hero + Gambar) -->
    <section class="public-hero" style="padding: 40px 0 50px; position: relative;">
        <div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: clamp(36px, 5vw, 64px); align-items: center;">
                <!-- Left Content -->
                <div>
                    <!-- Breadcrumbs & Badges -->
                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px; margin-bottom: 16px;">
                        <nav style="font-size: 12.5px; color: var(--text-muted); display: inline-flex; align-items: center; gap: 6px; margin-right: 8px;">
                            <a href="{{ route('home') }}" style="color: var(--text-muted); text-decoration: none;">⌂ Beranda</a>
                            <span>/</span>
                            <span style="color: var(--primary); font-weight: 600;">Video Pembelajaran</span>
                        </nav>
                        <span class="home-tag">
                            <span>▶</span> MODUL 04
                        </span>
                    </div>

                    <h1 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(32px, 4.5vw, 48px); margin: 0 0 14px; line-height: 1.18; font-weight: 800; letter-spacing: -0.6px;">
                        Video Edukasi <br><span style="font-family: 'Playfair Display', Georgia, serif; font-weight: 600; font-style: italic; color: var(--primary);">Flora-V Care</span>
                    </h1>

                    <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); max-width: 500px; margin: 0 0 26px;">
                        Tonton demonstrasi visual seputar tata cara perawatan kebersihan organ reproduksi wanita (Vulva Hygiene) yang baik dan benar secara jelas dan terpercaya.
                    </p>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 12px;">
                        <a href="#pemutar-video" class="button" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                            Tonton Sekarang <span aria-hidden="true" style="margin-left: 6px;">↓</span>
                        </a>
                        <span class="home-badge-outline">
                            TUTORIAL VISUAL PRAKTIK
                        </span>
                    </div>
                </div>

                <!-- Right Hero Image Frame -->
                <div style="position: relative; text-align: center;">
                    <div style="position: relative; display: inline-block; max-width: 460px; width: 100%;">
                        <div style="border-radius: 28px; overflow: hidden; box-shadow: 0 20px 48px rgba(0, 0, 0, 0.12); border: 1px solid var(--border); aspect-ratio: 4/3.2; background: var(--surface-2);">
                            <img src="{{ asset('assets/image 4.jpg') }}" alt="Tenaga Medis Flora-V Care Video" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <!-- Floating Card Overlay Sesuai Referensi -->
                        <div class="card" style="position: absolute; bottom: -20px; right: clamp(10px, 3vw, 24px); left: clamp(10px, 3vw, 24px); background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 16px 22px; box-shadow: 0 16px 36px rgba(0, 0, 0, 0.16); text-align: left;">
                            <span class="home-card-eyebrow">
                                <span>🎥</span> MEDIA INTERAKTIF
                            </span>
                            <p style="font-size: 13.5px; line-height: 1.5; color: var(--text); margin: 0; font-weight: 500;">
                                Pembelajaran audio-visual mempermudah remaja memahami praktik higienitas sehari-hari.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Video Player -->
    <section id="pemutar-video" style="padding: 70px 0 80px; background: var(--surface-2); border-top: 1px solid var(--border);">
        <div class="container" style="max-width: 1080px; margin: 0 auto; padding: 0 20px;">
            @php
                $hasVideo = $videos->count() > 0;
            @endphp

            @if ($hasVideo)
                <div style="display: grid; gap: 32px; margin-bottom: 40px;">
                    @foreach ($videos as $vid)
                        <article class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: clamp(20px, 3.5vw, 36px); box-shadow: 0 8px 30px rgba(0,0,0,0.04);">
                            <div style="margin-bottom: 20px;">
                                <span class="home-tag" style="margin-bottom: 10px;">
                                    🌸 VIDEO PEMBELAJARAN
                                </span>
                                <h2 class="home-title" style="font-size: clamp(22px, 3.2vw, 30px); margin: 0 0 10px; font-weight: 800; font-family: 'Poppins', sans-serif;">
                                    {{ $vid->title }}
                                </h2>
                                <p style="font-size: 14.5px; line-height: 1.7; color: var(--text-muted); margin: 0;">
                                    {{ $vid->description ?: 'Demonstrasi langkah-langkah praktis menjaga kebersihan genitalia wanita.' }}
                                </p>
                            </div>

                            <!-- Video Player -->
                            <div style="background: #000; border-radius: 18px; overflow: hidden; aspect-ratio: 16/9; position: relative; box-shadow: 0 12px 36px rgba(0,0,0,0.25); border: 1px solid var(--border);">
                                @if (str_starts_with($vid->file_path, 'http://') || str_starts_with($vid->file_path, 'https://'))
                                    <iframe src="{{ $vid->file_path }}" title="{{ $vid->title }}" style="width: 100%; height: 100%; border: none;" allowfullscreen></iframe>
                                @elseif (str_starts_with($vid->file_path, 'assets/'))
                                    <video controls style="width: 100%; height: 100%; display: block;" poster="{{ $vid->thumbnail ? (str_starts_with($vid->thumbnail, 'assets/') ? asset($vid->thumbnail) : \Illuminate\Support\Facades\Storage::disk('public')->url($vid->thumbnail)) : asset('assets/apa-itu-illustration.png') }}" onplay="trackVideoPlay({{ $vid->id }}, '{{ addslashes($vid->title) }}')">
                                        <source src="{{ asset($vid->file_path) }}" type="{{ $vid->mime_type ?: 'video/mp4' }}">
                                        Peramban Anda tidak mendukung pemutar video HTML5.
                                    </video>
                                @else
                                    <video controls style="width: 100%; height: 100%; display: block;" poster="{{ $vid->thumbnail ? \Illuminate\Support\Facades\Storage::disk('public')->url($vid->thumbnail) : '' }}" onplay="trackVideoPlay({{ $vid->id }}, '{{ addslashes($vid->title) }}')">
                                        <source src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($vid->file_path) }}" type="{{ $vid->mime_type ?: 'video/mp4' }}">
                                        Peramban Anda tidak mendukung pemutar video HTML5.
                                    </video>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Video Utama Flora-V Care dari public/assets/video.mp4 -->
                <article class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 24px; padding: clamp(20px, 3.5vw, 36px); box-shadow: 0 8px 30px rgba(0,0,0,0.04); margin-bottom: 40px;">
                    <div style="margin-bottom: 22px;">
                        <span class="home-tag" style="margin-bottom: 12px;">
                            🌸 VIDEO EDUKASI RESMI
                        </span>
                        <h2 class="home-title" style="font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif; font-size: clamp(22px, 3.2vw, 32px); margin: 0 0 12px; font-weight: 800; letter-spacing: -0.5px;">
                            Tutorial &amp; Edukasi Vulva Hygiene Remaja Putri
                        </h2>
                        <p style="font-size: 13.5px; line-height: 1.75; color: var(--text-muted); margin: 0; max-width: 760px;">
                            Saksikan video pembelajaran interaktif mengenai praktik membasuh organ kewanitaan dengan benar, pencegahan kelembapan, serta cara merawat kesehatan organ reproduksi secara mandiri.
                        </p>
                    </div>

                    <!-- Video Player Container -->
                    <div style="background: #000; border-radius: 18px; overflow: hidden; aspect-ratio: 16/9; position: relative; box-shadow: 0 14px 40px rgba(0,0,0,0.25); border: 1px solid var(--border);">
                        <video controls preload="metadata" style="width: 100%; height: 100%; display: block;" poster="{{ asset('assets/apa-itu-illustration.png') }}" onplay="trackVideoPlay(0, 'Video Edukasi Vulva Hygiene')">
                            <source src="{{ asset('assets/video.mp4') }}" type="video/mp4">
                            Peramban Anda tidak mendukung pemutar video HTML5.
                        </video>
                    </div>
                </article>
            @endif

            <!-- Callout Rekomendasi Medis Sesuai Style Referensi -->
            <div class="card" style="background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 22px 26px; display: flex; align-items: center; gap: 18px; margin-bottom: 40px; box-shadow: 0 4px 18px rgba(0,0,0,0.03);">
                <div class="home-icon-box home-icon-care" style="flex-shrink: 0; width: 48px; height: 48px; font-size: 24px;">
                    💡
                </div>
                <div>
                    <strong style="color: var(--heading); display: block; font-size: 15px; margin-bottom: 4px;">Penting Diingat:</strong>
                    <p style="margin: 0; font-size: 14px; color: var(--text-muted); line-height: 1.65;">
                        Setelah menyaksikan video, praktikkan langkah-langkah kebersihan organ kewanitaan secara konsisten setiap hari untuk menjaga kesehatan reproduksimu.
                    </p>
                </div>
            </div>

            <!-- Navigasi Bawah -->
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px; padding-top: 20px; border-top: 1px solid var(--border);">
                <a class="button button-outline" href="{{ route('public.cara-pencegahan') }}" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                    <span aria-hidden="true">←</span> Kembali ke Cara Pencegahan
                </a>
                <a class="button" href="{{ route('home') }}" style="border-radius: 99px; padding: 0 24px; min-height: 46px; font-size: 13.5px; font-weight: 600;">
                    Kembali ke Beranda <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
