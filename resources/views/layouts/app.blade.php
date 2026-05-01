<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRM Sistem')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --primary-light: #e0e7ff;
            --success: #059669;
            --success-light: #d1fae5;
            --danger: #dc2626;
            --danger-light: #fee2e2;
            --warning: #d97706;
            --warning-light: #fef3c7;
            --info: #0284c7;
            --info-light: #e0f2fe;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --radius: 10px;
            --shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
            --shadow-md: 0 4px 6px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.06);
            --shadow-lg: 0 10px 15px rgba(0,0,0,.08), 0 4px 6px rgba(0,0,0,.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0; top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(180deg, var(--gray-900) 0%, #1e1b4b 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 24px 20px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.5px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand i {
            font-size: 24px;
            color: #818cf8;
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-nav .nav-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255,255,255,.35);
            padding: 12px 12px 8px;
            font-weight: 600;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 8px;
            color: rgba(255,255,255,.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s ease;
            margin-bottom: 2px;
        }

        .sidebar-nav a:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
        }

        .sidebar-nav a.active {
            background: rgba(99,102,241,.3);
            color: #fff;
        }

        .sidebar-nav a i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        /* Main */
        .main {
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            background: #fff;
            padding: 16px 32px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-900);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .content {
            padding: 28px 32px;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all .2s ease;
            line-height: 1.4;
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-1px); box-shadow: var(--shadow-md); }

        .btn-success {
            background: var(--success);
            color: #fff;
        }
        .btn-success:hover { background: #047857; }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }
        .btn-danger:hover { background: #b91c1c; }

        .btn-outline {
            background: #fff;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }
        .btn-outline:hover { background: var(--gray-50); border-color: var(--gray-400); }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .btn-icon {
            padding: 7px 10px;
        }

        /* Cards */
        .card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header h2 {
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-900);
        }

        .card-body {
            padding: 24px;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 2px solid var(--gray-200);
            white-space: nowrap;
        }

        th a {
            color: var(--gray-500);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        th a:hover { color: var(--primary); }

        td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        tr:hover td {
            background: rgba(79,70,229,.02);
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .2px;
        }

        .badge-baru { background: var(--info-light); color: var(--info); }
        .badge-dihubungi { background: #e0e7ff; color: #4338ca; }
        .badge-prospek { background: #fef3c7; color: #92400e; }
        .badge-negosiasi { background: #fce7f3; color: #9d174d; }
        .badge-menang { background: var(--success-light); color: var(--success); }
        .badge-kalah { background: var(--danger-light); color: var(--danger); }
        .badge-pending { background: var(--gray-100); color: var(--gray-600); }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            color: var(--gray-800);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
        }

        .invalid-feedback {
            font-size: 12px;
            color: var(--danger);
            margin-top: 4px;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }

        /* Alert */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideDown .3s ease;
        }

        .alert-success { background: var(--success-light); color: #065f46; border: 1px solid #a7f3d0; }
        .alert-danger { background: var(--danger-light); color: #991b1b; border: 1px solid #fca5a5; }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Filter bar */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 20px 24px;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-100);
            align-items: flex-end;
        }

        .filter-bar .filter-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .filter-bar .filter-item label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--gray-500);
        }

        .filter-bar .filter-item input,
        .filter-bar .filter-item select {
            padding: 8px 12px;
            border: 1px solid var(--gray-300);
            border-radius: 6px;
            font-size: 13px;
            font-family: inherit;
            background: #fff;
            min-width: 160px;
        }

        .filter-bar .filter-item input:focus,
        .filter-bar .filter-item select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(79,70,229,.1);
        }

        /* Pagination */
        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            border-top: 1px solid var(--gray-100);
        }

        .pagination-info {
            font-size: 13px;
            color: var(--gray-500);
        }

        .pagination {
            display: flex;
            gap: 4px;
            list-style: none;
        }

        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 8px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
            background: #fff;
            transition: all .15s;
        }

        .pagination li a:hover {
            background: var(--primary-light);
            color: var(--primary);
            border-color: var(--primary);
        }

        .pagination li.active span {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .pagination li.disabled span {
            color: var(--gray-300);
            cursor: not-allowed;
        }

        /* Detail grid */
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0;
        }

        .detail-item {
            padding: 14px 24px;
            border-bottom: 1px solid var(--gray-100);
        }

        .detail-item:nth-child(odd) {
            border-right: 1px solid var(--gray-100);
        }

        .detail-label {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--gray-400);
            margin-bottom: 4px;
        }

        .detail-value {
            font-size: 15px;
            color: var(--gray-800);
            font-weight: 500;
        }

        /* Actions column */
        .actions {
            display: flex;
            gap: 6px;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.4);
            backdrop-filter: blur(4px);
            z-index: 200;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: #fff;
            border-radius: 12px;
            padding: 28px;
            max-width: 440px;
            width: 90%;
            box-shadow: var(--shadow-lg);
            animation: modalIn .2s ease;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .modal p {
            color: var(--gray-500);
            font-size: 14px;
            margin-bottom: 24px;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-400);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .empty-state h3 {
            font-size: 18px;
            color: var(--gray-600);
            margin-bottom: 6px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .content { padding: 16px; }
            .form-row { grid-template-columns: 1fr; }
            .detail-grid { grid-template-columns: 1fr; }
            .detail-item:nth-child(odd) { border-right: none; }
            .filter-bar { flex-direction: column; }
            .filter-bar .filter-item input,
            .filter-bar .filter-item select { min-width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-chart-line"></i>
            CRM Sistem
        </div>
        <nav class="sidebar-nav">
            <div class="nav-label">Menu Utama</div>
            <a href="{{ route('penjualan.index') }}" class="{{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Data Penjualan
            </a>
            <a href="#"><i class="fas fa-clock-rotate-left"></i> History</a>
            <a href="#"><i class="fas fa-users"></i> Lead</a>
            <a href="#"><i class="fas fa-phone"></i> Follow Up</a>
            <div class="nav-label">Pengaturan</div>
            <a href="#"><i class="fas fa-user-gear"></i> User</a>
            <a href="#"><i class="fas fa-cog"></i> Pengaturan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main">
        <header class="topbar">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="topbar-actions">
                @yield('topbar-actions')
                @auth
                    <div style="display: flex; align-items: center; gap: 16px; margin-left: 16px; padding-left: 16px; border-left: 1px solid var(--gray-200);">
                        <div style="font-size: 14px; color: var(--gray-700);">
                            Halo, <strong style="color: var(--gray-900);">{{ auth()->user()->nama }}</strong>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm" style="color: var(--danger); border-color: var(--danger-light);">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </header>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>
