<?php $__env->startSection('title', 'Admin Dashboard - Inkblade.cloud'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #002b36;
        border: 1px solid #586e75;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        border-color: #b58900;
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #b58900;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #93a1a1;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .dashboard-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .action-card {
        background: #002b36;
        border: 1px solid #586e75;
        border-radius: 12px;
        padding: 25px;
        transition: all 0.3s ease;
    }

    .action-card:hover {
        border-color: #b58900;
        transform: translateY(-3px);
    }

    .action-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .action-icon {
        font-size: 1.8rem;
        margin-right: 15px;
        color: #b58900;
    }

    .action-title {
        color: #eee8d5;
        font-size: 1.2rem;
        font-weight: bold;
        margin: 0;
    }

    .action-description {
        color: #93a1a1;
        font-size: 0.9rem;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .action-btn {
        background: #b58900;
        color: #002b36;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        font-family: 'JetBrains Mono', monospace;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .action-btn:hover {
        background: #cb4b16;
        color: #eee8d5;
        transform: translateY(-2px);
        text-decoration: none;
    }

    .recent-projects {
        background: #002b36;
        border: 1px solid #586e75;
        border-radius: 12px;
        padding: 25px;
    }

    .section-title {
        color: #eee8d5;
        font-size: 1.3rem;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .section-title span {
        margin-right: 10px;
        font-size: 1.5rem;
        color: #b58900;
    }

    .project-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .project-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #586e75;
    }

    .project-item:last-child {
        border-bottom: none;
    }

    .project-info h4 {
        color: #eee8d5;
        margin: 0 0 5px 0;
        font-size: 1rem;
    }

    .project-info p {
        color: #93a1a1;
        margin: 0;
        font-size: 0.8rem;
    }

    .project-status {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: bold;
        text-transform: uppercase;
    }

    .status-completed {
        background: rgba(133, 153, 0, 0.2);
        color: #859900;
        border: 1px solid #859900;
    }

    .status-in-progress {
        background: rgba(181, 137, 0, 0.2);
        color: #b58900;
        border: 1px solid #b58900;
    }

    .status-planning {
        background: rgba(108, 113, 196, 0.2);
        color: #6c71c4;
        border: 1px solid #6c71c4;
    }

    .welcome-message {
        background: linear-gradient(135deg, rgba(181, 137, 0, 0.1) 0%, rgba(203, 75, 22, 0.1) 100%);
        border: 1px solid #b58900;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: center;
    }

    .welcome-title {
        color: #b58900;
        font-size: 1.4rem;
        font-weight: bold;
        margin: 0 0 10px 0;
    }

    .welcome-text {
        color: #93a1a1;
        margin: 0;
        font-size: 1rem;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .dashboard-stats {
            grid-template-columns: 1fr;
        }

        .dashboard-actions {
            grid-template-columns: 1fr;
        }

        .project-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .project-status {
            align-self: flex-end;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-message">
    <h2 class="welcome-title">🎉 Benvenuto nel Pannello Admin!</h2>
    <p class="welcome-text">Gestisci i tuoi progetti e il contenuto del sito da qui</p>
</div>

<!-- Statistics -->
<div class="dashboard-stats">
    <div class="stat-card">
        <span class="stat-icon">📁</span>
        <div class="stat-number"><?php echo e($projectsCount); ?></div>
        <div class="stat-label">Progetti Totali</div>
    </div>
    
    <div class="stat-card">
        <span class="stat-icon">✅</span>
        <div class="stat-number"><?php echo e($completedProjects); ?></div>
        <div class="stat-label">Completati</div>
    </div>
    
    <div class="stat-card">
        <span class="stat-icon">🚧</span>
        <div class="stat-number"><?php echo e($inProgressProjects); ?></div>
        <div class="stat-label">In Corso</div>
    </div>
    
    <div class="stat-card">
        <span class="stat-icon">⭐</span>
        <div class="stat-number"><?php echo e($featuredProjects); ?></div>
        <div class="stat-label">In Evidenza</div>
    </div>
</div>

<!-- Quick Actions -->
<div class="dashboard-actions">
    <div class="action-card">
        <div class="action-header">
            <span class="action-icon">➕</span>
            <h3 class="action-title">Nuovo Progetto</h3>
        </div>
        <p class="action-description">
            Aggiungi un nuovo progetto al tuo portfolio con tutte le informazioni necessarie.
        </p>
        <a href="<?php echo e(route('admin.projects.create')); ?>" class="action-btn">
            Crea Progetto
        </a>
    </div>

    <div class="action-card">
        <div class="action-header">
            <span class="action-icon">📁</span>
            <h3 class="action-title">Gestisci Progetti</h3>
        </div>
        <p class="action-description">
            Visualizza, modifica ed elimina i progetti esistenti nel tuo portfolio.
        </p>
        <a href="<?php echo e(route('admin.projects.index')); ?>" class="action-btn">
            Vedi Tutti
        </a>
    </div>

    <div class="action-card">
        <div class="action-header">
            <span class="action-icon">🌐</span>
            <h3 class="action-title">Vedi Sito</h3>
        </div>
        <p class="action-description">
            Apri il sito principale in una nuova scheda per vedere le modifiche.
        </p>
        <a href="<?php echo e(route('home')); ?>" target="_blank" class="action-btn">
            Apri Sito
        </a>
    </div>

    <div class="action-card">
        <div class="action-header">
            <span class="action-icon">📊</span>
            <h3 class="action-title">Statistiche</h3>
        </div>
        <p class="action-description">
            Visualizza statistiche dettagliate sui tuoi progetti e visite.
        </p>
        <a href="#" class="action-btn" onclick="alert('Funzionalità in arrivo!')">
            Prossimamente
        </a>
    </div>
</div>

<!-- Recent Projects -->
<div class="recent-projects">
    <h3 class="section-title">
        <span>📋</span>
        Progetti Recenti
    </h3>
    
    <?php if($recentProjects->count() > 0): ?>
        <ul class="project-list">
            <?php $__currentLoopData = $recentProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="project-item">
                    <div class="project-info">
                        <h4><?php echo e($project->title); ?></h4>
                        <p><?php echo e(Str::limit($project->description, 60)); ?></p>
                    </div>
                    <span class="project-status status-<?php echo e($project->status); ?>">
                        <?php echo e(ucfirst(str_replace('-', ' ', $project->status))); ?>

                    </span>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php else: ?>
        <p style="color: #93a1a1; text-align: center; padding: 20px;">
            Nessun progetto trovato. 
            <a href="<?php echo e(route('admin.projects.create')); ?>" style="color: #b58900;">Crea il tuo primo progetto!</a>
        </p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/admin/dashboard/index.blade.php ENDPATH**/ ?>