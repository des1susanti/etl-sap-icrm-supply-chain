<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Rekonsiliasi Baru – PT PLN ICON PLUS</title>

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
            align-items: center;
            gap: 14px;
            margin-bottom: 28px;
        }

        .btn-back {
            display: flex; align-items: center; gap: 6px;
            height: 40px; padding: 0 16px;
            background: #fff; color: #3a4a6b;
            border: 1.5px solid #e4e9f2;
            border-radius: 10px; font-size: 13px;
            font-weight: 600; cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back:hover { border-color: #c8d3e8; color: #0d1f3c; background: #f8fafd; }

        .page-title {
            font-size: 24px; font-weight: 700;
            color: #0d1f3c; margin-bottom: 4px;
        }

        .page-subtitle { font-size: 14px; color: #7280a0; }

        /* ===== FORM CARD ===== */
        .form-card {
            background: #fff; border-radius: 16px;
            max-width: 600px;
            border: 1px solid #e4e9f2;
            box-shadow: 0 4px 14px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .form-card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f0f3f9;
            background: #f8fafd;
        }

        .form-card-title { font-size: 16px; font-weight: 700; color: #0d1f3c; }

        .form-card-body { padding: 24px; }

        .form-label-custom {
            font-size: 12px; font-weight: 700;
            color: #3a4a6b; text-transform: uppercase;
            letter-spacing: 0.5px; margin-bottom: 8px;
            display: block;
        }

        .form-input-custom {
            width: 100%; height: 44px; padding: 0 14px;
            border: 1.5px solid #dce3ee;
            border-radius: 10px; font-size: 14px;
            color: #2d3a52; background: #f8fafd;
            transition: all 0.2s;
        }
        .form-input-custom:focus {
            outline: none; border-color: #72b3ff; background: #fff;
            box-shadow: 0 0 0 4px rgba(114,179,255,0.15);
        }

        .form-hint {
            font-size: 12px; color: #7280a0; margin-top: 6px; display: block;
        }

        .alert-box {
            border-radius: 12px; padding: 14px 18px;
            font-size: 13.5px; margin-bottom: 20px;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-danger { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

        .btn-submit-etl {
            height: 44px; width: 100%;
            background: linear-gradient(135deg, #0054a6, #003a75);
            color: #fff; border: none; border-radius: 10px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit-etl:hover {
            background: linear-gradient(135deg, #003a75, #00254a);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0,84,166,0.25);
        }

        @media (max-width: 768px) {
            .main-content { padding: 24px 16px; }
            .top-navbar { padding: 0 16px; }
            .navbar-menu { display: none; }
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

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="main-content">
        
        {{-- PAGE HEADER --}}
        <div class="page-header">
            <a href="{{ route('reconciliation.index') }}" class="btn-back">← Kembali</a>
            <div>
                <div class="page-title">Mulai Rekonsiliasi Baru</div>
                <div class="page-subtitle">Jalankan pipeline ETL untuk mencocokkan data SAP dan ICRM+</div>
            </div>
        </div>

        {{-- ERROR HANDLING --}}
        @if($errors->any())
            <div class="alert-box alert-danger">
                ❌ &nbsp;
                <div>
                    @foreach($errors->all() as $e)
                        <div>{{ $e }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">Parameter Pipeline Rekonsiliasi</div>
            </div>
            
            <div class="form-card-body">
                <form method="POST" action="{{ route('reconciliation.store') }}">
                    @csrf
                    
                    <div style="margin-bottom: 24px;">
                        <label for="periode" class="form-label-custom">Periode Rekonsiliasi</label>
                        <input type="text" name="periode" id="periode" class="form-input-custom" 
                               placeholder="Contoh: Mei 2026 atau Q1-2026" required value="{{ old('periode') }}">
                        <small class="form-hint">Tentukan nama penanda periode laporan rekonsiliasi yang akan diproses oleh sistem.</small>
                    </div>

                    <button type="submit" class="btn-submit-etl">
                        ⚙️ Jalankan Proses ETL & Rekonsiliasi
                    </button>
                </form>
            </div>
        </div>

    </main>
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