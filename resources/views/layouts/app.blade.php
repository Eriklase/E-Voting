<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Beranda') | E-Voting Senat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --sidebar-active: #3b82f6;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --accent: #3b82f6;
            --accent-dark: #2563eb;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--body-bg);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* ========== SIDEBAR ========== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.25s ease;
        }

        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar-brand h4 {
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand h4 .brand-icon {
            width: 32px;
            height: 32px;
            background: var(--accent);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .sidebar-brand small {
            color: rgba(255,255,255,0.45);
            font-size: 11px;
            display: block;
            margin-top: 4px;
            padding-left: 42px;
        }

        .sidebar-menu {
            padding: 16px 12px;
        }

        .sidebar-menu .menu-label {
            color: rgba(255,255,255,0.35);
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 12px 6px;
            margin-top: 8px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.15s ease;
            margin-bottom: 2px;
        }

        .sidebar-menu a:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .sidebar-menu a.active {
            background: var(--accent);
            color: #fff;
        }

        .sidebar-menu a i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .sidebar-user {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.08);
            background: rgba(0,0,0,0.15);
        }

        .sidebar-user .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .sidebar-user .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }

        .sidebar-user .user-name {
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user .user-role {
            color: rgba(255,255,255,0.45);
            font-size: 11px;
            text-transform: capitalize;
        }

        .sidebar-user .btn-logout {
            display: block;
            width: 100%;
            padding: 8px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.6);
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.15s ease;
            font-family: inherit;
        }

        .sidebar-user .btn-logout:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        /* ========== MAIN CONTENT ========== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .topbar {
            background: var(--card-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar .page-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .topbar .breadcrumb-nav {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .topbar .breadcrumb-nav a {
            color: var(--accent);
            text-decoration: none;
        }

        .topbar .btn-toggle {
            display: none;
            background: none;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
            color: var(--text-primary);
        }

        .content-area {
            padding: 24px 28px 40px;
        }

        /* ========== CARDS ========== */
        .card {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            background: var(--card-bg);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        /* ========== STAT CARDS ========== */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }

        .stat-card .stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 14px;
        }

        .stat-card .stat-icon.blue {
            background: #dbeafe;
            color: #2563eb;
        }

        .stat-card .stat-icon.green {
            background: #dcfce7;
            color: #16a34a;
        }

        .stat-card .stat-icon.purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        .stat-card .stat-icon.amber {
            background: #fef3c7;
            color: #d97706;
        }

        .stat-card h3 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .stat-card p {
            color: var(--text-secondary);
            font-size: 13px;
            margin: 0;
        }

        /* ========== TABLES ========== */
        .table {
            font-size: 13.5px;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
            padding: 12px 16px;
        }

        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-hover tbody tr:hover {
            background: #f8fafc;
        }

        /* ========== BUTTONS ========== */
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 18px;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
        }

        .btn-sm {
            padding: 5px 12px;
            font-size: 12px;
            border-radius: 6px;
        }

        /* ========== BADGE ========== */
        .badge {
            font-weight: 600;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 6px;
        }

        /* ========== FORM ========== */
        .form-control {
            border: 1px solid var(--border-color);
            border-radius: 7px;
            padding: 9px 14px;
            font-size: 13.5px;
            transition: border-color 0.15s ease;
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        /* ========== ALERTS ========== */
        .alert {
            border-radius: 8px;
            font-size: 13.5px;
            border: none;
            padding: 14px 18px;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left: 3px solid #22c55e;
        }

        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border-left: 3px solid #ef4444;
        }

        .alert-warning {
            background: #fffbeb;
            color: #92400e;
            border-left: 3px solid #f59e0b;
        }

        .alert-info {
            background: #eff6ff;
            color: #1e40af;
            border-left: 3px solid #3b82f6;
        }

        /* ========== PROGRESS ========== */
        .progress {
            border-radius: 6px;
            background: #f1f5f9;
        }

        .progress-bar {
            border-radius: 6px;
            background: var(--accent) !important;
        }

        /* ========== FOOTER ========== */
        .main-footer {
            padding: 20px 28px;
            text-align: center;
            font-size: 12px;
            color: var(--text-secondary);
            border-top: 1px solid var(--border-color);
        }

        /* ========== OVERLAY ========== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-wrapper {
                margin-left: 0;
            }

            .topbar .btn-toggle {
                display: inline-flex;
            }

            .content-area {
                padding: 20px 16px;
            }
        }

        /* ========== PAGE HEADER ========== */
        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 13.5px;
            margin: 0;
        }

        /* ========== SCROLLBAR ========== */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.15);
            border-radius: 4px;
        }

        /* ========== PAGINATION ========== */
        .pagination {
            gap: 4px;
        }

        .page-link {
            border-radius: 6px !important;
            font-size: 13px;
            padding: 6px 12px;
            border-color: var(--border-color);
            color: var(--text-primary);
        }

        .page-item.active .page-link {
            background: var(--accent);
            border-color: var(--accent);
        }
    </style>
    @yield('css')
