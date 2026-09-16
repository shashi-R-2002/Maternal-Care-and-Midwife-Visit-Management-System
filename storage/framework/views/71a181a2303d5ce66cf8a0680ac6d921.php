

<?php $__env->startSection('title', 'Midwife Dashboard'); ?>

<?php $__env->startSection('content'); ?>

    <!-- ══ SIDEBAR ══ -->
<div class="sidebar">

    <!-- Brand -->
    <div class="sidebar-brand">
        <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z"
                  fill="url(#sbShield)" opacity="0.9"/>
            <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z"
                  fill="white" opacity="0.95"/>
            <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18"
                  stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <defs>
                <linearGradient id="sbShield" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse">
                    <stop offset="0%" stop-color="#1e40af"/>
                    <stop offset="100%" stop-color="#0891b2"/>
                </linearGradient>
            </defs>
        </svg>
        <div class="brand-text">
            <div class="b-name">MaternalCare</div>
            <div class="b-sub">Health System</div>
        </div>
    </div>

    <!-- Role badge -->
    <div class="sidebar-role">
        <div class="role-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="role-info">
            <div class="r-name">Midwife Portal</div>
            <div class="r-role">Logged in as Midwife</div>
        </div>
    </div>

    <!-- Nav -->
<nav class="sidebar-nav">
    <div class="nav-section-label">Main Menu</div>

    <a href="<?php echo e(route('midwife.dashboard')); ?>" class="active">
        <span class="nav-icon">
            <i class="bi bi-speedometer2"></i>
        </span>
        Dashboard
    </a>

    <a href="<?php echo e(route('mothers.create')); ?>">
        <span class="nav-icon">
            <i class="bi bi-person-plus-fill"></i>
        </span>
        Add Mother
    </a>

    <a href="<?php echo e(route('mothers.index')); ?>">
        <span class="nav-icon">
            <i class="bi bi-people-fill"></i>
        </span>
        Mother List
    </a>

    <a href="<?php echo e(route('midwife.visits')); ?>">
        <span class="nav-icon">
            <i class="bi bi-calendar2-check-fill"></i>
        </span>
        Visits
    </a>

    <a href="<?php echo e(route('midwife.medicines')); ?>">
        <span class="nav-icon">
            <i class="bi bi-capsule"></i>
        </span>
        Medicines
    </a>

    <a href="<?php echo e(route('midwife.health-record')); ?>">
        <span class="nav-icon">
            <i class="bi bi-heart-pulse"></i>
        </span>
        Health Records
    </a>

    <a href="<?php echo e(route('midwife.reports')); ?>">
        <span class="nav-icon">
            <i class="bi bi-bar-chart-fill"></i>
        </span>
        Reports
    </a>

</nav>

    <!-- Footer -->
    <div class="sidebar-footer">
    <a href="<?php echo e(route('home')); ?>" class="logout-btn">
        <i class="bi bi-box-arrow-left"></i>
        Sign Out
    </a>
</div>
</div>

