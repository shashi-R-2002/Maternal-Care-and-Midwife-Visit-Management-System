

<?php $__env->startSection('title','Health-report'); ?>

<?php $__env->startSection('content'); ?>
<div class="sidebar">
  <div class="sidebar-brand">
    <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#sbG)" opacity="0.9"/>
      <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
      <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <defs><linearGradient id="sbG" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#1e40af"/><stop offset="100%" stop-color="#0891b2"/></linearGradient></defs>
    </svg>
    <div class="brand-text"><div class="b-name">MaternalCare</div><div class="b-sub">Health System</div></div>
  </div>
  <div class="sidebar-role">
    <div class="role-avatar"><i class="bi bi-person-fill"></i></div>
    <div class="role-info"><div class="r-name">Midwife Portal</div><div class="r-role">Logged in as Midwife</div></div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Main Menu</div>
        <a href="<?php echo e(route('midwife.dashboard')); ?>">
            <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>Dashboard
        </a>
        <a href="<?php echo e(route('mothers.create')); ?>">
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
         <a href="<?php echo e(route('midwife.health-record')); ?>" >
          <span class="nav-icon"><i class="bi bi-heart-pulse me-2"></i></span>
            Health Records
        </a>
        <a href="<?php echo e(route('midwife.reports')); ?>"class="active">
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
      <h5>Generate Health Report</h5>
      <p>Create a simple health summary for a mother to take home</p>
    </div>
  </div>

  <div class="content">

    <!-- ══ SETUP ══ -->
    <div class="box" id="setupBox">
      <div class="box-header">
        <div class="box-icon"><i class="bi bi-file-earmark-plus-fill"></i></div>
        <div><h5>Report Setup</h5><p>Choose the mother and the time period to summarise</p></div>
      </div>
      <div class="box-body">
        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <div class="field-label"><i class="bi bi-person-fill"></i> Select Mother</div>
            <select class="field-input" id="motherSelect">
              <option value="0">Nimali Silva — MOM001</option>
              <option value="1">Sanduni Perera — MOM014</option>
              <option value="2">Ruwani Jayasuriya — MOM031</option>
            </select>
          </div>
          <div class="col-md-6">
            <div class="field-label"><i class="bi bi-translate"></i> Report Language</div>
            <select class="field-input" id="langSelect">
              <option value="en">English</option>
              <option value="si">Sinhala (translate manually for now)</option>
              <option value="ta">Tamil (translate manually for now)</option>
            </select>
          </div>
        </div>

        <div class="field-label"><i class="bi bi-calendar-range"></i> Report Period</div>
        <div class="period-group mb-4" id="periodGroup">
          <div class="period-option checked" data-period="weekly" onclick="selectPeriod(this)"><i class="bi bi-calendar-week"></i>This Week</div>
          <div class="period-option" data-period="monthly" onclick="selectPeriod(this)"><i class="bi bi-calendar-month"></i>This Month</div>
          <div class="period-option" data-period="all" onclick="selectPeriod(this)"><i class="bi bi-calendar-check"></i>Since First Visit</div>
        </div>

        <button class="btn-generate" onclick="generateReport()"><i class="bi bi-magic"></i> Generate Report</button>
      </div>
    </div>

    <!-- ══ REPORT ══ -->
    <div id="reportWrap">
      <div class="report-card" id="reportCard">

        <div class="report-banner">
          <div class="rb-top">
            <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="#67e8f9" opacity="0.9"/>
              <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
            </svg>
            <div>
              <div class="rb-title">MaternalCare Health Report</div>
              <div class="rb-sub">A SIMPLE SUMMARY OF YOUR RECENT CHECK-UPS</div>
            </div>
          </div>
          <div class="rb-mother">
            <div>
              <div class="rb-mother-name" id="repMotherName">—</div>
              <div class="rb-mother-meta" id="repMotherMeta">—</div>
            </div>
            <div class="rb-period" id="repPeriod">—</div>
          </div>
        </div>

        <div class="report-body">

          <div class="greeting" id="repGreeting"></div>

          <div class="section-title"><i class="bi bi-clipboard2-pulse-fill"></i> Your Health at a Glance</div>
          <div class="check-grid" id="checkGrid"></div>

          <div class="section-title"><i class="bi bi-graph-up-arrow"></i> Your Progress Over Time</div>
          <div class="chart-grid" id="chartGrid">
            <div class="chart-card">
              <div class="chart-card-title"><i class="bi bi-speedometer2"></i> Your Weight</div>
              <canvas id="weightMiniChart" height="160"></canvas>
              <div class="chart-card-hint">Steady, gradual gain is healthy during pregnancy.</div>
            </div>
            <div class="chart-card">
              <div class="chart-card-title"><i class="bi bi-heart-pulse-fill"></i> Your Blood Pressure</div>
              <canvas id="bpMiniChart" height="160"></canvas>
              <div class="chart-card-hint">Shaded band shows the normal range.</div>
            </div>
          </div>

          <div class="section-title"><i class="bi bi-calendar2-check-fill"></i> Your Visits This Period</div>
          <div class="visit-list" id="visitList"></div>

          <div class="advice-box">
            <div class="ab-title"><i class="bi bi-chat-heart-fill"></i> A Note From Your Midwife</div>
            <textarea id="midwifeAdvice" placeholder="Write a short, simple note for the mother here — e.g. eat more iron-rich foods, rest well, drink enough water…"></textarea>
          </div>

          <div class="next-visit">
            <div class="nv-icon"><i class="bi bi-calendar-plus-fill"></i></div>
            <div>
              <div class="nv-title" id="nvTitle">Your Next Visit</div>
              <div class="nv-sub" id="nvSub">—</div>
            </div>
          </div>

        </div>

        <div class="report-footer">
          Prepared by <strong id="repMidwifeName">Priya Fernando (Midwife)</strong> · MaternalCare System · Generated on <span id="repGenDate"></span>
        </div>
      </div>

      <div class="action-bar">
        <button class="btn-print" onclick="window.print()"><i class="bi bi-printer-fill"></i> Print</button>
        <button class="btn-pdf" id="pdfBtn" onclick="downloadPDF()"><i class="bi bi-file-earmark-pdf-fill"></i> Download PDF for Mother</button>
      </div>
    </div>

  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.midwife', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\maternal-care-system\resources\views/midwife/health-report.blade.php ENDPATH**/ ?>