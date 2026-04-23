# 🗳️ Sistem Voting Ketua Senat Fakultas

Aplikasi web untuk pemilihan Ketua Senat Fakultas secara online dengan sistem satu mahasiswa satu suara.

## 🎯 Status: Production Ready ✅

**Versi**: 1.0 | **Last Updated**: 2024-04-22

---

## ✨ Fitur Utama

✅ **Authentication** - Login/Logout dengan role-based access  
✅ **Voting System** - One student one vote validation  
✅ **Real-time Results** - Hasil voting update otomatis  
✅ **Charts & Analytics** - Visualisasi dengan Chart.js  
✅ **Data Management** - CRUD untuk mahasiswa & kandidat  
✅ **File Upload** - Upload foto kandidat  
✅ **Reports** - Export laporan ke CSV  
✅ **Responsive UI** - Bootstrap 5 design  
✅ **Secure** - CSRF protection, password hashing, authorization  

---

## 🚀 Quick Start (5 Menit)

### 1. Setup Database
```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 2. Jalankan Aplikasi
```bash
php artisan serve
```

### 3. Login dengan Demo Account

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
