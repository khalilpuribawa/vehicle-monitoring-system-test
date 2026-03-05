# Vehicle Monitoring & Booking System

Sistem web responsif untuk manajemen pemesanan kendaraan operasional perusahaan tambang nikel. Dibangun dengan alat modern termasuk Laravel 11, Tailwind CSS v4, Flowbite, dan Chart.js.

## Fitur Utama

- **Dashboard:** Menampilkan statistik grafik penggunaan kendaraan (Angkutan Orang vs Barang).
- **Pemesanan:** Flow pemesanan kendaraan dengan pemilihan driver.
- **Persetujuan Berurutan:** Alur verifikasi pemesanan oleh dua tingkat atasan (Sequential Approval).
- **Ekspor Excel:** Fitur unduhan laporan pemesanan dalam format Excel (.xlsx).
- **Log Histori:** Sistem mencatat setiap penambahan atau perubahan status otomatis.

## Persyaratan Sistem

- PHP 8.2+
- Composer
- Node.js & NPM
- Database: MySQL / PostgreSQL / SQLite (default)

## Instalasi

1. **Clone repositori dan masuk ke direktori proyek:**
   ```bash
   git clone <repo-url>
   cd vehicle-monitoring
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Instal dependensi dan jalankan build Node.js:**
   ```bash
   npm install
   npm run build
   ```

4. **Konfigurasi Lingkungan:**
   - Salin file `.env.example` ke `.env`.
   - Pastikan konfigurasi `DB_CONNECTION` sesuai dengan database pilihan Anda (SQLite, MySQL, dll).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Jalankan Migrasi dan Seeder:**
   Proses ini akan membuat skema database dan memasukkan data admin, approver, kendaraan, serta driver awal.
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Jalankan Server Lokal Laravel:**
   ```bash
   php artisan serve
   ```
   Aplikasi akan berjalan di `http://localhost:8000`.

## Kredensial Login Default

Saat menjalankan seeder, beberapa user default akan dibuat:

- **Admin (Pembuat Pesanan):**
  - Username: `admin`
  - Password: `admin123`

- **Approver Level 1:**
  - Username: `approver1`
  - Password: `approver123`

- **Approver Level 2:**
  - Username: `approver2`
  - Password: `approver123`

## Teknologi yang Digunakan

- Backend: Laravel 11
- Frontend: React JS, Inertia.js
- UI/Styling: Tailwind CSS 4.0, Flowbite React / Flowbite
- Export Excel: Maatwebsite Excel
- Grafik: Chart.js
