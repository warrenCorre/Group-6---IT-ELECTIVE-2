<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Group 6 • IT Elective 2')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #0b0f15;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            letter-spacing: 0.2px;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 30%, #1e2635, #0a0c12);
            z-index: -2;
        }
        
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
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
            0% { background-position: 0% 0%; }
            25% { background-position: 50% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 50% 50%; }
            100% { background-position: 0% 0%; }
        }
        
        .member-card {
            background: rgba(20, 26, 36, 0.8);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(66, 82, 110, 0.3);
            transition: transform 0.25s ease, box-shadow 0.3s ease, border-color 0.2s;
            box-shadow: 0 20px 30px -15px rgba(0,0,0,0.7);
        }
        .member-card:hover {
            transform: translateY(-6px) scale(1.02);
            border-color: #4f7aa6;
            box-shadow: 0 25px 35px -10px #0e141f;
        }
        .navbar-glass {
            background: rgba(12, 18, 28, 0.85);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #2a3440;
        }
        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 14px auto;
            border: 2px solid #3b5570;
            box-shadow: 0 8px 14px -4px #010101;
            overflow: hidden;
            background: linear-gradient(145deg, #263b4f, #17222d);
        }
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .info-line {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            margin-top: 8px;
            color: #c0d2ec;
        }
        .info-line i {
            width: 18px;
            color: #6e8bb8;
        }
        .bio-text {
            font-size: 0.85rem;
            line-height: 1.5;
            color: #9fafca;
            border-top: 1px dashed #2f3e55;
            padding-top: 10px;
            margin-top: 10px;
        }
        .members-grid {
            max-width: 1300px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 28px;
        }
        .member-card {
            width: 260px;
            padding: 1.8rem 1.2rem 1.5rem 1.2rem;
            border-radius: 32px;
            text-align: center;
        }
        .welcome-card {
            background: rgba(20, 28, 40, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid #31445a;
            border-radius: 48px;
            max-width: 720px;
            margin: 2.5rem auto;
            padding: 2.8rem 2rem;
            box-shadow: 0 30px 40px -20px black;
        }
        .eyebrow {
            color: #7f9bc0;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        .group-title {
            font-size: 3rem;
            font-weight: 300;
            background: linear-gradient(to right, #d3e4ff, #a4c2f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }
        .form-input, .form-select, .form-textarea {
            background: rgba(30, 40, 55, 0.8);
            border: 1px solid #3a4a62;
            color: #e0eaff;
            border-radius: 12px;
            padding: 10px 16px;
            width: 100%;
            transition: all 0.2s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #6a9eff;
            box-shadow: 0 0 0 3px rgba(106, 158, 255, 0.2);
        }
        .btn-primary {
            background: linear-gradient(145deg, #2a405b, #1d2e44);
            border: 1px solid #4f7aa6;
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(145deg, #325473, #253b54);
            border-color: #6a9eff;
        }
        .btn-danger {
            background: linear-gradient(145deg, #5b2a2a, #441d1d);
            border: 1px solid #a64f4f;
            color: white;
            padding: 10px 24px;
            border-radius: 30px;
            transition: all 0.2s;
        }
        .btn-danger:hover {
            background: linear-gradient(145deg, #733232, #542525);
            border-color: #ff6a6a;
        }
        .alert-success {
            background: rgba(30, 70, 50, 0.8);
            border: 1px solid #3a8b5e;
            color: #b0ffcf;
            padding: 12px 20px;
            border-radius: 30px;
            margin-bottom: 20px;
        }
        .alert-error {
            background: rgba(70, 30, 30, 0.8);
            border: 1px solid #8b3a3a;
            color: #ffb0b0;
            padding: 12px 20px;
            border-radius: 30px;
            margin-bottom: 20px;
        }
        .nav-label {
            font-weight: 500;
            transition: opacity 0.2s;
        }
        .nav-label:hover {
            opacity: 0.8;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-void text-gray-200 min-h-screen">
    <!-- Navbar -->
    <div class="navbar-glass fixed top-0 w-full z-50 px-6 py-4 flex justify-between items-center text-white/90">
        <div class="flex items-center space-x-8">
            <a href="{{ route('home') }}" class="nav-label text-xl tracking-wide hover:opacity-100 transition">Home</a>
            <a href="{{ route('team.public') }}" class="nav-label text-xl tracking-wide hover:opacity-100 transition">View Team</a>
            
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.members') }}" class="nav-label text-xl tracking-wide hover:opacity-100 transition">Manage Members</a>
                @endif
            @endauth
        </div>

        <div class="flex items-center space-x-6">
            @auth
                <a href="{{ route('profile.show') }}" class="block">
                    <div class="w-10 h-10 rounded-full border-2 border-indigo-400 overflow-hidden hover:border-indigo-300 transition">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b5570&color=fff&size=40" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        @endif
                    </div>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="nav-label text-xl tracking-wide hover:opacity-100 transition">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-label text-xl tracking-wide hover:opacity-100 transition">Login</a>
            @endauth
        </div>
    </div>

    <div class="h-20"></div>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="alert-error">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="alert-error">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="content px-4 md:px-6 pb-16">
        @yield('content')
    </div>

    @stack('scripts')
</body>
</html>