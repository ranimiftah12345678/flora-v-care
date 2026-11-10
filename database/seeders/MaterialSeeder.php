<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Seed the default learning modules based on official Flora-V Care presentation.
     *
     * @return array<int, array<string, mixed>>
     */
    private function modules(): array
    {
        return [
            [
                'title' => 'Mengenal Keputihan',
                'slug' => 'keputihan',
                'category' => 'apa_itu',
                'sort_order' => 1,
                'body' => implode("\n\n", [
                    "Filosofi Flora-V Care:\nFlora-V Care merupakan media edukasi berbasis website yang dapat diakses oleh remaja putri untuk meningkatkan pemahaman dan kepedulian dalam menjaga kesehatan organ reproduksi serta mencegah fluor albus atau keputihan.\n\nNama Flora-V Care terdiri dari tiga unsur:\n• Flora: merujuk pada flora normal, yaitu mikroorganisme alami yang membantu menjaga keseimbangan lingkungan vagina.\n• V: merujuk pada V-area atau vagina sebagai fokus kesehatan reproduksi.\n• Care: berarti kepedulian dan perawatan diri sebagai bentuk kesadaran remaja putri dalam menjaga kesehatan reproduksinya.",

                    "Apa Itu Keputihan (Fluor Albus)?\nFluor albus atau keputihan (vaginal discharge / leucorrhea) merupakan keluarnya cairan dari organ genitalia wanita yang bukan berupa darah. Cairan tersebut dapat memiliki konsistensi dan warna yang beragam, mulai dari cair hingga kental serta jernih, putih, kekuningan, atau kehijauan, dengan atau tanpa bau.",

                    "Penyebab dan Waktu Terjadinya:\n\n1. Keputihan Normal (Fisiologis):\n• Perubahan hormon alami tubuh\n• Peningkatan hormon estrogen\n• Menjelang atau sesudah masa menstruasi\n• Saat masa ovulasi (masa subur)\n\n2. Keputihan Tidak Normal (Patologis):\n• Warna cairan yang tidak normal (kuning kehijauan, abu-abu, kemerahan, cokelat)\n• Menimbulkan bau tidak sedap atau menyengat\n• Disertai rasa gatal, iritasi, perih, atau nyeri di area kewanitaan\n• Higienitas pribadi (personal hygiene) yang kurang baik",
                ]),
            ],
            [
                'title' => 'Jenis & Perubahan',
                'slug' => 'jenis-keputihan',
                'category' => 'jenis',
                'sort_order' => 2,
                'body' => implode("\n\n", [
                    "Jenis Keputihan Secara Klinis:\n\n1. Keputihan Normal (Fisiologis):\nCairan yang keluar dari organ genitalia wanita yang bukan berupa darah dan tidak disebabkan oleh penyakit (infeksi atau radang). Merupakan proses alami tubuh dalam membersihkan dan melembapkan organ intim.\n\n2. Keputihan Tidak Normal (Patologis):\nCairan yang keluar dari organ reproduksi wanita yang tidak normal, disebabkan oleh infeksi mikroorganisme atau kondisi medis tertentu. Umumnya disertai perubahan warna, tekstur, bau tidak sedap, dan keluhan rasa tidak nyaman.",

                    "Jenis Keputihan Berdasarkan Mikrobiologis (Penyebab Infeksi):\n\n• Jamur (Candida albicans):\nKeputihan tampak putih kental menyerupai gumpalan susu atau keju cottage, disertai rasa gatal yang hebat dan sensasi panas/perih di area vulva.\n\n• Bakteri (Bacterial Vaginosis):\nKeputihan berwarna putih keabu-abuan, bertekstur encer, dan mengeluarkan bau amis khas yang menyengat (terutama setelah membasuh atau saat berkeringat).\n\n• Parasit (Trichomonas vaginalis):\nKeputihan berwarna kuning kehijauan, berbusa, berbau busuk, serta dapat memicu nyeri saat berkemih dan peradangan pada dinding vagina.",
                ]),
            ],
            [
                'title' => 'Tanda & Gejala',
                'slug' => 'tanda-gejala',
                'category' => 'tanda_gejala',
                'sort_order' => 3,
                'body' => implode("\n\n", [
                    "Mengenali Tanda dan Gejala Keputihan:\n\n1. Tanda Keputihan Normal:\n• Warna: Jernih bening, putih susu, atau menyerupai putih telur mentah.\n• Tekstur: Licin, elastis, atau kental ringan.\n• Bau: Tidak mengeluarkan bau menyengat atau berbau asam ringan alami.\n• Kenyamanan: Tidak menimbulkan gatal, panas, nyeri, maupun kemerahan.",

                    "2. Tanda Keputihan Tidak Normal (Patologis):\n• Perubahan Warna: Kuning, hijau pekat, abu-abu, merah muda/bercampur bercak darah, atau kecokelatan.\n• Perubahan Tekstur: Menggumpal seperti keju pecah, berbusa, atau terlalu encer bercampur lendir keruh.\n• Bau: Amis, asam menyengat, atau berbau busuk tajam.\n• Keluhan Penyerta: Rasa gatal intens, perih saat buang air kecil, iritasi kemerahan di bibir vagina, dan nyeri pada perut bagian bawah.",

                    "Kapan Harus Memeriksakan Diri?\nJika kamu mengalami salah satu tanda keputihan patologis di atas dan keluhan tidak kunjung membaik setelah menjaga kebersihan dasar, segera konsultasikan kepada petugas kesehatan di UKS, bidan, atau puskesmas.",
                ]),
            ],
            [
                'title' => 'Kebiasaan Sehat',
                'slug' => 'pencegahan',
                'category' => 'pencegahan',
                'sort_order' => 4,
                'body' => implode("\n\n", [
                    "Langkah Higienitas Mandiri (Vulva Hygiene):\n\n1. Cara Mencuci Organ Kewanitaan yang Benar:\n• Basuh selalu dari arah DEPAN ke BELAKANG (dari vagina ke arah anus), jangan pernah terbalik agar kuman dari anus tidak berpindah ke saluran reproduksi.\n• Gunakan air bersih mengalir yang suhunya netral.\n• Keringkan secara lembut menggunakan handuk bersih atau tisu yang tidak mudah hancur sebelum mengenakan pakaian dalam.\n\n2. Hindari Produk Beraroma dan Bahan Kimia Keras:\n• Hindari sabun mandi wangi, cairan pembersih kewanitaan antiseptik harian (douche), atau bedak tabur di area intim.\n• Vagina memiliki mekanisme pembersihan alami dengan pH asam seimbang. Sabun kimia dapat membunuh bakteri baik (Lactobacillus) dan memicu infeksi jamur atau bakteri.\n\n3. Pemilihan Pakaian Dalam yang Tepat:\n• Gunakan pakaian dalam berbahan katun 100% yang menyerap keringat dan memiliki sirkulasi udara baik.\n• Hindari pakaian dalam berbahan nilon sintetis atau pakaian luar yang terlalu ketat.\n• Ganti pakaian dalam minimal 2 sampai 3 kali sehari, terutama setelah beraktivitas fisik, berkeringat, atau basah.",
                ]),
            ],
            [
                'title' => 'Higienitas & Menstruasi',
                'slug' => 'higienitas',
                'category' => 'pencegahan',
                'sort_order' => 5,
                'body' => implode("\n\n", [
                    "Praktik Higienitas Harian Tambahan:\n\n1. Penggunaan Pantyliner yang Bijak:\n• Gunakan pantyliner hanya saat benar-benar diperlukan (misalnya pada hari-hari terakhir menstruasi).\n• Ganti pantyliner setiap 2 hingga 3 jam sekali agar area kewanitaan tidak menjadi lembap dan menjadi sarang berkembang biak kuman.\n• Hindari pemakaian pantyliner harian secara terus-menerus tanpa jeda.\n\n2. Kebiasaan Cuci Tangan 3 Langkah:\n• Cuci tangan dengan sabun dan air mengalir SEBELUM menyentuh area kewanitaan atau mengganti pembalut.\n• Cuci tangan kembali SETELAH membersihkan diri.\n• Pastikan kuku terpotong rapi dan bersih dari kotoran.\n\n3. Jangan Berbagi Handuk atau Pakaian:\n• Gunakan handuk pribadi yang kering dan bersih.\n• Jangan saling bertukar handuk, pakaian dalam, atau celana dengan orang lain untuk mencegah penularan kuman dan jamur antar-individu.\n\nIngat Pesan Kunci:\nVulva Hygiene adalah bentuk cinta dan kepedulian kita terhadap kesehatan tubuh sendiri. Kenali, Pahami, Cegah!",
                ]),
            ],
        ];
    }

    public function run(): void
    {
        foreach ($this->modules() as $module) {
            Material::query()->updateOrCreate(
                ['slug' => $module['slug']],
                [
                    'title' => $module['title'],
                    'category' => $module['category'],
                    'body' => $module['body'],
                    'sort_order' => $module['sort_order'],
                    'is_published' => true,
                ],
            );
        }
    }
}
