

<?php $__env->startSection('title','Add Mother'); ?>

<?php $__env->startSection('content'); ?>

<!-- Original HTML body content -->
<!-- ══ SIDEBAR ══ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#sbGAM)" opacity="0.9"/>
            <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
            <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <defs>
                <linearGradient id="sbGAM" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse">
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

    <div class="sidebar-role">
        <div class="role-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="role-info">
            <div class="r-name">Midwife Portal</div>
            <div class="r-role">Logged in as Midwife</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main Menu</div>
        <a href="<?php echo e(route('midwife.dashboard')); ?>">
            <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>Dashboard
        </a>
        <a href="<?php echo e(route('mothers.create')); ?>" class="active">
            <span class="nav-icon"><i class="bi bi-person-plus-fill"></i></span>Add Mother
        </a>
        <a href="<?php echo e(route('mothers.index')); ?>">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
        </a>
        <a href="<?php echo e(route('midwife.visits')); ?>">
            <span class="nav-icon"><i class="bi bi-calendar2-check-fill"></i></span>Visits
        </a>
        <a href="<?php echo e(route('midwife.medicines')); ?>">
            <span class="nav-icon"><i class="bi bi-capsule"></i></span>Medicines
        </a>
         <a href="<?php echo e(route('midwife.health-record')); ?>">
          <span class="nav-icon"><i class="bi bi-heart-pulse me-2"></i></span>
            Health Records
        </a>
        <a href="<?php echo e(route('midwife.reports')); ?>">
            <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>Reports
            
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="<?php echo e(route('home')); ?>" class="logout-btn">
            <i class="bi bi-box-arrow-left"></i>Sign Out
        </a>
    </div>
</div>


<!-- ══ MAIN ══ -->
<div class="main">

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-left">
            <h5>Add Pregnant Mother</h5>
            <p>Fill in all details to register a new mother into the system</p>
        </div>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3"></i>
                <span id="todayDate"></span>
            </span>
        </div>
    </div>

    <div class="content">
    <div class="form-card">
    <form id="addMotherForm" action="<?php echo e(route('mothers.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

       <!-- ══ SECTION 1 — LOGIN DETAILS ══ -->
<div class="form-section">
    <div class="section-heading">
        <div class="section-icon login"><i class="bi bi-shield-lock-fill"></i></div>
        <div>
            <h5>Login Credentials</h5>
            <p>Auto-generated — share with the mother after saving</p>
        </div>
    </div>

    <div class="cred-grid">

        <div class="cred-box">
            <div class="cb-label">
                <i class="bi bi-hash"></i> Registration Number
            </div>

            <div class="cb-value" id="regNoDisplay">
                MOM0001
            </div>

            <input type="hidden"
                   name="registration_no"
                   id="registrationNo"
                   value="MOM0001">

            <div class="cb-note">
                <i class="bi bi-info-circle-fill"></i>
                Auto-assigned by system
            </div>
        </div>

        <div class="cred-box nic-box">
            <div class="cb-label">
                <i class="bi bi-person-badge-fill"></i> Username
            </div>

            <div class="cb-value" id="nicPreview">
                Enter NIC below ↓
            </div>

            <div class="cb-note">
                <i class="bi bi-info-circle-fill"></i>
                NIC used as login username
            </div>
        </div>

        <div class="cred-box">
            <div class="cb-label">
                <i class="bi bi-lock-fill"></i> Initial Password
            </div>

            <div class="cb-value" id="passDisplay">
                MOM0001
            </div>

            <div class="cb-note">
                <i class="bi bi-info-circle-fill"></i>
                Same as registration number
            </div>
        </div>

    </div>
</div>

<!-- ══ SECTION 2 — PERSONAL INFORMATION ══ -->

