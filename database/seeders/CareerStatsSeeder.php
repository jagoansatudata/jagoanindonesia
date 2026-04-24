<?php

namespace Database\Seeders;

use App\Models\CareerStats;
use Illuminate\Database\Seeder;

class CareerStatsSeeder extends Seeder
{
    public function run(): void
    {
        CareerStats::create([
            'title' => 'Batch',
            'value' => '3 Batch',
            'description' => 'Program internship Jagoan Indonesia telah berjalan selama tiga batch, memberikan pengalaman nyata dan akan terus berlanjut pada batch berikutnya.',
            'icon_path' => 'images/icon-batch.svg',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        CareerStats::create([
            'title' => 'Applicants',
            'value' => '30+ Applicants',
            'description' => 'Lebih dari 30 peserta telah mendaftar program ini, berkontribusi dalam berbagai proyek nyata, sekaligus mengembangkan keterampilan dan pengalaman profesional.',
            'icon_path' => 'images/icon-applicant.svg',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        CareerStats::create([
            'title' => 'Projects',
            'value' => '10+ Projects',
            'description' => 'Lebih dari 10 proyek telah diselesaikan melalui program ini, memberikan pengalaman nyata dalam kolaborasi tim, pemecahan masalah, dan implementasi solusi berdampak.',
            'icon_path' => 'images/icon-project.svg',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        CareerStats::create([
            'title' => 'Clients',
            'value' => '10+ Clients',
            'description' => 'Lebih dari 10 klien telah kami bantu dalam menjalankan dan mengembangkan bisnisnya, mulai dari instansi swasta, pemerintah, pendidikan, hingga startup.',
            'icon_path' => 'images/icon-clients.svg',
            'sort_order' => 4,
            'is_active' => true,
        ]);
    }
}
