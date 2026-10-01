<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Workshop Cyber Security & CSIRT Pemprov Jatim 2026',
                'tag' => 'Workshop Siber',
                'event_date' => '2026-09-22',
                'date_label' => '22 September 2026',
                'location' => 'Ruang Bromo Diskominfo Jatim, Surabaya',
                'image' => 'images/galeri_event_maulid.png',
                'is_active' => true,
            ],
            [
                'title' => 'Pembukaan Jatim Digital Hackathon & Innovation Expo 2026',
                'tag' => 'Hackathon',
                'event_date' => '2026-09-25',
                'date_label' => '25 September 2026',
                'location' => 'Grand City Convention Center, Surabaya',
                'image' => 'images/event_tech_summit.png',
                'is_active' => true,
            ],
            [
                'title' => 'Pasar Murah Digital & Bazar UMKM Binaan Kominfo',
                'tag' => 'Pasar Murah',
                'event_date' => '2026-09-26',
                'date_label' => '26 September 2026',
                'location' => 'Halaman Utama Diskominfo Jatim, Surabaya',
                'image' => 'images/galeri_pasar_murah.png',
                'is_active' => true,
            ],
            [
                'title' => 'Kejuaraan Sepatu Roda & Marathon Jatim Digital 2026',
                'tag' => 'Festival / Kejuaraan',
                'event_date' => '2026-09-27',
                'date_label' => '25 - 27 Sep 2026',
                'location' => 'Grand City Convention Hall & Balai Kota Surabaya',
                'image' => 'images/event_tech_summit.png',
                'is_active' => true,
            ],
            [
                'title' => 'Sosialisasi Keterbukaan Informasi Publik PPID Utama',
                'tag' => 'Sosialisasi',
                'event_date' => '2026-09-30',
                'date_label' => '30 September 2026',
                'location' => 'Gedung Negara Grahadi, Surabaya',
                'image' => 'images/galeri_event_maulid.png',
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Event::create($item);
        }
    }
}
