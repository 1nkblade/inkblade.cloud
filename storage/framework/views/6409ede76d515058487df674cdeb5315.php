<?php $__env->startSection('title', 'Contact - Inkblade.cloud'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/contact.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Contact Header -->
<section class="contact-header">
    <div class="container">
        <h1 class="contact-title">Get In Touch</h1>
        <p class="contact-subtitle">I'd love to hear from you. Send me a message and I'll respond as soon as possible.</p>
    </div>
</section>

<!-- Contact Content -->
<div class="container">
    <div class="contact-content">
        <!-- Contact Form -->
        <div class="contact-form-section">
            <h2 class="section-title">Send Message</h2>
            
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-error">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="contact-form">
                <?php echo csrf_field(); ?>
                
                <div class="form-group">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('name')); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('email')); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Subject *</label>
                    <input type="text" 
                           id="subject" 
                           name="subject" 
                           class="form-input <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           value="<?php echo e(old('subject')); ?>" 
                           required>
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">Message *</label>
                    <textarea id="message" 
                              name="message" 
                              class="form-textarea <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              rows="6" 
                              required><?php echo e(old('message')); ?></textarea>
                    <div class="char-count">
                        <span id="char-count">0</span>/2000 characters
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <span>📧</span> Send Message
                </button>
            </form>
        </div>

        <!-- Contact Info -->
        <div class="contact-info-section">
            <h2 class="section-title">Contact Information</h2>
            
            <div class="contact-info">
                <div class="info-item">
                    <div class="info-icon">📧</div>
                    <div class="info-content">
                        <h3>Email</h3>
                        <p>hello@inkblade.cloud</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">🌐</div>
                    <div class="info-content">
                        <h3>Website</h3>
                        <p>inkblade.cloud</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">⏰</div>
                    <div class="info-content">
                        <h3>Response Time</h3>
                        <p>Usually within 24 hours</p>
                    </div>
                </div>
            </div>

            <div class="social-links">
                <h3>Find Me Online</h3>
                <div class="social-grid">
                    <a href="https://github.com" class="social-link" target="_blank" rel="noopener">
                        <span>🐙</span> GitHub
                    </a>
                    <a href="https://linkedin.com" class="social-link" target="_blank" rel="noopener">
                        <span>💼</span> LinkedIn
                    </a>
                    <a href="https://twitter.com" class="social-link" target="_blank" rel="noopener">
                        <span>🐦</span> Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Home -->
    <div class="text-center mt-4">
        <a href="<?php echo e(route('home')); ?>" class="btn btn-secondary">← Back to Home</a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counter for message textarea
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('char-count');
    
    function updateCharCount() {
        const length = messageTextarea.value.length;
        charCount.textContent = length;
        
        if (length > 1800) {
            charCount.style.color = '#dc322f'; // Solarized Red
        } else if (length > 1500) {
            charCount.style.color = '#b58900'; // Solarized Yellow
        } else {
            charCount.style.color = '#93a1a1'; // Solarized Base1
        }
    }
    
    messageTextarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initialize count
    
    // Form validation enhancement
    const form = document.querySelector('.contact-form');
    const inputs = form.querySelectorAll('input, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('error');
            } else {
                this.classList.remove('error');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error') && this.value.trim() !== '') {
                this.classList.remove('error');
            }
        });
    });
    
    // Form submission with loading state
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>⏳</span> Sending...';
        
        // Re-enable button after 3 seconds as fallback
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 3000);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/contact.blade.php ENDPATH**/ ?>