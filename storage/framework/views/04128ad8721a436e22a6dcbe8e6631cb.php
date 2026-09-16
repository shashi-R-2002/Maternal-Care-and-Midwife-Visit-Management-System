

<?php $__env->startSection('title','Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>

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
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="active">
    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>Dashboard
</a>

<a href="<?php echo e(route('admin.mothers')); ?>">
    <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
</a>

<a href="<?php echo e(route('admin.midwives')); ?>">
    <span class="nav-icon"><i class="bi bi-person-badge-fill"></i></span>Midwife List
</a>

<a href="<?php echo e(route('admin.reports')); ?>">
    <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>Reports
</a>

    </nav>

    <div class="sidebar-footer">
        <a href="<?php echo e(route('home')); ?>" class="logout-btn"><i class="bi bi-box-arrow-left"></i>Sign Out</a>
    </div>
</div>

<div class="main">

    <div class="topbar">
        <div class="topbar-left">
            <h5>Midwife Approvals</h5>
            <p>Review and manage midwife registration requests</p>
        </div>
        <span class="topbar-date"><i class="bi bi-calendar3"></i><span id="todayDate"></span></span>
    </div>

    <div class="content">

        <div class="flow-banner">
            <div class="flow-banner-icon"><i class="bi bi-info-circle-fill"></i></div>
            <div style="flex:1">
                <h6>How Midwife Access Works</h6>
                <p style="font-size:12.5px;color:#3730a3;margin:0;">Midwives register on the home page and wait here for admin approval before they can log in. Once approved, they appear in the <a href="midwife-list.html" style="color:#2563eb;font-weight:600;">Midwife List</a>.</p>
                <div class="flow-steps">
                    <span class="flow-step"><span class="fs-num">1</span> Midwife registers</span>
                    <span class="flow-arrow"><i class="bi bi-arrow-right"></i></span>
                    <span class="flow-step"><span class="fs-num">2</span> Status = Pending</span>
                    <span class="flow-arrow"><i class="bi bi-arrow-right"></i></span>
                    <span class="flow-step"><span class="fs-num">3</span> Admin approves here</span>
                    <span class="flow-arrow"><i class="bi bi-arrow-right"></i></span>
                    <span class="flow-step"><span class="fs-num">4</span> Midwife can log in</span>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card amber">
                <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
                <div class="stat-body"><div class="s-label">Pending Requests</div><div class="s-value" id="countPending"><?php echo e($pendingCount); ?></div></div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
                <div class="stat-body"><div class="s-label">Approved</div><div class="s-value" id="countApproved"><?php echo e($approvedCount); ?></div></div>
            </div>
            <div class="stat-card red">
                <div class="stat-icon"><i class="bi bi-person-x-fill"></i></div>
                <div class="stat-body"><div class="s-label">Rejected</div><div class="s-value" id="countRejected"><?php echo e($rejectedCount); ?></div></div>
            </div>
            <div class="stat-card blue">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stat-body"><div class="s-label">Total Requests</div><div class="s-value" id="countTotal"><?php echo e($totalCount); ?></div></div>
            </div>
        </div>

        <div class="box">
            <div class="box-header">
                <div class="box-header-left">
                    <div class="box-icon"><i class="bi bi-person-lines-fill"></i></div>
                    <div>
                        <h5>Midwife Registration Requests</h5>
                        <p>Pending midwives cannot log in until you approve them</p>
                    </div>
                </div>
                <div class="search-wrap">
                    <i class="bi bi-search s-icon"></i>
                    <input type="text" id="searchInput" placeholder="Search by name or NIC…">
                </div>
            </div>

            <div class="filter-pills">
                <div class="filter-pill active" data-filter="all">All <span class="pill-count" id="pill-all"><?php echo e($totalCount); ?></span></div>
                <div class="filter-pill" data-filter="pending">Pending <span class="pill-count" id="pill-pending"><?php echo e($pendingCount); ?></span></div>
                <div class="filter-pill gpill" data-filter="approved">Approved <span class="pill-count" id="pill-approved"><?php echo e($approvedCount); ?></span></div>
                <div class="filter-pill rpill" data-filter="rejected">Rejected <span class="pill-count" id="pill-rejected"><?php echo e($rejectedCount); ?></span></div>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th><th>Midwife</th><th>NIC</th><th>Phone</th>
                            <th>Registered</th><th>Login Access</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                   <tbody id="tableBody">

<?php $__empty_1 = true; $__currentLoopData = $midwives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $midwife): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