<div class="form-section">

    <div class="section-heading">
        <div class="section-icon personal">
            <i class="bi bi-person-vcard-fill"></i>
        </div>

        <div>
            <h5>Personal Information</h5>
            <p>Mother's identity, contact and background details</p>
        </div>
    </div>

    <div class="row g-3">

        <!-- Full Name -->
        <div class="col-md-6">
            <div class="field-wrap">
                <div class="field-label">
                    <i class="bi bi-person-fill"></i>
                    Full Name
                    <span class="req">*</span>
                </div>

                <input
                    type="text"
                    class="field-input"
                    id="fullName"
                    name="full_name"
                    value="<?php echo e(old('full_name')); ?>"
                    placeholder="e.g. Nimalie Silva"
                    required>
            </div>
        </div>

        <!-- NIC -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-credit-card-fill"></i>
                    NIC Number
                    <span class="req">*</span>
                </div>

                <input
                    type="text"
                    class="field-input"
                    id="nicInput"
                    name="nic"
                    value="<?php echo e(old('nic')); ?>"
                    placeholder="e.g. 982345678V or 199823456789"
                    oninput="onNicInput(this.value)"
                    required>

                <div class="field-note">
                    <i class="bi bi-info-circle-fill"></i>
                    Used as the mother's login username
                </div>

            </div>
        </div>

        <!-- Date of Birth -->
        <div class="col-md-4">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-calendar3"></i>
                    Date of Birth
                </div>

                <input
                    type="date"
                    class="field-input"
                    id="dobInput"
                    name="dob"
                    value="<?php echo e(old('dob')); ?>"
                    oninput="calcAge()">

            </div>
        </div>

        <!-- Age -->
        <div class="col-md-2">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-123"></i>
                    Age
                </div>

                <input
                    type="text"
                    class="field-input"
                    id="ageDisplay"
                    name="age"
                    value="<?php echo e(old('age')); ?>"
                    placeholder="—"
                    readonly>

                <div class="field-note">
                    <i class="bi bi-info-circle-fill"></i>
                    Auto-calculated
                </div>

            </div>
        </div>

        <!-- Phone -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-telephone-fill"></i>
                    Phone Number
                </div>

                <input
                    type="tel"
                    class="field-input"
                    name="phone"
                    value="<?php echo e(old('phone')); ?>"
                    placeholder="e.g. 071 234 5678">

            </div>
        </div>

        <!-- Address -->
        <div class="col-12">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-geo-alt-fill"></i>
                    Address
                </div>

                <textarea
                    class="field-input"
                    name="address"
                    rows="2"
                    placeholder="e.g. No. 12, Galle Road, Colombo 03"><?php echo e(old('address')); ?></textarea>

            </div>
        </div>

        <!-- Occupation -->
        <div class="col-md-6">
            <div class="field-wrap" style="margin-bottom:0;">
                <div class="field-label">
                    <i class="bi bi-briefcase-fill"></i>
                    Occupation
                </div>

                <input
                    type="text"
                    class="field-input"
                    placeholder="e.g. Teacher, Housewife">
            </div>
        </div>

        <!-- Education -->
        <div class="col-md-6">
            <div class="field-wrap" style="margin-bottom:0;">
                <div class="field-label">
                    <i class="bi bi-mortarboard-fill"></i>
                    Education Level
                </div>

                <select class="field-input">
                    <option value="" disabled selected>Select education level</option>
                    <option>No Formal Education</option>
                    <option>Primary (Grade 1–5)</option>
                    <option>Junior Secondary (Grade 6–9)</option>
                    <option>O/L Completed</option>
                    <option>A/L Completed</option>
                    <option>Diploma / Certificate</option>
                    <option>Bachelor's Degree</option>
                    <option>Postgraduate</option>
                </select>

            </div>
        </div>

    </div>
</div>

        <!-- ══ SECTION 3 — EMERGENCY CONTACT ══ -->
<div class="form-section">
    <div class="section-heading">
        <div class="section-icon emergency"><i class="bi bi-person-hearts"></i></div>
        <div>
            <h5>Husband / Emergency Contact</h5>
            <p>Guardian details for urgent situations</p>
        </div>
    </div>

    <div class="notice-box orange">
        <i class="bi bi-exclamation-circle-fill"></i>
        This contact will be reached in case of any medical emergency or urgent clinic update.
    </div>

    <div class="row g-3">

        <div class="col-md-6">
            <div class="field-wrap" style="margin-bottom:0;">
                <div class="field-label">
                    <i class="bi bi-person-fill"></i>
                    Husband / Guardian Name
                </div>

                <input type="text"
                       class="field-input"
                       placeholder="e.g. Kamal Silva">
            </div>
        </div>

        <div class="col-md-6">
            <div class="field-wrap" style="margin-bottom:0;">
                <div class="field-label">
                    <i class="bi bi-telephone-fill"></i>
                    Husband / Guardian Phone
                </div>

                <input type="tel"
                       class="field-input"
                       placeholder="e.g. 077 123 4567">
            </div>
        </div>

    </div>
</div>

