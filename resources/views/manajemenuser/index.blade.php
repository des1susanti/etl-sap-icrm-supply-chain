<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User – PT PLN ICON PLUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins',sans-serif; }
        body { background:#f0f3f9; min-height:100vh; }

        /* NAVBAR */
        .top-navbar {
            position:fixed; top:0; left:0; width:100%; z-index:999;
            background:#fff; box-shadow:0 2px 12px rgba(0,0,0,0.07);
            height:64px; display:flex; align-items:center;
            justify-content:space-between; padding:0 32px;
        }
        .navbar-logo img { height:38px; width:auto; object-fit:contain; }
        .navbar-menu { display:flex; align-items:center; gap:4px; list-style:none; }
        .navbar-menu a {
            font-size:13.5px; font-weight:500; color:#3a4a6b;
            text-decoration:none; padding:7px 14px; border-radius:8px;
            transition:background 0.2s,color 0.2s; white-space:nowrap;
        }
        .navbar-menu a:hover, .navbar-menu a.active { background:#eef3ff; color:#0054a6; font-weight:600; }
        .btn-logout {
            font-size:13px; font-weight:600; color:#e53935; background:#fff0f0;
            border:none; padding:7px 16px; border-radius:8px; cursor:pointer;
            transition:background 0.2s; margin-left:8px;
        }
        .btn-logout:hover { background:#ffd6d6; }

        /* CONTENT */
        .main-content { margin-top:64px; padding:36px 40px; }

        /* PAGE HEADER */
        .page-header {
            display:flex; align-items:flex-start;
            justify-content:space-between; margin-bottom:28px; gap:16px;
        }
        .page-title { font-size:24px; font-weight:700; color:#0d1f3c; margin-bottom:4px; }
        .page-subtitle { font-size:14px; color:#7280a0; }

        .btn-add {
            display:flex; align-items:center; gap:8px;
            height:44px; padding:0 22px;
            background:linear-gradient(135deg,#0054a6,#003d7a);
            color:#fff; border:none; border-radius:10px;
            font-size:14px; font-weight:600; cursor:pointer;
            text-decoration:none; white-space:nowrap;
            transition:all 0.2s; flex-shrink:0;
        }
        .btn-add:hover {
            background:linear-gradient(135deg,#003d7a,#002a5a);
            transform:translateY(-1px);
            box-shadow:0 6px 16px rgba(0,84,166,0.3); color:#fff;
        }

        /* ALERT */
        .alert-box {
            border-radius:12px; padding:14px 18px; font-size:13.5px;
            margin-bottom:20px; display:flex; align-items:center; gap:10px;
        }
        .alert-success { background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; }
        .alert-danger  { background:#fee2e2; color:#b91c1c; border:1px solid #fecaca; }

        /* STAT CARDS */
        .stat-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
        .stat-card {
            background:#fff; border-radius:14px; padding:20px 22px;
            border:1px solid #e4e9f2; box-shadow:0 2px 8px rgba(0,0,0,0.04);
            display:flex; align-items:center; gap:14px;
        }
        .stat-icon { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0; }
        .icon-blue { background:#eff6ff; } .icon-green { background:#f0fdf4; }
        .icon-orange { background:#fffbeb; } .icon-red { background:#fff1f2; }
        .stat-info-label { font-size:12px; color:#7280a0; font-weight:500; margin-bottom:4px; }
        .stat-info-value { font-size:26px; font-weight:700; line-height:1; }
        .val-blue { color:#0054a6; } .val-green { color:#16a34a; }
        .val-orange { color:#d97706; } .val-red { color:#dc2626; }

        /* FILTER */
        .filter-card {
            background:#fff; border-radius:14px; padding:18px 24px;
            border:1px solid #e4e9f2; box-shadow:0 2px 8px rgba(0,0,0,0.04);
            margin-bottom:20px;
        }
        .filter-row { display:flex; align-items:flex-end; gap:14px; flex-wrap:wrap; }
        .filter-group { display:flex; flex-direction:column; gap:6px; }
        .filter-group label { font-size:11px; font-weight:700; color:#7280a0; text-transform:uppercase; letter-spacing:0.5px; }
        .filter-input {
            height:40px; padding:0 14px; border:1.5px solid #dce3ee;
            border-radius:10px; font-size:13.5px; font-family:'Poppins',sans-serif;
            color:#2d3a52; background:#f8fafd; transition:border-color 0.2s; min-width:160px;
        }
        .filter-input:focus { outline:none; border-color:#72b3ff; background:#fff; }
        .btn-filter {
            height:40px; padding:0 22px; background:#0d1f3c; color:#fff;
            border:none; border-radius:10px; font-size:13.5px; font-weight:600;
            cursor:pointer; white-space:nowrap;
        }
        .btn-filter:hover { background:#1a3260; }
        .btn-reset-filter {
            height:40px; padding:0 16px; background:#fff; color:#7280a0;
            border:1.5px solid #e4e9f2; border-radius:10px; font-size:13px;
            font-weight:600; cursor:pointer; text-decoration:none; display:flex; align-items:center;
        }

        /* TABLE CARD */
        .table-card { background:#fff; border-radius:16px; border:1px solid #e4e9f2; box-shadow:0 2px 8px rgba(0,0,0,0.04); overflow:hidden; }
        .table-card-header { display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-bottom:1px solid #f0f3f9; }
        .table-card-title { font-size:15px; font-weight:700; color:#0d1f3c; }
        .table-count { font-size:12px; color:#7280a0; background:#f0f3f9; padding:4px 12px; border-radius:20px; font-weight:600; }

        .data-table { width:100%; border-collapse:collapse; }
        .data-table thead th {
            font-size:11px; font-weight:700; color:#7280a0; text-transform:uppercase;
            letter-spacing:0.5px; padding:14px 16px; background:#f8fafd;
            border-bottom:1.5px solid #e4e9f2; white-space:nowrap;
        }
        .data-table tbody td { font-size:13.5px; color:#2d3a52; padding:14px 16px; border-bottom:1px solid #f0f3f9; vertical-align:middle; }
        .data-table tbody tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:#f8faff; }

        /* AVATAR */
        .user-avatar {
            width:38px; height:38px; border-radius:50%;
            object-fit:cover; border:2px solid #e4e9f2;
        }
        .user-avatar-placeholder {
            width:38px; height:38px; border-radius:50%;
            background:linear-gradient(135deg,#0054a6,#4da3ff);
            display:flex; align-items:center; justify-content:center;
            color:#fff; font-size:14px; font-weight:700; flex-shrink:0;
        }
        .user-info { display:flex; align-items:center; gap:12px; }
        .user-name { font-weight:600; font-size:13.5px; color:#0d1f3c; }
        .user-email { font-size:12px; color:#7280a0; }

        /* BADGE */
        .badge { display:inline-block; font-size:11px; font-weight:700; padding:4px 12px; border-radius:20px; letter-spacing:0.3px; white-space:nowrap; }
        .badge-manager    { background:#eff6ff; color:#1d4ed8; }
        .badge-admin      { background:#f5f3ff; color:#7c3aed; }
        .badge-active     { background:#dcfce7; color:#15803d; }
        .badge-inactive   { background:#fee2e2; color:#b91c1c; }

        /* LAST SEEN */
        .last-seen { font-size:12px; color:#7280a0; }
        .last-seen.online { color:#16a34a; font-weight:600; }

        /* ACTION */
        .action-wrap { display:flex; gap:8px; align-items:center; }
        .btn-edit {
            font-size:12.5px; font-weight:600; color:#0054a6;
            padding:5px 12px; border-radius:8px; background:#eff6ff;
            text-decoration:none; transition:background 0.2s;
        }
        .btn-edit:hover { background:#dbeafe; }
        .btn-toggle {
            font-size:12.5px; font-weight:600; padding:5px 12px;
            border-radius:8px; border:none; cursor:pointer; transition:background 0.2s;
        }
        .btn-toggle.deactivate { color:#b91c1c; background:#fee2e2; }
        .btn-toggle.deactivate:hover { background:#fecaca; }
        .btn-toggle.activate { color:#15803d; background:#dcfce7; }
        .btn-toggle.activate:hover { background:#bbf7d0; }
        .btn-delete { font-size:12.5px; font-weight:600; color:#b91c1c; padding:5px 12px; border-radius:8px; background:#fff1f2; border:none; cursor:pointer; transition:background 0.2s; }
        .btn-delete:hover { background:#fee2e2; }

        /* EMPTY */
        .empty-state { text-align:center; padding:60px 20px; }
        .empty-icon { font-size:48px; margin-bottom:12px; }
        .empty-title { font-size:15px; font-weight:600; color:#3a4a6b; margin-bottom:4px; }
        .empty-desc  { font-size:13px; color:#7280a0; }

        /* MODAL */
        .modal-overlay {
            display:none; position:fixed; inset:0; z-index:2000;
            background:rgba(13,31,60,0.45); backdrop-filter:blur(4px);
            align-items:center; justify-content:center;
        }
        .modal-overlay.show { display:flex; }
        .modal-box {
            background:#fff; border-radius:20px; width:100%; max-width:480px;
            padding:32px; box-shadow:0 24px 64px rgba(0,0,0,0.18);
            animation:slideUp 0.25s ease;
        }
        @keyframes slideUp { from { transform:translateY(20px); opacity:0; } to { transform:translateY(0); opacity:1; } }
        .modal-title { font-size:18px; font-weight:700; color:#0d1f3c; margin-bottom:6px; }
        .modal-subtitle { font-size:13px; color:#7280a0; margin-bottom:24px; }
        .modal-close { float:right; background:none; border:none; font-size:20px; cursor:pointer; color:#7280a0; margin-top:-4px; }
        .modal-close:hover { color:#0d1f3c; }

        .form-group { margin-bottom:18px; }
        .form-label-modal { font-size:12.5px; font-weight:600; color:#1f2a4d; margin-bottom:7px; display:block; }
        .form-control-modal {
            width:100%; height:46px; padding:0 14px;
            border:1.6px solid #dce3ee; border-radius:12px;
            font-size:14px; font-family:'Poppins',sans-serif;
            background:#f8fafd; color:#2d3a52; transition:border-color 0.2s;
        }
        .form-control-modal:focus { outline:none; border-color:#72b3ff; background:#fff; }
        select.form-control-modal { cursor:pointer; }

        .modal-actions { display:flex; gap:12px; margin-top:24px; }
        .btn-modal-submit {
            flex:1; height:46px; border:none; border-radius:12px;
            background:linear-gradient(135deg,#0054a6,#003d7a);
            color:#fff; font-size:14.5px; font-weight:600; cursor:pointer;
            transition:all 0.2s;
        }
        .btn-modal-submit:hover { background:linear-gradient(135deg,#003d7a,#002a5a); }
        .btn-modal-cancel {
            height:46px; padding:0 20px; border:1.5px solid #e4e9f2;
            border-radius:12px; background:#fff; color:#7280a0;
            font-size:14px; font-weight:600; cursor:pointer;
        }
        .btn-modal-cancel:hover { border-color:#c8d3e8; color:#3a4a6b; }

        /* PAGINATION */
        .pagination-wrap { padding:16px 24px; border-top:1px solid #f0f3f9; }

        @media (max-width:1024px) { .stat-grid { grid-template-columns:repeat(2,1fr); } }
        @media (max-width:768px) {
            .main-content { padding:24px 16px; }
            .top-navbar { padding:0 16px; }
            .navbar-menu { display:none; }
            .page-header { flex-direction:column; }
            .stat-grid { grid-template-columns:repeat(2,1fr); }
        }
        /* ===== NAVBAR ===== */
.top-navbar {
    position: fixed;
    top: 0; left: 0; width: 100%;
    z-index: 999;
    background: #fff;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 32px;
}

.navbar-logo img { height: 38px; width: auto; object-fit: contain; }

.navbar-menu {
    display: flex; align-items: center;
    gap: 4px; list-style: none;
}

.navbar-menu a {
    font-size: 13.5px; font-weight: 500;
    color: #3a4a6b; text-decoration: none;
    padding: 7px 14px; border-radius: 8px;
    transition: background 0.2s, color 0.2s;
    white-space: nowrap;
}

.navbar-menu a:hover, .navbar-menu a.active {
    background: #eef3ff; color: #0054a6; font-weight: 600;
}

.btn-logout {
    font-size: 13px; font-weight: 600;
    color: #e53935; background: #fff0f0;
    border: none; padding: 7px 16px;
    border-radius: 8px; cursor: pointer;
    transition: background 0.2s; margin-left: 8px;
}
.btn-logout:hover { background: #ffd6d6; }

/* ===== HAMBURGER ===== */
.btn-hamburger {
    display: none;
    flex-direction: column;
    justify-content: center;
    gap: 5px;
    background: none;
    border: none;
    cursor: pointer;
    padding: 6px;
    border-radius: 8px;
}
.btn-hamburger span {
    display: block;
    width: 24px; height: 2.5px;
    background: #3a4a6b;
    border-radius: 4px;
    transition: all 0.3s;
}

@media (max-width: 768px) {
    .top-navbar { padding: 0 16px; }
    .btn-hamburger { display: flex; }
    .navbar-menu {
        display: none;
        position: fixed;
        top: 64px; left: 0;
        width: 100%;
        background: #fff;
        flex-direction: column;
        align-items: flex-start;
        padding: 12px 16px 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        gap: 4px;
        z-index: 998;
    }
    .navbar-menu.open { display: flex; }
    .navbar-menu li { width: 100%; }
    .navbar-menu a {
        display: block;
        width: 100%;
        padding: 10px 14px;
        font-size: 14px;
    }
    .btn-logout { margin-left: 0; width: 100%; text-align: left; }
}
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
<nav class="top-navbar">
    <a href="{{ route('dashboard') }}" class="navbar-logo">
        <img src="{{ asset('images/icon.png') }}" alt="PLN Icon Plus">
    </a>

    <button class="btn-hamburger" onclick="toggleMenu()" id="hamburgerBtn">
        <span></span><span></span><span></span>
    </button>

    <ul class="navbar-menu" id="navbarMenu">
        <li><a href="{{ route('dashboard') }}" class="active">Dashboard</a></li>
        <li><a href="{{ route('upload.index') }}">Upload Data</a></li>
        <li><a href="{{ route('reconciliation.index') }}">Rekonsiliasi</a></li>
        @if(auth()->user()->role === 'manager')
            <li><a href="{{ route('users.index') }}">Manajemen User</a></li>
        @endif
        <li><a href="{{ route('profile.index') }}">Profil User</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </li>
    </ul>
</nav>

    <main class="main-content">

        <div class="page-header">
            <div>
                <div class="page-title">Manajemen User</div>
                <div class="page-subtitle">Kelola akun pengguna sistem ETL PLN ICON PLUS</div>
            </div>
            <button class="btn-add" onclick="openModal('modal-tambah')">
                ➕ Tambah User
            </button>
        </div>

        @if(session('success'))
            <div class="alert-box alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-box alert-danger">
                ❌ <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
        @endif

        {{-- STAT CARDS --}}
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon icon-blue">👥</div>
                <div>
                    <div class="stat-info-label">Total User</div>
                    <div class="stat-info-value val-blue">{{ $stats['total'] }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green">✅</div>
                <div>
                    <div class="stat-info-label">Aktif</div>
                    <div class="stat-info-value val-green">{{ $stats['active'] }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-red">🚫</div>
                <div>
                    <div class="stat-info-label">Non-Aktif</div>
                    <div class="stat-info-value val-red">{{ $stats['inactive'] }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-orange">🛡️</div>
                <div>
                    <div class="stat-info-label">Manager</div>
                    <div class="stat-info-value val-orange">{{ $stats['manager'] }}</div>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="filter-row">
                    <div class="filter-group">
                        <label>Cari Nama / Email</label>
                        <input type="text" name="search" class="filter-input"
                               placeholder="Nama atau email..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="filter-group">
                        <label>Role</label>
                        <select name="role" class="filter-input">
                            <option value="">Semua Role</option>
                            <option value="manager"     {{ request('role')=='manager'     ? 'selected':'' }}>Manager</option>
                            <option value="admin_gudang"{{ request('role')=='admin_gudang'? 'selected':'' }}>Admin Gudang</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select name="status" class="filter-input">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('status')==='1' ? 'selected':'' }}>Aktif</option>
                            <option value="0" {{ request('status')==='0' ? 'selected':'' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">🔍 Cari</button>
                    <a href="{{ route('users.index') }}" class="btn-reset-filter">Reset</a>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">Daftar Pengguna</div>
                <span class="table-count">{{ $users->total() }} user</span>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Login Terakhir</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="user-info">
                                    @if($user->avatar)
                                        <img src="{{ asset('storage/'.$user->avatar) }}" class="user-avatar" alt="">
                                    @else
                                        <div class="user-avatar-placeholder">
                                            {{ strtoupper(substr($user->name,0,1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge {{ $user->role === 'manager' ? 'badge-manager' : 'badge-admin' }}">
                                    {{ $user->role === 'manager' ? '🛡️ Manager' : '📦 Admin Gudang' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $user->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    {{ $user->is_active ? '● Aktif' : '○ Non-Aktif' }}
                                </span>
                            </td>
                            <td>
                                @if($user->last_login)
                                    @php
                                        $menit = now()->diffInMinutes($user->last_login);
                                    @endphp
                                    <span class="last-seen {{ $menit < 30 ? 'online' : '' }}">
                                        {{ $menit < 30 ? '🟢 Online' : '' }}
                                        {{ $user->last_login->diffForHumans() }}
                                    </span>
                                @else
                                    <span class="last-seen">Belum pernah login</span>
                                @endif
                            </td>
                            <td style="font-size:12.5px; color:#7280a0;">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td>
                                <div class="action-wrap">
                                    {{-- Edit --}}
                                    <button class="btn-edit"
                                            onclick="openEditModal(
                                                {{ $user->id }},
                                                '{{ $user->name }}',
                                                '{{ $user->email }}',
                                                '{{ $user->role }}'
                                            )">Edit</button>

                                    {{-- Toggle Status --}}
                                    <form method="POST"
                                          action="{{ route('users.toggle-status', $user->id) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                                class="btn-toggle {{ $user->is_active ? 'deactivate' : 'activate' }}"
                                                onclick="return confirm('{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }} user ini?')">
                                            {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    {{-- Hapus --}}
                                    @if($user->id !== auth()->id())
                                        <form method="POST"
                                              action="{{ route('users.destroy', $user->id) }}"
                                              onsubmit="return confirm('Hapus user ini permanen?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-delete">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-icon">👤</div>
                                    <div class="empty-title">Belum ada user</div>
                                    <div class="empty-desc">Klik "Tambah User" untuk menambahkan pengguna baru</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($users->hasPages())
                <div class="pagination-wrap">{{ $users->withQueryString()->links() }}</div>
            @endif
        </div>

    </main>

    {{-- MODAL TAMBAH USER --}}
    <div class="modal-overlay" id="modal-tambah">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-tambah')">✕</button>
            <div class="modal-title">Tambah User Baru</div>
            <div class="modal-subtitle">Lengkapi data pengguna yang akan ditambahkan</div>

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label-modal">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control-modal"
                           placeholder="Nama lengkap pengguna" required>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Email</label>
                    <input type="email" name="email" class="form-control-modal"
                           placeholder="email@pln-iconplus.co.id" required>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Role</label>
                    <select name="role" class="form-control-modal" required>
                        <option value="">Pilih Role</option>
                        <option value="admin_gudang">📦 Admin Gudang</option>
                        <option value="manager">🛡️ Manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Password</label>
                    <input type="password" name="password" class="form-control-modal"
                           placeholder="Minimal 8 karakter" required>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control-modal"
                           placeholder="Ulangi password" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal('modal-tambah')">Batal</button>
                    <button type="submit" class="btn-modal-submit">Simpan User</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT USER --}}
    <div class="modal-overlay" id="modal-edit">
        <div class="modal-box">
            <button class="modal-close" onclick="closeModal('modal-edit')">✕</button>
            <div class="modal-title">Edit User</div>
            <div class="modal-subtitle">Ubah data pengguna</div>

            <form method="POST" id="form-edit" action="">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label-modal">Nama Lengkap</label>
                    <input type="text" name="name" id="edit-name" class="form-control-modal" required>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Email</label>
                    <input type="email" name="email" id="edit-email" class="form-control-modal" required>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Role</label>
                    <select name="role" id="edit-role" class="form-control-modal" required>
                        <option value="admin_gudang">📦 Admin Gudang</option>
                        <option value="manager">🛡️ Manager</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label-modal">Password Baru <span style="color:#a0aec0;font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" class="form-control-modal" placeholder="Password baru...">
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal('modal-edit')">Batal</button>
                    <button type="submit" class="btn-modal-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }
        function closeModal(id) {
            document.getElementById(id).classList.remove('show');
        }
        function openEditModal(id, name, email, role) {
            document.getElementById('edit-name').value  = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-role').value  = role;
            document.getElementById('form-edit').action = '/users/' + id;
            openModal('modal-edit');
        }
        // Tutup modal klik luar
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('show');
            });
        });

        // Auto-open modal jika ada error validasi
        @if($errors->any())
            openModal('modal-tambah');
        @endif
    </script>
    <script>
    function toggleMenu() {
        const menu = document.getElementById('navbarMenu');
        menu.classList.toggle('open');
    }

    // Tutup menu saat klik di luar navbar
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('navbarMenu');
        const btn  = document.getElementById('hamburgerBtn');
        if (!menu.contains(e.target) && !btn.contains(e.target)) {
            menu.classList.remove('open');
        }
    });
</script>
</body>
</html>