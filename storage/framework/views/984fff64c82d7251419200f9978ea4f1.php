<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/admin-projects.css')); ?>?v=<?php echo e(time()); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-card">
    <div class="page-header">
        <h1>Create New Project</h1>
        <a href="<?php echo e(route('admin.projects.index')); ?>" class="back-button">
            <span class="back-icon">←</span>
            <span class="back-text">Torna ai Progetti</span>
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div style="background: rgba(203, 75, 22, 0.2); border: 1px solid #cb4b16; color: #cb4b16; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h4 style="margin: 0 0 10px 0;">There are errors in the form:</h4>
            <ul style="margin: 0; padding-left: 20px;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.projects.store')); ?>" enctype="multipart/form-data" style="display: grid; gap: 25px;">
        <?php echo csrf_field(); ?>
        
        <!-- Title -->
        <div>
            <label for="title" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Project Title *
            </label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="<?php echo e(old('title')); ?>"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                class="<?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Enter project title"
                required
            >
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Description -->
        <div>
            <label for="description" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Description *
            </label>
            <textarea 
                id="description" 
                name="description" 
                rows="4"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box; resize: vertical;"
                class="<?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Describe the project..."
                required
            ><?php echo e(old('description')); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Status and Technologies -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            <!-- Status -->
            <div>
                <label for="status" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    Status *
                </label>
                <select 
                    id="status" 
                    name="status"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    required
                >
                    <option value="">Select status...</option>
                    <option value="active" <?php echo e(old('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                    <option value="completed" <?php echo e(old('status') === 'completed' ? 'selected' : ''); ?>>Completed</option>
                    <option value="in-progress" <?php echo e(old('status') === 'in-progress' ? 'selected' : ''); ?>>In Progress</option>
                    <option value="on-hold" <?php echo e(old('status') === 'on-hold' ? 'selected' : ''); ?>>On Hold</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    Display Order
                </label>
                <input 
                    type="number" 
                    id="sort_order" 
                    name="sort_order" 
                    value="<?php echo e(old('sort_order')); ?>"
                    min="0" 
                    max="999"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="<?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="0"
                >
                <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Technologies -->
        <div>
            <label for="technologies" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Technologies * (comma separated)
            </label>
            <input 
                type="text" 
                id="technologies" 
                name="technologies" 
                value="<?php echo e(old('technologies') ? (is_array(old('technologies')) ? implode(', ', old('technologies')) : old('technologies')) : ''); ?>"
                style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                class="<?php $__errorArgs = ['technologies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                placeholder="Laravel, PHP, JavaScript, CSS..."
                required
            >
            <div style="color: #93a1a1; font-size: 0.8rem; margin-top: 5px;">
                Example: Laravel, PHP, JavaScript, CSS, HTML
            </div>
            <?php $__errorArgs = ['technologies'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- URLs -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
            <!-- GitHub URL -->
            <div>
                <label for="github_url" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    GitHub URL
                </label>
                <input 
                    type="url" 
                    id="github_url" 
                    name="github_url" 
                    value="<?php echo e(old('github_url')); ?>"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="<?php $__errorArgs = ['github_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="https://github.com/username/repo"
                >
                <?php $__errorArgs = ['github_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Project Folder -->
            <div>
                <label for="demo_url" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                    Project Folder Name *
                </label>
                <input 
                    type="text" 
                    id="demo_url" 
                    name="demo_url" 
                    value="<?php echo e(old('demo_url')); ?>"
                    style="width: 100%; padding: 12px; background: rgba(7, 54, 66, 0.5); border: 2px solid #073642; border-radius: 8px; color: #eee8d5; font-family: inherit; font-size: 1rem; box-sizing: border-box;"
                    class="<?php $__errorArgs = ['demo_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="my-awesome-project"
                    required
                >
                <div style="color: #93a1a1; font-size: 0.8rem; margin-top: 5px;">
                    Example: my-awesome-project (will be created in /resources/views/projects/)
                </div>
                <?php $__errorArgs = ['demo_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Project Image -->
        <div>
            <label for="project_image" style="display: block; color: #eee8d5; font-weight: bold; margin-bottom: 8px;">
                Project Image
            </label>
            <div class="custom-file-upload">
                <input 
                    type="file" 
                    id="project_image" 
                    name="project_image" 
                    accept="image/*"
                    class="<?php $__errorArgs = ['project_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    onchange="updateFileName(this)"
                >
                <label for="project_image" class="file-upload-label">
                    <span class="file-upload-icon">📁</span>
                    <span class="file-upload-text">Scegli immagine</span>
                </label>
                <div class="file-name" id="file-name">Nessun file selezionato</div>
            </div>
            <div style="color: #93a1a1; font-size: 0.8rem; margin-top: 5px;">
                Supported formats: JPG, PNG, GIF, WebP (max 5MB)
            </div>
            <?php $__errorArgs = ['project_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div style="color: #cb4b16; font-size: 0.8rem; margin-top: 5px;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Featured -->
        <div>
            <label style="display: flex; align-items: center; gap: 10px; color: #eee8d5; font-weight: bold;">
                <input 
                    type="checkbox" 
                    name="is_featured" 
                    value="1"
                    <?php echo e(old('is_featured') ? 'checked' : ''); ?>

                    style="transform: scale(1.2);"
                >
                Featured Project
            </label>
        </div>

        <!-- Buttons -->
        <div style="display: flex; gap: 15px; justify-content: flex-end; margin-top: 20px;">
            <a href="<?php echo e(route('admin.projects.index')); ?>" style="padding: 12px 20px; background: rgba(7, 54, 66, 0.5); color: #93a1a1; text-decoration: none; border-radius: 8px; border: 1px solid #073642; transition: all 0.3s ease;">
                Cancel
            </a>
            <button type="submit" style="padding: 12px 20px; background: linear-gradient(135deg, #b58900, #cb4b16); color: #002b36; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: all 0.3s ease;">
                <span style="margin-right: 8px;">💾</span> Save Project
            </button>
        </div>
    </form>
</div>

<style>
    /* Ensure proper layout */
    .admin-main {
        position: relative;
        z-index: 1;
    }
    
    /* Back Button Styles - Updated for page-header */
    .back-button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 20px;
        background: rgba(7, 54, 66, 0.6);
        border: 2px solid #073642;
        border-radius: 10px;
        color: #eee8d5;
        text-decoration: none;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .back-button:hover {
        background: rgba(181, 137, 0, 0.2);
        border-color: #b58900;
        color: #b58900;
        transform: translateX(-3px);
        box-shadow: 0 4px 15px rgba(181, 137, 0, 0.3);
    }

    .back-icon {
        font-size: 1.5rem;
        font-weight: bold;
        transition: transform 0.3s ease;
    }

    .back-button:hover .back-icon {
        transform: translateX(-2px);
    }

    .back-text {
        font-size: 1rem;
        font-weight: 500;
    }

    input:focus, textarea:focus, select:focus {
        outline: none;
        border-color: #b58900 !important;
        background: rgba(7, 54, 66, 0.8) !important;
        box-shadow: 0 0 20px rgba(181, 137, 0, 0.2);
    }

    /* Custom File Upload Styles */
    .custom-file-upload {
        position: relative;
        display: block;
        width: 100%;
    }

    .custom-file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 1;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 12px 20px;
        background: rgba(7, 54, 66, 0.5);
        border: 2px solid #073642;
        border-radius: 8px;
        color: #eee8d5;
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: inherit;
        font-size: 1rem;
        box-sizing: border-box;
        position: relative;
        z-index: 0;
    }

    .file-upload-label:hover {
        background: rgba(7, 54, 66, 0.8);
        border-color: #b58900;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(181, 137, 0, 0.2);
    }

    .file-upload-icon {
        font-size: 1.2rem;
    }

    .file-upload-text {
        font-weight: 500;
    }

    .file-name {
        margin-top: 8px;
        padding: 8px 12px;
        background: rgba(7, 54, 66, 0.3);
        border-radius: 6px;
        color: #93a1a1;
        font-size: 0.9rem;
        font-style: italic;
        text-align: center;
    }

    .file-name.has-file {
        color: #b58900;
        font-style: normal;
        font-weight: 500;
    }

    input.error, textarea.error, select.error {
        border-color: #cb4b16 !important;
        background: rgba(203, 75, 22, 0.1) !important;
    }

    button:hover, a:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(181, 137, 0, 0.3);
    }

    @media (max-width: 768px) {
        div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<script>
function updateFileName(input) {
    const fileNameDiv = document.getElementById('file-name');
    if (input.files && input.files[0]) {
        fileNameDiv.textContent = input.files[0].name;
        fileNameDiv.classList.add('has-file');
    } else {
        fileNameDiv.textContent = 'Nessun file selezionato';
        fileNameDiv.classList.remove('has-file');
    }
}
</script>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/admin/projects/create.blade.php ENDPATH**/ ?>