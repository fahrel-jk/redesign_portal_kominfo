**PROJECT BRIEF**

Portal Layanan  
Kominfo Jawa Timur

Rancangan portal layanan digital yang terintegrasi dengan website utama Diskominfo Provinsi Jawa Timur

**Konteks Proyek**

Portal dikembangkan sebagai aplikasi terpisah untuk tahap desain dan pengembangan awal. Setelah stabil dan memenuhi acceptance criteria, aplikasi dipersiapkan untuk diintegrasikan ke repository serta infrastruktur website utama Kominfo Jawa Timur.

| **Item**            | **Keterangan**                                                                                                          |
| ------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| Nama Proyek         | Portal Layanan Kominfo Jawa Timur                                                                                       |
| Tujuan Utama        | Memusatkan daftar layanan dan mempermudah transisi layanan dari domain/subdomain terpisah menjadi path di domain utama. |
| Target Implementasi | Laravel + Tailwind CSS + database relasional                                                                            |
| Bentuk Output       | Landing page, CMS, database migration/seeder, dokumentasi, dan repository Git siap integrasi                            |
| Status Dokumen      | Brief pengembangan / bahan penugasan magang                                                                             |

# 1\. Latar Belakang

Lingkup layanan digital Diskominfo Provinsi Jawa Timur dapat tersebar pada domain atau subdomain layanan yang berbeda. Kondisi tersebut membuat akses layanan menjadi kurang terpusat dan menyulitkan pengelolaan alamat layanan dalam jangka panjang.

Portal Layanan Kominfo Jawa Timur dikembangkan sebagai katalog layanan terpusat yang nantinya dapat menjadi pintu masuk ke berbagai layanan. Sebagian layanan dapat tetap menggunakan domain/subdomain tersendiri, sedangkan layanan yang telah diintegrasikan melalui reverse proxy dapat diakses menggunakan path pada domain utama, misalnya:

```
Domain lama / layanan mandiri
https://sima.kominfo.jatimprov.go.id

Path pada domain utama
https://kominfo.jatimprov.go.id/sima
```

# 2\. Tujuan

- Menyediakan satu portal untuk menampilkan dan mengelola informasi berbagai layanan Kominfo Jawa Timur.
- Menyiapkan struktur data layanan yang dapat membedakan layanan yang masih berada pada domain/subdomain sendiri dengan layanan yang sudah menggunakan path domain utama.
- Menyediakan CMS agar administrator dapat menambah, mengubah, menonaktifkan, dan mengelompokkan layanan secara dinamis.
- Menghasilkan landing page yang selaras dengan identitas visual website Kominfo Jawa Timur saat ini.
- Menghasilkan source code yang terstruktur dan cukup modular untuk diintegrasikan kembali ke repository website utama.

# 3\. Ruang Lingkup

## 3.1. Landing / Public Portal

- Menampilkan kategori layanan.
- Menampilkan daftar layanan yang aktif dari database.
- Menampilkan detail singkat layanan.
- Menyediakan pencarian layanan.
- Mengarahkan pengguna ke URL layanan sesuai konfigurasi domain/path.
- Mengikuti gaya visual, tipografi, warna, dan pola layout yang konsisten dengan website Kominfo Jawa Timur.

## 3.2. CMS / Admin

| **Modul**          | **Fungsi Minimum**                                                                                          |
| ------------------ | ----------------------------------------------------------------------------------------------------------- |
| Authentication     | Login admin/CMS dan logout.                                                                                 |
| Dashboard          | Ringkasan jumlah kategori dan layanan serta status aktif/nonaktif.                                          |
| Service Categories | List, tambah, ubah, hapus, aktif/nonaktif, dan pengurutan kategori.                                         |
| Services           | List, tambah, ubah, hapus, aktif/nonaktif, kategori, konfigurasi akses domain/path, dan pengurutan layanan. |
| Users              | Minimal pengelolaan user CMS/admin; role dapat sederhana untuk tahap awal.                                  |

# 4\. Konsep Arsitektur Data

Portal ini tidak ditujukan untuk menggantikan struktur content existing pada website utama. Existing website saat ini memiliki konsep seperti navigation_menus dan pages untuk kebutuhan konten/halaman. Portal layanan menggunakan entity services sendiri karena layanan merupakan entity bisnis/katalog, bukan sekadar halaman konten.

```
Website utama
├── navigation_menus
├── pages
└── konten website

Portal layanan
├── service_categories
├── services
└── users
```

# 5\. Rancangan Database Minimum

## 5.1. service_categories

