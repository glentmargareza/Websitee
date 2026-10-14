# 🚙 Jeep Wukirsari

> Website pemesanan paket wisata jeep off-road di Wukirsari, Sleman, Yogyakarta.

---

## Deskripsi Project

**Jeep Wukirsari** adalah platform digital untuk pemesanan paket wisata petualangan menggunakan kendaraan jeep di kawasan Wukirsari. Website ini memudahkan calon wisatawan untuk melihat paket yang tersedia, melakukan pemesanan secara online, dan mengelola perjalanan wisata mereka.

### Fitur yang Direncanakan

- 🗺️ Katalog paket wisata jeep (berbagai rute & durasi)
- 📅 Sistem pemesanan online dengan kalender ketersediaan
- 💳 Integrasi pembayaran online
- 👤 Manajemen akun pengguna
- 🛠️ Dashboard admin untuk pengelolaan paket dan pemesanan

---

## Teknologi

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| Backend | PHP + Laravel | PHP 8.2, Laravel 12 |
| Database | MySQL | 8.x (via XAMPP) |
| Frontend | Blade + HTML + CSS + JS | — |
| Local Server | XAMPP | — |
| Version Control | Git + GitHub | — |

---

## Persyaratan Sistem

Sebelum menjalankan project, pastikan perangkat Anda memiliki:

- **PHP** versi 8.2 atau lebih baru
- **Composer** versi 2.x
- **XAMPP** (dengan Apache dan MySQL aktif)
- **Git** versi 2.x atau lebih baru
- **Node.js** dan **npm** (opsional, untuk asset compilation)

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/<username>/jeep-wukirsari.git
cd jeep-wukirsari
```

### 2. Install Dependency PHP

```bash
composer install
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database MySQL

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=jeep_wukirsari
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan untuk XAMPP:** Username default MySQL XAMPP adalah `root` dengan password kosong.

### 6. Buat Database di MySQL

Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) dan buat database baru dengan nama `jeep_wukirsari`.

Atau bisa menggunakan MySQL CLI:

```sql
CREATE DATABASE jeep_wukirsari CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Jalankan Migration

```bash
php artisan migrate
```

### 8. (Opsional) Jalankan Seeder

```bash
php artisan db:seed
```

---

## Menjalankan Aplikasi

### Via XAMPP

1. Pastikan XAMPP berjalan dengan **Apache** dan **MySQL** aktif.
2. Akses aplikasi di browser:

```
http://localhost/website/public
```

### Via PHP Artisan (Development Server)

```bash
php artisan serve
```

Kemudian buka browser ke:

```
http://localhost:8000
```

---

## Konfigurasi Tambahan

### Storage Link

Buat symlink untuk file upload:

```bash
php artisan storage:link
```

### Clear Cache (jika diperlukan)

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

---

## Struktur Folder Utama

```
website/
├── app/
│   ├── Http/Controllers/    # Controller aplikasi
│   ├── Models/              # Eloquent Models
│   └── Http/Requests/       # Form validation
├── database/
│   ├── migrations/          # Struktur tabel
│   └── seeders/             # Data awal
├── public/
│   ├── css/                 # Stylesheet
│   ├── js/                  # JavaScript
│   └── images/              # Gambar statis
├── resources/views/
│   ├── layouts/             # Layout Blade utama
│   ├── pages/               # Halaman
│   └── components/          # Komponen Blade
└── routes/web.php           # Routing web
```

---

## Pengembangan

Lihat [WORKFLOW.md](WORKFLOW.md) untuk panduan lengkap alur pengembangan, aturan Git, branch strategy, dan konvensi commit.

Lihat [AGENTS.md](AGENTS.md) untuk aturan standar coding dan ketentuan AI agent.

---

## Kontribusi

1. Fork repository ini.
2. Buat branch fitur baru: `git checkout -b feature/nama-fitur`
3. Commit perubahan Anda: `git commit -m "feat: tambah fitur X"`
4. Push ke branch: `git push origin feature/nama-fitur`
5. Buat Pull Request ke branch `dev`.

---

## Lisensi

Project ini dikembangkan untuk keperluan internal. Seluruh hak cipta dilindungi.

---

*Versi Laravel: 12.x &nbsp;|&nbsp; PHP: 8.2 &nbsp;|&nbsp; Dibuat: Oktober 2026*
