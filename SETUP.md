# 🚀 SETUP DAN CARA MENJALANKAN SISTEM VOTING

## Prasyarat
✅ PHP 8.2+  
✅ MySQL 5.7+  
✅ Composer  
✅ Node.js & NPM  

---

## 📋 LANGKAH-LANGKAH SETUP

### STEP 1: Konfigurasi Database

Buat database baru di MySQL:
```sql
CREATE DATABASE voting_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### STEP 2: Update File .env

Edit file `.env` di root project:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=voting_db
DB_USERNAME=root
DB_PASSWORD=
```

### STEP 3: Generate Application Key

```bash
php artisan key:generate
```

### STEP 4: Jalankan Migrations & Seeder

```bash
# Buat semua tabel
php artisan migrate

# Seed database dengan data demo
php artisan db:seed
```

### STEP 5: Buat Storage Link

```bash
php artisan storage:link
```

Ini untuk menghubungkan folder `storage` dengan `public` agar foto bisa diakses.

### STEP 6: Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### STEP 7: Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser dan akses: **http://localhost:8000**

---

## 🔐 AKUN LOGIN DEMO

Setelah seed, Anda akan memiliki akun demo berikut:

### Admin
```
Email: admin@example.com
Password: password
```

### Mahasiswa (10 akun)
```
Email: mahasiswa1@example.com - mahasiswa10@example.com
Password: password
```

---

## ✅ CEK INSTALASI

Pastikan semuanya berjalan dengan baik:

1. **Database**: 
   - ✅ Database `voting_db` sudah dibuat
   - ✅ Tabel `users`, `mahasiswa`, `kandidat`, `voting` sudah ada

2. **Aplikasi**:
   - ✅ Bisa akses `http://localhost:8000`
   - ✅ Bisa login dengan akun demo

3. **Storage**:
   - ✅ Folder `storage/app/public` terhubung ke `public/storage`
   - ✅ Foto kandidat bisa di-upload dan ditampilkan

---

## 📁 STRUKTUR FOLDER PENTING

```
project-voting/
├── app/Models/              ← Model Eloquent
├── app/Http/Controllers/    ← Business Logic
├── app/Http/Middleware/     ← Authorization
├── database/
│   ├── migrations/          ← Schema Database
│   └── seeders/             ← Sample Data
├── resources/views/         ← Blade Templates
├── routes/                  ← Routing
├── storage/app/public/      ← Upload Foto
└── public/storage/          ← Link ke storage (auto-created)
```

---

## 🎯 FITUR UTAMA YANG SIAP DIGUNAKAN

✅ **Login/Logout**
- Admin dan Mahasiswa bisa login
- Session management
- Password hashing

✅ **Dashboard**
- Admin: Statistik + Grafik + Tabel hasil
- Mahasiswa: Status voting + Grafik + Daftar kandidat

✅ **CRUD Mahasiswa**
- Tambah, edit, hapus, cari mahasiswa
- Validasi NIM unique
- Pagination

✅ **CRUD Kandidat**
- Tambah, edit, hapus, cari kandidat
- Upload foto
- Validasi file gambar

✅ **Voting System**
- One-student-one-vote validation
- Kandidat selection interface
- Voting confirmation

✅ **Hasil Voting**
- Real-time results
- Chart.js visualization (Bar + Pie)
- Percentage calculation

✅ **Laporan**
- Export to CSV
- Reset voting (password protected)
- Ranking display

✅ **Security**
- Role-based access control
- CSRF protection
- Password hashing
- Input validation

---

## 🔧 TIPS & TROUBLESHOOTING

### Masalah: Port 8000 sudah terpakai
```bash
php artisan serve --port=8080
```

### Masalah: Storage link error
```bash
php artisan storage:link
```

### Masalah: Database connection error
- Pastikan MySQL running
- Cek konfigurasi `.env`
- Cek username & password MySQL

### Masalah: Foto tidak muncul
```bash
php artisan storage:link
php artisan cache:clear
```

### Reset Database
```bash
php artisan migrate:refresh --seed
```

---

## 📊 TESTING WORKFLOW

### 1. Test Admin
```
1. Login: admin@example.com / password
2. Kunjungi Data Mahasiswa → Lihat daftar
3. Kunjungi Data Kandidat → Tambah kandidat + upload foto
4. Kunjungi Dashboard Admin → Lihat grafik
5. Kunjungi Laporan → Export CSV
```

### 2. Test Mahasiswa - Voting
```
1. Login: mahasiswa1@example.com / password
2. Kunjungi Voting
3. Pilih salah satu kandidat
4. Klik "Pilih Kandidat Ini"
5. Confirm dialog
6. Redirect ke hasil voting (auto-refresh)
```

### 3. Test Mahasiswa - Sudah Vote
```
1. Login: mahasiswa2@example.com / password
2. Di dashboard, akan terlihat "Anda sudah melakukan voting"
3. Coba akses voting page → redirect ke hasil voting
```

---

## 📞 PERLU BANTUAN?

Jika ada error, cek:

1. **Log file**: `storage/logs/laravel.log`
2. **Browser console**: F12 → Console tab
3. **Database**: Check dengan MySQL Workbench atau phpMyAdmin
4. **Permissions**: Pastikan folder `storage` & `bootstrap/cache` writable

---

## 🎓 SELESAI!

Sistem voting Anda sudah siap digunakan! 

🎉 Selamat menggunakan E-Voting!

---

**Versi**: 1.0  
**Status**: Production Ready ✅  
**Last Updated**: 2024-04-22
