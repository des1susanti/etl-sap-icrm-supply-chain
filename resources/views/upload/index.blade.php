<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Data – PT PLN ICON PLUS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body { background: #f0f3f9; min-height: 100vh; }

        /* ===== NAVBAR (sama persis dengan dashboard) ===== */
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

        /* ===== ALERT ===== */
        .alert-box {
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 13.5px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
        .alert-danger  { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        /* ===== UPLOAD GRID ===== */
        .upload-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 28px;
        }

        /* ===== UPLOAD CARD ===== */
        .upload-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .upload-card-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 8px;
        }

        .upload-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .icon-sap  { background: #eff6ff; }
        .icon-icrm { background: #f5f3ff; }

        .upload-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #0d1f3c;
        }

        .upload-card-desc {
            font-size: 13px;
            color: #7280a0;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        /* ===== DROPZONE ===== */
        .dropzone {
            border: 2px dashed #c8d3e8;
            border-radius: 12px;
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s, background 0.2s;
            background: #f8fafd;
            position: relative;
        }

        .dropzone:hover,
        .dropzone.dragover {
            border-color: #0054a6;
            background: #eef3ff;
        }

        .dropzone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .dropzone-icon {
            font-size: 32px;
            margin-bottom: 10px;
            color: #a0aec0;
        }

        .dropzone-text {
            font-size: 13.5px;
            font-weight: 600;
            color: #3a4a6b;
            margin-bottom: 4px;
        }

        .dropzone-hint {
            font-size: 12px;
            color: #a0aec0;
        }

        .dropzone-filename {
            display: none;
            margin-top: 12px;
            font-size: 13px;
            font-weight: 600;
            color: #0054a6;
            background: #eef3ff;
            border-radius: 8px;
            padding: 6px 12px;
        }

        /* ===== PROGRESS BAR ===== */
        .progress-wrap {
            display: none;
            margin-top: 14px;
        }

        .progress-bar-track {
            background: #e4e9f2;
            border-radius: 99px;
            height: 6px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, #0054a6, #4da3ff);
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-label {
            font-size: 12px;
            color: #7280a0;
            margin-top: 6px;
            text-align: right;
        }

        /* ===== ACTION BUTTONS ===== */
        .action-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 8px;
        }

        .btn-upload {
            height: 44px;
            padding: 0 24px;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-upload-sap {
            background: linear-gradient(135deg, #2f80ed, #1a6bd1);
            color: #fff;
        }

        .btn-upload-sap:hover {
            background: linear-gradient(135deg, #1a6bd1, #1258b8);
            transform: translateY(-1px);
        }

        .btn-upload-icrm {
            background: linear-gradient(135deg, #7c3aed, #6d28d9);
            color: #fff;
        }

        .btn-upload-icrm:hover {
            background: linear-gradient(135deg, #6d28d9, #5b21b6);
            transform: translateY(-1px);
        }

        .btn-reset {
            height: 44px;
            padding: 0 18px;
            border: 1.5px solid #e4e9f2;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            color: #7280a0;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            border-color: #c8d3e8;
            color: #3a4a6b;
        }

        /* ===== ETL BUTTON ===== */
        .etl-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            margin-bottom: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .etl-info-title {
            font-size: 16px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 4px;
        }

        .etl-info-desc {
            font-size: 13px;
            color: #7280a0;
            line-height: 1.6;
        }

        .btn-etl {
            flex-shrink: 0;
            height: 48px;
            padding: 0 28px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #0054a6, #003d7a);
            color: #fff;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
        }

        .btn-etl:hover {
            background: linear-gradient(135deg, #003d7a, #002a5a);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 84, 166, 0.3);
        }

        /* ===== INPUT PERIODE ===== */
        .input-periode {
            height: 48px;
            padding: 0 14px;
            border: 1.5px solid #e4e9f2;
            border-radius: 10px;
            font-size: 14px;
            color: #3a4a6b;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color 0.2s;
        }

        .input-periode:focus {
            border-color: #0054a6;
        }

        /* ===== LOG TABLE ===== */
        .card-box {
            background: #fff;
            border-radius: 16px;
            padding: 26px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .card-box-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-box-title {
            font-size: 15px;
            font-weight: 700;
            color: #0d1f3c;
        }

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

        /* ===== BADGE ===== */
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 11px;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        .badge-success    { background: #dcfce7; color: #15803d; }
        .badge-failed     { background: #fee2e2; color: #b91c1c; }
        .badge-processing { background: #dbeafe; color: #1d4ed8; }
        .badge-pending    { background: #fef9c3; color: #92400e; }

        /* ===== TYPE BADGE ===== */
        .type-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 6px;
            letter-spacing: 0.3px;
        }
        .type-sap  { background: #eff6ff; color: #1d4ed8; }
        .type-icrm { background: #f5f3ff; color: #7c3aed; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .upload-grid { grid-template-columns: 1fr; }
            .main-content { padding: 24px 16px; }
            .top-navbar { padding: 0 16px; }
            .navbar-menu { display: none; }
            .etl-card { flex-direction: column; align-items: flex-start; }
            .btn-etl { width: 100%; justify-content: center; }
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

        <div class="page-title">Upload Data Material</div>
        <div class="page-subtitle">
            Unggah file laporan dari SAP dan ICRM+ untuk proses sinkronisasi
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="alert-box alert-success">
                ✅ {{ session('success') }}
            </div>
             @endif
            @if(session('error'))
<div class="alert-box alert-danger">
    ❌ {{ session('error') }}
</div>
        @endif

        {{-- ALERT ERROR --}}
        @if($errors->any())
            <div class="alert-box alert-danger">
                ❌
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ===== UPLOAD CARDS ===== --}}
        <div class="upload-grid">

            {{-- SAP --}}
            <div class="upload-card">
                <div class="upload-card-header">
                    <div class="upload-icon icon-sap">📊</div>
                    <div class="upload-card-title">Data SAP (.xlsx)</div>
                </div>
                <div class="upload-card-desc">
                    Pastikan kolom sesuai dengan format standar ekspor SAP Material Management.
                </div>

           <form method="POST"
      action="{{ route('upload.sap') }}"
      enctype="multipart/form-data"
      id="form-sap">
    @csrf

    <input type="month"
           name="periode"
           class="input-periode"
           style="width:180px;margin-bottom:15px;"
           required>

    <div class="dropzone">
                        <input type="file" name="file" accept=".xlsx,.xls"
                               id="file-sap" onchange="handleFile(this, 'sap')">
                        <div class="dropzone-icon">☁️</div>
                        <div class="dropzone-text">Klik untuk pilih file atau seret ke sini</div>
                        <div class="dropzone-hint">Format: .xlsx / .xls — Maks. 10MB</div>
                        <div class="dropzone-filename" id="filename-sap"></div>
                    </div>

                    <div class="progress-wrap" id="progress-sap">
                        <div class="progress-bar-track">
                            <div class="progress-bar-fill" id="bar-sap"></div>
                        </div>
                        <div class="progress-label" id="pct-sap">0%</div>
                    </div>

                    <div class="action-row" style="margin-top:20px;">
                        <button type="button" class="btn-reset" onclick="resetForm('sap')">Reset</button>
                        <button type="submit" class="btn-upload btn-upload-sap">
                            ⬆️ Upload SAP
                        </button>
                    </div>
                </form>
            </div>

            {{-- ICRM --}}
            <div class="upload-card">
                <div class="upload-card-header">
                    <div class="upload-icon icon-icrm">🗃️</div>
                    <div class="upload-card-title">Data ICRM+ (.xlsx)</div>
                </div>
                <div class="upload-card-desc">
                    Unggah data inventaris dari ICRM+ untuk dibandingkan dengan data SAP.
                </div>

                <form method="POST"
      action="{{ route('upload.icrm') }}"
      enctype="multipart/form-data"
      id="form-icrm">
    @csrf

    <input type="month"
           name="periode"
           class="input-periode"
           style="width:180px;margin-bottom:15px;"
           required>

    <div class="dropzone">
                        <input type="file" name="file" accept=".xlsx,.xls"
                               id="file-icrm" onchange="handleFile(this, 'icrm')">
                        <div class="dropzone-icon">☁️</div>
                        <div class="dropzone-text">Klik untuk pilih file atau seret ke sini</div>
                        <div class="dropzone-hint">Format: .xlsx / .xls — Maks. 10MB</div>
                        <div class="dropzone-filename" id="filename-icrm"></div>
                    </div>

                    <div class="progress-wrap" id="progress-icrm">
                        <div class="progress-bar-track">
                            <div class="progress-bar-fill" id="bar-icrm"></div>
                        </div>
                        <div class="progress-label" id="pct-icrm">0%</div>
                    </div>

                    <div class="action-row" style="margin-top:20px;">
                        <button type="button" class="btn-reset" onclick="resetForm('icrm')">Reset</button>
                        <button type="submit" class="btn-upload btn-upload-icrm">
                            ⬆️ Upload ICRM+
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- ===== ETL PROCESS ===== --}}
        <div class="etl-card">
            <div>
                <div class="etl-info-title">🔄 Proses Sinkronisasi (ETL)</div>
                <div class="etl-info-desc">
                    Setelah kedua file berhasil diunggah, jalankan proses ETL untuk
                    membandingkan data SAP dan ICRM+ secara otomatis.
                </div>
            </div>
            {{-- REVISI: Tambah input periode agar tidak error validasi --}}
            <form method="POST" action="{{ route('reconciliation.store') }}"
                  style="display:flex; align-items:center; gap:12px;">
                @csrf
              <input type="month"
       name="periode"
       class="input-periode"
       style="width: 180px; padding: 0 10px;"
       required>
                <button type="submit" class="btn-etl">
                    🔃 Proses Sinkronisasi (ETL)
                </button>
            </form>
        </div>

        {{-- ===== LOG UPLOAD ===== --}}
        <div class="card-box">
            <div class="card-box-header">
                <div class="card-box-title">Riwayat Upload</div>
                @if(isset($logs) && $logs->total() > 0)
                    <span style="font-size:12px; color:#7280a0;">
                        {{ $logs->total() }} data
                    </span>
                @endif
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Tipe</th>
                        <th>Diupload Oleh</th>
                        <th>Jumlah Baris</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs ?? [] as $log)
                        <tr>
                            <td>
                                <div style="font-weight:600; font-size:13px;">
                                    {{ $log->filename ?? '-' }}
                                </div>
                            </td>
                            <td>
                                <span class="type-badge type-{{ strtolower($log->type ?? 'sap') }}">
                                    {{ strtoupper($log->type ?? '-') }}
                                </span>
                            </td>
                            <td>{{ $log->user->name ?? '-' }}</td>
                            <td style="font-size:13px; color:#7280a0;">
                                {{ number_format($log->row_count ?? 0) }} baris
                            </td>
                            <td style="font-size:12px; color:#7280a0;">
                                {{ $log->created_at->format('d M Y, H:i') }}
                            </td>
                            <td>
                                <span class="badge badge-{{ $log->status ?? 'pending' }}">
                                    {{ strtoupper($log->status ?? '-') }}
                                </span>
                            </td>
                            <td>
                                @if(auth()->user()->role === 'manager')
                                    <form method="POST"
                                          action="{{ route('upload.destroy', $log->id) }}"
                                          onsubmit="return confirm('Hapus log ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                style="background:none; border:none; cursor:pointer;
                                                       color:#e53935; font-size:13px; font-weight:600;">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                style="color:#7280a0; font-size:13px;
                                       text-align:center; padding:32px 0;">
                                Belum ada riwayat upload
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINATION --}}
            @if(isset($logs) && $logs->hasPages())
                <div style="margin-top:20px;">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // REVISI: Handle file pilih → progress naik ke 90%, saat submit → 100% hijau
        function handleFile(input, type) {
            const file = input.files[0];
            if (!file) return;

            const nameEl = document.getElementById('filename-' + type);
            nameEl.textContent = '📄 ' + file.name;
            nameEl.style.display = 'block';

            const progressWrap = document.getElementById('progress-' + type);
            const bar  = document.getElementById('bar-' + type);
            const pct  = document.getElementById('pct-' + type);
            progressWrap.style.display = 'block';

            // Simulasi naik ke 90% saat file dipilih
            let w = 0;
            const interval = setInterval(() => {
                w = Math.min(w + Math.random() * 15, 90);
                bar.style.width = w + '%';
                pct.textContent = Math.round(w) + '%';
                if (w >= 90) clearInterval(interval);
            }, 100);

            // Saat tombol Upload diklik → naik ke 100% hijau
            const form = document.getElementById('form-' + type);
            form.addEventListener('submit', function() {
                clearInterval(interval);
                bar.style.width = '100%';
                bar.style.background = 'linear-gradient(90deg, #15803d, #22c55e)';
                pct.textContent = '100%';
                pct.style.color = '#15803d';
            });
        }

        // Reset form
        function resetForm(type) {
            document.getElementById('form-' + type).reset();
            document.getElementById('filename-' + type).style.display = 'none';
            document.getElementById('filename-' + type).textContent = '';
            document.getElementById('progress-' + type).style.display = 'none';
            const bar = document.getElementById('bar-' + type);
            bar.style.width = '0%';
            bar.style.background = 'linear-gradient(90deg, #0054a6, #4da3ff)';
            const pct = document.getElementById('pct-' + type);
            pct.textContent = '0%';
            pct.style.color = '#7280a0';
        }

        // Drag & drop visual
        ['sap','icrm'].forEach(type => {
            const zone = document.getElementById('dropzone-' + type);
            zone.addEventListener('dragover', e => {
                e.preventDefault();
                zone.classList.add('dragover');
            });
            zone.addEventListener('dragleave', () => {
                zone.classList.remove('dragover');
            });
            zone.addEventListener('drop', e => {
                e.preventDefault();
                zone.classList.remove('dragover');
                const input = document.getElementById('file-' + type);
                input.files = e.dataTransfer.files;
                handleFile(input, type);
            });
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