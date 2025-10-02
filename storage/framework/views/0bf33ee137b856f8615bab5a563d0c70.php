<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Admin Panel - Inkblade.cloud'); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('icons/icons8-cat-32.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('icons/icons8-cat-32.png')); ?>">
    
    <!-- Google Fonts - JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>?v=<?php echo e(time()); ?>">
    
    <!-- Page-specific CSS -->
    <?php echo $__env->yieldPushContent('styles'); ?>
    
    <style>
        /* Admin-specific styles */
        body {
            background: linear-gradient(135deg, #002b36 0%, #073642 100%);
            min-height: 100vh;
            font-family: 'JetBrains Mono', 'Courier New', monospace;
            color: #eee8d5;
            margin: 0;
            padding: 0;
            padding-top: 80px; /* Compensate for fixed navbar */
        }

        .admin-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background: rgba(0, 43, 54, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #073642;
            padding: 20px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .admin-header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
            color: #eee8d5;
            transition: all 0.3s ease;
        }

        .admin-logo:hover {
            color: #b58900;
            transform: translateX(5px);
        }

        .admin-logo img {
            height: 40px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .admin-logo:hover img {
            transform: scale(1.1);
        }

        .admin-title {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .admin-nav {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .admin-nav a {
            color: #93a1a1;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .admin-nav a:hover {
            background: rgba(181, 137, 0, 0.1);
            color: #eee8d5;
            transform: translateY(-2px);
        }

        .admin-nav a.active {
            background: rgba(181, 137, 0, 0.2);
            color: #b58900;
        }

        .admin-nav button:hover {
            background: rgba(181, 137, 0, 0.1) !important;
            color: #eee8d5 !important;
            transform: translateY(-2px);
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
            z-index: 1001;
        }

        .dropdown-toggle {
            background: none;
            border: none;
            color: #93a1a1;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dropdown-toggle:hover {
            background: rgba(181, 137, 0, 0.1);
            color: #eee8d5;
            transform: translateY(-2px);
        }

        .dropdown-arrow {
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }

        .dropdown.open .dropdown-arrow {
            transform: rotate(180deg);
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: rgba(0, 43, 54, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #073642;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            min-width: 180px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .dropdown.open .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu a {
            display: block;
            color: #93a1a1;
            text-decoration: none;
            padding: 12px 16px;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .dropdown-menu a:hover {
            background: rgba(181, 137, 0, 0.1);
            color: #eee8d5;
            transform: none;
        }

        .dropdown-menu a.active {
            background: rgba(181, 137, 0, 0.2);
            color: #b58900;
        }

        .dropdown-divider {
            height: 1px;
            background: #073642;
            margin: 8px 0;
        }

        .dropdown-logout {
            background: none;
            border: none;
            color: #93a1a1;
            text-decoration: none;
            padding: 12px 16px;
            width: 100%;
            text-align: left;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            border-radius: 0;
        }

        .dropdown-logout:hover {
            background: rgba(181, 137, 0, 0.1);
            color: #eee8d5;
        }

        .admin-main {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .admin-card {
            background: rgba(0, 43, 54, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid #073642;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .admin-card h1 {
            color: #b58900;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 1px;
        }

        .admin-card h2 {
            color: #eee8d5;
            font-size: 1.5rem;
            margin-bottom: 15px;
            border-bottom: 2px solid #073642;
            padding-bottom: 10px;
        }

        .admin-card h3 {
            color: #93a1a1;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .admin-card p {
            color: #839496;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .admin-card ul {
            color: #839496;
            line-height: 1.6;
            padding-left: 20px;
        }

        .admin-card li {
            margin-bottom: 8px;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .admin-header-content {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }

            .admin-nav {
                flex-wrap: wrap;
                justify-content: center;
            }

            .dropdown-menu {
                right: auto;
                left: 50%;
                transform: translateX(-50%) translateY(-10px);
            }

            .dropdown.open .dropdown-menu {
                transform: translateX(-50%) translateY(0);
            }

            .admin-main {
                padding: 20px 15px;
            }

            .admin-card {
                padding: 20px;
            }

            .admin-card h1 {
                font-size: 1.5rem;
            }
        }

        <?php echo $__env->yieldContent('styles'); ?>
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Admin Header -->
        <header class="admin-header">
            <div class="admin-header-content">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-logo">
                    <img src="<?php echo e(asset('icons/icons8-cat-100.png')); ?>" alt="Admin Panel">
                    <span class="admin-title">Admin Panel</span>
                </a>
                
                <nav class="admin-nav">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        Dashboard
                    </a>
                    
                    <!-- More Dropdown -->
                    <div class="dropdown">
                        <button class="dropdown-toggle" onclick="toggleDropdown()">
                            More
                            <span class="dropdown-arrow">▼</span>
                        </button>
                        <div class="dropdown-menu" id="dropdownMenu">
                            <a href="<?php echo e(route('admin.projects.index')); ?>" class="<?php echo e(request()->routeIs('admin.projects.*') ? 'active' : ''); ?>">
                                Projects
                            </a>
                            <a href="<?php echo e(route('home')); ?>" target="_blank">
                                View Site
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="<?php echo e(route('admin.logout')); ?>" style="display: block;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-logout">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class="admin-main">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        function toggleDropdown() {
            const dropdown = document.querySelector('.dropdown');
            dropdown.classList.toggle('open');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.querySelector('.dropdown');
            if (!dropdown.contains(event.target)) {
                dropdown.classList.remove('open');
            }
        });

        <?php echo $__env->yieldContent('scripts'); ?>
    </script>
</body>
</html>
<?php /**PATH /var/www/inkblade.cloud/resources/views/layouts/admin.blade.php ENDPATH**/ ?>