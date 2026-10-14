# WORKFLOW.md — Alur Pengembangan Project Jeep Wukirsari

> Dokumen ini mendefinisikan alur kerja, aturan Git, strategi branch, konvensi commit, dan proses review untuk project Jeep Wukirsari.

---

## 1. Gambaran Umum Tahapan Project

```
Tahap 1 — Initial Setup          ← Saat ini
Tahap 2 — Desain Database
Tahap 3 — Autentikasi & Role
Tahap 4 — Modul Paket Wisata
Tahap 5 — Modul Pemesanan (Booking)
Tahap 6 — Modul Pembayaran
Tahap 7 — Dashboard Admin
Tahap 8 — Pengujian & QA
Tahap 9 — Deployment
```

Setiap tahap diselesaikan dan di-review sebelum memulai tahap berikutnya.

---

## 2. Strategi Branch

### 2.1 Branch Utama

| Branch | Fungsi | Siapa yang merge |
|--------|--------|-----------------|
| `main` | Branch production — selalu stabil dan siap deploy | Hanya via PR yang sudah di-review |
| `dev` | Branch integrasi pengembangan aktif | Merge dari branch fitur setelah review |

### 2.2 Branch Fitur

Dibuat dari `dev` dan di-merge kembali ke `dev` melalui Pull Request.

**Format penamaan branch:**

```
feature/<nama-fitur>     # Fitur baru
fix/<nama-bug>           # Perbaikan bug
hotfix/<nama-issue>      # Perbaikan kritis di production
refactor/<nama-modul>    # Refactoring kode
docs/<nama-dokumen>      # Perubahan dokumentasi
chore/<nama-task>        # Task maintenance (update dep, config, dll.)
```

**Contoh:**
```
feature/halaman-paket-wisata
feature/form-pemesanan
fix/validasi-tanggal-booking
hotfix/error-halaman-home
docs/update-readme
chore/update-laravel-dependencies
```

### 2.3 Alur Branch (Git Flow Sederhana)

```
main
 └── dev
      ├── feature/halaman-paket-wisata
      ├── feature/form-pemesanan
      └── fix/validasi-tanggal-booking
```

---

## 3. Konvensi Commit

Gunakan format **Conventional Commits**:

```
<type>(<scope>): <deskripsi singkat dalam bahasa Inggris>

[body opsional — penjelasan lebih detail]

[footer opsional — issue reference]
```

### 3.1 Tipe Commit

| Tipe | Digunakan untuk |
|------|----------------|
| `feat` | Fitur baru |
| `fix` | Perbaikan bug |
| `docs` | Perubahan dokumentasi saja |
| `style` | Perubahan formatting, tidak mengubah logika |
| `refactor` | Refactoring kode tanpa menambah fitur atau fix bug |
| `test` | Menambah atau mengubah test |
| `chore` | Maintenance — update dependency, konfigurasi, dll. |
| `perf` | Peningkatan performa |
| `ci` | Perubahan CI/CD |

### 3.2 Contoh Commit yang Benar

```bash
# Fitur baru
feat(packages): add PackageController with index and show methods

# Perbaikan bug
fix(booking): fix date validation not rejecting past dates

# Dokumentasi
docs(readme): add MySQL setup instructions for XAMPP

# Style / CSS
style(home): adjust hero section padding for mobile

# Chore
chore(deps): update laravel/framework to v12.70

# Refactor
refactor(booking): extract price calculation to BookingService
```

### 3.3 Aturan Pesan Commit

- Gunakan **kalimat imperatif** ("add", "fix", "update" — bukan "added", "fixed", "updated").
- Baris pertama maksimal **72 karakter**.
- Pisahkan judul dan body dengan satu baris kosong.
- Referensikan issue jika ada: `Closes #12`, `Refs #8`.
- **DILARANG** commit dengan pesan generik seperti `fix`, `update`, `wip`, `asdf`.

---

## 4. Alur Pengembangan Fitur

### 4.1 Langkah-langkah

```bash
# 1. Pastikan dev up-to-date
git checkout dev
git pull origin dev

# 2. Buat branch fitur baru
git checkout -b feature/nama-fitur

# 3. Kerjakan fitur, commit secara berkala
git add .
git commit -m "feat(scope): deskripsi perubahan"

# 4. Sebelum PR, pastikan test lulus
php artisan test

# 5. Push branch ke GitHub
git push origin feature/nama-fitur

# 6. Buat Pull Request ke branch 'dev' di GitHub
#    (bukan langsung ke main)

# 7. Setelah review dan approve, merge ke dev
# 8. Hapus branch fitur setelah merge
git branch -d feature/nama-fitur
```