<tr data-status="<?php echo e(strtolower($midwife->status)); ?>">

    <td style="color:#94a3b8;font-size:12px;font-weight:600;">
        <?php echo e($midwife->registration_no ?? '-'); ?>

    </td>

    <td>
        <div class="midwife-cell">

            <div class="m-avatar">
                <?php echo e(strtoupper(substr($midwife->full_name,0,1))); ?>

            </div>

            <div>
                <div class="m-name"><?php echo e($midwife->full_name); ?></div>
                <div class="m-email"><?php echo e($midwife->email); ?></div>
            </div>

        </div>
    </td>

    <td>
        <span class="nic-chip">
            <?php echo e($midwife->nic); ?>

        </span>
    </td>

    <td>
        <span class="phone-cell">
            <i class="bi bi-telephone-fill"></i>
            <?php echo e($midwife->phone); ?>

        </span>
    </td>

    <td>
        <span class="date-cell">
            <i class="bi bi-calendar3"></i>
            <?php echo e($midwife->created_at->format('d M Y')); ?>

        </span>
    </td>

    <td>

        <?php if($midwife->status=='Approved'): ?>

            <span style="display:inline-flex;align-items:center;gap:5px;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;padding:3px 9px;font-size:11px;font-weight:600;color:#166534;">
                <i class="bi bi-unlock-fill"></i>
                Access granted
            </span>

        <?php elseif($midwife->status=='Rejected'): ?>

            <span style="display:inline-flex;align-items:center;gap:5px;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:3px 9px;font-size:11px;font-weight:600;color:#991b1b;">
                <i class="bi bi-lock-fill"></i>
                Access denied
            </span>

        <?php else: ?>

            <span class="waiting-pill">
                <i class="bi bi-clock-fill"></i>
                Waiting for approval
            </span>

        <?php endif; ?>

    </td>

    <td>

        <?php if($midwife->status=='Approved'): ?>

            <span class="status-badge approved">
                <span class="dot"></span>Approved
            </span>

        <?php elseif($midwife->status=='Rejected'): ?>

            <span class="status-badge rejected">
                <span class="dot"></span>Rejected
            </span>

        <?php else: ?>

            <span class="status-badge pending">
                <span class="dot"></span>Pending
            </span>

        <?php endif; ?>

    </td>

    <td>

        <div class="action-group">

            <?php if($midwife->status=='Pending'): ?>

                <form action="<?php echo e(route('admin.midwives.approve',$midwife)); ?>"
                      method="POST"
                      style="display:inline;">
                    <?php echo csrf_field(); ?>

                    <button class="btn-action approve">
                        <i class="bi bi-check-lg"></i>
                        Approve
                    </button>

                </form>

                <form action="<?php echo e(route('admin.midwives.reject',$midwife)); ?>"
                      method="POST"
                      style="display:inline;">
                    <?php echo csrf_field(); ?>

                    <button class="btn-action reject">
                        <i class="bi bi-x-lg"></i>
                        Reject
                    </button>

                </form>

            <?php elseif($midwife->status=='Approved'): ?>

                <form action="<?php echo e(route('admin.midwives.reject',$midwife)); ?>"
                      method="POST"
                      style="display:inline;">
                    <?php echo csrf_field(); ?>

                    <button class="btn-action reject">
                        <i class="bi bi-x-lg"></i>
                        Revoke
                    </button>

                </form>

            <?php else: ?>

                <form action="<?php echo e(route('admin.midwives.approve',$midwife)); ?>"
                      method="POST"
                      style="display:inline;">
                    <?php echo csrf_field(); ?>

                    <button class="btn-action approve">
                        <i class="bi bi-check-lg"></i>
                        Re-approve
                    </button>

                </form>

            <?php endif; ?>

        </div>

    </td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>

    <td colspan="8" class="text-center py-4">
        No Midwife Requests Found
    </td>

</tr>

<?php endif; ?>

</tbody>
                </table>
            </div>

            <div class="table-footer">
                <span>Showing Showing
