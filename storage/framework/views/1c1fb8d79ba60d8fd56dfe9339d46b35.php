<?php $__env->startSection('title', 'Projects - Inkblade.cloud'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/projects.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Projects Header -->
<section class="projects-header">
    <div class="container">
        <h1 class="projects-title">My Projects</h1>
        <p class="projects-subtitle">A showcase of my latest work and development projects</p>
    </div>
    <div class="container">
    <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary mt-2 mb-0">Go Back</a>
    </div>
</section>

<!-- Projects Grid -->
<div class="container">
    <?php if(count($projects) > 0): ?>
        <div class="projects-grid">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="project-card">
                    <img src="<?php echo e($project['image']); ?>" alt="<?php echo e($project['title']); ?>" class="project-image">
                    
                    <div class="project-content">
                        <div class="status-badge status-<?php echo e($project['status']); ?>">
                            <?php echo e(ucfirst(str_replace('-', ' ', $project['status']))); ?>

                        </div>
                        
                        <h3 class="project-title"><?php echo e($project['title']); ?></h3>
                        
                        <p class="project-description"><?php echo e($project['description']); ?></p>
                        
                        <div class="technologies">
                            <?php $__currentLoopData = $project['technologies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="tech-tag"><?php echo e($tech); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <div class="project-links">
                            <?php if($project['github_url'] && $project['github_url'] !== '#'): ?>
                                <a href="<?php echo e($project['github_url']); ?>" class="project-link" target="_blank" rel="noopener">
                                    <span>📁</span>
                                    GitHub
                                </a>
                            <?php endif; ?>
                            
                            <?php if($project['demo_url']): ?>
                                <a href="<?php echo e($project['demo_url']); ?>" class="project-link secondary" target="_blank" rel="noopener">
                                    <span>🌐</span>
                                    Live Demo
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="empty-projects">
            <h3>No Projects Yet</h3>
            <p>I'm currently working on some exciting projects. Check back soon!</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/projects/index.blade.php ENDPATH**/ ?>