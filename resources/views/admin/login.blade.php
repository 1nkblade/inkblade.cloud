<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Inkblade.cloud</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('icons/icons8-cat-32.png') }}">
    <link rel="shortcut icon" href="{{ asset('icons/icons8-cat-32.png') }}">
    
    <!-- Google Fonts - JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ time() }}">
    
    <style>
        body {
            background: linear-gradient(135deg, #002b36 0%, #073642 50%, #002b36 100%);
            min-height: 100vh;
            font-family: 'JetBrains Mono', 'Courier New', monospace;
            color: #eee8d5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated background particles */
        .bg-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(181, 137, 0, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 40px;
            height: 40px;
            top: 30%;
            left: 70%;
            animation-delay: 1s;
        }

        .particle:nth-child(5) {
            width: 70px;
            height: 70px;
            top: 10%;
            left: 50%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.8;
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background: rgba(0, 43, 54, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid #073642;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #b58900, #cb4b16, #b58900);
            animation: shimmer 2s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% {
                opacity: 0.5;
            }
            50% {
                opacity: 1;
            }
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            display: block;
            transition: transform 0.3s ease;
        }

        .login-logo:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .login-title {
            color: #b58900;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .login-subtitle {
            color: #93a1a1;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #eee8d5;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(7, 54, 66, 0.5);
            border: 2px solid #073642;
            border-radius: 10px;
            color: #eee8d5;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #b58900;
            background: rgba(7, 54, 66, 0.8);
            box-shadow: 0 0 20px rgba(181, 137, 0, 0.2);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: #586e75;
            font-style: italic;
        }

        .form-input:focus::placeholder {
            color: #93a1a1;
        }

        .form-input.error {
            border-color: #cb4b16;
            background: rgba(203, 75, 22, 0.1);
        }

        .form-input.error:focus {
            border-color: #cb4b16;
            box-shadow: 0 0 20px rgba(203, 75, 22, 0.2);
        }

        .login-button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #b58900, #cb4b16);
            border: none;
            border-radius: 10px;
            color: #002b36;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-button:hover::before {
            left: 100%;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(181, 137, 0, 0.3);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #073642;
        }

        .back-link {
            color: #93a1a1;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-link:hover {
            color: #eee8d5;
            transform: translateX(-5px);
        }

        .back-link::before {
            content: '←';
            font-size: 1.2rem;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                padding: 15px;
            }

            .login-card {
                padding: 30px 25px;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .form-input {
                padding: 12px 15px;
            }

            .login-button {
                padding: 12px;
            }
        }

        /* Loading animation */
        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .spinner {
            width: 30px;
            height: 30px;
            border: 3px solid #073642;
            border-top: 3px solid #b58900;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Animated background particles -->
    <div class="bg-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Login Form -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('icons/icons8-cat-100.png') }}" alt="Admin Login" class="login-logo">
                <h1 class="login-title">Admin Login</h1>
                <p class="login-subtitle">Access the administrative panel</p>
            </div>

            @if (session('success'))
                <div style="background: rgba(133, 153, 0, 0.2); border: 1px solid #859900; color: #859900; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="background: rgba(203, 75, 22, 0.2); border: 1px solid #cb4b16; color: #cb4b16; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                    {{ session('error') }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('admin.authenticate') }}">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-input @error('username') error @enderror" 
                        placeholder="Enter your username"
                        value="{{ old('username') }}"
                        required
                    >
                    @error('username')
                        <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') error @enderror" 
                        placeholder="Enter your password"
                        required
                    >
                    @error('password')
                        <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="login-button">
                    Login to Admin Panel
                </button>

                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p style="margin-top: 10px; color: #93a1a1;">Authenticating...</p>
                </div>
            </form>

            <div class="login-footer">
                <a href="{{ route('home') }}" class="back-link">
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && (e.ctrlKey || e.metaKey)) {
                document.getElementById('loginForm').submit();
            }
        });
    </script>
</body>
</html>