| **Field**   | **Tipe/Contoh** | **Keterangan**                         |
| ----------- | --------------- | -------------------------------------- |
| id          | BIGINT / UUID   | Primary key.                           |
| name        | VARCHAR         | Nama kategori layanan.                 |
| slug        | VARCHAR         | Identifier URL yang unik.              |
| description | TEXT            | Deskripsi kategori, opsional.          |
| icon        | VARCHAR / TEXT  | Referensi icon, opsional.              |
| is_active   | BOOLEAN         | Menentukan kategori tampil atau tidak. |
| sort_order  | INTEGER         | Urutan tampilan.                       |
| timestamps  | DATETIME        | created_at dan updated_at.             |

## 5.2. services

| **Field**           | **Tipe/Contoh** | **Keterangan**                                                |
| ------------------- | --------------- | ------------------------------------------------------------- |
| id                  | BIGINT / UUID   | Primary key.                                                  |
| service_category_id | FK              | Relasi ke service_categories.                                 |
| name                | VARCHAR         | Nama layanan.                                                 |
| slug                | VARCHAR         | Identifier URL yang unik.                                     |
| description         | TEXT            | Deskripsi layanan.                                            |
| access_type         | ENUM / VARCHAR  | Nilai minimum: domain atau path.                              |
| url                 | VARCHAR         | URL domain/subdomain layanan; digunakan untuk layanan domain. |
| path                | VARCHAR         | Path pada domain utama, contoh /sima.                         |
| icon                | VARCHAR / TEXT  | Referensi icon, opsional.                                     |
| is_active           | BOOLEAN         | Menentukan layanan tampil atau tidak.                         |
| sort_order          | INTEGER         | Urutan tampilan.                                              |
| timestamps          | DATETIME        | created_at dan updated_at.                                    |

## 5.3. users

| **Field**  | **Tipe/Contoh** | **Keterangan**                      |
| ---------- | --------------- | ----------------------------------- |
| id         | BIGINT / UUID   | Primary key.                        |
| name       | VARCHAR         | Nama user.                          |
| email      | VARCHAR         | Email login.                        |
| password   | VARCHAR         | Password yang di-hash.              |
| role       | VARCHAR / ENUM  | Minimal admin/CMS untuk tahap awal. |
| timestamps | DATETIME        | created_at dan updated_at.          |

# 6\. Aturan Akses Service: Domain vs Path

Pembedaan akses merupakan requirement inti. Satu service harus menyimpan informasi yang cukup untuk menentukan apakah pengguna diarahkan ke domain/subdomain tersendiri atau ke path pada domain utama.

| **Access Type** | **Contoh Data**                                           | **URL Publik**                         |
| --------------- | --------------------------------------------------------- | -------------------------------------- |
| domain          | url = <https://sima.kominfo.jatimprov.go.id>; path = NULL | <https://sima.kominfo.jatimprov.go.id> |
| path            | path = /sima; url = NULL/opsional                         | <https://kominfo.jatimprov.go.id/sima> |

**Catatan implementasi:** aplikasi disarankan memiliki satu helper/accessor untuk menghasilkan public URL agar logic pembentukan URL tidak tersebar di banyak view/controller.

```
public_url = access_type == 'path'
    ? base_domain + path
    : url
```

# 7\. Relasi Data

```
service_categories
       │
       │ 1 : N
       ▼
    services

users
  └── digunakan untuk autentikasi dan pengelolaan CMS
```

# 8\. Rancangan Halaman

## 8.1. Landing Page

```
Header
  ↓
Hero + Search Layanan
  ↓
Kategori Layanan
  ↓
Daftar Layanan
  ↓
Informasi / CTA
  ↓
Footer
```

- Hero harus memiliki fokus utama pada pencarian dan penemuan layanan.
- Layanan ditampilkan berdasarkan data database dan status is_active.
- Kategori dapat digunakan untuk filtering atau grouping.
- Tampilan harus responsif untuk desktop, tablet, dan mobile.
- UI/UX mengikuti karakter visual website Kominfo Jawa Timur yang existing, tetapi tidak harus identik 1:1.

## 8.2. Halaman CMS

- Login
- Dashboard
- Service Categories
- Services
- Users
- Form tambah/edit service dengan pemilihan access_type domain/path.

# 9\. Requirement Teknis

