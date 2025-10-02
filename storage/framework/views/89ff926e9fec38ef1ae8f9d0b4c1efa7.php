<?php $__env->startSection('content'); ?>
<div class="admin-card">
    <h1>Welcome to Admin Dashboard</h1>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-top: 30px;">
        <!-- Site Statistics -->
        <div style="background: rgba(7, 54, 66, 0.3); padding: 25px; border-radius: 10px; border: 1px solid #073642;">
            <h2 style="color: #b58900; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <span>📊</span> Site Statistics
            </h2>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Total Projects:</span>
                    <span style="color: #eee8d5; font-weight: bold;"><?php echo e(\App\Models\Project::count()); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Feed Items:</span>
                    <span style="color: #eee8d5; font-weight: bold;">156</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Page Views:</span>
                    <span style="color: #eee8d5; font-weight: bold;">2,847</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Last Update:</span>
                    <span style="color: #eee8d5; font-weight: bold;">2 hours ago</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background: rgba(7, 54, 66, 0.3); padding: 25px; border-radius: 10px; border: 1px solid #073642;">
            <h2 style="color: #b58900; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <span>⚡</span> Quick Actions
            </h2>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <a href="<?php echo e(route('feed.refresh')); ?>" style="color: #93a1a1; text-decoration: none; padding: 10px; border-radius: 5px; transition: all 0.3s ease; border: 1px solid #073642;">
                    <span style="margin-right: 10px;">🔄</span> Refresh Feed
                </a>
                <a href="<?php echo e(route('admin.projects.create')); ?>" style="color: #93a1a1; text-decoration: none; padding: 10px; border-radius: 5px; transition: all 0.3s ease; border: 1px solid #073642;">
                    <span style="margin-right: 10px;">➕</span> New Project
                </a>
                <a href="<?php echo e(route('admin.projects.index')); ?>" style="color: #93a1a1; text-decoration: none; padding: 10px; border-radius: 5px; transition: all 0.3s ease; border: 1px solid #073642;">
                    <span style="margin-right: 10px;">📁</span> Manage Projects
                </a>
                <a href="<?php echo e(route('home')); ?>" target="_blank" style="color: #93a1a1; text-decoration: none; padding: 10px; border-radius: 5px; transition: all 0.3s ease; border: 1px solid #073642;">
                    <span style="margin-right: 10px;">🌐</span> View Site
                </a>
            </div>
        </div>

        <!-- System Status -->
        <div style="background: rgba(7, 54, 66, 0.3); padding: 25px; border-radius: 10px; border: 1px solid #073642;">
            <h2 style="color: #b58900; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <span>🔧</span> System Status
            </h2>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Server Status:</span>
                    <span style="color: #859900; font-weight: bold;">🟢 Online</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Database:</span>
                    <span style="color: #859900; font-weight: bold;">🟢 Connected</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Cache:</span>
                    <span style="color: #859900; font-weight: bold;">🟢 Active</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #93a1a1;">Uptime:</span>
                    <span style="color: #eee8d5; font-weight: bold;">99.9%</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div style="background: rgba(7, 54, 66, 0.3); padding: 25px; border-radius: 10px; border: 1px solid #073642;">
            <h2 style="color: #b58900; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                <span>📝</span> Recent Activity
            </h2>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                <div style="padding: 10px; background: rgba(0, 0, 0, 0.2); border-radius: 5px; border-left: 3px solid #b58900;">
                    <div style="color: #eee8d5; font-size: 0.9rem;">Feed refreshed successfully</div>
                    <div style="color: #586e75; font-size: 0.8rem;">2 hours ago</div>
                </div>
                <div style="padding: 10px; background: rgba(0, 0, 0, 0.2); border-radius: 5px; border-left: 3px solid #859900;">
                    <div style="color: #eee8d5; font-size: 0.9rem;">New project added: 3D Graphics</div>
                    <div style="color: #586e75; font-size: 0.8rem;">1 day ago</div>
                </div>
                <div style="padding: 10px; background: rgba(0, 0, 0, 0.2); border-radius: 5px; border-left: 3px solid #cb4b16;">
                    <div style="color: #eee8d5; font-size: 0.9rem;">System backup completed</div>
                    <div style="color: #586e75; font-size: 0.8rem;">3 days ago</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Notice -->
    <div style="margin-top: 40px; padding: 20px; background: rgba(181, 137, 0, 0.1); border: 1px solid #b58900; border-radius: 10px;">
        <h3 style="color: #b58900; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
            <span>⚠️</span> Admin Notice
        </h3>
        <p style="color: #eee8d5; margin-bottom: 10px;">
            This is a demo admin panel. In a production environment, you would implement:
        </p>
        <ul style="color: #93a1a1; padding-left: 20px;">
            <li>User authentication and authorization</li>
            <li>Role-based access control</li>
            <li>Secure session management</li>
            <li>Audit logging</li>
            <li>Two-factor authentication</li>
        </ul>
    </div>
</div>

<style>
    .admin-card a:hover {
        background: rgba(181, 137, 0, 0.1) !important;
        color: #eee8d5 !important;
        transform: translateX(5px);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/inkblade.cloud/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>