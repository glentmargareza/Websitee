# AGENTS.md — Aturan AI Agent untuk Project Jeep Wukirsari

> File ini mendefinisikan aturan, standar, dan batasan yang harus dipatuhi oleh AI agent (Antigravity, Copilot, atau assistant lain) saat bekerja pada project ini.

---

## 1. Identitas Project

| Properti | Nilai |
|----------|-------|
| **Nama** | Jeep Wukirsari |
| **Deskripsi** | Website pemesanan paket wisata jeep off-road |
| **Framework** | Laravel 12 (PHP 8.2+) |
| **Database** | MySQL via XAMPP |
| **Frontend** | Blade, HTML, CSS, JavaScript |
| **Environment** | XAMPP (localhost) |

---

## 2. Aturan Umum AI Agent

### 2.1 Sebelum Mengubah Kode

- **WAJIB** membaca file yang akan diubah terlebih dahulu.
- **WAJIB** memahami konteks file tersebut dalam arsitektur project.
- **DILARANG** menghapus atau menimpa file yang sudah ada tanpa konfirmasi eksplisit developer.
- **DILARANG** membuat fitur baru sebelum developer menyetujui rancangannya.
- **DILARANG** mengubah konfigurasi production (`.env`, `config/*.php`) tanpa instruksi yang jelas.
- Jika menemukan bug di luar scope task, **laporkan ke developer**, jangan langsung diperbaiki.

### 2.2 Saat Menulis Kode

- Ikuti standar **PSR-12** untuk PHP.
- Gunakan konvensi penamaan Laravel:
  - `snake_case` — nama kolom dan tabel database
  - `camelCase` — variabel PHP
  - `PascalCase` — nama class dan namespace
  - `kebab-case` — nama route dan URL
- Tambahkan komentar deskriptif pada logika yang kompleks.
- **DILARANG** meninggalkan kode debugging (`dd()`, `dump()`, `var_dump()`, `console.log()`) di branch `main` atau `dev`.
- Gunakan **Eloquent ORM** atau **Query Builder**, bukan raw SQL kecuali ada kebutuhan khusus.

### 2.3 Scope Perubahan

- Hanya ubah file yang relevan dengan task yang sedang dikerjakan.
- Hindari refactoring besar di luar scope task.
- Setiap perubahan harus dapat dijelaskan dalam satu kalimat yang jelas.

---

## 3. Standar Coding PHP & Laravel

### 3.1 Struktur Controller

Controller hanya bertugas menerima request, memanggil logika bisnis, dan mengembalikan response. Controller **tidak boleh** mengandung logika bisnis langsung.

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    public function __construct(
        private readonly BookingService $bookingService
    ) {}

    public function create(): View
    {
        return view('pages.booking.create');
    }

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $this->bookingService->create($request->validated());
        return redirect()->route('home')->with('success', 'Pemesanan berhasil!');
    }
}
```

### 3.2 Struktur Model

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration_hours',
        'capacity',
        'is_active',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Scope: hanya paket aktif
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // Relasi
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
```

### 3.3 Blade Template

- Gunakan **komponen Blade** (`<x-component-name>`) untuk elemen yang berulang.
- Hindari logika bisnis di dalam file Blade.
- Selalu gunakan `@csrf` pada setiap form POST/PUT/DELETE.
- Gunakan `{{ }}` untuk output yang di-escape (anti-XSS).
- Gunakan `{!! !!}` hanya jika konten sudah aman dan diperlukan (mis. HTML dari sanitized source).

### 3.4 Validasi

Selalu gunakan Form Request class untuk validasi. Jangan taruh validasi di Controller secara langsung untuk form yang kompleks.

```php
// Buat dengan: php artisan make:request StoreBookingRequest
class StoreBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_name'  => ['required', 'string', 'max:100'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'package_id'     => ['required', 'exists:packages,id'],
            'booking_date'   => ['required', 'date', 'after:today'],
        ];
    }
}
```

---

## 4. Keamanan

### 4.1 Environment & Kredensial

- **DILARANG** menyimpan password, API key, atau secret di repository.
- Gunakan `.env` untuk semua konfigurasi sensitif.
- Pastikan `.env` selalu ada di `.gitignore`.
- Gunakan `.env.example` sebagai template tanpa nilai asli.

### 4.2 Input & Output

- Validasi **semua** input dari pengguna sebelum diproses.
- Gunakan `{{ }}` di Blade (auto-escape XSS).
- Hindari raw SQL; gunakan parameter binding jika terpaksa.
- Gunakan Mass Assignment protection (`$fillable` atau `$guarded`) pada setiap Model.

