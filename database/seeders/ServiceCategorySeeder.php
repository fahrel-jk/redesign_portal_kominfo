<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Pemerintahan',
                'slug' => 'pemerintahan',
                'description' => 'Layanan digital untuk mendukung kebutuhan administrasi dan tata kelola pemerintahan.',
                'icon' => 'building-2',
                'sort_order' => 1,
            ],
            [
                'name' => 'Informasi Publik',
                'slug' => 'informasi',
                'description' => 'Informasi publik dan keterbukaan informasi bagi seluruh masyarakat.',
                'icon' => 'newspaper',
                'sort_order' => 2,
            ],
            [
                'name' => 'Teknologi Informasi',
                'slug' => 'teknologi',
                'description' => 'Layanan aplikasi, infrastruktur digital, dan persandian daerah.',
                'icon' => 'cpu',
                'sort_order' => 3,
            ],
            [
                'name' => 'Data & Statistik',
                'slug' => 'data',
                'description' => 'Akses data sektoral, statistik, dan portal data terbuka Provinsi Jawa Timur.',
                'icon' => 'chart-no-axes-combined',
                'sort_order' => 4,
            ],
            [
                'name' => 'Komunikasi Publik',
                'slug' => 'komunikasi',
                'description' => 'Sarana aspirasi, media center, dan pusat bantuan komunikasi publik.',
                'icon' => 'megaphone',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $cat) {
            ServiceCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