</head>

<body>
    @if (auth()->check())
        {{-- Sidebar Overlay (Mobile) --}}
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        {{-- Sidebar --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <h4>
                    <span class="brand-icon"><i class="fas fa-vote-yea"></i></span>
                    E-Voting Senat
                </h4>
                <small>Sistem Pemilihan Ketua Senat</small>
            </div>

            <nav class="sidebar-menu">
                @if (auth()->user()->role === 'admin')
                    <div class="menu-label">Menu Utama</div>
                    <a href="{{ route('dashboard.admin') }}" class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie"></i> Dashboard
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="{{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Data Mahasiswa
                    </a>
                    <a href="{{ route('kandidat.index') }}" class="{{ request()->routeIs('kandidat.*') ? 'active' : '' }}">
                        <i class="fas fa-user-tie"></i> Data Kandidat
                    </a>

                    <div class="menu-label">Pemilihan</div>
                    <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> Laporan & Rekap
                    </a>

                    <div class="menu-label">Akun</div>
                    <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i> Profil Saya
                    </a>
                @else
                    <div class="menu-label">Menu Utama</div>
                    <a href="{{ route('dashboard.mahasiswa') }}" class="{{ request()->routeIs('dashboard.mahasiswa') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Beranda
                    </a>

                    <div class="menu-label">Pemilihan</div>
                    <a href="{{ route('voting.index') }}" class="{{ request()->routeIs('voting.index') ? 'active' : '' }}">
                        <i class="fas fa-vote-yea"></i> Voting
                    </a>
                    <a href="{{ route('voting.hasil') }}" class="{{ request()->routeIs('voting.hasil') ? 'active' : '' }}">
                        <i class="fas fa-poll"></i> Hasil Voting
                    </a>

                    <div class="menu-label">Akun</div>
                    <a href="{{ route('profile.show') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i> Profil Saya
                    </a>
                @endif
            </nav>

            <div class="sidebar-user">
                <div class="user-info">
                    <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <div>
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ auth()->user()->role }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Keluar dari Akun
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="main-wrapper">
            <div class="topbar">
                <div>
                    <button class="btn-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span class="page-title d-none d-md-inline">@yield('title', 'Beranda')</span>
                </div>
                <div class="breadcrumb-nav">
                    <a href="/">E-Voting</a> / @yield('title', 'Beranda')
                </div>
            </div>

            <div class="content-area">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i> Terjadi Kesalahan</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle"></i> {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>

            <footer class="main-footer">
                &copy; {{ date('Y') }} E-Voting Senat Fakultas &mdash; Hak Cipta Dilindungi
            </footer>
        </div>
    @else
        {{-- Guest layout (login/register) --}}
        @yield('content')
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>
    @yield('js')
</body>

</html>
