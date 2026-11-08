<x-guest-layout>
    <x-slot name="title">Daftar Akun Siswi</x-slot>

    <div class="auth-columns registration-layout">
        <aside class="auth-story story-registration">
            <a class="back-link back-link-light" href="{{ route('home') }}"><span aria-hidden="true">←</span> Kembali ke Beranda</a>
            <div class="story-content">
                <span class="eyebrow eyebrow-white"><span class="eyebrow-dot"></span> Kenali, Pahami, Cegah</span>
                <h1>Langkah Awal Menuju <em>Kebiasaan Sehat Mandiri</em></h1>
                <p>Bergabunglah bersama komunitas siswi untuk mempelajari kesehatan reproduksi dengan bimbingan akademis yang tepercaya, ilmiah, dan aman.</p>

                <div class="educator-card">
                    <span class="educator-avatar" aria-hidden="true">F</span>
                    <span><strong>Flora-V Care</strong><small>Tim Edukasi · STIKes Karya Husada</small></span>
                    <p>“Belajar kesehatan reproduksi dengan nyaman, tanpa rasa canggung.”</p>
                </div>

                <ul class="story-benefits">
                    <li><span aria-hidden="true">✦</span><span><strong>Modul Klinis Tervalidasi</strong><small>Disusun bersama tenaga akademis dan kesehatan.</small></span></li>
                    <li><span aria-hidden="true">▣</span><span><strong>Pretest &amp; Evaluasi Personal</strong><small>Ukur pemahaman sebelum dan sesudah belajar.</small></span></li>
                    <li><span aria-hidden="true">▷</span><span><strong>Video Interaktif Ramah Remaja</strong><small>Animasi pembelajaran mudah dipahami.</small></span></li>
                </ul>
                <div class="story-footnote"><span>Kemitraan penelitian resmi</span><span>Kode etik edukasi remaja</span></div>
            </div>
        </aside>

        <section class="auth-panel registration-panel" aria-labelledby="registration-title">
            <span class="form-eyebrow"><span aria-hidden="true">♧</span> Registrasi siswi baru</span>
            <h2 id="registration-title">Daftar Akun Siswi</h2>
            <p class="form-intro">Lengkapi data dirimu dengan benar untuk memulai pembelajaran dan penelitian kesehatan reproduksi.</p>

            <x-auth-session-status class="auth-status" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf
                <div class="form-grid">
                    <div class="form-field form-span-two">
                        <label for="name">Nama Lengkap <span>*</span></label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nama lengkap sesuai data sekolah" autocomplete="name" required autofocus aria-describedby="name-error">
                        <x-input-error id="name-error" :messages="$errors->get('name')" class="field-error" />
                    </div>
                    <fieldset class="profile-preview form-span-two">
                        <legend>Profil siswi <span>Wajib diisi</span></legend>
                        <div class="form-grid">
                            <div class="form-field">
                                <label for="inisial">Inisial Anonim <span>*</span></label>
                                <input id="inisial" name="inisial" type="text" value="{{ old('inisial') }}" placeholder="Contoh: AR" maxlength="10" required autocomplete="off" aria-describedby="inisial-error">
                                <x-input-error id="inisial-error" :messages="$errors->get('inisial')" class="field-error" />
                            </div>
                            <div class="form-field">
                                <label for="username">Nama Pengguna <span>*</span></label>
                                <input id="username" name="username" type="text" value="{{ old('username') }}" placeholder="Contoh: aulia.rahma" minlength="3" maxlength="50" pattern="[a-zA-Z0-9._-]+" required autocomplete="username" aria-describedby="username-error">
                                <x-input-error id="username-error" :messages="$errors->get('username')" class="field-error" />
                            </div>
                            <div class="form-field">
                                <label for="usia">Usia <span>*</span></label>
                                <div class="input-suffix"><input id="usia" name="usia" type="number" value="{{ old('usia') }}" placeholder="16" min="10" max="25" required aria-describedby="usia-error"><span>Tahun</span></div>
                                <x-input-error id="usia-error" :messages="$errors->get('usia')" class="field-error" />
                            </div>
                            <div class="form-field">
                                <label for="kelas">Tingkat / Jenjang Kelas <span>*</span></label>
                                <select id="kelas" name="kelas" required aria-describedby="kelas-error">
                                    <option value="">Pilih kelas</option>
                                    @foreach (['X', 'XI', 'XII'] as $kelas)
                                        <option value="{{ $kelas }}" @selected(old('kelas') === $kelas)>Kelas {{ $kelas }}</option>
                                    @endforeach
                                </select>
                                <x-input-error id="kelas-error" :messages="$errors->get('kelas')" class="field-error" />
                            </div>
                            <div class="form-field form-span-two">
                                <label for="sekolah">Sekolah <span>*</span></label>
                                <input id="sekolah" name="sekolah" type="text" value="{{ old('sekolah', config('flora.school_name')) }}" maxlength="150" required autocomplete="organization" aria-describedby="sekolah-error">
                                <x-input-error id="sekolah-error" :messages="$errors->get('sekolah')" class="field-error" />
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-field form-span-two">
                        <label for="email">Email Akun <span>*</span></label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required aria-describedby="email-help email-error">
                        <small id="email-help" class="field-help">Email disimpan sebagai kontak akun; pemulihan kata sandi melalui email belum tersedia.</small>
                        <x-input-error id="email-error" :messages="$errors->get('email')" class="field-error" />
                    </div>
                    <div class="form-field">
                        <label for="password">Kata Sandi <span>*</span></label>
                        <input id="password" name="password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required aria-describedby="password-error">
                        <x-input-error id="password-error" :messages="$errors->get('password')" class="field-error" />
                    </div>
                    <div class="form-field">
                        <label for="password_confirmation">Konfirmasi Kata Sandi <span>*</span></label>
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                    </div>
                </div>

                <div class="privacy-callout">
                    <span class="privacy-callout-icon" aria-hidden="true">♧</span>
                    <p><strong>Pemberitahuan Privasi &amp; Etika Penelitian</strong><br>Data akun digunakan untuk keperluan edukasi. Pelajari <a href="{{ route('privacy') }}">kebijakan privasi</a> sebelum melanjutkan.</p>
                </div>
                <label class="consent-row" for="privacy_notice_acknowledged">
                <input id="privacy_notice_acknowledged" name="privacy_notice_acknowledged" type="checkbox" value="1" @checked(old('privacy_notice_acknowledged')) required aria-describedby="privacy-consent-error">
                <span>Saya telah membaca pemberitahuan privasi.</span>
                </label>
                <x-input-error id="privacy-consent-error" :messages="$errors->get('privacy_notice_acknowledged')" class="field-error" />

                <button class="button auth-submit" type="submit">Daftar &amp; Mulai Pretest <span aria-hidden="true">→</span></button>
            </form>

            <div class="auth-switch"><span>Sudah memiliki akun?</span><a href="{{ route('login') }}">Masuk Siswa di Sini</a></div>
            <a class="help-link" href="{{ route('privacy') }}">Perlu bantuan? Baca informasi privasi</a>
        </section>
    </div>

    <aside class="support-strip">
        <span class="support-icon" aria-hidden="true">✚</span>
        <div><strong>Dukungan Tenaga Kesehatan dan Konseling Guru</strong><p>Jika kamu mengalami keluhan, konsultasikan dengan tenaga kesehatan profesional atau guru pendamping.</p></div>
        <a href="{{ route('privacy') }}">Pelajari Privasi <span aria-hidden="true">→</span></a>
    </aside>
</x-guest-layout>
