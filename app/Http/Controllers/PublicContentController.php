<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Video;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicContentController extends Controller
{
    public function home(Request $request, ActivityLogger $logger): View
    {
        $logger->log('kunjungan_halaman', null, 'Membuka Beranda');

        $materials = Material::whereIn('slug', ['jenis-keputihan', 'tanda-gejala', 'pencegahan', 'video'])
            ->get()
            ->keyBy('slug');

        $videoSetting = Material::where('slug', 'video')->first();

        return view('public.home', compact('materials', 'videoSetting'));
    }

    public function jenis(Request $request, ActivityLogger $logger): View
    {
        $logger->log('kunjungan_halaman', null, 'Membuka Halaman Jenis');
        $material = Material::where('slug', 'jenis-keputihan')->first();

        return view('public.jenis', compact('material'));
    }

    public function tandaGejala(Request $request, ActivityLogger $logger): View
    {
        $logger->log('kunjungan_halaman', null, 'Membuka Halaman Tanda Gejala');
        $material = Material::where('slug', 'tanda-gejala')->first();

        return view('public.tanda-gejala', compact('material'));
    }

    public function caraPencegahan(Request $request, ActivityLogger $logger): View
    {
        $logger->log('kunjungan_halaman', null, 'Membuka Halaman Cara Pencegahan');
        $material = Material::where('slug', 'pencegahan')->first();

        return view('public.cara-pencegahan', compact('material'));
    }

    public function video(Request $request, ActivityLogger $logger): View
    {
        $logger->log('kunjungan_halaman', null, 'Membuka Halaman Video');
        $videos = Video::query()->orderBy('sort_order')->get();

        return view('public.video', compact('videos'));
    }

    public function trackVideo(Request $request, ActivityLogger $logger)
    {
        $videoId = $request->input('video_id');
        $videoTitle = $request->input('video_title', 'Video Edukasi');
        $logger->log('putar_video', null, "Memutar video: {$videoTitle}");

        return response()->json(['success' => true]);
    }

    public function identifyVisitor(Request $request, ActivityLogger $logger)
    {
        $validated = $request->validate([
            'visitor_name' => ['required', 'string', 'max:80'],
            'visitor_email' => ['required', 'email', 'max:120'],
        ]);

        $request->session()->put('visitor_name', $validated['visitor_name']);
        $request->session()->put('visitor_email', $validated['visitor_email']);

        $logger->log('identifikasi_pengunjung', null, "Pengunjung terdaftar: {$validated['visitor_name']} ({$validated['visitor_email']})");

        return response()->json([
            'success' => true,
            'message' => 'Identitas tersimpan',
        ]);
    }
}
