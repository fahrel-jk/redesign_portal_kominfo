# Portal Layanan Digital Diskominfo Jatim

Aplikasi portal terpadu untuk Dinas Komunikasi dan Informatika Provinsi Jawa Timur. Sistem ini berfungsi sebagai direktori layanan publik dan manajemen akses layanan (domain & reverse proxy path), lengkap dengan CMS untuk pengelolaan data.

## Fitur

- **Direktori Layanan**: Daftar layanan publik yang aktif, dikelompokkan berdasarkan kategori.
- **Pencarian & Filter**: Pencarian layanan berdasarkan nama atau deskripsi, serta filter kategori.
- **Manajemen Akses**: Mendukung dua tipe akses untuk setiap layanan:
  - `Domain` (Eksternal): Mengarahkan pengguna ke URL terpisah (contoh: sima.kominfo.jatimprov.go.id).
  - `Path` (Internal): Mengarahkan pengguna ke path pada domain utama (contoh: kominfo.jatimprov.go.id/sima).
- **CMS Admin**: Panel administrasi tertutup untuk mengelola kategori, layanan, dan pengguna sistem.
- **Widget Tambahan**: Integrasi informasi cuaca Surabaya, agenda kegiatan pemerintah provinsi, dan berita terbaru.

## Kebutuhan Sistem

- PHP >= 8.2 (termasuk ekstensi OpenSSL, PDO, Mbstring, dan database driver yang digunakan)
- Composer >= 2.x
- Node.js >= 18.x

## Cara Instalasi

1. Clone repository dan install dependensi PHP maupun JavaScript:
   ```bash
   git clone https://github.com/kominfo-jatim/portal-layanan.git
   cd redesign_portal_kominfo
   composer install
   npm install
   ```

2. Konfigurasi environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Aplikasi secara default menggunakan SQLite. Jika menggunakan SQLite, pastikan file database tersedia:*
   ```bash
   touch database/database.sqlite
   ```

3. Jalankan migrasi dan seeder untuk menyiapkan struktur tabel dan data awal:
   ```bash
   php artisan migrate:fresh --seed
   ```
   *Kredensial bawaan untuk login admin:*
   - **Email:** admin@kominfo.jatimprov.go.id
   - **Password:** admin123

4. Build aset dan jalankan server lokal:
   ```bash
   npm run dev
   php artisan serve
   ```
   Aplikasi publik dapat diakses melalui `http://localhost:8000` dan panel admin melalui `http://localhost:8000/admin/login`.

## Pengujian

Aplikasi ini dilengkapi test suite menggunakan Pest / PHPUnit untuk menguji fungsionalitas publik dan admin. Jalankan perintah berikut untuk menjalankan seluruh pengujian:
```bash
php artisan test
```

## Arsitektur Data

Struktur utama database terdiri dari tiga entitas:
- `service_categories`: Menyimpan data kategori layanan beserta urutan tampilannya.
- `services`: Menyimpan detail layanan publik, tipe akses (`domain` / `path`), status aktif, dan referensi ke kategori.
- `users`: Menyimpan data autentikasi dan peran administrator CMS.

## Catatan Integrasi

Aplikasi ini dirancang modular agar mudah digabungkan dengan repository utama portal Jawa Timur. Fitur pengelolaan layanan dengan `access_type = path` telah disesuaikan agar kompatibel dengan implementasi reverse proxy pada server produksi.
