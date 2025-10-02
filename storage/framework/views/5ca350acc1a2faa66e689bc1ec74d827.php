<?php $__env->startSection('title', '3D Graphics - Inkblade.cloud'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="project-header">
        <h1>3D Graphics</h1>
        <p class="project-description">Progetto #7</p>
    </div>
    
    <div class="project-content">
        <div class="project-demo">
            <h2>Progetto</h2>
            <p>Cartella: <code>/projects/3d-graphics</code></p>
            <p>Percorso: <code>/resources/views/projects//projects/3d-graphics/</code></p>
            <p>ID Progetto: <code>7</code></p>
        </div>
        
        <div class="project-info">
            <h2>Informazioni Progetto</h2>
            <p>Questo progetto è stato creato automaticamente dal sistema di gestione.</p>
            <p>La cartella del progetto è stata creata in:</p>
            <code>/var/www/inkblade.cloud/resources/views/projects//projects/3d-graphics/</code>
            
            <div style="margin-top: 20px;">
                <a href="<?php echo e(route('projects')); ?>" class="back-link">
                    ← Torna ai Progetti
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.project-header {
    text-align: center;
    margin-bottom: 40px;
    padding: 40px 0;
    background: rgba(7, 54, 66, 0.3);
    border-radius: 15px;
}

.project-header h1 {
    color: #eee8d5;
    font-size: 2.5rem;
    margin-bottom: 10px;
}

.project-description {
    color: #93a1a1;
    font-size: 1.2rem;
}

.project-content {
    display: grid;
    gap: 30px;
}

.project-demo, .project-info {
    background: rgba(7, 54, 66, 0.3);
    padding: 30px;
    border-radius: 15px;
    border: 1px solid rgba(181, 137, 0, 0.2);
}

.project-demo h2, .project-info h2 {
    color: #b58900;
    margin-bottom: 20px;
}

.project-demo p, .project-info p {
    color: #93a1a1;
    line-height: 1.6;
    margin-bottom: 10px;
}

code {
    background: rgba(7, 54, 66, 0.5);
    color: #b58900;
    padding: 4px 8px;
    border-radius: 4px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.9rem;
}

.back-link {
    display: inline-block;
    background: rgba(181, 137, 0, 0.2);
    color: #b58900;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    border: 1px solid rgba(181, 137, 0, 0.3);
    transition: all 0.3s ease;
}

.back-link:hover {
    background: rgba(181, 137, 0, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(181, 137, 0, 0.2);
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/projects/3d-graphics/index.blade.php ENDPATH**/ ?>