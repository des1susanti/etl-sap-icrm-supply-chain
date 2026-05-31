<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekonsiliasi – PT PLN ICON PLUS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body { background: #f0f3f9; min-height: 100vh; }

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

        /* ===== CONTENT ===== */
        .main-content { margin-top: 64px; padding: 36px 40px; }

        /* ===== PAGE HEADER ===== */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 16px;
        }

        .page-title {
            font-size: 24px; font-weight: 700;
            color: #0d1f3c; margin-bottom: 4px;
        }

        .page-subtitle { font-size: 14px; color: #7280a0; }

        .btn-export {
            display: flex; align-items: center; gap: 8px;
            height: 44px; padding: 0 22px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #fff; border: none; border-radius: 10px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            white-space: nowrap;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .btn-export:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(22,163,74,0.25);
            color: #fff;
        }

        /* ===== ALERT ===== */
        .alert-box {
            border-radius: 12px; padding: 14px 18px;
            font-size: 13.5px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-danger  { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        /* ===== STAT CARDS ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff; border-radius: 14px;
            padding: 20px 22px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex; align-items: center; gap: 14px;
        }

        .stat-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center;
            justify-content: center; font-size: 20px;
            flex-shrink: 0;
        }

        .icon-blue   { background: #eff6ff; }
        .icon-green  { background: #f0fdf4; }
        .icon-orange { background: #fffbeb; }
        .icon-red    { background: #fff1f2; }

        .stat-info-label {
            font-size: 12px; color: #7280a0;
            font-weight: 500; margin-bottom: 4px;
        }

        .stat-info-value {
            font-size: 26px; font-weight: 700; line-height: 1;
        }

        .val-blue   { color: #0054a6; }
        .val-green  { color: #16a34a; }
        .val-orange { color: #d97706; }
        .val-red    { color: #dc2626; }

        /* ===== FILTER CARD ===== */
        .filter-card {
            background: #fff; border-radius: 14px;
            padding: 20px 24px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 20px;
        }

        .filter-row {
            display: flex; align-items: flex-end;
            gap: 16px; flex-wrap: wrap;
        }

        .filter-group { display: flex; flex-direction: column; gap: 6px; }
        .filter-group label {
            font-size: 11px; font-weight: 700;
            color: #7280a0; text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .filter-input {
            height: 40px; padding: 0 14px;
            border: 1.5px solid #dce3ee;
            border-radius: 10px; font-size: 13.5px;
            font-family: 'Poppins', sans-serif;
            color: #2d3a52; background: #f8fafd;
            transition: border-color 0.2s;
            min-width: 160px;
        }

        .filter-input:focus {
            outline: none; border-color: #72b3ff;
            background: #fff;
        }

        .btn-filter {
            height: 40px; padding: 0 22px;
            background: #0d1f3c; color: #fff;
            border: none; border-radius: 10px;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer; transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-filter:hover { background: #1a3260; }

        .btn-reset-filter {
            height: 40px; padding: 0 16px;
            background: #fff; color: #7280a0;
            border: 1.5px solid #e4e9f2;
            border-radius: 10px; font-size: 13px;
            font-weight: 600; cursor: pointer;
            transition: all 0.2s;
        }
        .btn-reset-filter:hover { border-color: #c8d3e8; color: #3a4a6b; }

        /* ===== TABLE CARD ===== */
        .table-card {
            background: #fff; border-radius: 16px;
            padding: 0; border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .table-card-header {
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid #f0f3f9;
        }

        .table-card-title {
            font-size: 15px; font-weight: 700; color: #0d1f3c;
        }

        .table-count {
            font-size: 12px; color: #7280a0;
            background: #f0f3f9; padding: 4px 12px;
            border-radius: 20px; font-weight: 600;
        }

        /* ===== DATA TABLE ===== */
        .data-table { width: 100%; border-collapse: collapse; }

        .data-table thead th {
            font-size: 11px; font-weight: 700;
            color: #7280a0; text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            background: #f8fafd;
            border-bottom: 1.5px solid #e4e9f2;
            white-space: nowrap;
        }

        .data-table tbody td {
            font-size: 13.5px; color: #2d3a52;
            padding: 16px 16px;
            border-bottom: 1px solid #f0f3f9;
            vertical-align: middle;
        }

        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: #f8faff; }

        /* ID laporan */
        .laporan-id {
            font-size: 12.5px; font-weight: 700;
            color: #0054a6; font-family: monospace;
            letter-spacing: 0.3px;
        }

        /* Mismatch value */
        .mismatch-zero { color: #16a34a; font-weight: 700; }
        .mismatch-warn { color: #dc2626; font-weight: 700; }

        /* ===== BADGE ===== */
        .badge {
            display: inline-block; font-size: 11px;
            font-weight: 700; padding: 4px 12px;
            border-radius: 20px; letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .badge-sinkron      { background: #dcfce7; color: #15803d; }
        .badge-review       { background: #fef9c3; color: #92400e; }
        .badge-processing   { background: #dbeafe; color: #1d4ed8; }
        .badge-draft        { background: #f1f5f9; color: #64748b; }
        .badge-completed    { background: #dcfce7; color: #15803d; }
        .badge-failed       { background: #fee2e2; color: #b91c1c; }

        /* ===== ACTION BUTTONS ===== */
        .btn-detail {
            font-size: 13px; font-weight: 600;
            color: #0054a6; text-decoration: none;
            padding: 6px 14px; border-radius: 8px;
            background: #eff6ff;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-detail:hover { background: #dbeafe; color: #1d4ed8; }

        .btn-approve {
            font-size: 13px; font-weight: 600;
            color: #15803d; text-decoration: none;
            padding: 6px 14px; border-radius: 8px;
            background: #dcfce7; border: none; cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }
        .btn-approve:hover { background: #bbf7d0; }

        .action-wrap { display: flex; gap: 8px; align-items: center; }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center; padding: 60px 20px;
            color: #7280a0;
        }
        .empty-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-title { font-size: 15px; font-weight: 600; color: #3a4a6b; margin-bottom: 4px; }
        .empty-desc  { font-size: 13px; }

        /* ===== PAGINATION ===== */
        .pagination-wrap { padding: 16px 24px; border-top: 1px solid #f0f3f9; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .main-content { padding: 24px 16px; }
            .top-navbar { padding: 0 16px; }
            .navbar-menu { display: none; }
            .page-header { flex-direction: column; }
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .filter-row { flex-direction: column; }
            .filter-input { min-width: 100%; }
            .data-table { font-size: 12px; }
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
    {{-- ===== MAIN ===== --}}
    <main class="main-content">

   {{-- PAGE HEADER --}}
        <div class="page-header">
            <div>
                <div class="page-title">Laporan Rekonsiliasi</div>
                <div class="page-subtitle">Tinjau dan unduh riwayat sinkronisasi data SAP dan ICRM+</div>
            </div>
           <a href="/reconciliation/export?all=true" class="btn-export">
    📥 Export Excel
</a>
        </div>
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert-box alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-box alert-danger">
                ❌
                <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
        @endif

        {{-- STAT CARDS --}}
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-icon icon-blue">📋</div>
                <div>
                    <div class="stat-info-label">Total Laporan</div>
                    <div class="stat-info-value val-blue">{{ number_format($stats['total']) }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green">✅</div>
                <div>
                    <div class="stat-info-label">Sinkron</div>
                    <div class="stat-info-value val-green">{{ number_format($stats['completed']) }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-orange">⏳</div>
                <div>
                    <div class="stat-info-label">Review Diperlukan</div>
                    <div class="stat-info-value val-orange">{{ number_format($stats['pending']) }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-red">❌</div>
                <div>
                    <div class="stat-info-label">Gagal</div>
                    <div class="stat-info-value val-red">{{ number_format($stats['failed'] ?? 0) }}</div>
                </div>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('reconciliation.index') }}">
                <div class="filter-row">
                    <div class="filter-group">
                        <label>Rentang Tanggal</label>
                        <input type="date" name="from" class="filter-input"
                               value="{{ request('from') }}">
                    </div>
                    <div class="filter-group">
                        <label>Hingga</label>
                        <input type="date" name="to" class="filter-input"
                               value="{{ request('to') }}">
                    </div>
                    <div class="filter-group">
                        <label>Status</label>
                        <select name="status" class="filter-input">
                            <option value="">Semua Status</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Sinkron</option>
                            <option value="draft"     {{ request('status') == 'draft'     ? 'selected' : '' }}>Draft</option>
                            <option value="processing"{{ request('status') == 'processing'? 'selected' : '' }}>Processing</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Cari ID / Periode</label>
                        <input type="text" name="search" class="filter-input"
                               placeholder="REP-... atau periode"
                               value="{{ request('search') }}">
                    </div>
                    <button type="submit" class="btn-filter">🔍 Terapkan Filter</button>
                    <a href="{{ route('reconciliation.index') }}" class="btn-reset-filter">Reset</a>
                </div>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">Daftar Rekonsiliasi</div>
                <span class="table-count">{{ $reconciliations->total() }} data</span>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Laporan</th>
                        <th>Periode</th>
                        <th>Tanggal Proses</th>
                        <th>Total Item</th>
                        <th>Mismatch</th>
                        <th>Dibuat Oleh</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reconciliations as $rekon)
                        <tr>
                            <td>
                                <span class="laporan-id">
                                    REP-{{ str_pad($rekon->id, 8, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td>
    <div style="display:flex; align-items:center; gap:8px;">

        <span>
            {{ $rekon->periode ?? '-' }}
        </span>

        <a href="{{ route('reconciliation.edit', $rekon->id) }}"
           style="
                font-size:12px;
                font-weight:600;
                color:#2563eb;
                background:#eff6ff;
                border:1px solid #bfdbfe;
                padding:4px 10px;
                border-radius:7px;
                text-decoration:none;
                transition:0.2s;
           "
           onmouseover="this.style.background='#dbeafe'"
           onmouseout="this.style.background='#eff6ff'">

            ✏️ Edit

        </a>

    </div>
</td>
                            <td style="font-size:12.5px; color:#7280a0;">
                                {{ $rekon->created_at->format('d M Y, H:i') }}
                            </td>
                            <td>{{ number_format($rekon->results_count ?? 0) }}</td>
                            <td>
                                @php $mismatch = $rekon->mismatch_count ?? 0; @endphp
                                <span class="{{ $mismatch > 0 ? 'mismatch-warn' : 'mismatch-zero' }}">
                                    {{ number_format($mismatch) }}
                                </span>
                            </td>
                            <td>{{ $rekon->user->name ?? '-' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'completed'  => ['label' => 'Sinkron',    'class' => 'badge-sinkron'],
                                        'draft'      => ['label' => 'Draft',      'class' => 'badge-draft'],
                                        'processing' => ['label' => 'Processing', 'class' => 'badge-processing'],
                                        'failed'     => ['label' => 'Gagal',      'class' => 'badge-failed'],
                                    ];
                                    $s = $statusMap[$rekon->status] ?? ['label' => strtoupper($rekon->status), 'class' => 'badge-draft'];
                                @endphp
                                <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                            </td>
                            <td>
                                <div class="action-wrap">
                                    <a href="{{ route('reconciliation.show', $rekon->id) }}"
                                       class="btn-detail">Lihat Detail</a>
                                      <form method="POST" 
      action="{{ route('reconciliation.destroy', $rekon->id) }}" 
      style="display:inline;"
      onsubmit="return confirm('Yakin ingin menghapus data ini? Semua hasil rekonsiliasi juga akan terhapus.')">
    @csrf
    @method('DELETE')
    <button type="submit" 
            style="
                font-size: 13px; font-weight: 600;
                color: #e53935; background: #fff0f0;
                border: 1.5px solid #fecaca;
                padding: 6px 14px; border-radius: 8px;
                cursor: pointer; margin-left: 6px;
                transition: all 0.2s;
            "
            onmouseover="this.style.background='#ffd6d6'"
            onmouseout="this.style.background='#fff0f0'">
        🗑️ Hapus
    </button>
</form>
</td>
                                    @if(auth()->user()->role === 'manager' && $rekon->status === 'processing')
                                        <form method="POST"
                                              action="{{ route('reconciliation.approve', $rekon->id) }}"
                                              onsubmit="return confirm('Approve rekonsiliasi ini?')">
                                            @csrf
                                            <button type="submit" class="btn-approve">Approve</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <div class="empty-icon">📭</div>
                                    <div class="empty-title">Belum ada data rekonsiliasi</div>
                                    <div class="empty-desc">Data akan muncul setelah proses ETL dijalankan</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($reconciliations->hasPages())
                <div class="pagination-wrap">
                    {{ $reconciliations->withQueryString()->links() }}
                </div>
            @endif
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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