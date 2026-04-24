<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apakah sistem bekerja di Jagoan Indonesia dilakukan di kantor atau dapat bekerja dari rumah?',
                'answer' => 'Saat ini kami lebih mengutamakan bekerja di kantor untuk memaksimalkan produktivitas serta efisiensi penyaluran pengetahuan antara kawan magang dengan mentor, terutama pada masa on-boarding sangat disarankan untuk bekerja di kantor sepenuhnya agar membantu proses adaptasi Anda di Jagoan Indonesia.',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'question' => 'Berapa lama durasi magang di Jagoan Indonesia?',
                'answer' => 'Durasi minimal magang adalah 3 bulan dan dapat diperpanjang sesuai kesepakatan antara perusahaan dan peserta magang.',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah Jagoan Indonesia menerima magang wajib dari sekolah atau kampus (PKL)?',
                'answer' => 'Jagoan Indonesia sangat terbuka untuk menerima pengajuan magang wajib dari sekolah/kampus dengan rangkaian seleksi individual yang sama dengan pengajuan magang reguler.',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah Jagoan Indonesia menerima pendaftaran magang secara berkelompok?',
                'answer' => 'Untuk saat ini tidak. Setiap pelamar akan melalui proses seleksi dan evaluasi secara individual, sehingga kami tidak dapat menjamin seluruh anggota kelompok dapat diterima.',
                'sort_order' => 4,
                'is_published' => true,
            ],
            [
                'question' => 'Apakah magang di Jagoan Indonesia digaji atau tidak digaji?',
                'answer' => 'Saat ini sistem magang yang berlaku di Jagoan Indonesia adalah Paid Internship, kami selalu mengevaluasi dan memberikan apresiasi kepada siapapun yang telah memberikan kontribusi dan dampak positif bagi perusahaan.',
                'sort_order' => 5,
                'is_published' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
