<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Inkblade.cloud</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('icons/icons8-cat-32.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('icons/icons8-cat-32.png')); ?>">
    
    <!-- Google Fonts - JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #002b36 0%, #073642 100%);
            color: #eee8d5;
            font-family: 'JetBrains Mono', monospace;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: #073642;
            border: 2px solid #b58900;
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 0.8s ease-out;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            height: 60px;
            width: auto;
            margin-bottom: 15px;
        }

        .login-title {
            color: #b58900;
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0 0 10px 0;
            text-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
        }

        .login-subtitle {
            color: #93a1a1;
            font-size: 1rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: #93a1a1;
            font-size: 0.9rem;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            background: #002b36;
            border: 1px solid #586e75;
            border-radius: 8px;
            color: #eee8d5;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .form-input:focus {
            outline: none;
            border-color: #b58900;
            box-shadow: 0 0 0 2px rgba(181, 137, 0, 0.2);
        }

        .form-input::placeholder {
            color: #586e75;
        }

        .login-btn {
            width: 100%;
            background: #b58900;
            color: #002b36;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            background: #cb4b16;
            color: #eee8d5;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            background: rgba(220, 50, 47, 0.2);
            border: 1px solid #dc322f;
            color: #dc322f;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #93a1a1;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #b58900;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .login-subtitle {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="<?php echo e(asset('icons/icons8-cat-100.png')); ?>" alt="Admin" class="login-logo">
            <h1 class="login-title">🔐 Admin Access</h1>
            <p class="login-subtitle">Accedi al pannello di amministrazione</p>
        </div>

        <?php if($errors->any()): ?>
            <div class="error-message">
                <strong>Errore:</strong>
                <ul style="margin: 5px 0 0 0; padding-left: 20px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="error-message">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.login')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username" 
                    class="form-input" 
                    placeholder="Inserisci il tuo username"
                    value="<?php echo e(old('username')); ?>"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Inserisci la tua password"
                    required
                >
            </div>

            <button type="submit" class="login-btn">
                🚀 Accedi
            </button>
        </form>

        <div class="back-link">
            <a href="<?php echo e(route('home')); ?>">← Torna al sito principale</a>
        </div>
    </div>

    <script>
        // Auto-focus on username field
        document.getElementById('username').focus();
        
        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const btn = document.querySelector('.login-btn');
            btn.textContent = '🔄 Accesso in corso...';
            btn.disabled = true;
        });
    </script>
</body>
</html>
<?php /**PATH /var/www/inkblade.cloud/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>