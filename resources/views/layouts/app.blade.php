<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inkblade.cloud')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/icons8-cat-32.png') }}">
    <link rel="shortcut icon" href="{{ asset('icons/icons8-cat-32.png') }}">
    
    <!-- Google Fonts - JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ time() }}">
    
    <!-- Page-specific CSS -->
    @stack('styles')
    
    <style>
        /* Navbar-specific styles only */

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #002b36; /* Solarized Dark Base03 */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
            height: 70px;
            border-bottom: 1px solid #073642; /* Solarized Dark Base02 */
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100%;
            padding: 0 20px;
        }

        .navbar-brand {
            color: #eee8d5; /* Solarized Dark Base2 */
            font-size: 1.4rem;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s ease;
            font-family: 'JetBrains Mono', 'Courier New', monospace;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-logo {
            height: 40px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover .navbar-logo {
            transform: scale(1.1);
        }

        .navbar-text {
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #b58900; /* Solarized Dark Yellow */
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            color: #93a1a1; /* Solarized Dark Base1 */
            text-decoration: none;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background-color: rgba(181, 137, 0, 0.1); /* Solarized Dark Yellow with opacity */
            color: #eee8d5; /* Solarized Dark Base2 */
            transform: translateY(-2px);
        }

        .nav-link.active {
            background-color: rgba(181, 137, 0, 0.2); /* Solarized Dark Yellow with opacity */
            color: #b58900; /* Solarized Dark Yellow */
        }

        .nav-link span {
            margin-right: 5px;
            font-size: 1.1em;
        }

        /* Hide mobile-only links on desktop */
        .mobile-only {
            display: none;
        }

        /* Desktop dropdown styles */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: #002b36;
            border: 1px solid #073642;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            min-width: 150px;
            z-index: 1000;
            list-style: none;
            padding: 10px 0;
            margin: 0;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-link {
            display: block;
            padding: 12px 20px;
            color: #93a1a1;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .dropdown-link:hover {
            background-color: rgba(181, 137, 0, 0.1);
            color: #eee8d5;
        }

        .dropdown-link span {
            margin-right: 8px;
            font-size: 1em;
        }

        /* Hide desktop dropdown on mobile */
        .desktop-only {
            display: block;
        }

        /* Mobile menu button */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #eee8d5; /* Solarized Dark Base2 */
            font-size: 1.5rem;
            cursor: pointer;
            padding: 10px;
            transition: all 0.3s ease;
            border-radius: 5px;
            position: relative;
        }

        .mobile-menu-btn:hover {
            color: #b58900; /* Solarized Dark Yellow */
            background-color: rgba(181, 137, 0, 0.1);
            transform: scale(1.1);
        }

        .mobile-menu-btn:active {
            transform: scale(0.95);
        }

        /* Custom burger icon */
        .burger-line {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #eee8d5;
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .mobile-menu-btn.active .burger-line:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-btn.active .burger-line:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active .burger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Main content */
        .main-content {
            min-height: calc(100vh - 70px);
        }

        /* Mobile-first responsive design */
        @media (max-width: 768px) {
            .navbar {
                height: 60px; /* Slightly smaller for mobile */
            }

            .navbar-container {
                padding: 0 15px;
            }

            .navbar-brand {
                font-size: 1.2rem; /* Smaller brand on mobile */
                letter-spacing: 0.5px;
            }

            .navbar-logo {
                height: 35px;
            }

            .navbar-nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: #002b36; /* Solarized Dark Base03 */
                border-top: 1px solid #073642; /* Solarized Dark Base02 */
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                gap: 15px;
            }

            /* Hide desktop dropdown on mobile */
            .desktop-only {
                display: none;
            }

            .navbar-nav.active {
                display: flex;
            }

            /* Show mobile-only links in mobile menu */
            .navbar-nav.active .mobile-only {
                display: block;
            }

            .nav-link {
                padding: 15px 20px;
                font-size: 1.1rem;
                border-radius: 8px;
                text-align: center;
            }

            .mobile-menu-btn {
                display: block;
                font-size: 1.3rem;
                padding: 8px;
            }
        }

        /* iPhone 14 specific optimizations */
        @media (max-width: 430px) {
            .navbar {
                height: 55px;
            }

            .navbar-container {
                padding: 0 12px;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }

            .navbar-logo {
                height: 30px;
            }

            .mobile-menu-btn {
                font-size: 1.2rem;
                padding: 6px;
            }
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('icons/icons8-cat-100.png') }}" alt="Inkblade.cloud" class="navbar-logo">
                <span class="navbar-text">Inkblade.cloud</span>
            </a>
            
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    <span>⌂</span> Home
                </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('projects') }}" class="nav-link {{ request()->routeIs('projects') ? 'active' : '' }}">
                        <span>◉</span> Projects
                    </a>
                </li>
                <!-- Desktop dropdown -->
                <li class="nav-item dropdown desktop-only">
                    <a href="#" class="nav-link dropdown-toggle">
                        <span>⋯</span> More
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('games') }}" class="dropdown-link"><span>◊</span> Games</a></li>
                        <li><a href="{{ route('feed') }}" class="dropdown-link"><span>◐</span> Feed</a></li>
                        <li><a href="{{ route('contact') }}" class="dropdown-link"><span>✉</span> Contact</a></li>
                        <li><a href="#" class="dropdown-link"><span>◯</span> About</a></li>
                    </ul>
                </li>
                <!-- Mobile-only links -->
                <li class="nav-item mobile-only">
                    <a href="{{ route('games') }}" class="nav-link">
                        <span>◊</span> Games
                    </a>
                </li>
                <li class="nav-item mobile-only">
                    <a href="{{ route('feed') }}" class="nav-link">
                        <span>◐</span> Feed
                    </a>
                </li>
                <li class="nav-item mobile-only">
                    <a href="{{ route('contact') }}" class="nav-link">
                        <span>✉</span> Contact
                    </a>
                </li>
                <li class="nav-item mobile-only">
                    <a href="#" class="nav-link">
                        <span>◯</span> About
                    </a>
                </li>
            </ul>

            <button class="mobile-menu-btn" id="mobile-menu-btn" aria-label="Toggle mobile menu">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- JavaScript for mobile menu -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const nav = document.getElementById('navbar-nav');
            const btn = this;
            
            nav.classList.toggle('active');
            btn.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                const nav = document.getElementById('navbar-nav');
                const btn = document.getElementById('mobile-menu-btn');
                
                nav.classList.remove('active');
                btn.classList.remove('active');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const nav = document.getElementById('navbar-nav');
            const btn = document.getElementById('mobile-menu-btn');
            const navbar = document.querySelector('.navbar');
            
            if (!navbar.contains(event.target) && nav.classList.contains('active')) {
                nav.classList.remove('active');
                btn.classList.remove('active');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
