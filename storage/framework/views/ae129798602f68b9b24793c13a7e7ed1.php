<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin-projects.css')); ?>?v=<?php echo e(time()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-card">
    <div class="page-header">
        <h1>Project Management</h1>
        <a href="<?php echo e(route('admin.projects.create')); ?>" class="new-project-btn">
            <span style="margin-right: 8px;">+</span> New Project
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="success-message">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($projects->count() > 0): ?>
        <div style="overflow-x: auto;">
            <table class="admin-projects-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Technologies</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="project-title"><?php echo e($project->title); ?></div>
                                <div class="project-description"><?php echo e(Str::limit($project->description, 100)); ?></div>
                            </td>
                            <td>
                                <?php
                                    $statusClasses = [
                                        'active' => 'status-active',
                                        'completed' => 'status-completed',
                                        'in-progress' => 'status-in-progress',
                                        'on-hold' => 'status-on-hold'
                                    ];
                                    $statusLabels = [
                                        'active' => 'Active',
                                        'completed' => 'Completed',
                                        'in-progress' => 'In Progress',
                                        'on-hold' => 'On Hold'
                                    ];
                                ?>
                                <span class="status-badge <?php echo e($statusClasses[$project->status] ?? 'status-on-hold'); ?>">
                                    <?php echo e($statusLabels[$project->status] ?? ucfirst($project->status)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($project->technologies && count($project->technologies) > 0): ?>
                                    <div class="tech-tags">
                                        <?php $__currentLoopData = array_slice($project->technologies, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tech): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="tech-tag"><?php echo e($tech); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($project->technologies) > 3): ?>
                                            <span class="tech-count">+<?php echo e(count($project->technologies) - 3); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <span style="color: #586e75; font-style: italic;">Nessuna</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?php echo e(route('admin.projects.edit', $project)); ?>" class="edit-btn">
                                        Edit
                                    </a>
                                    <form method="POST" action="<?php echo e(route('admin.projects.destroy', $project)); ?>" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="delete-btn">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="project-counter">
            <p class="project-counter-text">
                Total projects: <span class="project-counter-number"><?php echo e($projects->count()); ?></span>
            </p>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">📁</div>
            <h3 class="empty-state-title">No projects found</h3>
            <p class="empty-state-description">Start by creating your first project!</p>
            <a href="<?php echo e(route('admin.projects.create')); ?>" class="new-project-btn">
                <span style="margin-right: 8px;">+</span> Create First Project
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/admin/projects/index.blade.php ENDPATH**/ ?>