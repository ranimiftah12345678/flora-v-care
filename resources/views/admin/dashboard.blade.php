<x-admin-layout title="Dasbor Admin" active="dashboard">
    <!-- Header Dasbor Modern - Ref: Sales Report Header -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
        <div>
            <h1 style="font-family: 'Poppins', sans-serif; font-size: 26px; font-weight: 800; color: var(--heading); margin: 0 0 4px; letter-spacing: -0.5px;">
                Dasbor Administrator
            </h1>
            <p style="font-size: 13px; color: var(--text-muted); margin: 0;">
                {{ now()->timezone('Asia/Jakarta')->translatedFormat('l, j F Y') }} · Pantauan statistik & edukasi reproduksi
            </p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <a class="button" href="{{ route('admin.content') }}" style="border-radius: 99px; padding: 0 20px; min-height: 40px; font-size: 13px; font-weight: 600;">
                Kelola Konten ✎
            </a>
            <a class="button button-outline" href="{{ route('home') }}" target="_blank" style="border-radius: 99px; padding: 0 20px; min-height: 40px; font-size: 13px; font-weight: 600;">
                Lihat Website ↗
            </a>
        </div>
    </div>

    <!-- Layout Grid Utama Sesuai Referensi Dasbord (Kiri 2 Kolom Cards + Chart, Kanan Widget Statistik) -->
    <div style="display: grid; grid-template-columns: minmax(0, 2fr) minmax(320px, 1fr); gap: 24px; align-items: start;">
        
        <!-- KOLOM KIRI (Main Content: 4 Stat Cards Grid + Customer Habbits Chart) -->
        <div style="display: grid; gap: 24px;">
            
            <!-- 4 Stat Cards (Sesuai Referensi: 1 Highlight Dark/Accent Card + 3 Clean White Cards) -->
            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px;">
                
                <!-- Card 1: Total Kunjungan (Highlight Featured Card Sesuai Card Hijau Gelap di Referensi) -->
                <div class="card" style="background: #1e1319; color: #ffffff; border-radius: 24px; padding: 24px; border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 10px 25px rgba(0,0,0,0.06); position: relative; overflow: hidden;">
                    <!-- Aksen Titik-titik Dekoratif Tipis -->
                    <div style="position: absolute; right: 16px; top: 16px; opacity: 0.15; font-size: 18px; line-height: 1; letter-spacing: 4px; user-select: none;">••••<br>••••<br>••••</div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="width: 44px; height: 44px; border-radius: 14px; background: rgba(255, 255, 255, 0.15); display: grid; place-items: center; font-size: 20px;">
                            👥
                        </div>
                        <span style="background: rgba(34, 197, 94, 0.2); color: #4ade80; border: 1px solid rgba(34, 197, 94, 0.4); padding: 4px 10px; border-radius: 99px; font-size: 11px; font-weight: 700;">
                            +{{ $todayVisits }} Hari ini
                        </span>
                    </div>

                    <span style="font-size: 12px; color: rgba(255, 255, 255, 0.7); font-weight: 500; display: block; margin-bottom: 4px;">
                        Total Kunjungan
                    </span>
                    <strong style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; display: block; line-height: 1.1; margin-bottom: 8px;">
                        {{ number_format($totalVisits) }}
                    </strong>
                    <span style="font-size: 11.5px; color: rgba(255, 255, 255, 0.6);">
                        Tayangan edukasi publik
                    </span>
                </div>

                <!-- Card 2: Pemutaran Video (Clean White Card dengan Badge Persentase Sesuai Referensi) -->
                <div class="card" style="background: var(--surface); border-radius: 24px; padding: 24px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="width: 44px; height: 44px; border-radius: 14px; background: rgba(168, 36, 63, 0.08); color: var(--primary); display: grid; place-items: center; font-size: 20px;">
                            ▶
                        </div>
                        <span style="background: #eaf7ee; color: #166534; border: 1px solid #bbf7d0; padding: 4px 10px; border-radius: 99px; font-size: 11px; font-weight: 700;">
                            +{{ $todayVideoPlays }} Hari ini
                        </span>
                    </div>

                    <span style="font-size: 12px; color: var(--text-muted); font-weight: 500; display: block; margin-bottom: 4px;">
                        Pemutaran Video
                    </span>
                    <strong style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 800; color: var(--heading); letter-spacing: -0.5px; display: block; line-height: 1.1; margin-bottom: 8px;">
                        {{ number_format($videoPlays) }}
                    </strong>
                    <span style="font-size: 11.5px; color: var(--text-muted);">
                        Interaksi video edukasi
                    </span>
                </div>

                <!-- Card 3: Halaman Terpopuler -->
                <div class="card" style="background: var(--surface); border-radius: 24px; padding: 24px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="width: 44px; height: 44px; border-radius: 14px; background: rgba(194, 24, 91, 0.08); color: #c2185b; display: grid; place-items: center; font-size: 20px;">
                            ⭐
                        </div>
                        <span style="background: #fdf2f8; color: #9d174d; border: 1px solid #fbcfe8; padding: 4px 10px; border-radius: 99px; font-size: 11px; font-weight: 700;">
                            Terfavorit
                        </span>
                    </div>

                    <span style="font-size: 12px; color: var(--text-muted); font-weight: 500; display: block; margin-bottom: 4px;">
                        Halaman Terpopuler
                    </span>
                    <strong style="font-family: 'Poppins', sans-serif; font-size: 15px; font-weight: 700; color: var(--heading); display: block; line-height: 1.3; margin-bottom: 8px; min-height: 38px;">
                        {{ $topPages->first()?->description ? str_replace('Membuka ', '', $topPages->first()->description) : 'Belum ada' }}
                    </strong>
                    <span style="font-size: 11.5px; color: var(--text-muted);">
                        {{ $topPages->first()?->total ?? 0 }} kali dibuka pengunjung
                    </span>
                </div>

                <!-- Card 4: Video Tersedia -->
                <div class="card" style="background: var(--surface); border-radius: 24px; padding: 24px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <div style="width: 44px; height: 44px; border-radius: 14px; background: rgba(217, 119, 6, 0.08); color: #d97706; display: grid; place-items: center; font-size: 20px;">
                            🎬
                        </div>
                        <span style="background: #fffbeb; color: #b45309; border: 1px solid #fde68a; padding: 4px 10px; border-radius: 99px; font-size: 11px; font-weight: 700;">
                            Aktif
                        </span>
                    </div>

                    <span style="font-size: 12px; color: var(--text-muted); font-weight: 500; display: block; margin-bottom: 4px;">
                        Video Tersedia
                    </span>
                    <strong style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 800; color: var(--heading); letter-spacing: -0.5px; display: block; line-height: 1.1; margin-bottom: 8px;">
                        {{ $totalVideos }}
                    </strong>
                    <a href="{{ route('admin.videos') }}" style="font-size: 11.5px; color: var(--primary); text-decoration: none; font-weight: 600;">
                        Kelola koleksi video →
                    </a>
                </div>

            </div>

            <!-- GRAFIK BESAR: Tren Kunjungan Harian (Sesuai Komponen 'Customer Habbits' di Referensi) -->
            <div class="card" style="background: var(--surface); border-radius: 24px; padding: 26px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 17px; font-weight: 700; color: var(--heading); margin: 0 0 4px;">
                            Tren Kunjungan Harian
                        </h2>
                        <span style="font-size: 12px; color: var(--text-muted);">
                            Grafik intensitas kunjungan materi edukasi 7 hari terakhir
                        </span>
                    </div>
                    
                    <!-- Indikator Legend & Periode Sesuai Referensi -->
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div style="display: flex; align-items: center; gap: 6px; font-size: 11.5px; color: var(--text-muted);">
                            <span style="width: 10px; height: 10px; border-radius: 50%; background: var(--primary);"></span> Kunjungan
                        </div>
                        <span style="font-size: 11.5px; padding: 4px 12px; border-radius: 99px; background: var(--surface-2); border: 1px solid var(--border); color: var(--heading); font-weight: 600;">
                            7 Hari Ini ▾
                        </span>
                    </div>
                </div>

                @php
                    $maxVal = max(1, $dailyVisits->max('count'));
                @endphp
                <div style="display: flex; align-items: flex-end; justify-content: space-around; gap: 12px; height: 210px; padding: 24px 10px 0; border-bottom: 1px solid var(--border);">
                    @foreach ($dailyVisits as $day)
                        @php
                            $heightPercent = max(12, round(($day['count'] / $maxVal) * 100));
                        @endphp
                        <div style="flex: 1; max-width: 48px; display: flex; flex-direction: column; align-items: center; gap: 8px; height: 100%; justify-content: flex-end;">
                            <span style="font-size: 11px; font-weight: 700; color: var(--primary);">{{ $day['count'] }}</span>
                            <!-- Batang Berujung Rounded Tebal Sesuai Referensi -->
                            <div style="width: 100%; height: {{ $heightPercent }}%; background: linear-gradient(180deg, var(--primary) 0%, #8c1638 100%); border-radius: 99px 99px 0 0; transition: height 0.4s cubic-bezier(0.4, 0, 0.2, 1);"></div>
                            <span style="font-size: 11px; color: var(--text-muted); font-weight: 600; white-space: nowrap;">{{ $day['date'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- AKTIVITAS PENGUNJUNG TERBARU -->
            <div class="card" style="background: var(--surface); border-radius: 24px; padding: 26px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                    <div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 17px; font-weight: 700; color: var(--heading); margin: 0 0 4px;">
                            Aktivitas Pengunjung Terbaru
                        </h2>
                        <span style="font-size: 12px; color: var(--text-muted);">
                            Log sistem pembelajaran tanpa identitas pribadi
                        </span>
                    </div>
                    <a class="button button-small button-outline" href="{{ route('admin.activity') }}" style="border-radius: 99px; font-size: 11.5px; padding: 0 16px; min-height: 32px;">
                        Semua Log →
                    </a>
                </div>

                <div style="overflow-x: auto;">
                    <table class="admin-table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                        <thead>
                            <tr style="background: var(--surface-2);">
                                <th style="padding: 10px 14px; border-radius: 10px 0 0 10px; font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-muted);">Waktu</th>
                                <th style="padding: 10px 14px; font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-muted);">Aktivitas / Halaman</th>
                                <th style="padding: 10px 14px; border-radius: 0 10px 10px 0; font-size: 11px; font-weight: 700; text-transform: uppercase; color: var(--text-muted);">Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentActivities as $act)
                                <tr>
                                    <td style="padding: 12px 14px; font-size: 12px; color: var(--text-muted); border-bottom: 1px solid var(--border); white-space: nowrap;">
                                        {{ $act->created_at->diffForHumans() }}
                                    </td>
                                    <td style="padding: 12px 14px; border-bottom: 1px solid var(--border);">
                                        <strong style="font-size: 13px; color: var(--heading);">{{ $act->description }}</strong>
                                    </td>
                                    <td style="padding: 12px 14px; border-bottom: 1px solid var(--border);">
                                        <span class="home-tag" style="font-size: 10.5px; padding: 3px 10px;">
                                            {{ ucfirst($act->action_type) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: var(--text-muted); padding: 24px;">
                                        Belum ada aktivitas tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN (Sidebar Widget: Product Statistic Pie Card & Growth Breakdown Sesuai Referensi) -->
        <div style="display: grid; gap: 24px;">

            <!-- WIDGET 1: Statistik Distribusi Konten (Dihitung Dinamis Dari Database) -->
            @php
                $statTotal = $totalVisits + $videoPlays + $totalVideos;
                $pctVisits = $statTotal > 0 ? round(($totalVisits / $statTotal) * 100) : 0;
                $pctVideos = $statTotal > 0 ? round(($videoPlays / $statTotal) * 100) : 0;
                $pctAvail = $statTotal > 0 ? max(0, 100 - $pctVisits - $pctVideos) : 0;
                
                $degVisits = round(($pctVisits / 100) * 360);
                $degVideos = $degVisits + round(($pctVideos / 100) * 360);
            @endphp
            <div class="card" style="background: var(--surface); border-radius: 24px; padding: 26px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; color: var(--heading); margin: 0 0 2px;">
                            Statistik Konten
                        </h2>
                        <span style="font-size: 11.5px; color: var(--text-muted);">
                            Distribusi keterlibatan materi
                        </span>
                    </div>
                    <span style="font-size: 11px; padding: 3px 10px; border-radius: 99px; background: var(--surface-2); border: 1px solid var(--border); color: var(--heading); font-weight: 600;">
                        Real-time ▾
                    </span>
                </div>

                <!-- Circular Diagram Dinamis Sesuai Database -->
                <div style="display: grid; place-items: center; margin: 24px 0 28px;">
                    <div style="width: 170px; height: 170px; border-radius: 50%; background: conic-gradient(var(--primary) 0deg {{ $degVisits }}deg, #c2185b {{ $degVisits }}deg {{ $degVideos }}deg, #d97706 {{ $degVideos }}deg 360deg); box-shadow: 0 10px 25px rgba(0,0,0,0.06); display: grid; place-items: center; position: relative;">
                        <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--surface); display: grid; place-items: center; box-shadow: inset 0 2px 8px rgba(0,0,0,0.05);">
                            <span style="font-size: 11px; font-weight: 700; color: var(--heading); text-align: center; line-height: 1.2;">
                                {{ number_format($statTotal) }}<br><small style="font-size: 9px; color: var(--text-muted); font-weight: 500;">Interaksi</small>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Breakdown List Dinamis Dari Database -->
                <div style="display: grid; gap: 10px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: var(--primary);"></span>
                            <span style="color: var(--heading); font-weight: 600;">Modul Edukasi</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <strong style="color: var(--heading);">{{ number_format($totalVisits) }}</strong>
                            <span style="background: #eaf7ee; color: #166534; padding: 2px 6px; border-radius: 6px; font-size: 10.5px; font-weight: 700;">{{ $pctVisits }}%</span>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #c2185b;"></span>
                            <span style="color: var(--heading); font-weight: 600;">Pemutaran Video</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <strong style="color: var(--heading);">{{ number_format($videoPlays) }}</strong>
                            <span style="background: #eaf7ee; color: #166534; padding: 2px 6px; border-radius: 6px; font-size: 10.5px; font-weight: 700;">{{ $pctVideos }}%</span>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 12px;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <span style="width: 10px; height: 10px; border-radius: 3px; background: #d97706;"></span>
                            <span style="color: var(--heading); font-weight: 600;">Video Tersedia</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <strong style="color: var(--heading);">{{ $totalVideos }}</strong>
                            <span style="background: #fdf2f8; color: #9d174d; padding: 2px 6px; border-radius: 6px; font-size: 10.5px; font-weight: 700;">{{ $pctAvail }}%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WIDGET 2: Halaman Terbuka Terbanyak (Sesuai 'Customer Growth' di Referensi) -->
            <div class="card" style="background: var(--surface); border-radius: 24px; padding: 26px; border: 1px solid var(--border); box-shadow: 0 8px 24px rgba(0,0,0,0.03);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                    <div>
                        <h2 style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 700; color: var(--heading); margin: 0 0 2px;">
                            Halaman Terbanyak
                        </h2>
                        <span style="font-size: 11.5px; color: var(--text-muted);">
                            Peringkat akses halaman publik
                        </span>
                    </div>
                    <span style="font-size: 11px; padding: 3px 10px; border-radius: 99px; background: var(--surface-2); border: 1px solid var(--border); color: var(--heading); font-weight: 600;">
                        Top 5 ▾
                    </span>
                </div>

                <div style="display: grid; gap: 10px;">
                    @forelse ($topPages as $idx => $page)
                        @php
                            $maxHits = max(1, $topPages->max('total'));
                            $widthBar = max(15, round(($page->total / $maxHits) * 100));
                        @endphp
                        <div style="padding: 10px 12px; border-radius: 14px; background: var(--surface-2); border: 1px solid var(--border);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <strong style="font-size: 12.5px; color: var(--heading);">
                                    {{ $page->description }}
                                </strong>
                                <span style="font-size: 11.5px; font-weight: 700; color: var(--primary);">
                                    {{ $page->total }} hits
                                </span>
                            </div>
                            <!-- Baris Horizontal Progress Bar Sesuai Referensi Customer Growth -->
                            <div style="width: 100%; height: 6px; background: var(--border); border-radius: 99px; overflow: hidden;">
                                <div style="width: {{ $widthBar }}%; height: 100%; background: linear-gradient(90deg, var(--primary) 0%, #8c1638 100%); border-radius: 99px;"></div>
                            </div>
                        </div>
                    @empty
                        <p class="admin-muted">Belum ada data kunjungan.</p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</x-admin-layout>
