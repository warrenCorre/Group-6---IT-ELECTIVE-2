<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Group 6 • IT Elective 2')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --bg-void: #080c12;
            --bg-surface: #0d1420;
            --bg-card: rgba(13, 20, 34, 0.85);
            --bg-card-hover: rgba(18, 28, 46, 0.92);
            --border-subtle: rgba(66, 99, 148, 0.22);
            --border-active: rgba(106, 158, 255, 0.5);
            --border-card: rgba(52, 78, 120, 0.35);
            --accent-blue: #4f7aa6;
            --accent-blue-bright: #6a9eff;
            --accent-indigo: #6366f1;
            --text-primary: #e8f0ff;
            --text-secondary: #94a8c8;
            --text-muted: #4e6080;
            --glow-blue: rgba(79, 122, 166, 0.15);
            --glow-indigo: rgba(99, 102, 241, 0.12);
            --nav-height: 68px;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg-void);
            font-family: 'DM Sans', system-ui, sans-serif;
            letter-spacing: 0.1px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
            color: var(--text-primary);
        }

        /* ── Background layers ── */
        .bg-layer-base {
            position: fixed; inset: 0; z-index: -3;
            background: radial-gradient(ellipse 80% 60% at 20% 10%, #111c2e 0%, #080c12 60%);
        }
        .bg-layer-mesh {
            position: fixed; inset: 0; z-index: -2;
            background:
                radial-gradient(ellipse 50% 50% at 75% 80%, rgba(30, 48, 75, 0.4) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 10% 60%, rgba(20, 35, 60, 0.35) 0%, transparent 70%);
        }
        .bg-layer-noise {
            position: fixed; inset: 0; z-index: -1; opacity: 0.025;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='1'/%3E%3C/svg%3E");
            background-size: 256px 256px;
        }
        .bg-layer-grid {
            position: fixed; inset: 0; z-index: -1; opacity: 0.028;
            background-image:
                linear-gradient(rgba(106,158,255,0.6) 1px, transparent 1px),
                linear-gradient(90deg, rgba(106,158,255,0.6) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 70% 70% at 50% 50%, black 20%, transparent 80%);
        }

        /* ── Animated gradient background (preserved exactly) ── */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 30% 30%, #1e2635, #0a0c12);
            z-index: -2;
        }
        body::after {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(125deg,
                rgba(30, 38, 53, 0.4) 0%,
                rgba(10, 12, 18, 0.6) 25%,
                rgba(20, 30, 45, 0.5) 50%,
                rgba(8, 12, 20, 0.7) 75%,
                rgba(30, 38, 53, 0.4) 100%);
            background-size: 300% 300%;
            z-index: -1;
            animation: gradientMove 15s ease infinite;
        }
        @keyframes gradientMove {
            0%   { background-position: 0% 0%; }
            25%  { background-position: 50% 50%; }
            50%  { background-position: 100% 100%; }
            75%  { background-position: 50% 50%; }
            100% { background-position: 0% 0%; }
        }

        /* ── Navbar ── */
        .navbar {
            position: fixed; top: 0; width: 100%; z-index: 100;
            height: var(--nav-height);
            background: rgba(8, 12, 18, 0.82);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border-subtle);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 2rem;
            transition: background 0.3s ease;
        }
        .navbar::after {
            content: '';
            position: absolute; bottom: 0; left: 10%; right: 10%; height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-blue-bright), transparent);
            opacity: 0.25;
        }

        .nav-brand {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: linear-gradient(135deg, #d3e4ff 0%, #8ab4f8 50%, #6a9eff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-link {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-secondary);
            text-decoration: none;
            padding: 6px 14px;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            letter-spacing: 0.02em;
            position: relative;
        }
        .nav-link:hover {
            color: var(--text-primary);
            background: rgba(79, 122, 166, 0.1);
            border-color: var(--border-subtle);
        }
        .nav-link.active {
            color: var(--accent-blue-bright);
            background: rgba(106, 158, 255, 0.08);
            border-color: rgba(106, 158, 255, 0.2);
        }

        .nav-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1.5px solid var(--accent-blue);
            overflow: hidden;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 0 0 0 rgba(106, 158, 255, 0);
        }
        .nav-avatar:hover {
            border-color: var(--accent-blue-bright);
            box-shadow: 0 0 0 3px rgba(106, 158, 255, 0.15), 0 0 16px rgba(106, 158, 255, 0.2);
            transform: scale(1.05);
        }
        .nav-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }

        .nav-logout-btn {
            font-size: 0.88rem; font-weight: 500;
            color: var(--text-secondary);
            background: none; border: none; cursor: pointer;
            padding: 6px 14px; border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            font-family: 'DM Sans', sans-serif;
        }
        .nav-logout-btn:hover {
            color: #ff8a8a;
            background: rgba(255, 80, 80, 0.08);
            border-color: rgba(255, 80, 80, 0.2);
        }

        /* ── Cards ── */
        .member-card {
            background: var(--bg-card);
            backdrop-filter: blur(16px) saturate(150%);
            -webkit-backdrop-filter: blur(16px) saturate(150%);
            border: 1px solid var(--border-card);
            border-radius: 24px;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease, border-color 0.25s ease;
            box-shadow: 0 4px 24px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.03);
            position: relative;
            overflow: hidden;
        }
        .member-card::before {
            content: '';
            position: absolute; inset: 0; border-radius: 24px; pointer-events: none;
            background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(79,122,166,0.06), transparent 70%);
            opacity: 0; transition: opacity 0.3s ease;
        }
        .member-card:hover::before { opacity: 1; }
        .member-card:hover {
            transform: translateY(-8px) scale(1.015);
            border-color: rgba(106, 158, 255, 0.3);
            box-shadow:
                0 20px 50px rgba(0,0,0,0.55),
                0 0 0 1px rgba(106, 158, 255, 0.1),
                inset 0 1px 0 rgba(255,255,255,0.05);
        }

        /* ── Profile avatar ── */
        .profile-avatar {
            width: 88px; height: 88px;
            border-radius: 50%;
            margin: 0 auto 18px auto;
            border: 2px solid var(--accent-blue);
            box-shadow:
                0 0 0 4px rgba(79, 122, 166, 0.12),
                0 12px 24px rgba(0,0,0,0.5);
            overflow: hidden;
            background: linear-gradient(145deg, #1d3048, #111e2e);
            transition: all 0.3s ease;
            position: relative;
        }
        .profile-avatar::after {
            content: '';
            position: absolute; inset: 0; border-radius: 50%;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
            pointer-events: none;
        }
        .member-card:hover .profile-avatar {
            border-color: var(--accent-blue-bright);
            box-shadow: 0 0 0 4px rgba(106, 158, 255, 0.2), 0 12px 24px rgba(0,0,0,0.5);
        }
        .profile-avatar img { width: 100%; height: 100%; object-fit: cover; display: block; }

        /* ── Role badge ── */
        .role-badge {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 3px 12px;
            border-radius: 20px;
            background: rgba(99, 102, 241, 0.12);
            border: 1px solid rgba(99, 102, 241, 0.25);
            color: #a5b4fc;
            margin-top: 4px;
        }

        /* ── Info lines ── */
        .info-line {
            display: flex; align-items: center; gap: 10px;
            font-size: 0.83rem; margin-top: 10px;
            color: var(--text-secondary);
        }
        .info-line i {
            width: 16px; text-align: center;
            color: var(--accent-blue); opacity: 0.8;
            font-size: 0.8rem;
        }
        .info-line span { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

        .bio-text {
            font-size: 0.82rem;
            line-height: 1.6;
            color: #7a90b0;
            border-top: 1px solid rgba(66, 82, 110, 0.2);
            padding-top: 12px;
            margin-top: 14px;
            font-style: italic;
        }

        /* ── Members grid ── */
        .members-grid {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
        }
        .members-grid .member-card {
            width: 264px;
            padding: 2rem 1.4rem 1.6rem;
            text-align: center;
        }

        /* ── Welcome / Hero card ── */
        .welcome-card {
            background: rgba(13, 20, 34, 0.75);
            backdrop-filter: blur(20px) saturate(160%);
            -webkit-backdrop-filter: blur(20px) saturate(160%);
            border: 1px solid var(--border-card);
            border-radius: 32px;
            max-width: 720px;
            margin: 2.5rem auto;
            padding: 3.5rem 2.5rem;
            box-shadow: 0 40px 80px -20px rgba(0,0,0,0.7), inset 0 1px 0 rgba(255,255,255,0.04);
            position: relative; overflow: hidden;
        }
        .welcome-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(106,158,255,0.4), transparent);
        }

        .eyebrow {
            font-family: 'Syne', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .group-title {
            font-family: 'Syne', sans-serif;
            font-size: 3.8rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #e8f0ff 0%, #b8d0f8 40%, #7aa8f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.1;
        }

        .subtitle-divider {
            font-size: 1.5rem;
            font-weight: 300;
            color: #4a6480;
            letter-spacing: 0.05em;
            padding: 14px 0;
            border-top: 1px solid rgba(66, 99, 148, 0.2);
            border-bottom: 1px solid rgba(66, 99, 148, 0.2);
            margin: 16px 0;
        }

        /* ── Forms ── */
        .form-group {
            display: flex; flex-direction: column; gap: 6px;
        }
        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--text-muted);
        }
        .form-input, .form-select, .form-textarea {
            background: rgba(8, 14, 24, 0.7);
            border: 1px solid rgba(52, 78, 120, 0.4);
            color: var(--text-primary);
            border-radius: 12px;
            padding: 11px 16px;
            width: 100%;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            outline: none;
        }
        .form-input::placeholder, .form-textarea::placeholder { color: var(--text-muted); }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--accent-blue-bright);
            background: rgba(12, 20, 36, 0.9);
            box-shadow: 0 0 0 3px rgba(106, 158, 255, 0.12), 0 0 20px rgba(106, 158, 255, 0.05);
        }
        .form-input:hover:not(:focus), .form-select:hover:not(:focus), .form-textarea:hover:not(:focus) {
            border-color: rgba(79, 122, 166, 0.5);
        }
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%236a9eff' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 40px;
        }
        .form-select option { background: #0d1420; color: var(--text-primary); }
        .form-textarea { resize: vertical; min-height: 80px; line-height: 1.6; }
        .form-error { font-size: 0.76rem; color: #ff8080; margin-top: 4px; display: flex; align-items: center; gap: 5px; }
        .form-error::before { content: '⚠'; font-size: 0.7rem; }

        /* ── Buttons ── */
        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(145deg, rgba(42, 64, 91, 0.9), rgba(29, 46, 68, 0.9));
            border: 1px solid var(--accent-blue);
            color: var(--text-primary);
            padding: 10px 24px;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            letter-spacing: 0.02em;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative; overflow: hidden;
        }
        .btn-primary::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.06), transparent);
            opacity: 0; transition: opacity 0.2s;
        }
        .btn-primary:hover::before { opacity: 1; }
        .btn-primary:hover {
            background: linear-gradient(145deg, rgba(50, 78, 110, 0.95), rgba(37, 59, 84, 0.95));
            border-color: var(--accent-blue-bright);
            box-shadow: 0 4px 20px rgba(106, 158, 255, 0.2), 0 0 0 1px rgba(106, 158, 255, 0.1);
            transform: translateY(-1px);
        }
        .btn-primary:active { transform: translateY(0); }

        .btn-danger {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(145deg, rgba(91, 42, 42, 0.9), rgba(68, 29, 29, 0.9));
            border: 1px solid #a64f4f;
            color: var(--text-primary);
            padding: 10px 24px;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-danger:hover {
            background: linear-gradient(145deg, rgba(115, 50, 50, 0.95), rgba(84, 37, 37, 0.95));
            border-color: #ff6a6a;
            box-shadow: 0 4px 20px rgba(255, 80, 80, 0.2);
            transform: translateY(-1px);
        }

        .btn-sm { padding: 7px 16px; font-size: 0.82rem; border-radius: 10px; }

        /* ── Alerts ── */
        .alert {
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 20px;
            display: flex; align-items: center; gap: 12px;
            font-size: 0.88rem;
            animation: alertSlideIn 0.3s ease;
        }
        @keyframes alertSlideIn {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .alert-success {
            background: rgba(20, 60, 40, 0.7);
            border: 1px solid rgba(50, 160, 90, 0.4);
            color: #7dffc2;
        }
        .alert-error {
            background: rgba(60, 20, 20, 0.7);
            border: 1px solid rgba(160, 50, 50, 0.4);
            color: #ffb0b0;
        }
        .alert-icon { font-size: 1rem; flex-shrink: 0; }

        /* ── Section headings ── */
        .section-heading {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: rgba(232, 240, 255, 0.92);
        }
        .section-divider {
            height: 2px; width: 40px;
            background: linear-gradient(90deg, var(--accent-indigo), transparent);
            border-radius: 2px;
            margin: 10px auto 0;
        }

        /* ── Page enter animation ── */
        .page-content {
            animation: pageIn 0.4s ease both;
        }
        @keyframes pageIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ── Staggered card animations ── */
        .member-card {
            animation: cardIn 0.5s ease both;
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(20px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-void); }
        ::-webkit-scrollbar-thumb { background: rgba(79,122,166,0.35); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(106,158,255,0.5); }

        /* ── Utility ── */
        .spacer-nav { height: var(--nav-height); }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Background layers -->
    <div class="bg-layer-base"></div>
    <div class="bg-layer-mesh"></div>
    <div class="bg-layer-noise"></div>
    <div class="bg-layer-grid"></div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="nav-brand">G6 · IT Elec 2</a>
            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('team.public') }}" class="nav-link {{ request()->routeIs('team.public') ? 'active' : '' }}">View Team</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.members') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">Manage Members</a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('profile.show') }}">
                    <div class="nav-avatar">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1d3048&color=7aa8f0&size=72" alt="{{ auth()->user()->name }}">
                        @endif
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="nav-logout-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-primary btn-sm">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                    Login
                </a>
            @endauth
        </div>
    </nav>

    <div class="spacer-nav"></div>

    <!-- Flash messages -->
    @if(session('success') || session('error') || $errors->any())
        <div class="max-w-5xl mx-auto px-6 mt-5">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check alert-icon"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fa-solid fa-circle-exclamation alert-icon"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fa-solid fa-triangle-exclamation alert-icon"></i>
                    <ul style="margin:0;padding:0;list-style:none;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    @endif

    <div class="page-content px-4 md:px-6 pb-20">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>