<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Info Jatim Minggu Ke-3 Bulan September 2026',
                'youtube_url' => 'https://www.youtube.com/watch?v=live_stream',
                'category' => 'UMUM',
                'description' => 'Kilas informasi kegiatan Gubernur Jawa Timur dan Kegiatan di Lingkungan Pemerintah Provinsi Jawa Timur.',
                'published_at' => '2026-09-25 08:53:00',
                'is_active' => true,
            ],
            [
                'title' => 'Info Jatim Minggu Ke-2 Bulan September 2026',
                'youtube_url' => 'https://www.youtube.com/watch?v=live_stream',
                'category' => 'UMUM',
                'description' => 'Informasi mingguan seputar perkembangan pembangunan dan program Pemprov Jatim.',
                'published_at' => '2026-09-14 10:39:00',
                'is_active' => true,
            ],
            [
                'title' => 'Info Jatim Minggu Ke-1 Bulan September 2026',
                'youtube_url' => 'https://www.youtube.com/watch?v=live_stream',
                'category' => 'INFO JATIM',
                'description' => 'Rangkuman berita dan agenda Pemprov Jawa Timur awal September 2026.',
                'published_at' => '2026-09-07 09:16:00',
                'is_active' => true,
            ],
            [
                'title' => 'Membangun Pemimpin Muda, Berkarya Dan Mendunia',
                'youtube_url' => 'https://www.youtube.com/watch?v=live_stream',
                'category' => 'PODCAST',
                'description' => 'Podcast inspiratif bersama tokoh muda Jawa Timur tentang inovasi digital.',
                'published_at' => '2026-09-07 09:14:00',
                'is_active' => true,
            ],
            [
                'title' => 'Wisata Mangrove Berdaya, Podcast Eps 108',
                'youtube_url' => 'https://www.youtube.com/watch?v=live_stream',
                'category' => 'PODCAST',
                'description' => 'Pembahasan potensi wisata ekologi mangrove Jawa Timur dalam mendongkrak ekonomi warga.',
                'published_at' => '2026-09-07 09:12:00',
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            Video::create($item);
        }
    }
}