| **Area**        | **Requirement**                                                                                                   |
| --------------- | ----------------------------------------------------------------------------------------------------------------- |
| Backend         | Laravel.                                                                                                          |
| Frontend        | HTML + Tailwind CSS; dapat menggunakan Blade untuk tahap awal.                                                    |
| Database        | Database relasional dengan migration dan foreign key.                                                             |
| Authentication  | Laravel authentication untuk akses CMS.                                                                           |
| Code Quality    | Struktur folder dan naming convention konsisten; validasi request; penggunaan relationship/Eloquent secara tepat. |
| Version Control | Git repository dengan commit yang jelas dan mudah direview.                                                       |
| Seed Data       | Seeder untuk kategori, contoh layanan, dan user admin agar aplikasi dapat dijalankan dengan cepat.                |

# 10\. Alur Pengembangan yang Disarankan

1. Buat desain landing page dalam HTML + Tailwind CSS terlebih dahulu.
2. Review desain dan struktur halaman sebelum masuk ke integrasi data.
3. Buat migration, model, relationship, factory/seeder sesuai kebutuhan.
4. Buat CMS untuk kategori layanan dan services.
5. Integrasikan data CMS ke landing page secara dinamis.
6. Implementasikan logic public URL untuk access_type domain/path.
7. Tambahkan authentication dan user management minimal.
8. Lakukan pengujian fungsi utama dan rapikan dokumentasi instalasi.
9. Siapkan branch/repository yang bersih dan siap direview untuk proses merge ke repository utama.

# 11\. Output / Deliverables

- Source code aplikasi Laravel.
- Landing page HTML + Tailwind CSS.
- CMS untuk service categories, services, dan users.
- Database migration, model, relationship, dan seeder.
- Landing page yang menampilkan layanan secara dinamis dari database.
- Konfigurasi service access_type untuk domain dan path.
- Dokumentasi instalasi, konfigurasi environment, migration, dan seeding.
- Repository Git yang rapi dan dapat di-review sebelum proses integrasi ke repository utama website Kominfo Jawa Timur.

# 12\. Acceptance Criteria

| **Kode** | **Kriteria**                                                                                           |
| -------- | ------------------------------------------------------------------------------------------------------ |
| AC-01    | Landing page dapat dijalankan dan tampil responsif pada desktop dan mobile.                            |
| AC-02    | Landing page menampilkan kategori dan service aktif dari database; tidak hardcode.                     |
| AC-03    | Admin dapat CRUD service_categories.                                                                   |
| AC-04    | Admin dapat CRUD services dan memilih kategori service.                                                |
| AC-05    | Service dapat dikonfigurasi sebagai domain atau path.                                                  |
| AC-06    | Untuk access_type=domain, tombol layanan mengarah ke URL domain/subdomain yang disimpan.               |
| AC-07    | Untuk access_type=path, tombol layanan mengarah ke path pada domain utama, misalnya /sima.             |
| AC-08    | Service inactive tidak ditampilkan di public portal.                                                   |
| AC-09    | Migration dan seeder dapat digunakan untuk menyiapkan database dari kondisi kosong.                    |
| AC-10    | Source code memiliki dokumentasi dasar dan siap melalui code review sebelum merge ke repository utama. |

# 13\. Catatan Integrasi ke Website Utama

**Pemisahan Repository Pada Tahap Awal**

Pengembangan awal dilakukan pada repository terpisah agar eksperimen desain dan implementasi tidak mengganggu repository website Kominfo Jawa Timur yang berjalan. Setelah hasil disetujui, integrasi dilakukan melalui proses review dan merge.

- Reverse proxy dan pemetaan path merupakan bagian infrastruktur/deployment; peserta magang cukup memastikan aplikasi siap menerima base path apabila dibutuhkan.
- Jangan mengubah struktur existing navigation_menus/pages pada website utama tanpa kebutuhan yang telah disepakati.
- Service portal dan content website diperlakukan sebagai domain data yang berbeda agar pengembangan tetap modular.
- Struktur service harus mendukung migrasi bertahap dari domain/subdomain ke path tanpa perlu mengubah data layanan secara besar-besaran.

# 14\. Batasan Scope Tahap Awal

- Tidak perlu membangun ulang seluruh website Kominfo Jawa Timur.
- Tidak perlu membangun reverse proxy dari sisi aplikasi Laravel.
- Tidak perlu membuat workflow approval layanan yang kompleks.
- Tidak perlu membuat integrasi ke seluruh aplikasi layanan existing pada tahap awal; cukup sediakan mekanisme katalog dan target URL.
- Fokus tahap pertama adalah fondasi data, CMS, UI landing, dan kemampuan membedakan domain/path.

\---

_Dokumen ini merupakan brief pengembangan tahap awal dan dapat disesuaikan setelah review desain serta kebutuhan integrasi._