<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ServiceCategory::all()->keyBy('slug');

        $services = [
            [
                'category_slug' => 'teknologi',
                'name' => 'SIMA',
                'description' => 'Sistem informasi untuk mendukung pengelolaan layanan digital Kominfo Jawa Timur.',
                'access_type' => 'domain',
                'url' => 'https://sima.kominfo.jatimprov.go.id',
                'path' => null,
                'icon' => 'monitor',
                'sort_order' => 1,
            ],
            [
                'category_slug' => 'pemerintahan',
                'name' => 'SIKIPO',
                'description' => 'Layanan digital untuk mendukung kebutuhan administrasi dan pemerintahan.',
                'access_type' => 'domain',
                'url' => 'https://sikipo.kominfo.jatimprov.go.id',
                'path' => null,
                'icon' => 'landmark',
                'sort_order' => 2,
            ],
            [
                'category_slug' => 'data',
                'name' => 'Data Jawa Timur',
                'description' => 'Akses informasi dan data yang berkaitan dengan Provinsi Jawa Timur.',
                'access_type' => 'path',
                'url' => null,
                'path' => '/data',
                'icon' => 'database',
                'sort_order' => 3,
            ],
            [
                'category_slug' => 'informasi',
                'name' => 'Informasi Publik',
                'description' => 'Informasi publik dan berbagai dokumen yang dapat diakses masyarakat.',
                'access_type' => 'path',
                'url' => null,
                'path' => '/informasi-publik',
                'icon' => 'file-text',
                'sort_order' => 4,
            ],
            [
                'category_slug' => 'informasi',
                'name' => 'PPID Jawa Timur',
                'description' => 'Layanan keterbukaan informasi publik Provinsi Jawa Timur.',
                'access_type' => 'domain',
                'url' => 'https://ppid.jatimprov.go.id',
                'path' => null,
                'icon' => 'folder-open',
                'sort_order' => 5,
            ],
            [
                'category_slug' => 'komunikasi',
                'name' => 'Pengaduan Masyarakat',
                'description' => 'Sarana penyampaian aspirasi, pengaduan, dan masukan masyarakat.',
                'access_type' => 'path',
                'url' => null,
                'path' => '/pengaduan',
                'icon' => 'message-square-warning',
                'sort_order' => 6,
            ],
            [
                'category_slug' => 'data',
                'name' => 'Statistik Kominfo',
                'description' => 'Informasi statistik dan data sektoral bidang komunikasi dan informatika.',
                'access_type' => 'path',
                'url' => null,
                'path' => '/statistik',
                'icon' => 'chart-no-axes-combined',
                'sort_order' => 7,
            ],
            [
                'category_slug' => 'teknologi',
                'name' => 'Layanan Persandian',
                'description' => 'Informasi dan layanan yang berkaitan dengan persandian daerah.',
                'access_type' => 'domain',
                'url' => 'https://persandian.kominfo.jatimprov.go.id',
                'path' => null,
                'icon' => 'shield-check',
                'sort_order' => 8,
            ],
            [
                'category_slug' => 'teknologi',
                'name' => 'Jaringan & Infrastruktur',
                'description' => 'Informasi layanan infrastruktur teknologi dan jaringan komunikasi.',
                'access_type' => 'domain',
                'url' => 'https://infrastruktur.kominfo.jatimprov.go.id',
                'path' => null,
                'icon' => 'network',
                'sort_order' => 9,
            ],
            [
                'category_slug' => 'komunikasi',
                'name' => 'Media Center',
                'description' => 'Pusat informasi dan publikasi kegiatan Pemerintah Provinsi Jawa Timur.',
                'access_type' => 'domain',
                'url' => 'https://mediacenter.kominfo.jatimprov.go.id',
                'path' => null,
                'icon' => 'megaphone',
                'sort_order' => 10,
            ],
            [
                'category_slug' => 'informasi',
                'name' => 'Dokumentasi Digital',
                'description' => 'Pusat dokumentasi dan arsip digital informasi Kominfo Jawa Timur.',
                'access_type' => 'path',
                'url' => null,
                'path' => '/dokumentasi',
                'icon' => 'archive',
                'sort_order' => 11,
            ],
            [
                'category_slug' => 'komunikasi',
                'name' => 'Helpdesk Kominfo',
                'description' => 'Pusat bantuan untuk mendapatkan informasi dan dukungan layanan.',
                'access_type' => 'domain',
                'url' => 'https://helpdesk.kominfo.jatimprov.go.id',
                'path' => null,
                'icon' => 'headset',
                'sort_order' => 12,
            ],
        ];

        foreach ($services as $svc) {
            $cat = $categories->get($svc['category_slug']);
            if (!$cat) continue;

            Service::updateOrCreate(
                ['slug' => Str::slug($svc['name'])],
                [
                    'service_category_id' => $cat->id,
                    'name' => $svc['name'],
                    'slug' => Str::slug($svc['name']),
                    'description' => $svc['description'],
                    'access_type' => $svc['access_type'],
                    'url' => $svc['url'],
                    'path' => $svc['path'],
                    'icon' => $svc['icon'],
                    'is_active' => true,
                    'sort_order' => $svc['sort_order'],
                ]
            );
        }
    }
}