<!-- ══ MAIN ══ -->
<div class="main">

    <!-- Topbar -->
   <?php echo $__env->make('partials.midwife-topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- Content -->
    <div class="content">

        <!-- ── SUMMARY CARDS ── -->
        <div class="summary-grid">

            <div class="stat-card blue">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stat-body">
                    <div class="stat-label">Total Mothers</div>
                    <div class="stat-num"><?php echo e($totalMothers); ?></div>
                    <div class="stat-hint">Registered in your area</div>
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon"><i class="bi bi-calendar-check-fill"></i></div>
                <div class="stat-body">
                    <div class="stat-label">Today's Visits</div>
                    <div class="stat-num"><?php echo e($todayVisits); ?></div>

                    <div class="stat-hint">Scheduled for today</div>
                </div>
            </div>

            <div class="stat-card amber">
                <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
                <div class="stat-body">
                   <div class="stat-label">Upcoming Visits</div>
                     <div class="stat-num"><?php echo e($upcomingVisits); ?></div>
                    <div class="stat-hint">Scheduled upcoming visits</div>
                </div>
            </div>

            <div class="stat-card rose">
                <div class="stat-icon"><i class="bi bi-heart-fill"></i></div>
                <div class="stat-body">
                    <div class="stat-label">Delivered Mothers</div>
                    <div class="stat-num"><?php echo e($deliveredMothers); ?></div>
                    <div class="stat-hint">Successfully delivered</div>
                </div>
            </div>

        </div>

        <!-- ── VISITS TABLE + ALERTS ── -->
        <div class="dash-row">

            <!-- Today's Visits Table -->
            <div class="panel">
                <div class="panel-header">
                    <h5>
                        <span class="ph-icon"><i class="bi bi-calendar2-check"></i></span>
                        Today's Visits
                    </h5>
                    <span class="panel-badge today">
                      <?php echo e($todayVisits); ?> scheduled
                   </span>
                </div>
                <div class="panel-body" style="padding:16px 18px;">
                    <table class="visits-table">
                        <thead>
                            <tr>
                                <th>Mother</th>
                                <th>Time</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

<?php $__empty_1 = true; $__currentLoopData = $recentVisits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $visit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr>

    <td>
        <div class="mother-cell">

            <div class="mother-avatar">
                <?php echo e(strtoupper(substr($visit->mother->full_name,0,2))); ?>

            </div>

            <span class="mother-name">
                <?php echo e($visit->mother->full_name); ?>

            </span>

        </div>
    </td>

    <td>
        <span class="time-chip">
            <?php echo e(\Carbon\Carbon::parse($visit->visit_date)->format('d M Y')); ?>

        </span>
    </td>

    <td>
        <span class="loc-chip">
            <?php echo e($visit->visit_type); ?>

        </span>
    </td>

    <td>
        <span class="status-chip done">
            Completed
        </span>
    </td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>

    <td colspan="4" style="text-align:center;padding:30px;">
        No visits available.
    </td>

</tr>

<?php endif; ?>

</tbody>
                    </table>
                </div>
            </div>

            <!-- Alerts Panel -->
            <div class="panel">
                <div class="panel-header">
                    <h5>
                        <span class="ph-icon" style="background:#fff1f2;color:#ef4444;"><i class="bi bi-exclamation-triangle"></i></span>
                        Alerts
                    </h5>
                    <span class="panel-badge alert">3 active</span>
                </div>
                <div class="panel-body">

                    <div class="alert-item danger">
                        <div class="ai-icon"><i class="bi bi-x-circle-fill"></i></div>
                        <div class="ai-text">
                            <div class="ai-title">Missed Clinic Visits</div>
                            <div class="ai-desc">2 mothers missed their scheduled clinic appointments</div>
                        </div>
                    </div>

                    <div class="alert-item warning">
                        <div class="ai-icon"><i class="bi bi-clock-fill"></i></div>
                        <div class="ai-text">
                            <div class="ai-title">Overdue Check-up</div>
                            <div class="ai-desc">Kamala Perera is 5 days overdue for a check-up</div>
                        </div>
                    </div>

                    <div class="alert-item info">
                        <div class="ai-icon"><i class="bi bi-capsule-pill"></i></div>
                        <div class="ai-text">
                            <div class="ai-title">Medicine Low Stock</div>
                            <div class="ai-desc">Iron supplements running low — please reorder</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- ── QUICK LINKS ── -->
         <div class="panel mb-4">
    <div class="panel-header">
        <h5>Recently Registered Mothers</h5>
    </div>

    <div class="panel-body">

        <table class="table">
            <thead>
                <tr>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $recentMothers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mother): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>
                    <td><?php echo e($mother->registration_no); ?></td>
                    <td><?php echo e($mother->full_name); ?></td>
                    <td>
    <?php if($mother->status == 'Pregnant'): ?>
        <span class="status-badge status-pregnant">
            Pregnant
        </span>

    <?php elseif($mother->status == 'Delivered'): ?>
        <span class="status-badge status-delivered">
            Delivered
        </span>

    <?php else: ?>
        <span class="status-badge status-high-risk">
            <?php echo e($mother->status); ?>

        </span>
    <?php endif; ?>
</td>
                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr class="empty-row">
    <td colspan="3">
        No mothers registered yet.
    </td>
</tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>
</div>

        <div class="panel" style="margin-bottom:0;">
            <div class="panel-header">
                <h5>
                    <span class="ph-icon" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-lightning-fill"></i></span>
                    Quick Actions
                </h5>
                <span class="panel-badge quick">4 shortcuts</span>
            </div>
            <div class="panel-body">
                <div class="quick-links-grid">

                    <a href="<?php echo e(route('mothers.create')); ?>" class="ql-card">
                        <div class="ql-icon"><i class="bi bi-person-plus-fill"></i></div>
                        <div class="ql-text">
                            <div class="ql-title">Add Mother</div>
                            <div class="ql-sub">Register a new mother</div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('midwife.visits')); ?>" class="ql-card">
                        <div class="ql-icon"><i class="bi bi-calendar2-plus-fill"></i></div>
                        <div class="ql-text">
                            <div class="ql-title">Add Visit</div>
                            <div class="ql-sub">Record a new visit</div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('mothers.index')); ?>" class="ql-card">
                        <div class="ql-icon"><i class="bi bi-people-fill"></i></div>
                        <div class="ql-text">
                            <div class="ql-title">Mother List</div>
                            <div class="ql-sub">View all registered mothers</div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('midwife.medicines')); ?>" class="ql-card">
                        <div class="ql-icon"><i class="bi bi-capsule"></i></div>
                        <div class="ql-text">
                            <div class="ql-title">Medicines</div>
                            <div class="ql-sub">Manage medicine records</div>
                        </div>
                    </a>

                    <a href="<?php echo e(route('midwife.health-record')); ?>" class="ql-card">
                          <div class="ql-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>

                     <div class="ql-text">
                  <div class="ql-title">Health Records</div>
                     <div class="ql-sub">Manage mother health records</div>
                     </div>
                     </a>

                </div>
            </div>
        </div>

    </div><!-- /content -->
</div><!-- /main -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.midwife', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\maternal-care-system\resources\views/midwife/dashboard.blade.php ENDPATH**/ ?>