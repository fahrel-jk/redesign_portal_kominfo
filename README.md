# Portal Layanan Digital Diskominfo Jawa Timur

![Laravel Version](https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge&logo=laravel)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38BDF8?style=for-the-badge&logo=tailwind-css)
![Status](https://img.shields.io/badge/Status-Ready%20for%20Integration-success?style=for-the-badge)

Rancangan portal layanan digital terpadu Dinas Komunikasi dan Informatika (Diskominfo) Provinsi Jawa Timur. Aplikasi ini mengintegrasikan direktori layanan publik, manajemen domain & path reverse proxy, serta CMS admin untuk pengelolaan kategori, layanan, dan user administrator.

---

## 📌 Fitur Utama

### 1. Public Portal (Landing Page)
* **Visual Premium & Modern**: Desain responsif, modern, dynamic city silhouette, dan komponen liquid glass panel.
* **Direktori Layanan Dinamis**: Menampilkan daftar layanan dan kategori aktif secara real-time dari database.
* **Pencarian & Filtering Instant**: Filter kategori berbasis chips dan pencarian nama/deskripsi layanan berbasis JavaScript client-side instant.
* **Dukungan Tipe Akses Layanan**:
  * **Domain (Eksternal)**: Mengarahkan pengguna langsung ke URL subdomain/domain terpisah (misal: `https://sima.kominfo.jatimprov.go.id`).
  * **Path (Terintegrasi)**: Mengarahkan pengguna ke path pada domain utama (misal: `https://kominfo.jatimprov.go.id/sima`).
* **Widget Interaktif Tambahan**: Informasi cuaca realtime Surabaya, Kalender Kegiatan Pemprov, Galeri Event 3D Carousel, dan Berita Terkini.

### 2. Secret Admin CMS (`/admin`)
* **Autentikasi Aman**: Login/logout admin dengan enkripsi password `Bcrypt`.
* **Dashboard Analytics**: Overview total statistik kategori, layanan aktif/non-aktif, dan user CMS.
* **CRUD Service Categories**: Tambah, ubah, hapus, kelola `sort_order`, dan toggle status aktif/non-aktif.
* **CRUD Services**: Form interaktif dengan validasi khusus `access_type` (`domain` wajib URL & `path` wajib path URL), ikon Lucide, dan toggle status aktif.
* **User Management**: Pengelolaan akun administrator dengan proteksi agar tidak dapat menghapus admin terakhir.

---

## ⚙️ Persyaratan Sistem

* **PHP**: `>= 8.2` (dengan ekstensi SQLite/MySQL, OpenSSL, PDO, Mbstring)
* **Composer**: `>= 2.x`
* **Node.js**: `>= 18.x` & NPM

---

## 🚀 Panduan Instalasi & Penggunaan

### 1. Clone & Install Dependencies
```bash
git clone https://github.com/kominfo-jatim/portal-layanan.git
cd redesign_portal_kominfo

composer install
npm install
```

### 2. Konfigurasi Environment
Salin file `.env.example` ke `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Secara default, aplikasi menggunakan database **SQLite** local. Anda juga dapat mengkonfigurasi MySQL pada `.env`:
```env
DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite
```

Jika menggunakan SQLite, pastikan file database dibuat jika belum ada:
```bash
touch database/database.sqlite
```

### 3. Migrasi Database & Seeding
Jalankan migrasi dan seeder untuk membuat tabel serta memasukkan data sampel:
```bash
php artisan migrate:fresh --seed
```

#### Kredensial Default Admin CMS:
* **URL Login**: `http://localhost:8000/admin/login`
* **Email**: `admin@kominfo.jatimprov.go.id`
* **Password**: `password`

### 4. Kompilasi Aset Frontend & Jalankan Server
```bash
# Jalankan Vite server (opsional untuk HMR development)
npm run dev

# Jalankan server Laravel
php artisan serve
```

Akses portal publik di `http://localhost:8000`.

---

## 🧪 Pengujian (Unit & Feature Testing)

Aplikasi dilengkapi dengan pengujian otomatis menggunakan **Pest PHP / PHPUnit** yang menguji seluruh fungsionalitas publik dan CMS admin:

```bash
php artisan test
```

### Hasil Pengujian:
* `Tests\Feature\PublicPortalTest`: Pengujian landing page, dynamic URL generator (`access_type`), dan penyaringan layanan aktif.
* `Tests\Feature\AdminAuthTest`: Pengujian login, logout, dan guard otentikasi admin.
* `Tests\Feature\AdminCategoryTest`: Pengujian CRUD dan toggle status kategori.
* `Tests\Feature\AdminServiceTest`: Pengujian CRUD layanan, validasi domain vs path.
* `Tests\Feature\AdminUserTest`: Pengujian pengelolaan user dan proteksi akun admin.

---

## 🏗️ Struktur Arsitektur Data

```text
Database Entities
├── service_categories
│   ├── id, name, slug, description, icon, is_active, sort_order, timestamps
│
├── services
│   ├── id, service_category_id (FK), name, slug, description, access_type ('domain'|'path')
│   ├── url, path, icon, is_active, sort_order, timestamps
│   └── Accessor: public_url (Dynamic URL binding)
│
└── users
    └── id, name, email, password, role, timestamps
```

---

## 📄 Catatan Integrasi ke Website Utama

1. **Repository Isolation**: Aplikasi ini dibangun secara modular agar mudah di-merge ke repository utama website Kominfo Jawa Timur.
2. **Reverse Proxy Compatibility**: Layanan dengan `access_type = path` memanfaatkan helper `public_url` di model `Service` yang secara otomatis menyesuaikan base URL aplikasi domain utama.

---

## 📜 Lisensi & Hak Cipta
Dinas Komunikasi dan Informatika Provinsi Jawa Timur © 2026. All Rights Reserved.