### 4.2 Checklist Sebelum Membuat Pull Request

- [ ] Kode sudah diuji secara manual (fungsional berjalan).
- [ ] `php artisan test` lulus tanpa error.
- [ ] Tidak ada `dd()`, `dump()`, `var_dump()`, atau `console.log()` yang tertinggal.
- [ ] File `.env` tidak ikut di-commit.
- [ ] Migration sudah diuji (`php artisan migrate:fresh --seed` berhasil).
- [ ] Pesan commit sudah mengikuti konvensi.
- [ ] Tidak ada konflik merge dengan branch `dev`.

---

## 5. Aturan Pull Request (PR)

### 5.1 Format Deskripsi PR

```markdown
## Ringkasan
[Apa yang dilakukan PR ini?]

## Perubahan
- [Perubahan 1]
- [Perubahan 2]

## Cara Testing
1. [Langkah 1]
2. [Langkah 2]

## Screenshot (jika perubahan UI)
[Lampirkan screenshot sebelum dan sesudah]

## Issue terkait
Closes #[nomor issue]
```

### 5.2 Aturan Review PR

- PR ke `dev` bisa di-merge setelah minimal **1 approval**.
- PR ke `main` harus melalui review lebih ketat — hanya saat siap release.
- **DILARANG** self-merge (merge PR milik sendiri) tanpa review dari orang lain, kecuali di tahap initial setup.
- Jika ada review comment, perbaiki dan push ulang — jangan buat PR baru.

---

## 6. Aturan Git Harian

```bash
# Sebelum mulai kerja: selalu pull terbaru
git pull origin dev

# Commit kecil dan sering — jangan tumpuk perubahan besar dalam 1 commit
# Satu commit = satu perubahan logis

# Jangan commit file yang tidak perlu:
# - vendor/
# - .env
# - node_modules/
# - storage/logs/*.log
# - .DS_Store, Thumbs.db
```

---

## 7. Konfigurasi .gitignore

File `.gitignore` sudah dikonfigurasi oleh Laravel. Pastikan selalu ada entri berikut:

```
/vendor
/.env
/node_modules
/storage/logs
/public/hot
/public/storage
/.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
```

---

## 8. Perintah Artisan yang Sering Digunakan

```bash
# Menjalankan server development
php artisan serve

# Menjalankan migration
php artisan migrate

# Rollback migration terakhir
php artisan migrate:rollback

# Fresh migration + seed
php artisan migrate:fresh --seed

# Membuat file baru
php artisan make:controller NamaController
php artisan make:model NamaModel -m          # sekaligus buat migration
php artisan make:request NamaRequest
php artisan make:seeder NamaSeeder
php artisan make:factory NamaFactory
php artisan make:middleware NamaMiddleware

# Melihat semua route
php artisan route:list

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Jalankan test
php artisan test
php artisan test --filter=NamaTest

# Symlink storage
php artisan storage:link
```

---

## 9. Pengujian

### 9.1 Jenis Test

| Jenis | Lokasi | Digunakan untuk |
|-------|--------|----------------|
| Unit Test | `tests/Unit/` | Testing logika terisolasi (Service, Helper) |
| Feature Test | `tests/Feature/` | Testing endpoint dan alur pengguna |

### 9.2 Aturan Pengujian

- Setiap fitur baru **wajib** disertai minimal 1 Feature Test.
- Jalankan `php artisan test` sebelum setiap PR.
- Test menggunakan database terpisah (konfigurasi di `phpunit.xml`).
- Gunakan Factory untuk membuat data testing.

---

## 10. Riwayat Tahap Pengerjaan

| Tahap | Status | Branch | Tanggal |
|-------|--------|--------|---------|
| Initial Setup | ✅ Selesai | `main` | Oktober 2026 |
| Desain Database | ⏳ Belum dimulai | — | — |
| Autentikasi & Role | ⏳ Belum dimulai | — | — |
| Modul Paket Wisata | ⏳ Belum dimulai | — | — |
| Modul Pemesanan | ⏳ Belum dimulai | — | — |
| Modul Pembayaran | ⏳ Belum dimulai | — | — |
| Dashboard Admin | ⏳ Belum dimulai | — | — |
| Pengujian & QA | ⏳ Belum dimulai | — | — |
| Deployment | ⏳ Belum dimulai | — | — |

---

*Terakhir diperbarui: Oktober 2026*
