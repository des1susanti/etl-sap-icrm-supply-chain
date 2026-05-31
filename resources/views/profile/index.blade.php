<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya – PT PLN ICON PLUS</title>
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

        .page-title { font-size:24px; font-weight:700; color:#0d1f3c; margin-bottom:4px; }
        .page-subtitle { font-size:14px; color:#7280a0; margin-bottom:28px; }

        /* ALERT */
        .alert-box {
            border-radius:12px; padding:14px 18px; font-size:13.5px;
            margin-bottom:20px; display:flex; align-items:center; gap:10px;
        }
        .alert-success { background:#dcfce7; color:#15803d; border:1px solid #bbf7d0; }
        .alert-danger  { background:#fee2e2; color:#b91c1c; border:1px solid #fecaca; }

        /* PROFILE GRID */
        .profile-grid {
            display:grid;
            grid-template-columns:320px 1fr;
            gap:24px;
            align-items:start;
        }

        /* LEFT COLUMN */
        .profile-card {
            background:#fff; border-radius:20px; padding:32px 24px;
            border:1px solid #e4e9f2; box-shadow:0 2px 8px rgba(0,0,0,0.04);
            text-align:center;
        }

        /* AVATAR */
        .avatar-wrap {
            position:relative; width:110px; height:110px;
            margin:0 auto 20px; cursor:pointer;
        }
        .avatar-img {
            width:110px; height:110px; border-radius:50%;
            object-fit:cover; border:4px solid #e4e9f2;
            transition:opacity 0.2s;
        }
        .avatar-placeholder {
            width:110px; height:110px; border-radius:50%;
            background:linear-gradient(135deg,#0054a6,#4da3ff);
            display:flex; align-items:center; justify-content:center;
            color:#fff; font-size:36px; font-weight:700;
            border:4px solid #e4e9f2;
        }
        .avatar-overlay {
            position:absolute; inset:0; border-radius:50%;
            background:rgba(0,0,0,0.45); display:flex;
            align-items:center; justify-content:center;
            opacity:0; transition:opacity 0.2s; cursor:pointer;
            color:#fff; font-size:22px;
        }
        .avatar-wrap:hover .avatar-overlay { opacity:1; }
        .avatar-wrap:hover .avatar-img { opacity:0.7; }
        .avatar-input { display:none; }

        .profile-name { font-size:18px; font-weight:700; color:#0d1f3c; margin-bottom:4px; }
        .profile-email { font-size:13px; color:#7280a0; margin-bottom:14px; }

        .profile-role {
            display:inline-block; font-size:12px; font-weight:700;
            padding:5px 16px; border-radius:20px; margin-bottom:20px;
        }
        .role-manager    { background:#eff6ff; color:#1d4ed8; }
        .role-admin      { background:#f5f3ff; color:#7c3aed; }

        .profile-stats {
            display:grid; grid-template-columns:1fr 1fr;
            gap:12px; margin-top:4px;
        }
        .profile-stat-item {
            background:#f8fafd; border-radius:12px; padding:14px 10px;
        }
        .profile-stat-val { font-size:20px; font-weight:700; color:#0054a6; }
        .profile-stat-label { font-size:11px; color:#7280a0; font-weight:500; margin-top:2px; }

        /* RIGHT COLUMN */
        .right-col { display:flex; flex-direction:column; gap:20px; }

        /* CARD */
        .section-card {
            background:#fff; border-radius:16px;
            border:1px solid #e4e9f2; box-shadow:0 2px 8px rgba(0,0,0,0.04);
            overflow:hidden;
        }
        .section-header {
            padding:20px 24px; border-bottom:1px solid #f0f3f9;
            display:flex; align-items:center; gap:10px;
        }
        .section-icon { font-size:18px; }
        .section-title { font-size:15px; font-weight:700; color:#0d1f3c; }
        .section-body { padding:24px; }

        /* FORM */
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .form-group { margin-bottom:18px; }
        .form-group:last-child { margin-bottom:0; }
        .form-label-p { font-size:12.5px; font-weight:600; color:#1f2a4d; margin-bottom:7px; display:block; }
        .form-control-p {
            width:100%; height:46px; padding:0 14px;
            border:1.6px solid #dce3ee; border-radius:12px;
            font-size:14px; font-family:'Poppins',sans-serif;
            background:#f8fafd; color:#2d3a52; transition:border-color 0.2s;
        }
        .form-control-p:focus { outline:none; border-color:#72b3ff; background:#fff; }
        .form-control-p:disabled { background:#f0f3f9; color:#a0aec0; cursor:not-allowed; }

        .password-wrap { position:relative; }
        .password-wrap .form-control-p { padding-right:44px; }
        .toggle-pw {
            position:absolute; right:14px; top:50%; transform:translateY(-50%);
            background:none; border:none; cursor:pointer;
            font-size:16px; color:#7280a0;
        }

        .btn-save {
            height:46px; padding:0 28px; border:none; border-radius:12px;
            background:linear-gradient(135deg,#0054a6,#003d7a);
            color:#fff; font-size:14px; font-weight:600;
            cursor:pointer; transition:all 0.2s; margin-top:20px;
        }
        .btn-save:hover {
            background:linear-gradient(135deg,#003d7a,#002a5a);
            transform:translateY(-1px); box-shadow:0 6px 16px rgba(0,84,166,0.3);
        }

        .btn-save-pw {
            height:46px; padding:0 28px; border:none; border-radius:12px;
            background:linear-gradient(135deg,#7c3aed,#6d28d9);
            color:#fff; font-size:14px; font-weight:600;
            cursor:pointer; transition:all 0.2s; margin-top:20px;
        }
        .btn-save-pw:hover {
            background:linear-gradient(135deg,#6d28d9,#5b21b6);
            transform:translateY(-1px);
        }

        /* PASSWORD STRENGTH */
        .pw-strength { margin-top:8px; }
        .pw-strength-bar {
            height:4px; border-radius:99px; background:#e4e9f2;
            overflow:hidden; margin-bottom:4px;
        }
        .pw-strength-fill { height:100%; border-radius:99px; width:0%; transition:width 0.3s,background 0.3s; }
        .pw-strength-label { font-size:11.5px; color:#7280a0; }

        /* ACTIVITY LOG */
        .activity-list { display:flex; flex-direction:column; gap:0; }
        .activity-item {
            display:flex; align-items:flex-start; gap:14px;
            padding:14px 0; border-bottom:1px solid #f0f3f9;
        }
        .activity-item:last-child { border-bottom:none; }
        .activity-dot {
            width:36px; height:36px; border-radius:10px;
            display:flex; align-items:center; justify-content:center;
            font-size:16px; flex-shrink:0; margin-top:2px;
        }
        .dot-login   { background:#eff6ff; }
        .dot-upload  { background:#f0fdf4; }
        .dot-rekon   { background:#fffbeb; }
        .dot-profile { background:#f5f3ff; }

        .activity-info-title { font-size:13.5px; font-weight:600; color:#0d1f3c; margin-bottom:2px; }
        .activity-info-meta  { font-size:12px; color:#7280a0; }

        .empty-activity { text-align:center; padding:32px; color:#7280a0; font-size:13px; }

        /* DIVIDER */
        .form-divider {
            border:none; border-top:1px solid #f0f3f9; margin:20px 0;
        }

        @media (max-width:1024px) {
            .profile-grid { grid-template-columns:1fr; }
            .form-row { grid-template-columns:1fr; }
        }
        @media (max-width:768px) {
            .main-content { padding:24px 16px; }
            .top-navbar { padding:0 16px; }
            .navbar-menu { display:none; }
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

        <div class="page-title">Profil Saya</div>
        <div class="page-subtitle">Kelola informasi akun dan keamanan Anda</div>

        @if(session('success'))
            <div class="alert-box alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-box alert-danger">
                ❌ <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
            </div>
        @endif

        <div class="profile-grid">

            {{-- LEFT: PROFILE CARD --}}
            <div>
                <div class="profile-card">

                    {{-- AVATAR --}}
                    <form method="POST" action="{{ route('profile.avatar') }}"
                          enctype="multipart/form-data" id="form-avatar">
                        @csrf
                        <div class="avatar-wrap" onclick="document.getElementById('avatar-input').click()">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/'.auth()->user()->avatar) }}"
                                     class="avatar-img" id="avatar-preview" alt="Foto Profil">
                            @else
                                <div class="avatar-placeholder" id="avatar-placeholder">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="avatar-overlay">📷</div>
                        </div>
                        <input type="file" name="avatar" id="avatar-input"
                               class="avatar-input" accept="image/*"
                               onchange="previewAvatar(this)">
                    </form>

                    <div class="profile-name">{{ auth()->user()->name }}</div>
                    <div class="profile-email">{{ auth()->user()->email }}</div>
                    <span class="profile-role {{ auth()->user()->role === 'manager' ? 'role-manager' : 'role-admin' }}">
                        {{ auth()->user()->role === 'manager' ? '🛡️ Manager' : '📦 Admin Gudang' }}
                    </span>

                    <div class="profile-stats">
                        <div class="profile-stat-item">
                            <div class="profile-stat-val">
                                {{ auth()->user()->last_login ? auth()->user()->last_login->format('d M') : '-' }}
                            </div>
                            <div class="profile-stat-label">Login Terakhir</div>
                        </div>
                        <div class="profile-stat-item">
                            <div class="profile-stat-val">
                                {{ auth()->user()->created_at->format('Y') }}
                            </div>
                            <div class="profile-stat-label">Tahun Bergabung</div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div class="right-col">

                {{-- EDIT DATA DIRI --}}
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-icon">👤</span>
                        <div class="section-title">Informasi Akun</div>
                    </div>
                    <div class="section-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf @method('PUT')
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label-p">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control-p"
                                           value="{{ old('name', auth()->user()->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label-p">Email</label>
                                    <input type="email" name="email" class="form-control-p"
                                           value="{{ old('email', auth()->user()->email) }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label-p">Role</label>
                                <input type="text" class="form-control-p"
                                       value="{{ auth()->user()->role === 'manager' ? 'Manager' : 'Admin Gudang' }}"
                                       disabled>
                            </div>
                            <button type="submit" class="btn-save">💾 Simpan Perubahan</button>
                        </form>
                    </div>
                </div>

                {{-- GANTI PASSWORD --}}
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-icon">🔒</span>
                        <div class="section-title">Ganti Password</div>
                    </div>
                    <div class="section-body">
                        <form method="POST" action="{{ route('profile.password') }}">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label class="form-label-p">Password Saat Ini</label>
                                <div class="password-wrap">
                                    <input type="password" name="current_password"
                                           class="form-control-p" id="pw-current"
                                           placeholder="••••••••" required>
                                    <button type="button" class="toggle-pw"
                                            onclick="togglePw('pw-current', this)">👁</button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label-p">Password Baru</label>
                                    <div class="password-wrap">
                                        <input type="password" name="password"
                                               class="form-control-p" id="pw-new"
                                               placeholder="Min. 8 karakter" required
                                               oninput="checkStrength(this.value)">
                                        <button type="button" class="toggle-pw"
                                                onclick="togglePw('pw-new', this)">👁</button>
                                    </div>
                                    <div class="pw-strength">
                                        <div class="pw-strength-bar">
                                            <div class="pw-strength-fill" id="pw-fill"></div>
                                        </div>
                                        <div class="pw-strength-label" id="pw-label"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label-p">Konfirmasi Password</label>
                                    <div class="password-wrap">
                                        <input type="password" name="password_confirmation"
                                               class="form-control-p" id="pw-confirm"
                                               placeholder="Ulangi password baru" required>
                                        <button type="button" class="toggle-pw"
                                                onclick="togglePw('pw-confirm', this)">👁</button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn-save-pw">🔐 Ganti Password</button>
                        </form>
                    </div>
                </div>

                {{-- RIWAYAT AKTIVITAS --}}
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-icon">📋</span>
                        <div class="section-title">Riwayat Aktivitas</div>
                    </div>
                    <div class="section-body" style="padding:0 24px;">
                        <div class="activity-list">
                            @forelse($activities ?? [] as $activity)
                                <div class="activity-item">
                                    <div class="activity-dot dot-{{ $activity->type ?? 'login' }}">
                                        @php
                                            $icons = ['login'=>'🔑','upload'=>'📤','rekon'=>'🔄','profile'=>'👤'];
                                            echo $icons[$activity->type ?? 'login'] ?? '📌';
                                        @endphp
                                    </div>
                                    <div>
                                        <div class="activity-info-title">{{ $activity->description ?? '-' }}</div>
                                        <div class="activity-info-meta">{{ $activity->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                </div>
                            @empty
                                {{-- Tampilkan login terakhir sebagai aktivitas minimal --}}
                                @if(auth()->user()->last_login)
                                    <div class="activity-item">
                                        <div class="activity-dot dot-login">🔑</div>
                                        <div>
                                            <div class="activity-info-title">Login ke sistem</div>
                                            <div class="activity-info-meta">
                                                {{ auth()->user()->last_login->format('d M Y, H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="empty-activity">Belum ada riwayat aktivitas</div>
                                @endif
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview avatar sebelum upload
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const placeholder = document.getElementById('avatar-placeholder');
                    let preview = document.getElementById('avatar-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'avatar-preview';
                        preview.className = 'avatar-img';
                        preview.alt = 'Foto Profil';
                        if (placeholder) placeholder.replaceWith(preview);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
                // Auto submit form avatar
                document.getElementById('form-avatar').submit();
            }
        }

        // Toggle show/hide password
        function togglePw(id, btn) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text'; btn.textContent = '🙈';
            } else {
                input.type = 'password'; btn.textContent = '👁';
            }
        }

        // Password strength checker
        function checkStrength(val) {
            const fill  = document.getElementById('pw-fill');
            const label = document.getElementById('pw-label');
            let score = 0;
            if (val.length >= 8)  score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [
                { w:'0%',   bg:'#e4e9f2', text:'' },
                { w:'25%',  bg:'#dc2626', text:'Lemah' },
                { w:'50%',  bg:'#d97706', text:'Cukup' },
                { w:'75%',  bg:'#0054a6', text:'Kuat' },
                { w:'100%', bg:'#16a34a', text:'Sangat Kuat' },
            ];
            const l = levels[score];
            fill.style.width = l.w;
            fill.style.background = l.bg;
            label.textContent = l.text;
            label.style.color = l.bg;
        }
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