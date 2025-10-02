<?php $__env->startSection('title', 'Blog - Inkblade.cloud'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/blog.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Blog Header -->
<section class="blog-header">
    <div class="container">
        <h1 class="blog-title">Blog</h1>
        <p class="blog-subtitle">Thoughts, tutorials, and insights</p>
    </div>
</section>

<!-- Blog Content -->
<div class="container">
    <div class="blog-content">
        <div class="empty-state">
            <div class="empty-icon">◐</div>
            <h2>Coming Soon</h2>
            <p>I'm working on some interesting content for the blog. Check back soon for articles about web development, programming tips, and more!</p>
            <div class="empty-actions">
                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">← Back to Home</a>
                <a href="<?php echo e(route('projects')); ?>" class="btn btn-secondary">View Projects</a>
            </div>
        </div>
    </div>
</div>

<style>
.blog-header {
    padding: 100px 20px 60px;
    text-align: center;
    background: linear-gradient(135deg, #002b36 0%, #073642 100%);
    border-bottom: 1px solid #073642;
}

.blog-title {
    color: #b58900;
    font-size: 3rem;
    font-weight: bold;
    margin-bottom: 15px;
    font-family: 'JetBrains Mono', monospace;
    text-shadow: 0 0 20px rgba(181, 137, 0, 0.3);
}

.blog-subtitle {
    color: #93a1a1;
    font-size: 1.2rem;
    font-family: 'JetBrains Mono', monospace;
    margin-bottom: 0;
}

.blog-content {
    padding: 60px 0;
    min-height: 400px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    max-width: 600px;
    margin: 0 auto;
}

.empty-icon {
    font-size: 4rem;
    color: #586e75;
    margin-bottom: 30px;
    opacity: 0.7;
}

.empty-state h2 {
    color: #eee8d5;
    font-size: 2rem;
    margin-bottom: 20px;
    font-family: 'JetBrains Mono', monospace;
}

.empty-state p {
    color: #93a1a1;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 40px;
    font-family: 'JetBrains Mono', monospace;
}

.empty-actions {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn {
    display: inline-block;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    font-family: 'JetBrains Mono', monospace;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn-primary {
    background: #b58900;
    color: #002b36;
    border-color: #b58900;
}

.btn-primary:hover {
    background: #cb4b16;
    color: #eee8d5;
    border-color: #cb4b16;
    transform: translateY(-2px);
}

.btn-secondary {
    background: transparent;
    color: #93a1a1;
    border-color: #586e75;
}

.btn-secondary:hover {
    background: #586e75;
    color: #eee8d5;
    border-color: #586e75;
    transform: translateY(-2px);
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .blog-header {
        padding: 80px 15px 40px;
    }

    .blog-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .blog-subtitle {
        font-size: 1rem;
    }

    .blog-content {
        padding: 40px 0;
    }

    .empty-state {
        padding: 40px 15px;
    }

    .empty-icon {
        font-size: 3rem;
        margin-bottom: 20px;
    }

    .empty-state h2 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .empty-state p {
        font-size: 1rem;
        margin-bottom: 30px;
    }

    .empty-actions {
        flex-direction: column;
        align-items: center;
        gap: 15px;
    }

    .btn {
        width: 200px;
        text-align: center;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/blog/index.blade.php ENDPATH**/ ?>