### 4.3 CSRF & Autentikasi

- Selalu gunakan `@csrf` pada form HTML.
- Jangan menonaktifkan CSRF middleware untuk route yang menerima input pengguna.
- Gunakan middleware `auth` untuk melindungi route yang membutuhkan login.
- Gunakan **Laravel Policy** atau **Gate** untuk otorisasi aksi.

### 4.4 File Upload (jika ada di masa depan)

- Validasi tipe dan ukuran file sebelum menyimpan.
- Simpan upload di `storage/app/public/`, bukan di `public/` langsung.
- Gunakan `php artisan storage:link` untuk membuat symlink.

---

## 5. Struktur Project

```
website/                          # Root project Laravel
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Controller aplikasi
│   │   ├── Middleware/           # Middleware custom
│   │   └── Requests/             # Form Request (validasi)
│   ├── Models/                   # Eloquent Models
│   ├── Providers/                # Service Providers
│   └── Services/                 # Business logic (jika diperlukan)
├── config/                       # Konfigurasi Laravel
├── database/
│   ├── migrations/               # Migrasi tabel (dibuat setelah DB dirancang)
│   ├── seeders/                  # Data awal sistem
│   └── factories/                # Factory untuk testing
├── public/
│   ├── css/app.css               # Stylesheet utama
│   ├── js/app.js                 # JavaScript utama
│   └── images/                  # Gambar publik statis
├── resources/
│   └── views/
│       ├── layouts/app.blade.php # Layout utama
│       ├── pages/                # Halaman (home, tentang, dll.)
│       └── components/           # Komponen Blade (navbar, footer, dll.)
├── routes/
│   └── web.php                   # Routing web
├── storage/
│   └── app/public/               # File upload pengguna
├── .env.example                  # Template environment
├── .gitignore                    # File yang dikecualikan dari Git
├── AGENTS.md                     # Aturan AI agent (file ini)
├── WORKFLOW.md                   # Alur kerja pengembangan
└── README.md                     # Dokumentasi project
```

---

## 6. Pengelolaan Database

### 6.1 Aturan Migrasi

- **DILARANG** membuat tabel bisnis atau migrasi fitur sebelum rancangan database disetujui developer.
- Setiap migrasi harus memiliki method `down()` yang reversible.
- Gunakan nama migrasi yang deskriptif:
  - ✅ `create_jeep_packages_table`
  - ✅ `add_notes_column_to_bookings_table`
  - ❌ `update_table`
- **DILARANG** mengubah migrasi yang sudah pernah di-run di production. Buat migrasi baru.

### 6.2 Konvensi Penamaan Database

| Elemen | Konvensi | Contoh |
|--------|----------|--------|
| Tabel | `snake_case` plural | `jeep_packages`, `booking_orders` |
| Kolom | `snake_case` | `customer_name`, `booking_date` |
| Primary key | `id` (auto-increment) | `id` |
| Foreign key | `{singular_table}_id` | `package_id`, `user_id` |
| Timestamp | `created_at`, `updated_at` | (via `$table->timestamps()`) |

### 6.3 Seeder & Factory

- Seeder untuk **data awal sistem** yang diperlukan (bukan data testing dalam jumlah besar).
- Factory + Faker untuk data dummy pengujian (`php artisan db:seed --class=...`).

---

## 7. Aturan Git (Ringkasan)

> Detail lengkap ada di `WORKFLOW.md`.

- **DILARANG** commit langsung ke branch `main`.
- Buat branch fitur dari `dev`: `feature/nama-fitur`.
- Format commit: `type(scope): deskripsi singkat` — lihat `WORKFLOW.md`.
- Jalankan `php artisan test` sebelum membuat Pull Request.
- Pastikan tidak ada error atau warning yang tertinggal.

---

## 8. Ketentuan Berdasarkan Tahap Pengerjaan

| Tahap | Boleh | Dilarang |
|-------|-------|----------|
| **Initial Setup** (saat ini) | Setup struktur, konfigurasi, dokumentasi, layout dasar, routing dasar | Fitur login, booking, pembayaran, CRUD, dashboard, migrasi bisnis |
| **Development** (berikutnya) | Semua yang sudah dirancang dan disetujui | Perubahan arsitektur tanpa diskusi |
| **Production** | Deploy, monitoring | Mengedit file production langsung |

---

*Terakhir diperbarui: Oktober 2026 — Versi Laravel: 12.x — PHP: 8.2*
