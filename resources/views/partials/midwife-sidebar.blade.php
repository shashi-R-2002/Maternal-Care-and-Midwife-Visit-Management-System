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
        <a href="{{ route('midwife.dashboard') }}">
            <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>Dashboard
        </a>
       <a href="{{ route('mothers.create') }}">
    <span class="nav-icon"><i class="bi bi-person-plus-fill"></i></span>Add Mother
</a>

<a href="{{ route('mothers.index') }}" class="active">
    <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
</a>
        <a href="{{ route('midwife.visits') }}">
            <span class="nav-icon"><i class="bi bi-calendar2-check-fill"></i></span>Visits
        </a>
        <a href="{{ route('midwife.medicines') }}">
            <span class="nav-icon"><i class="bi bi-capsule"></i></span>Medicines
        </a>
         <a href="{{ route('midwife.health-record') }}">
          <span class="nav-icon"><i class="bi bi-heart-pulse me-2"></i></span>
            Health Records
        </a>
        <a href="{{ route('midwife.reports') }}">
            <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>Reports
            
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="logout-btn">
            <i class="bi bi-box-arrow-left"></i>Sign Out
        </a>
    </div>
</div>


