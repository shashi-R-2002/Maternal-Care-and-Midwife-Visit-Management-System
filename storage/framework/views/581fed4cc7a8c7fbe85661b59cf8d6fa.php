

<?php $__env->startSection('title','Midwives List'); ?>

<?php $__env->startSection('content'); ?>

<!-- ══ SIDEBAR ══ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#sbG)" opacity="0.9"/>
            <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
            <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <defs><linearGradient id="sbG" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#1e40af"/><stop offset="100%" stop-color="#0891b2"/></linearGradient></defs>
        </svg>
        <div class="brand-text"><div class="b-name">MaternalCare</div><div class="b-sub">Admin Portal</div></div>
    </div>

    <div class="sidebar-role">
        <div class="role-avatar"><i class="bi bi-shield-fill-check"></i></div>
        <div class="role-info"><div class="r-name">Admin Panel</div><div class="r-role">Logged in as Admin</div></div>
    </div>

    <nav class="sidebar-nav">
       <div class="nav-section-label">Main Menu</div>
        <a href="<?php echo e(route('admin.dashboard')); ?>" >
    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>Dashboard
</a>
       
        <a href="<?php echo e(route('admin.mothers')); ?>">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
        </a>
        <a href="<?php echo e(route('admin.midwives')); ?>"class="active">
    <span class="nav-icon"><i class="bi bi-person-badge-fill"></i></span>Midwife List
</a>

<a href="<?php echo e(route('admin.reports')); ?>">
    <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>Reports
</a>

        
    </nav>

    <div class="sidebar-footer">
        <a href="index.html" class="logout-btn"><i class="bi bi-box-arrow-left"></i>Sign Out</a>
    </div>
</div>

<!-- ══ MAIN ══ -->
<div class="main">

    <div class="topbar">
        <div class="topbar-left">
            <h5>Midwife List</h5>
            <p>Approved midwives who can currently log in to the system</p>
        </div>
        <span class="topbar-date"><i class="bi bi-calendar3"></i><span id="todayDate"></span></span>
    </div>

    <div class="content">

        <!-- Info banner pointing back to approvals -->
        <div class="info-banner">
            <div class="info-banner-icon"><i class="bi bi-shield-check"></i></div>
            <div>
                <h6>Only Approved Midwives Appear Here</h6>
                <p>This list shows midwives who have been approved by the admin and have active login access.</p>
            </div>
            <a href="admin-approvals.html" class="info-banner-link">
                <i class="bi bi-hourglass-split"></i> Review Pending Requests
            </a>
        </div>

        <!-- ══ STAT CARDS ══ -->
        <div class="stats-grid">
            <div class="stat-card green">
                <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
                <div class="stat-body"><div class="s-label">Approved Midwives</div><div class="s-value" id="countApproved">3</div></div>
            </div>
            <div class="stat-card blue">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stat-body"><div class="s-label">Mothers Under Their Care</div><div class="s-value" id="countMothers">18</div></div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon"><i class="bi bi-calendar2-week-fill"></i></div>
                <div class="stat-body"><div class="s-label">Active This Month</div><div class="s-value" id="countActive">3</div></div>
            </div>
        </div>

        <!-- ══ TABLE BOX ══ -->
        <div class="box">
            <div class="box-header">
                <div class="box-header-left">
                    <div class="box-icon"><i class="bi bi-person-badge-fill"></i></div>
                    <div>
                        <h5>Approved Midwives</h5>
                        <p>Midwives with active login access to the system</p>
                    </div>
                </div>
                <div class="search-wrap">
                    <i class="bi bi-search s-icon"></i>
                    <input type="text" id="searchInput" placeholder="Search by name or NIC…">
                </div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Midwife</th>
                            <th>NIC</th>
                            <th>Phone</th>
                            <th>Qualification</th>
                            <th>Approved On</th>
                            <th>Login Access</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">

<?php $__empty_1 = true; $__currentLoopData = $midwives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $midwife): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr>
    <td><?php echo e($midwife->registration_no ?? '-'); ?></td>

    <td>
        <strong><?php echo e($midwife->full_name); ?></strong><br>
        <small><?php echo e($midwife->email); ?></small>
    </td>

    <td><?php echo e($midwife->nic); ?></td>

    <td><?php echo e($midwife->phone); ?></td>

    <td>-</td>

    <td>
        <?php echo e(optional($midwife->updated_at)->format('d M Y')); ?>

    </td>

    <td>
        <span class="badge bg-success">Active</span>
    </td>

    <td>
        <button class="btn btn-primary btn-sm">
            View
        </button>
    </td>
</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>
    <td colspan="8" class="text-center">
        No approved midwives found.
    </td>
</tr>

<?php endif; ?>

</tbody>
                </table>

                <!-- Empty state — shown via JS if search yields nothing -->
                <div class="empty-state" id="emptyState" style="display:none;">
                    <i class="bi bi-person-x"></i>
                    <h6>No matching midwives found</h6>
                    <p>Try a different search term.</p>
                </div>
            </div>

           <div class="table-footer">
    <span>
        Showing
        <strong id="visibleCount"><?php echo e($midwives->count()); ?></strong>
        of
        <strong id="totalCount"><?php echo e($midwives->count()); ?></strong>
        approved midwives
    </span>

    <span style="color:#16a34a;font-weight:600;font-size:12px;">
        <i class="bi bi-shield-check me-1"></i>
        All shown midwives have active login access
    </span>
</div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\maternal-care-system\resources\views/admin/midwives.blade.php ENDPATH**/ ?>