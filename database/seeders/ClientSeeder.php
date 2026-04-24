<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Kementerian Pendidikan Indonesia',
                'logo_path' => null,
                'website_url' => 'https://www.kemdikbud.go.id',
                'description' => 'Kementerian Pendidikan dan Kebudayaan Republik Indonesia',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Universitas Indonesia',
                'logo_path' => null,
                'website_url' => 'https://www.ui.ac.id',
                'description' => 'Universitas terkemuka di Indonesia',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Pemerintah Provinsi DKI Jakarta',
                'logo_path' => null,
                'website_url' => 'https://www.jakarta.go.id',
                'description' => 'Pemerintah Provinsi Daerah Khusus Ibukota Jakarta',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'PT Telkom Indonesia',
                'logo_path' => null,
                'website_url' => 'https://www.telkom.co.id',
                'description' => 'Perusahaan telekomunikasi terbesar di Indonesia',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kementerian Kesehatan RI',
                'logo_path' => null,
                'website_url' => 'https://www.kemkes.go.id',
                'description' => 'Kementerian Kesehatan Republik Indonesia',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'logo_path' => null,
                'website_url' => 'https://www.itb.ac.id',
                'description' => 'Institusi pendidikan teknik terkemuka',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'PT Bank Mandiri',
                'logo_path' => null,
                'website_url' => 'https://www.bankmandiri.co.id',
                'description' => 'Bank terbesar di Indonesia',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Komunitas Pengembang Software Indonesia',
                'logo_path' => null,
                'website_url' => '#',
                'description' => 'Komunitas profesional pengembang software',
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
