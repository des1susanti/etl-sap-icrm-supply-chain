<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ETL – PT PLN ICON PLUS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4f6fb;
        }

        /* ===== HERO ===== */
        .hero-section {
            height: 500px;
            background: url("{{ asset('images/login.png') }}") center center / cover no-repeat;
            position: relative;
            /* Filter untuk mencerahkan & mempertajam gambar */
            filter: brightness(1.15) contrast(1.1) saturate(1.1);
        }

        /* Overlay sangat tipis agar gambar tetap terang */
        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(5, 30, 80, 0.08);
        }

        /* ===== BELOW HERO ===== */
        .below-hero {
            background: #f4f6fb;
            padding-bottom: 60px;
        }

        /* ===== LOGIN CARD ===== */
        .login-card-wrap {
            display: flex;
            justify-content: flex-end; /* geser ke kanan */
            margin-top: -300px;
            position: relative;
            z-index: 10;
            padding: 0 60px; /* jarak dari tepi kanan */
        }

        .login-wrapper {
            width: 100%;
            max-width: 460px;
            background: #fff;
            border-radius: 28px;
            padding: 36px 36px 32px;
            box-shadow: 0 16px 56px rgba(11, 44, 95, 0.20);
            border: 1px solid rgba(0, 80, 160, 0.07);
        }

        /* ===== HEADER ===== */
        .header-section {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-img {
            width: 200px;
            height: auto;
            object-fit: contain;
            display: block;
            margin: 0 auto 20px;
        }

        .header-title {
            font-size: 21px;
            font-weight: 700;
            color: #0b2c5f;
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }

        .header-subtitle {
            font-size: 14px;
            color: #0054a6;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .header-desc {
            font-size: 12.5px;
            color: #8b96ad;
            font-weight: 400;
        }

        /* ===== FORM ===== */
        .form-label {
            font-size: 13.5px;
            font-weight: 600;
            color: #1f2a4d;
            margin-bottom: 7px;
        }

        .form-control {
            height: 50px;
            border-radius: 12px;
            border: 1.6px solid #dce3ee;
            font-size: 14px;
            padding-left: 16px;
            background: #f8fafd;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(46, 128, 237, 0.12);
            border-color: #72b3ff;
            background: #fff;
            outline: none;
        }

        .remember {
            font-size: 13px;
            color: #7280a0;
        }

        .forgot {
            font-size: 13px;
            color: #0054a6;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot:hover { text-decoration: underline; }

        /* ===== BUTTON ===== */
        .btn-login {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #4da3ff, #2f80ed);
            color: white;
            font-size: 15.5px;
            font-weight: 600;
            margin-top: 18px;
            transition: background 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #3395ff, #1f74e7);
            transform: translateY(-1px);
        }

        .btn-login:active { transform: translateY(0); }

        /* ===== FOOTER BOX ===== */
        .footer-box {
            margin-top: 22px;
            background: #eef2f7;
            border-radius: 14px;
            padding: 14px 16px;
            text-align: center;
            font-size: 12.5px;
            color: #7280a0;
            line-height: 1.75;
        }

        .footer-box strong {
            color: #003b7a;
            font-size: 13.5px;
        }

        /* ===== SITE FOOTER ===== */
        .site-footer {
            background: #fff;
            border-top: 1px solid #e8ecf4;
            padding: 24px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-logo-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-logo-wrap img {
            height: 34px;
            width: auto;
        }

        .footer-brand {
            font-size: 13px;
            font-weight: 700;
            color: #0054a6;
            line-height: 1.3;
        }

        .footer-tagline {
            font-size: 11.5px;
            color: #7280a0;
        }

        .footer-nav a {
            font-size: 13px;
            color: #0054a6;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-nav a:hover { text-decoration: underline; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .login-card-wrap {
                justify-content: center;
                padding: 0 20px;
                margin-top: -220px;
            }

            .hero-section { height: 380px; }

            .login-wrapper {
                padding: 26px 20px 24px;
                border-radius: 22px;
            }

            .logo-img { width: 160px; }

            .site-footer {
                flex-direction: column;
                align-items: flex-start;
                padding: 18px 20px;
            }
        }
    </style>
</head>
<body>

    {{-- HERO: background image --}}
    <section class="hero-section"></section>

    {{-- BELOW HERO + LOGIN CARD --}}
    <div class="below-hero">
        <div class="login-card-wrap">
            <div class="login-wrapper">

                {{-- HEADER --}}
                <div class="header-section">
                    <img src="{{ asset('images/icon.png') }}"
                         alt="Logo PLN Icon Plus"
                         class="logo-img">
                    <h1 class="header-title">PT PLN ICON PLUS</h1>
                    <div class="header-subtitle">Kantor Wilayah Jambi</div>
                    <div class="header-desc">Sistem ETL Integrasi Data SAP &amp; ICRM+</div>
                </div>

                {{-- ERROR ALERT --}}
                @if ($errors->any())
                    <div class="alert alert-danger p-2 mb-3" style="font-size:13px; border-radius:12px;">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="admin@pln-iconplus.co.id"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="••••••••"
                               required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label remember" for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="forgot">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-login">Masuk</button>

                </form>

                {{-- FOOTER BOX --}}
                <div class="footer-box">
                    <strong>SISTEM ETL v1.0</strong><br>
                    Inventory Visibility Supply Chain<br>
                    © 2025 PT PLN ICON PLUS KWJ
                </div>

            </div>
        </div>
    </div>

    {{-- SITE FOOTER --}}
    <footer class="site-footer">
        <div class="footer-logo-wrap">
            <img src="{{ asset('images/icon.png') }}" alt="PLN Icon Plus">
            <div>
                <div class="footer-brand">PLN Icon Plus</div>
                <div class="footer-tagline">Unleashing <strong>Beyond kWh</strong></div>
            </div>
        </div>

        <nav class="footer-nav">
            <a href="https://plniconplus.co.id/" target="_blank" rel="noopener">Tentang Kami</a>
        </nav>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>