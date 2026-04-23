# 🚀 QUICK START - Sistem Voting Ketua Senat Fakultas

Panduan singkat untuk menjalankan aplikasi dalam 5 menit!

---

## ⚡ INSTALASI CEPAT (5 MENIT)

### 1. Copy `.env`
```bash
cp .env.example .env
```

### 2. Generate Key
```bash
php artisan key:generate
```

### 3. Buat Database
```sql
CREATE DATABASE voting_db;
```

### 4. Setup Database & Seed
```bash
php artisan migrate
php artisan db:seed
```

### 5. Storage Link
```bash
php artisan storage:link
```

### 6. Jalankan
```bash
php artisan serve
```

✅ **SELESAI!** Akses: `http://localhost:8000`

---

## 🔐 AKUN DEMO

### Admin
- Email: `admin@example.com`
- Password: `password`

### Mahasiswa
- Email: `mahasiswa1@example.com` hingga `mahasiswa10@example.com`
- Password: `password` (untuk semua)

---

## 📋 FITUR UTAMA

| Fitur | Admin | Mahasiswa |
|-------|-------|-----------|
| Login/Logout | ✅ | ✅ |
| Dashboard | ✅ | ✅ |
| Kelola Mahasiswa | ✅ | ❌ |
| Kelola Kandidat | ✅ | ❌ |
| Voting | ❌ | ✅ |
| Lihat Hasil | ✅ | ✅ |
| Export Laporan | ✅ | ❌ |
| Reset Voting | ✅ | ❌ |

---

## 🎯 TESTING CEPAT

### Test Admin
1. Login: `admin@example.com` / `password`
2. Klik "Data Kandidat" → Tambah Kandidat
3. Upload foto kandidat
4. Klik "Dashboard" → Lihat grafik

### Test Mahasiswa
1. Login: `mahasiswa1@example.com` / `password`
2. Klik "Voting" → Pilih Kandidat
3. Konfirmasi voting
4. Lihat hasil real-time

---

## 📊 STRUKTUR SEDERHANA

```
app/Models/
├── User          ← Admin & Mahasiswa
├── Mahasiswa     ← Data mahasiswa
├── Kandidat      ← Data kandidat
└── Voting        ← Data voting

app/Http/Controllers/
├── AuthController      ← Login/Register
├── DashboardController ← Dashboard
├── MahasiswaController ← CRUD Mahasiswa
├── KandidatController  ← CRUD Kandidat
├── VotingController    ← Voting System
└── LaporanController   ← Reports

resources/views/
├── auth/        ← Login & Register
├── dashboard/   ← Admin & Mahasiswa Dashboard
├── mahasiswa/   ← Mahasiswa CRUD
├── kandidat/    ← Kandidat CRUD
├── voting/      ← Voting Pages
└── laporan/     ← Reports
```

---

## ❓ MASALAH UMUM

**Q: Port 8000 sudah digunakan?**
```bash
php artisan serve --port=8080
```

**Q: Database error?**
- Pastikan MySQL running
- Cek `.env` (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- Jalankan: `php artisan migrate`

**Q: Foto tidak muncul?**
```bash
php artisan storage:link
```

**Q: Lupa login?**
- Admin: `admin@example.com` / `password`
- Mahasiswa: `mahasiswa1@example.com` / `password`

---

## 📞 SESUATU TIDAK BEKERJA?

Cek log:
```bash
tail -f storage/logs/laravel.log
```

Reset & setup ulang:
```bash
php artisan migrate:refresh --seed
```

---

## ✅ SIAP!

Sistem voting Anda sudah berjalan! 🎉

Untuk info lebih lengkap, baca: `DOCUMENTATION.md` dan `SETUP.md`

---

**Happy Voting!** 🗳️
