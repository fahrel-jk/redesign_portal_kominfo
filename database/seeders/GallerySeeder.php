<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Peringatan Maulid Nabi Muhammad SAW di Masjid Al-Akbar Surabaya',
                'tag' => 'KEGIATAN',
                'description' => 'Jajaran Pemprov Jatim dan masyarakat menghadiri Peringatan Maulid Nabi Muhammad SAW.',
                'image' => 'images/galeri_event_maulid.png',
                'event_datetime' => '2026-09-22 07:50:00',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Pasar Murah Kominfo Jatim Stabilkan Harga Bahan Pokok',
                'tag' => 'PASAR MURAH',
                'description' => 'Operasi pasar murah bahan pokok diselenggarakan untuk membantu pemenuhan kebutuhan warga.',
                'image' => 'images/galeri_pasar_murah.png',
                'event_datetime' => '2026-09-20 09:30:00',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Workshop Siber & CSIRT Pemprov Jawa Timur 2026',
                'tag' => 'CSIRT JATIM',
                'description' => 'Peningkatan kapabilitas tim tanggap insiden siber dalam mengamankan infrastruktur digital.',
                'image' => 'images/event_tech_summit.png',
                'event_datetime' => '2026-09-18 13:15:00',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Gallery::create($item);
        }
    }
}
