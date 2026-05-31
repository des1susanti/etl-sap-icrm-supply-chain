<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Rekonsiliasi – PT PLN ICON PLUS</title>

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

        .page-header-left { display: flex; align-items: center; gap: 14px; }

        .btn-back {
            display: flex; align-items: center; gap: 6px;
            height: 40px; padding: 0 16px;
            background: #fff; color: #3a4a6b;
            border: 1.5px solid #e4e9f2;
            border-radius: 10px; font-size: 13px;
            font-weight: 600; cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        .btn-back:hover { border-color: #c8d3e8; color: #0d1f3c; background: #f8fafd; }

        .page-title {
            font-size: 22px; font-weight: 700;
            color: #0d1f3c; margin-bottom: 2px;
        }

        .page-subtitle { font-size: 13.5px; color: #7280a0; }

        /* ===== INFO CARD ===== */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .info-card {
            background: #fff; border-radius: 14px;
            padding: 20px 22px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .info-card-label {
            font-size: 11px; font-weight: 700;
            color: #7280a0; text-transform: uppercase;
            letter-spacing: 0.5px; margin-bottom: 8px;
        }

        .info-card-value {
            font-size: 16px; font-weight: 700; color: #0d1f3c;
        }

        .info-card-value.mono {
            font-family: monospace; font-size: 15px; color: #0054a6;
        }

        /* ===== STAT CARDS ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #fff; border-radius: 14px;
            padding: 16px 18px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex; flex-direction: column; gap: 10px;
        }

        .stat-card-top {
            display: flex; align-items: center; gap: 12px;
        }

        .stat-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center;
            justify-content: center; font-size: 18px;
            flex-shrink: 0;
        }

        .icon-blue    { background: #eff6ff; }
        .icon-green   { background: #f0fdf4; }
        .icon-red     { background: #fff1f2; }
        .icon-yellow  { background: #fffbeb; }
        .icon-sky     { background: #f0f9ff; }

        .stat-info-label { font-size: 12px; color: #7280a0; font-weight: 500; margin-bottom: 4px; }
        .stat-info-value { font-size: 22px; font-weight: 700; line-height: 1; }

        .val-blue    { color: #0054a6; }
        .val-green   { color: #16a34a; }
        .val-red     { color: #dc2626; }
        .val-yellow  { color: #d97706; }
        .val-sky     { color: #0369a1; }

        /* Export mini button inside stat card */
        .btn-export-mini {
            display: flex; align-items: center; justify-content: center; gap: 5px;
            width: 100%; height: 32px; padding: 0 10px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: #fff; border: none; border-radius: 8px;
            font-size: 11.5px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            white-space: nowrap;
            transition: all 0.2s;
        }
        .btn-export-mini:hover {
            background: linear-gradient(135deg, #15803d, #166534);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(22,163,74,0.22);
            color: #fff;
        }
        .btn-export-mini.blue-mini {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
        .btn-export-mini.blue-mini:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            box-shadow: 0 4px 10px rgba(37,99,235,0.22);
        }
        .btn-export-mini.red-mini {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
        }
        .btn-export-mini.red-mini:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            box-shadow: 0 4px 10px rgba(220,38,38,0.22);
        }
        .btn-export-mini.yellow-mini {
            background: linear-gradient(135deg, #d97706, #b45309);
        }
        .btn-export-mini.yellow-mini:hover {
            background: linear-gradient(135deg, #b45309, #92400e);
            box-shadow: 0 4px 10px rgba(217,119,6,0.22);
        }
        .btn-export-mini.sky-mini {
            background: linear-gradient(135deg, #0284c7, #0369a1);
        }
        .btn-export-mini.sky-mini:hover {
            background: linear-gradient(135deg, #0369a1, #075985);
            box-shadow: 0 4px 10px rgba(2,132,199,0.22);
        }

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

        .table-card-title { font-size: 15px; font-weight: 700; color: #0d1f3c; }

        .table-count {
            font-size: 12px; color: #7280a0;
            background: #f0f3f9; padding: 4px 12px;
            border-radius: 20px; font-weight: 600;
        }

        /* ===== FILTER ===== */
        .filter-inline {
            padding: 14px 24px;
            border-bottom: 1px solid #f0f3f9;
            display: flex; gap: 12px; align-items: center; flex-wrap: wrap;
        }

        .filter-input {
            height: 38px; padding: 0 14px;
            border: 1.5px solid #dce3ee;
            border-radius: 10px; font-size: 13px;
            font-family: 'Poppins', sans-serif;
            color: #2d3a52; background: #f8fafd;
            transition: border-color 0.2s;
        }
        .filter-input:focus { outline: none; border-color: #72b3ff; background: #fff; }

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
            font-size: 13px; color: #2d3a52;
            padding: 14px 16px;
            border-bottom: 1px solid #f0f3f9;
            vertical-align: middle;
        }

        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: #f8faff; }

        /* ===== BADGE ===== */
        .badge {
            display: inline-block; font-size: 11px;
            font-weight: 700; padding: 4px 12px;
            border-radius: 20px; letter-spacing: 0.3px;
            white-space: nowrap;
        }

        .badge-match         { background: #dcfce7; color: #15803d; }
        .badge-mismatch-diff { background: #fee2e2; color: #b91c1c; }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center; padding: 60px 20px; color: #7280a0;
        }
        .empty-icon { font-size: 48px; margin-bottom: 12px; }
        .empty-title { font-size: 15px; font-weight: 600; color: #3a4a6b; margin-bottom: 4px; }
        .empty-desc  { font-size: 13px; }

        /* ===== STATUS HEADER BADGE ===== */
        .status-pill {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 16px; border-radius: 20px;
            font-size: 12.5px; font-weight: 700;
        }
        .pill-completed  { background: #dcfce7; color: #15803d; }
        .pill-draft      { background: #f1f5f9; color: #64748b; }
        .pill-processing { background: #dbeafe; color: #1d4ed8; }
        .pill-failed     { background: #fee2e2; color: #b91c1c; }

        @media (max-width: 1400px) {
            .stat-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 1200px) {
            .stat-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 768px) {
            .main-content { padding: 24px 16px; }
            .top-navbar { padding: 0 16px; }
            .navbar-menu { display: none; }
            .page-header { flex-direction: column; }
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .info-grid { grid-template-columns: 1fr; }
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
            <div class="page-header-left">
                <a href="{{ route('reconciliation.index') }}" class="btn-back">← Kembali</a>
                <div>
                    <div class="page-title">
                        Detail Rekonsiliasi
                        @php
                            $statusMap = [
                                'completed'  => ['label' => 'Sinkron',    'class' => 'pill-completed'],
                                'draft'      => ['label' => 'Draft',      'class' => 'pill-draft'],
                                'processing' => ['label' => 'Processing', 'class' => 'pill-processing'],
                                'failed'     => ['label' => 'Gagal',      'class' => 'pill-failed'],
                            ];
                            $s = $statusMap[$rekon->status] ?? ['label' => strtoupper($rekon->status), 'class' => 'pill-draft'];
                        @endphp
                        <span class="status-pill {{ $s['class'] }}" style="vertical-align: middle; margin-left: 8px; font-size: 12px;">
                            {{ $s['label'] }}
                        </span>
                    </div>
                    <div class="page-subtitle">
                        REP-{{ str_pad($rekon->id, 8, '0', STR_PAD_LEFT) }}
                        &nbsp;·&nbsp; Periode: {{ $rekon->periode ?? '-' }}
                        &nbsp;·&nbsp; {{ $rekon->created_at->format('d M Y, H:i') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- INFO CARDS --}}
        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-label">ID Laporan</div>
                <div class="info-card-value mono">REP-{{ str_pad($rekon->id, 8, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label">Dibuat Oleh</div>
                <div class="info-card-value">{{ $rekon->user->name ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label">Tanggal Proses</div>
                <div class="info-card-value">{{ $rekon->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        @php
            $results = $rekon->results ?? collect();
            $total   = $results->count();

            $matched      = 0;
            $mismatchDiff = 0;
            $sapOnly      = 0;
            $icrmOnly     = 0;

            foreach ($results as $row) {
                $dbSt = $row->status ?? 'mismatch';
                if ($dbSt === 'match') {
                    $matched++;
                } else {
                    // SINKRONISASI LOGIKA SAMA DENGAN DATABASE CONTROLLER
                    if (!empty($row->sap_material) && !empty($row->icrm_material)) {
                        $mismatchDiff++;
                    } elseif (!empty($row->sap_material) && empty($row->icrm_material)) {
                        $sapOnly++;
                    } else {
                        $icrmOnly++;
                    }
                }
            }

            $mismatch = $mismatchDiff + $sapOnly + $icrmOnly;
        @endphp

        <div class="stat-grid">
            {{-- TOTAL ITEM --}}
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-blue">📋</div>
                    <div>
                        <div class="stat-info-label">Total Item</div>
                        <div class="stat-info-value val-blue">{{ number_format($total) }}</div>
                    </div>
                </div>
                <a href="{{ route('reconciliation.export.detail', $rekon->id) }}?filter=all" class="btn-export-mini blue-mini">
                    📥 Export Semua
                </a>
            </div>

            {{-- MATCH --}}
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-green">✅</div>
                    <div>
                        <div class="stat-info-label">Match</div>
                        <div class="stat-info-value val-green">{{ number_format($matched) }}</div>
                    </div>
                </div>
                <a href="{{ route('reconciliation.export.detail', $rekon->id) }}?filter=match" class="btn-export-mini">
                    📥 Export Match
                </a>
            </div>

            {{-- MISMATCH TOTAL --}}
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-red">❌</div>
                    <div>
                        <div class="stat-info-label">Mismatch (Total)</div>
                        <div class="stat-info-value val-red">{{ number_format($mismatch) }}</div>
                    </div>
                </div>
                <a href="{{ route('reconciliation.export.detail', $rekon->id) }}?filter=mismatch" class="btn-export-mini red-mini">
                    📥 Export Mismatch
                </a>
            </div>

            {{-- SAP ONLY --}}
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-yellow">⚠️</div>
                    <div>
                        <div class="stat-info-label">SAP Only</div>
                        <div class="stat-info-value val-yellow">{{ number_format($sapOnly) }}</div>
                    </div>
                </div>
                <a href="{{ route('reconciliation.export.detail', $rekon->id) }}?filter=sap_only" class="btn-export-mini yellow-mini">
                    📥 Export SAP Only
                </a>
            </div>

            {{-- ICRM ONLY --}}
            <div class="stat-card">
                <div class="stat-card-top">
                    <div class="stat-icon icon-sky">ℹ️</div>
                    <div>
                        <div class="stat-info-label">ICRM Only</div>
                        <div class="stat-info-value val-sky">{{ number_format($icrmOnly) }}</div>
                    </div>
                </div>
                <a href="{{ route('reconciliation.export.detail', $rekon->id) }}?filter=icrm_only" class="btn-export-mini sky-mini">
                    📥 Export ICRM Only
                </a>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">Hasil Rekonsiliasi Detail</div>
                <span class="table-count">{{ number_format($total) }} item</span>
            </div>

            <div class="filter-inline">
                <input type="text" id="searchInput" class="filter-input" placeholder="🔍 Cari serial number, material..." style="min-width:260px;">
                <select id="statusFilter" class="filter-input">
                    <option value="">Semua Status</option>
                    <option value="match">✅ Match</option>
                    <option value="mismatch_diff">❌ Mismatch (Beda Material)</option>
                    <option value="sap_only">⚠️ Mismatch (SAP Only)</option>
                    <option value="icrm_only">ℹ️ Mismatch (ICRM Only)</option>
                </select>
            </div>

            <div style="overflow-x:auto;">
                <table class="data-table" id="detailTable">
                    <thead>
                        <tr>
                            <th rowspan="2">#</th>
                            <th rowspan="2">Serial Number</th>
                            <th colspan="2" style="text-align:center; background:#eff6ff; color:#1d4ed8; border-left:2px solid #bfdbfe;">DATA SAP</th>
                            <th colspan="2" style="text-align:center; background:#f0fdf4; color:#15803d; border-left:2px solid #bbf7d0;">DATA ICRM+</th>
                            <th rowspan="2">Status</th>
                            <th rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                            <th style="border-left:2px solid #bfdbfe;">Material SAP</th>
                            <th>Deskripsi SAP</th>
                            <th style="border-left:2px solid #bbf7d0;">Material ICRM</th>
                            <th>Nama Material ICRM</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $i => $row)
                            @php
                                $dbStatus = $row->status ?? 'mismatch';

                                if ($dbStatus === 'match') {
                                    $displayStatus = 'match';
                                } elseif (!empty($row->sap_material) && !empty($row->icrm_material)) {
                                    $displayStatus = 'mismatch_diff';
                                } elseif (!empty($row->sap_material) && empty($row->icrm_material)) {
                                    $displayStatus = 'sap_only';
                                } else {
                                    $displayStatus = 'icrm_only';
                                }
                            @endphp

                            <tr data-status="{{ $displayStatus }}" data-search="{{ strtolower(($row->serial_number ?? '') . ' ' . ($row->sap_material ?? '') . ' ' . ($row->icrm_material ?? '') . ' ' . ($row->sap_description ?? '') . ' ' . ($row->icrm_nama_material ?? '')) }}">
                                <td style="color:#7280a0; font-size:12px;">{{ $i + 1 }}</td>

                                <td style="font-family:monospace; font-weight:700; font-size:13px; color:#0d1f3c; white-space:nowrap;">
                                    {{ $row->serial_number ?? '-' }}
                                </td>

                                <td style="border-left:2px solid #bfdbfe;">
                                    @if(!empty($row->sap_material))
                                        <span style="font-weight:600; color:#1e3a8a;">{{ $row->sap_material }}</span>
                                    @else
                                        <span style="color:#c0c7d5;">-</span>
                                    @endif
                                </td>

                                <td style="max-width:240px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    {{ $row->sap_description ?? '-' }}
                                </td>

                                <td style="border-left:2px solid #bbf7d0;">
                                    @if(!empty($row->icrm_material))
                                        <span style="font-weight:600; color:#166534;">{{ $row->icrm_material }}</span>
                                    @else
                                        <span style="color:#c0c7d5;">-</span>
                                    @endif
                                </td>

                                <td style="max-width:240px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    {{ $row->icrm_nama_material ?? '-' }}
                                </td>

                                <td>
                                    @if($displayStatus === 'match')
                                        <span class="badge badge-match">✅ Match</span>
                                    @else
                                        <span class="badge badge-mismatch-diff">❌ Mismatch</span>
                                    @endif
                                </td>

                                <td style="font-size:12.5px;">
                                    @if($displayStatus === 'match')
                                        <span style="color:#16a34a; font-weight:600;">Serial Number & Material cocok</span>
                                    @elseif($displayStatus === 'mismatch_diff')
                                        <span style="color:#dc2626; font-weight:600;">Serial Number sama tetapi Material berbeda</span>
                                    @elseif($displayStatus === 'sap_only')
                                        <span style="color:#b45309; font-weight:600;">Data hanya ada di SAP</span>
                                    @else
                                        <span style="color:#0369a1; font-weight:600;">Data hanya ada di ICRM+</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-icon">📭</div>
                                        <div class="empty-title">Belum ada data hasil rekonsiliasi</div>
                                        <div class="empty-desc">Data detail akan muncul setelah proses ETL selesai</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- ===== FILTER SCRIPT ===== --}}
    <script>
        const searchInput  = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');
        const tbody        = document.querySelector('#detailTable tbody');

        function applyFilter() {
            const q      = searchInput.value.toLowerCase();
            const status = statusFilter.value.toLowerCase();
            const rows   = tbody.querySelectorAll('tr[data-status]');

            rows.forEach(row => {
                const matchSearch = !q || row.dataset.search.includes(q);
                const matchStatus = !status || row.dataset.status === status;

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', applyFilter);
        statusFilter.addEventListener('change', applyFilter);
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