<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    private const SETTINGS = [
        'site_name' => ['label' => 'Judul situs', 'max' => 100, 'public' => true],
        'tagline' => ['label' => 'Slogan', 'max' => 255, 'public' => true],
        'institution' => ['label' => 'Nama institusi', 'max' => 255, 'public' => true],
        'contact_email' => ['label' => 'Email kontak resmi', 'max' => 255, 'public' => true],
        'contact_phone' => ['label' => 'Nomor kontak resmi', 'max' => 50, 'public' => true],
        'education_philosophy' => ['label' => 'Filosofi edukasi', 'max' => 5000, 'public' => true],
    ];

    public function index(): View
    {
        return view('admin.settings', [
            'settings' => SiteSetting::query()->get()->keyBy('key'),
            'fields' => self::SETTINGS,
        ]);
    }

    public function update(Request $request, ActivityLogger $logger): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            ...collect(self::SETTINGS)->mapWithKeys(fn (array $setting, string $key): array => [
                'settings.'.$key => ['nullable', 'string', 'max:'.$setting['max']],
            ])->all(),
        ]);

        DB::transaction(function () use ($validated): void {
            foreach (self::SETTINGS as $key => $setting) {
                SiteSetting::query()->updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $validated['settings'][$key] ?? null,
                        'is_public' => $setting['public'],
                    ],
                );
            }
        });

        $logger->log('ubah_pengaturan_situs', $request->user(), 'Pengaturan situs diperbarui');

        return back()->with('status', 'Pengaturan situs berhasil disimpan.');
    }
}
