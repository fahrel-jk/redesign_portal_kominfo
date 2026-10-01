<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Pemerintah Provinsi Jawa Timur Percepat Transformasi Layanan Digital Terpadu',
                'category' => 'pemerintahan',
                'summary' => 'Dinas Komunikasi dan Informatika Provinsi Jawa Timur terus melakukan integrasi seluruh sistem informasi ke dalam satu portal terpadu untuk mempermudah akses layanan publik bagi masyarakat.',
                'image' => 'images/galeri_event_maulid.png',
                'read_time' => '3 min baca',
                'published_at' => '2026-09-22',
                'is_active' => true,
            ],
            [
                'title' => 'Jatim Digital Festival 2026 Siap Digelar di Surabaya',
                'category' => 'digital',
                'summary' => 'Festival teknologi dan inovasi digital tahunan terbesar di Jawa Timur menghadirkan pameran startup dan solusi digital.',
                'image' => 'images/event_tech_summit.png',
                'read_time' => '2 min baca',
                'published_at' => '2026-09-20',
                'is_active' => true,
            ],
            [
                'title' => 'Pasar Murah Digital Kominfo Jatim Sambut Hari Jadi Jatim',
                'category' => 'pengumuman',
                'summary' => 'Operasi pasar murah bahan pokok diselenggarakan secara digital untuk membantu pemenuhan kebutuhan warga.',
                'image' => 'images/galeri_pasar_murah.png',
                'read_time' => '4 min baca',
                'published_at' => '2026-09-18',
                'is_active' => true,
            ],
            [
                'title' => 'CSIRT Jatim Raih Penghargaan Pengamanan Siber Terbaik',
                'category' => 'digital',
                'summary' => 'Peningkatan kapabilitas tim tanggap insiden siber Pemprov Jatim dalam mengamankan infrastruktur digital.',
                'image' => 'images/event_tech_summit.png',
                'read_time' => '3 min baca',
                'published_at' => '2026-09-15',
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            News::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'category' => $item['category'],
                'summary' => $item['summary'],
                'image' => $item['image'],
                'read_time' => $item['read_time'],
                'published_at' => $item['published_at'],
                'is_active' => $item['is_active'],
            ]);
        }
    }
}
