<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Voting Senat Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            color: #fff;
            min-height: 100vh;
        }

        /* ===== NAV ===== */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 16px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-logo .logo-icon {
            width: 34px; height: 34px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
        }

        .nav-logo span {
            font-size: 15px;
            font-weight: 700;
            color: #fff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-nav-login {
            padding: 8px 20px;
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 7px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.15s;
        }

        .btn-nav-login:hover {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }

        .btn-nav-cta {
            padding: 8px 20px;
            background: #3b82f6;
            border-radius: 7px;
            color: #fff;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 600;
            transition: background 0.15s;
        }

        .btn-nav-cta:hover {
            background: #2563eb;
            color: #fff;
        }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 15%;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 700px;
            background: radial-gradient(ellipse, rgba(59,130,246,0.14) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,130,246,0.12);
            border: 1px solid rgba(59,130,246,0.25);
            border-radius: 50px;
            padding: 6px 16px;
            font-size: 12.5px;
            color: #93c5fd;
            font-weight: 600;
            margin-bottom: 28px;
            letter-spacing: 0.3px;
        }

        .hero-badge i { font-size: 11px; }

        .hero h1 {
            font-size: clamp(34px, 6vw, 60px);
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 20px;
            letter-spacing: -1px;
            color: #fff;
        }

        .hero h1 .highlight {
            color: #60a5fa;
        }

        .hero p {
            font-size: 17px;
            color: rgba(255,255,255,0.5);
            max-width: 520px;
            margin: 0 auto 36px;
            line-height: 1.75;
        }

        .hero-cta {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            background: #3b82f6;
            color: #fff;
            border-radius: 9px;
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 700;
            transition: all 0.15s;
        }

        .btn-cta-primary:hover {
            background: #2563eb;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.8);
            border-radius: 9px;
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 600;
            transition: all 0.15s;
        }

        .btn-cta-secondary:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }

        /* ===== STATS STRIP ===== */
        .stats-strip {
            background: rgba(255,255,255,0.03);
            border-top: 1px solid rgba(255,255,255,0.06);
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 40px 0;
        }

        .stats-strip .container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 64px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-item .num {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
        }

        .stat-item .label {
            font-size: 12.5px;
            color: rgba(255,255,255,0.4);
            margin-top: 4px;
        }

        /* ===== FEATURES ===== */
        .features {
            padding: 100px 0;
        }

        .section-label {
            font-size: 11.5px;
            font-weight: 700;
            color: #60a5fa;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: clamp(26px, 4vw, 38px);
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 14px;
        }

        .section-sub {
            font-size: 16px;
            color: rgba(255,255,255,0.45);
            max-width: 480px;
            line-height: 1.7;
        }

        .feature-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 28px;
            transition: all 0.2s;
        }

        .feature-card:hover {
            background: rgba(255,255,255,0.055);
            border-color: rgba(255,255,255,0.12);
            transform: translateY(-2px);
        }

        .feature-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            margin-bottom: 18px;
        }

        .feature-icon.blue  { background: rgba(59,130,246,0.15); color: #60a5fa; }
        .feature-icon.green { background: rgba(34,197,94,0.12); color: #4ade80; }
        .feature-icon.purple{ background: rgba(139,92,246,0.15); color: #a78bfa; }
        .feature-icon.amber { background: rgba(245,158,11,0.12); color: #fbbf24; }
        .feature-icon.cyan  { background: rgba(6,182,212,0.12); color: #22d3ee; }
        .feature-icon.rose  { background: rgba(244,63,94,0.12); color: #fb7185; }

        .feature-card h5 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .feature-card p {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            margin: 0;
            line-height: 1.65;
        }

        /* ===== CTA SECTION ===== */
        .cta-section {
            padding: 100px 0;
        }

        .cta-box {
            background: linear-gradient(135deg, #1e3a5f 0%, #1e293b 100%);
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 20px;
            padding: 64px 48px;
            text-align: center;
        }

        /* ===== FOOTER ===== */
        footer {
            padding: 28px 0;
            border-top: 1px solid rgba(255,255,255,0.06);
            text-align: center;
            font-size: 13px;
            color: rgba(255,255,255,0.3);
        }

        @media (max-width: 767px) {
            nav { padding: 14px 20px; }
            .stats-strip .container { gap: 36px; }
            .cta-box { padding: 40px 24px; }
        }
    </style>
</head>
<body>

    {{-- Navigation --}}
    <nav>
        <a href="/" class="nav-logo">
            <div class="logo-icon"><i class="fas fa-vote-yea"></i></div>
            <span>E-Voting Senat</span>
        </a>
        <div class="nav-links">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}" class="btn-nav-cta">Dashboard</a>
                @else
                    <a href="{{ route('dashboard.mahasiswa') }}" class="btn-nav-cta">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-nav-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-nav-cta">Daftar</a>
            @endauth
        </div>
    </nav>

    {{-- Hero --}}
    <section class="hero">
        <div>
            <div class="hero-badge">
                <i class="fas fa-shield-alt"></i>
                Aman &bull; Transparan &bull; Terpercaya
            </div>
            <h1>
                Sistem Voting<br>
                <span class="highlight">Ketua Senat Fakultas</span>
            </h1>
            <p>
                Platform pemilihan digital yang aman dan transparan. Gunakan hak suara Anda kapan saja,
                dan pantau hasilnya secara langsung.
            </p>
            <div class="hero-cta">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard.admin') }}" class="btn-cta-primary">
                            <i class="fas fa-chart-pie"></i> Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('voting.index') }}" class="btn-cta-primary">
                            <i class="fas fa-vote-yea"></i> Mulai Voting
                        </a>
                        <a href="{{ route('voting.hasil') }}" class="btn-cta-secondary">
                            Lihat Hasil
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-cta-primary">
                        <i class="fas fa-sign-in-alt"></i> Masuk & Voting
                    </a>
                    <a href="{{ route('register') }}" class="btn-cta-secondary">
                        Daftar Akun
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <div class="stats-strip">
        <div class="container">
            <div class="stat-item">
                <div class="num">100%</div>
                <div class="label">Aman & Rahasia</div>
            </div>
            <div class="stat-item">
                <div class="num">Real-time</div>
                <div class="label">Update Hasil</div>
            </div>
            <div class="stat-item">
                <div class="num">1 Suara</div>
                <div class="label">Per Mahasiswa</div>
            </div>
            <div class="stat-item">
                <div class="num">Terverifikasi</div>
                <div class="label">Berdasarkan NIM</div>
            </div>
        </div>
    </div>

    {{-- Features --}}
    <section class="features">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-label">Fitur Unggulan</div>
                <h2 class="section-title">Semua yang Anda butuhkan<br>dalam satu platform</h2>
                <p class="section-sub mx-auto">Dirancang untuk kemudahan mahasiswa dan efisiensi pengelolaan pemilihan oleh admin.</p>
            </div>

            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon blue"><i class="fas fa-user-check"></i></div>
                        <h5>Autentikasi Aman</h5>
                        <p>Login berbasis NIM memastikan setiap suara berasal dari mahasiswa yang terdaftar.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon green"><i class="fas fa-chart-bar"></i></div>
                        <h5>Hasil Real-time</h5>
                        <p>Grafik dan tabel perolehan suara diperbarui secara langsung tanpa perlu reload manual.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon purple"><i class="fas fa-lock"></i></div>
                        <h5>Satu Suara Satu Pilihan</h5>
                        <p>Sistem mencegah voting ganda secara otomatis untuk menjamin keadilan pemilihan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon amber"><i class="fas fa-users-cog"></i></div>
                        <h5>Kelola Data Admin</h5>
                        <p>Admin dapat mengelola mahasiswa dan kandidat dengan mudah melalui panel yang intuitif.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon cyan"><i class="fas fa-file-export"></i></div>
                        <h5>Export Laporan</h5>
                        <p>Unduh rekap hasil voting dalam format CSV untuk dokumentasi dan arsip resmi.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon rose"><i class="fas fa-mobile-alt"></i></div>
                        <h5>Tampilan Responsif</h5>
                        <p>Antarmuka yang nyaman digunakan dari perangkat apa pun, baik PC maupun ponsel.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="cta-section">
        <div class="container">
            <div class="cta-box">
                <div style="font-size: 11.5px; font-weight: 700; color: #60a5fa; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 16px;">
                    Siap berpartisipasi?
                </div>
                <h2 style="font-size: clamp(24px, 4vw, 36px); font-weight: 800; margin-bottom: 14px;">
                    Gunakan hak suara Anda sekarang
                </h2>
                <p style="font-size: 15px; color: rgba(255,255,255,0.5); max-width: 440px; margin: 0 auto 32px; line-height: 1.7;">
                    Masuk ke akun Anda dan ikut menentukan siapa yang akan memimpin Senat Fakultas.
                </p>
                @auth
                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ route('voting.index') }}" class="btn-cta-primary" style="font-size: 15px; padding: 14px 32px;">
                            <i class="fas fa-vote-yea"></i> Voting Sekarang
                        </a>
                    @else
                        <a href="{{ route('dashboard.admin') }}" class="btn-cta-primary" style="font-size: 15px; padding: 14px 32px;">
                            <i class="fas fa-chart-pie"></i> Buka Dashboard
                        </a>
                    @endif
                @else
                    <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                        <a href="{{ route('login') }}" class="btn-cta-primary" style="font-size: 15px; padding: 14px 32px;">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                        <a href="{{ route('register') }}" class="btn-cta-secondary" style="font-size: 15px; padding: 14px 32px;">
                            Buat Akun Baru
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer>
        <div class="container">
            &copy; {{ date('Y') }} E-Voting Senat Fakultas. Semua hak dilindungi.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
