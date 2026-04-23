# Sistem Voting Ketua Senat Fakultas

Aplikasi web untuk pemilihan Ketua Senat Fakultas secara online dengan sistem satu mahasiswa satu suara.

## 📋 Daftar Isi
1. [Persyaratan Sistem](#persyaratan-sistem)
2. [Fitur Utama](#fitur-utama)
3. [Instalasi](#instalasi)
4. [Penggunaan](#penggunaan)
5. [Struktur Basis Data](#struktur-basis-data)
6. [Akun Demo](#akun-demo)
7. [Panduan Pengguna](#panduan-pengguna)

---

## ⚙️ Persyaratan Sistem

- PHP 8.2+
- Laravel 11
- MySQL 5.7+
- Composer
- Node.js & NPM (untuk asset compilation)

## ✨ Fitur Utama

### 1. Autentikasi & Otorisasi
- Login/Logout
- Registrasi Mahasiswa
- Role-based Access Control (Admin & Mahasiswa)
- Middleware protection

### 2. Dashboard Admin
- Statistik keseluruhan (total mahasiswa, kandidat, suara)
- Grafik hasil voting real-time (Bar Chart & Pie Chart)
- Tabel hasil voting terperinci

### 3. Dashboard Mahasiswa
- Informasi pemilihan
- Status voting (sudah/belum vote)
- Grafik hasil voting real-time
- Daftar kandidat dengan progress voting

### 4. Manajemen Data
- **CRUD Mahasiswa**: Tambah, edit, hapus, cari data mahasiswa
- **CRUD Kandidat**: Tambah, edit, hapus, cari data kandidat
- Upload foto kandidat
- Pagination & search functionality

### 5. Sistem Voting
- Pilih kandidat dari daftar yang tersedia
- Validasi one-student-one-vote (duplikasi voting dicegah)
- Konfirmasi sebelum voting
- Pengalaman voting yang intuitif

### 6. Hasil Voting
- Hasil voting real-time
- Grafik Bar Chart dan Pie Chart
- Tabel perolehan suara
- Persentase untuk setiap kandidat

### 7. Laporan & Administrasi
- Laporan hasil voting komprehensif
- Export data ke CSV
- Reset voting (dengan password confirmation)

### 8. Keamanan
- Password hashing (bcrypt)
- CSRF protection
- Form validation
- Role-based authorization
- Cascade delete untuk data relasional

---

## 🚀 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd project-voting
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voting_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Buat Database & Run Migrations
```bash
php artisan migrate
php artisan db:seed
```

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Start Application
```bash
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

---

## 📖 Penggunaan

### Admin
1. Login dengan email: `admin@example.com`, password: `password`
2. Kelola mahasiswa (CRUD)
3. Kelola kandidat (CRUD + upload foto)
4. Monitor hasil voting real-time
5. Export laporan voting
6. Reset voting jika diperlukan

### Mahasiswa
1. Daftar akun atau login
2. Lihat dashboard dengan informasi pemilihan
3. Mulai voting jika belum vote
4. Pilih kandidat dari daftar
5. Konfirmasi pilihan
6. Lihat hasil voting real-time

---

## 🗄️ Struktur Basis Data

### Entity Relationship Diagram (ERD)

```
users (1) ←→ (1) mahasiswa
mahasiswa (1) ←→ (N) voting ←→ (N) kandidat

Relasi:
- users 1:1 mahasiswa (one-to-one)
- mahasiswa 1:N voting (one-to-many)
- kandidat 1:N voting (one-to-many)
- mahasiswa 1:1 voting (unique constraint)
```

### Tabel: users
```
- id (PK)
- name
- email (UNIQUE)
- password
- role (ENUM: admin, mahasiswa)
- created_at
- updated_at
```

### Tabel: mahasiswa
```
- id (PK)
- nim (UNIQUE)
- nama
- jurusan
- angkatan
- user_id (FK → users.id, CASCADE)
- created_at
- updated_at
```

### Tabel: kandidat
```
- id (PK)
- nama_kandidat
- visi
- misi
- foto
- created_at
- updated_at
```

### Tabel: voting
```
- id (PK)
- mahasiswa_id (FK → mahasiswa.id, CASCADE, UNIQUE)
- kandidat_id (FK → kandidat.id, CASCADE)
- created_at
- updated_at
```

---

## 👥 Akun Demo

### Admin
- **Email**: admin@example.com
- **Password**: password
- **Role**: Admin

### Mahasiswa (10 akun)
- **Email**: mahasiswa1@example.com hingga mahasiswa10@example.com
- **Password**: password (untuk semua)
- **Role**: Mahasiswa
- **NIM**: 201111001 hingga 201111010

---

## 📱 Panduan Pengguna

### Untuk Admin

#### 1. Dashboard Admin
- Lihat statistik keseluruhan
- Monitor hasil voting dengan grafik
- Lihat tabel hasil voting

#### 2. Kelola Mahasiswa
- **Menu**: Data Mahasiswa
- **Fitur**:
  - Tambah mahasiswa baru
  - Edit data mahasiswa
  - Hapus mahasiswa
  - Cari mahasiswa (NIM atau Nama)
  - Pagination

#### 3. Kelola Kandidat
- **Menu**: Data Kandidat
- **Fitur**:
  - Tambah kandidat dengan foto
  - Edit data kandidat
  - Hapus kandidat
  - Upload/ubah foto
  - Cari kandidat

#### 4. Laporan Voting
- **Menu**: Laporan
- **Fitur**:
  - Lihat hasil voting terperinci
  - Peringkat kandidat
  - Export ke CSV
  - Reset voting (dengan konfirmasi password)

### Untuk Mahasiswa

#### 1. Dashboard Mahasiswa
- Lihat informasi pemilihan
- Lihat status voting (sudah/belum)
- Monitor hasil voting
- Lihat daftar kandidat dengan progress

#### 2. Voting
- **Menu**: Voting
- **Proses**:
  1. Lihat semua kandidat beserta visi dan misi
  2. Klik tombol "Pilih Kandidat Ini"
  3. Konfirmasi pilihan
  4. Voting selesai (tidak bisa mengubah)
  5. Redirect ke halaman hasil voting

#### 3. Hasil Voting
- **Menu**: Hasil Voting
- **Tampilan**:
  - Grafik Bar Chart
  - Grafik Pie Chart
  - Tabel perolehan suara
  - Persentase setiap kandidat
  - Auto-refresh setiap 5 detik

---

## 🔐 Validasi Keamanan

### One Student One Vote
- Setiap mahasiswa hanya bisa vote 1 kali
- Constraint UNIQUE pada tabel voting (mahasiswa_id)
- Validasi di aplikasi sebelum voting
- Tidak bisa mengubah pilihan setelah voting

### Password Security
- Password di-hash dengan bcrypt
- Minimal 8 karakter saat registrasi
- Admin dapat membuat akun mahasiswa dengan password yang aman

### Authorization
- Admin hanya bisa akses halaman admin
- Mahasiswa hanya bisa akses halaman mahasiswa
- Middleware protection di routing
- Role-based access control

---

## 📊 Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 11
- **Database**: MySQL
- **ORM**: Eloquent
- **Validation**: Laravel Validation
- **Authentication**: Laravel Auth

### Frontend
- **Template**: Blade
- **CSS Framework**: Bootstrap 5
- **Icons**: Font Awesome 6
- **Chart**: Chart.js 3.9.1

### DevTools
- **Composer**: Dependency Manager
- **NPM**: Package Manager
- **Git**: Version Control

---

## 📝 Struktur Project

```
project-voting/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── MahasiswaController.php
│   │   │   ├── KandidatController.php
│   │   │   ├── VotingController.php
│   │   │   └── LaporanController.php
│   │   └── Middleware/
│   │       ├── IsAdmin.php
│   │       └── IsMahasiswa.php
│   └── Models/
│       ├── User.php
│       ├── Mahasiswa.php
│       ├── Kandidat.php
│       └── Voting.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2024_04_22_000001_create_mahasiswa_table.php
│   │   ├── 2024_04_22_000002_create_kandidat_table.php
│   │   └── 2024_04_22_000003_create_voting_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── dashboard/
│       │   ├── admin.blade.php
│       │   └── mahasiswa.blade.php
│       ├── mahasiswa/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── kandidat/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── voting/
│       │   ├── index.blade.php
│       │   └── hasil.blade.php
│       └── laporan/
│           ├── index.blade.php
│           └── reset.blade.php
├── routes/
│   └── web.php
├── bootstrap/
│   └── app.php
├── database.sql
└── README.md
```

---

## 🔧 Troubleshooting

### 1. Storage Link Error
```bash
php artisan storage:link
```

### 2. Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### 3. Database Issues
```bash
php artisan migrate:refresh --seed
```

### 4. Permission Issues
```bash
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## 📞 Support

Untuk pertanyaan atau masalah, silakan hubungi tim pengembang.

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik/kampus.

---

**Versi**: 1.0  
**Last Updated**: 2024-04-22  
**Status**: Production Ready
