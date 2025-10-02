<?php $__env->startSection('title', 'Games - Inkblade.cloud'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Games-specific styles */
.games-header {
    background: linear-gradient(135deg, #002b36 0%, #073642 100%);
    color: #eee8d5;
    padding: 100px 0 60px;
    text-align: center;
    border-bottom: 1px solid #073642;
}

.games-title {
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 1rem;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
    background: linear-gradient(45deg, #b58900, #268bd2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.games-subtitle {
    font-size: 1.2rem;
    color: #93a1a1;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin: 40px 0;
    padding: 0 20px;
}

.game-card {
    background: #002b36;
    border: 1px solid #073642;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.game-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    border-color: #b58900;
}

.game-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: #073642;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: #586e75;
}

.game-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.game-content {
    padding: 25px;
}

.game-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #eee8d5;
    margin-bottom: 10px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.game-description {
    color: #93a1a1;
    line-height: 1.6;
    margin-bottom: 20px;
}

.game-status {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 15px;
}

.status-development {
    background: rgba(203, 75, 22, 0.2);
    color: #cb4b16;
    border: 1px solid #cb4b16;
}

.status-completed {
    background: rgba(133, 153, 0, 0.2);
    color: #859900;
    border: 1px solid #859900;
}

.status-planned {
    background: rgba(38, 139, 210, 0.2);
    color: #268bd2;
    border: 1px solid #268bd2;
}

.game-links {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.game-link {
    padding: 10px 20px;
    background: #073642;
    color: #eee8d5;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid #586e75;
}

.game-link:hover {
    background: #b58900;
    color: #002b36;
    border-color: #b58900;
    transform: translateY(-2px);
}

.game-link.secondary {
    background: transparent;
    color: #93a1a1;
    border-color: #586e75;
}

.game-link.secondary:hover {
    background: #268bd2;
    color: #eee8d5;
    border-color: #268bd2;
}

.empty-games {
    text-align: center;
    padding: 60px 20px;
    color: #93a1a1;
}

.empty-games h3 {
    font-size: 1.8rem;
    color: #eee8d5;
    margin-bottom: 15px;
    font-family: 'JetBrains Mono', 'Courier New', monospace;
}

.empty-games p {
    font-size: 1.1rem;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    background: #b58900;
    color: #002b36;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn:hover {
    background: #cb4b16;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #073642;
    color: #eee8d5;
    border: 1px solid #586e75;
}

.btn-secondary:hover {
    background: #586e75;
    color: #eee8d5;
}

/* Responsive design */
@media (max-width: 768px) {
    .games-title {
        font-size: 2.2rem;
    }
    
    .games-subtitle {
        font-size: 1rem;
    }
    
    .games-grid {
        grid-template-columns: 1fr;
        gap: 20px;
        padding: 0 15px;
    }
    
    .game-content {
        padding: 20px;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Games Header -->
<section class="games-header">
    <div class="container">
        <h1 class="games-title">◉ Games</h1>
        <p class="games-subtitle">Interactive games and mini-projects</p>
    </div>
    <div class="container">
        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-2 mb-0">Go Back</a>
    </div>
</section>

<!-- Games Grid -->
<div class="container">
    <div class="games-grid">
        <div class="game-card">
            <img src="<?php echo e(asset('images/games/tetris.png')); ?>" alt="Tetris" class="game-image">
            <div class="game-content">
                <div class="game-status status-completed">Available</div>
                <h3 class="game-title">Tetris</h3>
                <p class="game-description">Classic Tetris game with modern controls. Clear lines by fitting falling pieces together. Built with HTML5 Canvas and JavaScript.</p>
                <div class="game-links">
                    <a href="<?php echo e(route('games.tetris')); ?>" class="game-link">Play Game</a>
                </div>
            </div>
        </div>
        
        <div class="game-card">
            <img src="<?php echo e(asset('images/games/tic-tac-toe.png')); ?>" alt="Tic-Tac-Toe" class="game-image">
            <div class="game-content">
                <div class="game-status status-completed">Available</div>
                <h3 class="game-title">Tic-Tac-Toe</h3>
                <p class="game-description">Classic Tic-Tac-Toe game with two-player and AI modes. Play against a friend or challenge the AI. Built with modern JavaScript.</p>
                <div class="game-links">
                    <a href="<?php echo e(route('games.tictactoe')); ?>" class="game-link">Play Game</a>
                </div>
            </div>
        </div>
        
        <div class="game-card">
            <img src="<?php echo e(asset('images/games/pibble.jpg')); ?>" alt="Pibble Belly Washing" class="game-image">
            <div class="game-content">
                <div class="game-status status-completed">Available</div>
                <h3 class="game-title">Pibble Belly Washing</h3>
                <p class="game-description">Give the adorable pibble a nice belly wash! Click to wash, collect achievements, and watch soap bubbles float away. Perfect stress relief!</p>
                <div class="game-links">
                    <a href="<?php echo e(route('games.pibble-belly')); ?>" class="game-link">Wash Pibble</a>
                </div>
            </div>
        </div>
        
        <div class="game-card">
            <div class="game-image">○</div>
            <div class="game-content">
                <div class="game-status status-planned">Coming Soon</div>
                <h3 class="game-title">More Games</h3>
                <p class="game-description">Additional games and interactive experiences are in development. Check back soon for more fun!</p>
                <div class="game-links">
                    <a href="#" class="game-link secondary">Coming Soon</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/games/index.blade.php ENDPATH**/ ?>