<strong id="visibleCount"><?php echo e($midwives->count()); ?></strong>
of
<strong id="totalCount"><?php echo e($totalCount); ?></strong>
requests</span>
                <span style="color:#f59e0b;font-weight:600;font-size:12px;"><i class="bi bi-clock-history me-1"></i>Last updated: Today</span>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:520px;">
        <div class="modal-content view-modal">
            <div class="view-modal-banner">
                <div class="view-avatar-lg" id="vm-avatar"></div>
                <div><div class="vm-name" id="vm-name"></div><div class="vm-email" id="vm-email"></div></div>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal" style="opacity:0.7;"></button>
            </div>
            <div class="view-modal-body">
                <div class="vm-section-title"><i class="bi bi-person-fill" style="color:#2563eb;"></i>Personal Details</div>
                <div class="vm-grid">
                    <div class="vm-field"><div class="vf-label"><i class="bi bi-hash"></i>Midwife ID</div><div class="vf-value" id="vm-id"></div></div>
                    <div class="vm-field"><div class="vf-label"><i class="bi bi-credit-card-fill"></i>NIC Number</div><div class="vf-value" id="vm-nic" style="font-family:monospace;"></div></div>
                    <div class="vm-field"><div class="vf-label"><i class="bi bi-telephone-fill"></i>Phone</div><div class="vf-value" id="vm-phone"></div></div>
                    <div class="vm-field"><div class="vf-label"><i class="bi bi-calendar3"></i>Registered On</div><div class="vf-value" id="vm-regdate"></div></div>
                    <div class="vm-field" style="grid-column:span 2;"><div class="vf-label"><i class="bi bi-geo-alt-fill"></i>Address</div><div class="vf-value" id="vm-address"></div></div>
                    <div class="vm-field" style="grid-column:span 2;"><div class="vf-label"><i class="bi bi-award-fill"></i>Qualification</div><div class="vf-value" id="vm-qualification"></div></div>
                </div>
                <div class="vm-section-title"><i class="bi bi-shield-fill" style="color:#2563eb;"></i>Login Access Status</div>
                <div class="access-block" id="vm-access-block">
                    <div class="access-icon" id="vm-access-icon"></div>
                    <div><div class="ab-title" id="vm-access-title"></div><div class="ab-sub" id="vm-access-sub"></div></div>
                </div>
                <div class="cred-block" id="vm-cred-block" style="display:none;">
                    <div class="cb-title"><i class="bi bi-key-fill"></i>Login Credentials (set by backend)</div>
                    <div class="cred-row">
                        <div class="cred-item"><div class="ci-label">Username</div><div class="ci-value" id="vm-cred-user"></div></div>
                        <div class="cred-item"><div class="ci-label">Password</div><div class="ci-value">••••••••</div></div>
                    </div>
                </div>
                <div class="reject-reason-box" id="vm-reject-box" style="display:none;">
                    <div class="rr-label"><i class="bi bi-exclamation-triangle-fill"></i>Reason for Rejection</div>
                    <p id="vm-reject-reason" style="font-size:13px;color:#475569;margin:0;"></p>
                </div>
            </div>
            <div class="modal-footer" id="vm-footer" style="padding:16px 28px;border-top:1px solid #f1f5f9;gap:10px;">
                <button class="btn-modal cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:440px;">
        <div class="modal-content confirm-modal">
            <div class="modal-header" id="c-header">
                <h5 class="modal-title"><span class="modal-icon-wrap" id="c-icon-wrap"><i id="c-icon" class="bi"></i></span><span id="c-heading"></span></h5>
            </div>
            <div class="modal-body">
                <p id="c-body"></p>
                <div class="confirm-reason-wrap" id="c-reason-wrap" style="display:none;">
                    <label><i class="bi bi-pencil-fill" style="color:#dc2626;margin-right:5px;"></i>Reason for rejection <span style="color:#94a3b8;font-weight:400;">(optional — shown to midwife)</span></label>
                    <textarea id="c-reason" placeholder="e.g. Qualification documents were incomplete or not verified…"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-modal cancel" data-bs-dismiss="modal">Cancel</button>
                <button class="btn-modal" id="c-btn" onclick="executeAction()"></button>
            </div>
        </div>
    </div>
</div>

<div class="toast-wrap" id="toastWrap">
    <div class="toast-card">
        <div class="toast-icon" id="toastIcon"></div>
        <div><div class="toast-title" id="toastTitle"></div><div class="toast-sub" id="toastSub"></div></div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\maternal-care-system\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>