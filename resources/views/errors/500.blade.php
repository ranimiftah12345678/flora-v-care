<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kesalahan server | Flora V Care</title>
    <style>
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 24px; background: #fff5f7; color: #56142a; font-family: "Poppins", sans-serif; }
        .error-page { width: min(560px, 100%); text-align: center; }
        .error-code { margin: 0; font-family: "Playfair Display", Georgia, serif; font-size: 64px; font-weight: 600; color: #a20e49; }
        .error-page h1 { margin: 10px 0 6px; font-size: 18px; font-weight: 600; }
        .error-page p { margin: 0 0 20px; color: #806873; font-size: 12px; line-height: 1.8; }
        .error-page a { display: inline-block; padding: 11px 20px; border-radius: 999px; background: #a20e49; color: #fff; font-size: 11px; font-weight: 600; }
    </style>
</head>
<body>
    <main class="error-page">
        <p class="error-code">500</p>
        <h1>Terjadi kesalahan</h1>
        <p>Terjadi kesalahan pada server. Silakan coba lagi beberapa saat kemudian.</p>
        <a href="{{ url('/') }}">Kembali ke beranda</a>
    </main>
</body>
</html>