<!-- ══ SECTION 4 — PREGNANCY INFORMATION ══ -->
<div class="form-section">

    <div class="section-heading">
        <div class="section-icon preg">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>

        <div>
            <h5>Pregnancy Information</h5>
            <p>Gestational details, delivery timeline and obstetric history</p>
        </div>
    </div>

    <div class="row g-3">

        <!-- LMP -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-calendar-minus"></i>
                    Last Menstrual Period (LMP)
                </div>

                <input
                    type="date"
                    class="field-input"
                    id="lmpInput"
                    name="lmp"
                    value="<?php echo e(old('lmp')); ?>"
                    oninput="calcEDD()">

                <div class="field-note">
                    <i class="bi bi-info-circle-fill"></i>
                    EDD is auto-calculated from LMP (+280 days)
                </div>

            </div>
        </div>

        <!-- EDD -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-calendar-plus"></i>
                    Expected Delivery Date (EDD)
                </div>

                <input
                    type="date"
                    class="field-input"
                    id="eddInput"
                    name="edd"
                    value="<?php echo e(old('edd')); ?>">

                <div class="field-note">
                    <i class="bi bi-info-circle-fill"></i>
                    Can be adjusted manually if needed
                </div>

            </div>
        </div>

        <!-- Gravida -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-hash"></i>
                    Gravida (G)
                </div>

                <input
                    type="number"
                    class="field-input"
                    name="gravida"
                    value="<?php echo e(old('gravida')); ?>"
                    placeholder="e.g. 2"
                    min="1">

            </div>
        </div>

        <!-- Para -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-hash"></i>
                    Para (P)
                </div>

                <input
                    type="number"
                    class="field-input"
                    name="para"
                    value="<?php echo e(old('para')); ?>"
                    placeholder="e.g. 1"
                    min="0">

            </div>
        </div>

        <!-- Pregnancy Status -->
        <div class="col-12">

            <div class="field-wrap" style="margin-bottom:0;">

                <div class="field-label">
                    <i class="bi bi-activity"></i>
                    Pregnancy Status
                </div>

                <div class="status-pills">

                    <label class="status-pill active">
                        <input type="radio"
                               name="status"
                               value="Pregnant"
                               checked>
                        <span class="sp-icon">🤱</span>
                        <span class="sp-label">Pregnant</span>
                    </label>

                    <label class="status-pill">
                        <input type="radio"
                               name="status"
                               value="Delivered">
                        <span class="sp-icon">👶</span>
                        <span class="sp-label">Delivered</span>
                    </label>

                </div>

            </div>

        </div>

    </div>
</div>

<!-- ══ SECTION 5 — MEDICAL INFORMATION ══ -->
<div class="form-section" style="border-bottom:none;">

    <div class="section-heading">
        <div class="section-icon medical">
            <i class="bi bi-file-earmark-medical-fill"></i>
        </div>

        <div>
            <h5>Medical Information</h5>
            <p>Blood type, allergies and relevant medical history</p>
        </div>
    </div>

    <div class="row g-3">

        <!-- Blood Group -->
        <div class="col-md-6">
            <div class="field-wrap">

                <div class="field-label">
                    <i class="bi bi-droplet-fill"></i>
                    Blood Group
                </div>

                <select
                    class="field-input"
                    name="blood_group">

                    <option value="">Select Blood Group</option>

                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>

                </select>

            </div>
        </div>

        
       

        <!-- Allergies -->
        <div class="col-md-6">
            <div class="field-wrap">
                <div class="field-label">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Allergies
                </div>

                <input type="text"
                       class="field-input"
                       placeholder="e.g. Penicillin">
            </div>
        </div>

        <!-- Medical History -->
        <div class="col-md-6">
            <div class="field-wrap" style="margin-bottom:0;">
                <div class="field-label">
                    <i class="bi bi-journal-medical"></i>
                    Medical History
                </div>

                <textarea class="field-input"
                          rows="4"></textarea>
            </div>
        </div>

        <!-- Family History -->
        <div class="col-md-6">
            <div class="field-wrap" style="margin-bottom:0;">
                <div class="field-label">
                    <i class="bi bi-people-fill"></i>
                    Family History
                </div>

                <textarea class="field-input"
                          rows="4"></textarea>
            </div>
        </div>

    </div>

</div>

       <!-- ══ FORM FOOTER ══ -->
<div class="form-footer">

    <div class="footer-hint">
        <i class="bi bi-shield-check-fill"></i>
        Credentials will be confirmed after saving — give them to the mother
    </div>

    <div class="footer-actions">

        <a href="<?php echo e(route('mothers.index')); ?>" class="btn-cancel">
            <i class="bi bi-x-lg"></i>
            Cancel
        </a>

        <button type="submit" class="btn-save">
            <i class="bi bi-person-check-fill"></i>
            Register Mother
        </button>

    </div>

</div>

</form>

</div>
</div>
<!-- /content -->

</div>
<!-- /main -->


<?php if(session('success')): ?>
<div class="toast-wrap" id="successToast">

    <div class="toast-card">

        <div class="toast-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <div>
            <div class="toast-title">
                Mother Registered Successfully!
            </div>

            <div class="toast-sub">
                <?php echo e(session('success')); ?>

            </div>
        </div>

    </div>

</div>

<script>
setTimeout(function () {
    document.getElementById('successToast').style.display = 'none';
}, 4000);
</script>

<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.midwife', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\maternal-care-system\resources\views/midwife/add-mother.blade.php ENDPATH**/ ?>