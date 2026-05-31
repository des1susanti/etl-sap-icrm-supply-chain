<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – PT PLN ICON PLUS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
            top: 0; left: 0;
            width: 100%;
            z-index: 999;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .navbar-logo img {
            height: 38px;
            width: auto;
            object-fit: contain;
        }

        .navbar-menu {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .navbar-menu a {
            font-size: 13.5px;
            font-weight: 500;
            color: #3a4a6b;
            text-decoration: none;
            padding: 7px 14px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }

        .navbar-menu a:hover,
        .navbar-menu a.active {
            background: #eef3ff;
            color: #0054a6;
            font-weight: 600;
        }

        .btn-logout {
            font-size: 13px;
            font-weight: 600;
            color: #e53935;
            background: #fff0f0;
            border: none;
            padding: 7px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            margin-left: 8px;
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

        /* ===== CONTENT ===== */
        .main-content {
            margin-top: 64px;
            padding: 36px 40px;
        }

        .page-title {
            font-size: 24px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 4px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #7280a0;
            margin-bottom: 32px;
        }

        /* ===== STAT CARDS ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 26px 24px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .stat-label {
            font-size: 13px;
            color: #7280a0;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 34px;
            font-weight: 700;
            color: #0d1f3c;
            line-height: 1;
        }

        .stat-value.blue   { color: #0054a6; }
        .stat-value.green  { color: #16a34a; }
        .stat-value.orange { color: #d97706; }
        .stat-value.purple { color: #7c3aed; }

        /* ===== GRID 2 COL ===== */
        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 28px;
        }

        /* ===== CARD ===== */
        .card-box {
            background: #fff;
            border-radius: 16px;
            padding: 26px 26px 20px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .card-box-title {
            font-size: 15px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 20px;
        }

        /* ===== TABLE ===== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead th {
            font-size: 11px;
            font-weight: 700;
            color: #7280a0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0 12px 12px 0;
            border-bottom: 1.5px solid #e4e9f2;
        }

        .data-table tbody td {
            font-size: 13.5px;
            color: #2d3a52;
            padding: 13px 12px 13px 0;
            border-bottom: 1px solid #f0f3f9;
        }

        .data-table tbody tr:last-child td { border-bottom: none; }
        .data-table tbody tr:hover td { background: #f8faff; }

        .td-id {
            font-size: 12px;
            font-weight: 600;
            color: #7280a0;
        }

        /* ===== BADGE ===== */
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 11px;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        .badge-completed  { background: #dcfce7; color: #15803d; }
        .badge-pending    { background: #fef9c3; color: #92400e; }
        .badge-processing { background: #dbeafe; color: #1d4ed8; }
        .badge-draft      { background: #f1f5f9; color: #64748b; }
        .badge-failed     { background: #fee2e2; color: #b91c1c; }

        /* ===== CHART ===== */
        .chart-wrap {
            position: relative;
            height: 220px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .two-col { grid-template-columns: 1fr; }
            .main-content { padding: 24px 16px; }
            .top-navbar { padding: 0 16px; }
            .navbar-menu { display: none; }
        }

        @media (max-width: 576px) {
            .stat-grid { grid-template-columns: 1fr 1fr; }
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

        <div class="page-title">Dashboard Rekonsiliasi</div>
        <div class="page-subtitle">
            Selamat datang, <strong>{{ auth()->user()->name }}</strong> —
            Monitor sinkronisasi data SAP dan ICRM+
        </div>

        {{-- STAT CARDS --}}
        <div class="stat-grid">
            <div class="stat-card">
                <div class="stat-label">Total Rekonsiliasi</div>
                <div class="stat-value blue">{{ number_format($stats['total_reconciliations']) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Selesai</div>
                <div class="stat-value green">{{ number_format($stats['completed']) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Pending / Proses</div>
                <div class="stat-value orange">{{ number_format($stats['pending']) }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Total User</div>
                <div class="stat-value purple">{{ number_format($stats['total_users']) }}</div>
            </div>
        </div>

        {{-- CHART + UPLOAD LOG --}}
        <div class="two-col">

            {{-- Chart rekonsiliasi per bulan --}}
            <div class="card-box">
                <div class="card-box-title">Rekonsiliasi 6 Bulan Terakhir</div>
                <div class="chart-wrap">
                    <canvas id="rekonChart"></canvas>
                </div>
            </div>

            {{-- Upload terbaru --}}
            <div class="card-box">
                <div class="card-box-title">Upload Terbaru</div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>File / User</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_uploads'] as $upload)
                            <tr>
                                <td>
                                    <div style="font-weight:600; font-size:13px;">
                                        {{ $upload->file_name ?? '-' }}
                                    </div>
                                    <div class="td-id">
                                        {{ $upload->user->name ?? '-' }}
                                    </div>
                                </td>
                                <td style="font-size:12px; color:#7280a0;">
                                    {{ $upload->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    <span class="badge badge-{{ $upload->status ?? 'draft' }}">
                                        {{ strtoupper($upload->status ?? '-') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="color:#7280a0; font-size:13px; text-align:center; padding:24px 0;">
                                    Belum ada data upload
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{-- REKONSILIASI TERBARU --}}
        <div class="card-box">
            <div class="card-box-title">Rekonsiliasi Terbaru</div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Dibuat Oleh</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_reconciliations'] as $rekon)
                        <tr>
                            <td class="td-id">#{{ $rekon->id }}</td>
                            <td>{{ $rekon->name ?? '-' }}</td>
                            <td>{{ $rekon->user->name ?? '-' }}</td>
                            <td style="font-size:12.5px; color:#7280a0;">
                                {{ $rekon->created_at->format('d M Y, H:i') }}
                            </td>
                            <td>
                                <span class="badge badge-{{ $rekon->status }}">
                                    {{ strtoupper($rekon->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="color:#7280a0; font-size:13px; text-align:center; padding:24px 0;">
                                Belum ada data rekonsiliasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Data chart dari controller
        const chartRaw = @json($chartData);

        const bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        const labels  = chartRaw.map(d => bulanLabel[(d.month - 1)]);
        const values  = chartRaw.map(d => d.total);

        const ctx = document.getElementById('rekonChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels.length ? labels : ['Belum ada data'],
                datasets: [{
                    label: 'Rekonsiliasi',
                    data: values.length ? values : [0],
                    backgroundColor: 'rgba(0, 84, 166, 0.15)',
                    borderColor: '#0054a6',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, font: { family: 'Poppins', size: 11 } },
                        grid: { color: '#f0f3f9' }
                    },
                    x: {
                        ticks: { font: { family: 'Poppins', size: 11 } },
                        grid: { display: false }
                    }
                }
            }
        });
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