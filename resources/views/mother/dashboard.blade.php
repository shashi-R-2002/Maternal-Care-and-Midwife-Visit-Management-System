@extends('layouts.mother')

@section('title', 'Mother Dashboard')

@section('content')
<!-- ══ SIDEBAR ══ -->
<div class="sidebar">
    <div class="sidebar-brand">
        <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#sbG)" opacity="0.9"/>
            <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
            <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            <defs>
                <linearGradient id="sbG" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse">
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

    <div class="sidebar-profile">
        <div class="profile-avatar"><i class="bi bi-person-fill"></i></div>
        <div class="profile-name">{{ $mother->full_name }}</div>
        <div class="profile-badge">🤱 Expecting Mother</div>
    </div>

    <nav class="sidebar-nav">
       <div class="nav-section-label">My Portal</div>

<a href="{{ route('mother.dashboard') }}" class="active">
    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>
    Dashboard
</a>

<a href="#section-visits" onclick="smoothTo('section-visits')">
    <span class="nav-icon"><i class="bi bi-calendar2-check-fill"></i></span>
    My Visits
</a>

<a href="#section-health" onclick="smoothTo('section-health')">
    <span class="nav-icon"><i class="bi bi-file-earmark-medical-fill"></i></span>
    Health Records
</a>

<a href="#section-meds" onclick="smoothTo('section-meds')">
    <span class="nav-icon"><i class="bi bi-capsule"></i></span>
    Medicines
</a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('home') }}" class="logout-btn">
            <i class="bi bi-box-arrow-left"></i>Sign Out
        </a>
    </div>
</div>


<!-- ══ MAIN ══ -->
<div class="main">

    <div class="topbar">
        <div class="topbar-left">
            <h5>Mother Dashboard</h5>
            <p>Welcome back, {{ $mother->full_name }} — your health overview</p>
        </div>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3 me-1"></i>
                <span id="todayDate"></span>
            </span>
            <button class="topbar-notif">
                <i class="bi bi-bell"></i>
                <span class="notif-dot"></span>
            </button>
        </div>
    </div>

    <div class="content">

        
        <!-- ── SUMMARY CARDS ── -->
<div class="summary-grid">

    <!-- Pregnancy Status -->
    <div class="stat-card pink">
        <div class="stat-icon">
            <i class="bi bi-heart-pulse-fill"></i>
        </div>

        <div class="stat-body">
            <div class="stat-label">Pregnancy Status</div>

            <div class="stat-value">
                {{ $mother->status }}
            </div>

            <div class="stat-hint">
                {{ $mother->status == 'Pregnant' ? 'Active pregnancy' : 'Delivery completed' }}
            </div>
        </div>
    </div>

    <!-- Next Clinic Visit -->
    <div class="stat-card blue">
        <div class="stat-icon">
            <i class="bi bi-calendar-event-fill"></i>
        </div>

        <div class="stat-body">
            <div class="stat-label">Next Clinic Visit</div>

            <div class="stat-value">
                @if($latestVisit && $latestVisit->next_visit_date)
                    {{ \Carbon\Carbon::parse($latestVisit->next_visit_date)->format('d M Y') }}
                @else
                    No Upcoming Visit
                @endif
            </div>

            <div class="stat-hint">
                @if($latestVisit && $latestVisit->next_visit_date)
                    Upcoming appointment
                @else
                    No scheduled visit
                @endif
            </div>
        </div>
    </div>

    
   <!-- Total Visits -->
<div class="stat-card green">
    <div class="stat-icon">
        <i class="bi bi-clipboard2-pulse-fill"></i>
    </div>

    <div class="stat-body">
        <div class="stat-label">Total Visits Done</div>

        <div class="stat-value">
            {{ $visits->count() }}
        </div>

        <div class="stat-hint">
            @if($visits->count() > 0)
                Completed clinic visits
            @else
                No visits recorded yet
            @endif
        </div>
    </div>
</div>
        
       <!-- ── PERSONAL INFO + VISIT HISTORY ── -->
<div class="dash-row" id="section-visits">

    <!-- Visit History -->
    <div class="panel">
        <div class="panel-header">
            <h5>
                <span class="ph-icon pink">
                    <i class="bi bi-clipboard2-heart"></i>
                </span>
                My Visit History
            </h5>

            <span style="font-size:12px;color:#94a3b8;font-weight:500;">
                {{ $visits->count() }} {{ Str::plural('visit', $visits->count()) }} recorded
            </span>
        </div>

        <div class="panel-body" style="padding:14px 18px;">
            <table class="visit-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Weight</th>
                        <th>Blood Pressure</th>
                        <th>Notes</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($visits as $visit)

                        <tr>

                            <td>
                                <span class="date-chip">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
                                </span>
                            </td>

                            <td>
                                <span class="weight-chip">
                                    {{ $visit->weight }} kg
                                </span>
                            </td>

                            <td>
                                <span class="bp-chip">
                                    {{ $visit->blood_pressure }}
                                </span>
                            </td>

                            <td>
                                <span class="note-chip">
                                    <i class="bi bi-check-circle-fill"></i>
                                    {{ $visit->notes ?: 'No Notes' }}
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" style="text-align:center;padding:25px;color:#64748b;">
                                <i class="bi bi-calendar-x" style="font-size:22px;"></i><br>
                                No visit history available.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

            <!-- Personal Info -->
<div class="panel">
    <div class="panel-header">
        <h5>
            <span class="ph-icon blue">
                <i class="bi bi-person-lines-fill"></i>
            </span>
            My Details
        </h5>
    </div>

    <div class="panel-body">
        <div class="info-grid">

            <!-- Full Name -->
            <div class="info-item">
                <div class="ii-label">
                    <i class="bi bi-person-fill"></i> Full Name
                </div>
                <div class="ii-value">
                    {{ $mother->full_name ?? 'N/A' }}
                </div>
            </div>

            <!-- Phone -->
            <div class="info-item">
                <div class="ii-label">
                    <i class="bi bi-telephone-fill"></i> Phone
                </div>
                <div class="ii-value">
                    {{ $mother->phone ?? 'N/A' }}
                </div>
            </div>

            <!-- Address -->
            <div class="info-item" style="grid-column: span 2;">
                <div class="ii-label">
                    <i class="bi bi-geo-alt-fill"></i> Address
                </div>
                <div class="ii-value">
                    {{ $mother->address ?? 'N/A' }}
                </div>
            </div>

            <!-- Blood Group -->
            <div class="info-item">
                <div class="ii-label">
                    <i class="bi bi-droplet-fill"></i> Blood Group
                </div>
                <div class="ii-value">
                    {{ $mother->blood_group ?? 'N/A' }}
                </div>
            </div>

            <!-- Gravida / Para -->
            <div class="info-item">
                <div class="ii-label">
                    <i class="bi bi-clipboard2-pulse-fill"></i> Gravida / Para
                </div>
                <div class="ii-value">
                    G{{ $mother->gravida ?? 0 }} / P{{ $mother->para ?? 0 }}
                </div>
            </div>

            <!-- Expected Delivery Date -->
            <div class="edd-highlight" style="grid-column: span 2;">
                <div class="edd-icon">
                    <i class="bi bi-stars"></i>
                </div>

                <div class="edd-text">
                    <div class="edd-label">
                        Expected Delivery Date
                    </div>

                    <div class="edd-date">
                        @if($mother->edd)
                            {{ \Carbon\Carbon::parse($mother->edd)->format('d M Y') }}
                        @else
                            Not Available
                        @endif
                    </div>
                </div>

                <div class="edd-countdown" id="eddCountdown">
                    @if($mother->edd)
                        {{ \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($mother->edd), false) }} days
                    @else
                        —
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

</div>

        <!-- ══════════════════════════════
             HEALTH RECORDS SECTION
        ══════════════════════════════ -->
        <div id="section-health" style="margin-bottom: 22px;">

            <div class="section-title-row">
                <h4>
                    <span class="st-icon"><i class="bi bi-file-earmark-medical-fill"></i></span>
                    My Health Records
                </h4>
                <span style="font-size:12.5px;color:#64748b;font-weight:500;background:#f1f5f9;padding:6px 14px;border-radius:20px;">
                    <i class="bi bi-clock-history me-1"></i>2 antenatal records
                </span>
            </div>

            <div class="hr-timeline">

                <!-- ── RECORD 1 — 2026-06-10 (most recent) ── -->
                <div class="hr-card">
                    <div class="hr-card-header">
                        <div class="hr-date-block">
                            <span class="hr-date-pill"><i class="bi bi-calendar3"></i> 10 Jun 2026</span>
                            <span class="hr-poa-pill">POA: 24 weeks</span>
                        </div>
                        <span style="font-size:11.5px;color:#64748b;font-weight:500;">
                            <i class="bi bi-calendar-plus me-1" style="color:#2563eb;"></i>Next clinic: 01 Jul 2026
                        </span>
                    </div>

                    <div class="hr-card-body">

                        <!-- Vitals -->
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-heart-pulse-fill"></i> Blood Pressure</div>
                            <div class="hm-value bp-normal">120/80</div>
                        </div>
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-speedometer2"></i> Weight</div>
                            <div class="hm-value">60 kg</div>
                        </div>
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-droplet-fill"></i> Haemoglobin</div>
                            <div class="hm-value">11.8 g/dL</div>
                        </div>
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-droplet-half"></i> Blood Sugar</div>
                            <div class="hm-value">95 mg/dL</div>
                        </div>

                        <!-- Divider row: Urine + Obstetric -->
                        <div class="hr-divider-row">
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-circle-fill" style="font-size:9px;color:#fbbf24;"></i> Urine Sugar</div>
                                <div class="hm-value" style="font-size:13px;">Negative</div>
                            </div>
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-circle-fill" style="font-size:9px;color:#818cf8;"></i> Urine Albumin</div>
                                <div class="hm-value" style="font-size:13px;">Negative</div>
                            </div>
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-rulers"></i> Fundal Height</div>
                                <div class="hm-value">24 cm</div>
                            </div>
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-heart-fill"></i> Foetal Heart</div>
                                <div class="hm-value">
                                    <span class="fhs-badge normal"><i class="bi bi-check-circle-fill"></i> Normal</span>
                                </div>
                            </div>
                            <div class="hr-metric" style="grid-column: span 2;">
                                <div class="hm-label"><i class="bi bi-arrow-down-circle-fill"></i> Presentation</div>
                                <div class="hm-value" style="font-size:13px;">Cephalic</div>
                            </div>
                            <div class="hr-metric" style="grid-column: span 2;">
                                <div class="hm-label"><i class="bi bi-activity"></i> Foetal Movement</div>
                                <div class="hm-value" style="font-size:13px;color:#16a34a;">Present</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ── RECORD 2 — 2026-05-10 ── -->
                <div class="hr-card">
                    <div class="hr-card-header">
                        <div class="hr-date-block">
                            <span class="hr-date-pill"><i class="bi bi-calendar3"></i> 10 May 2026</span>
                            <span class="hr-poa-pill">POA: 20 weeks</span>
                        </div>
                        <span style="font-size:11.5px;color:#64748b;font-weight:500;">
                            <i class="bi bi-calendar-plus me-1" style="color:#2563eb;"></i>Next clinic: 10 Jun 2026
                        </span>
                    </div>

                    <div class="hr-card-body">
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-heart-pulse-fill"></i> Blood Pressure</div>
                            <div class="hm-value bp-normal">110/70</div>
                        </div>
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-speedometer2"></i> Weight</div>
                            <div class="hm-value">58 kg</div>
                        </div>
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-droplet-fill"></i> Haemoglobin</div>
                            <div class="hm-value">11.5 g/dL</div>
                        </div>
                        <div class="hr-metric">
                            <div class="hm-label"><i class="bi bi-droplet-half"></i> Blood Sugar</div>
                            <div class="hm-value">90 mg/dL</div>
                        </div>

                        <div class="hr-divider-row">
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-circle-fill" style="font-size:9px;color:#fbbf24;"></i> Urine Sugar</div>
                                <div class="hm-value" style="font-size:13px;">Negative</div>
                            </div>
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-circle-fill" style="font-size:9px;color:#818cf8;"></i> Urine Albumin</div>
                                <div class="hm-value" style="font-size:13px;">Negative</div>
                            </div>
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-rulers"></i> Fundal Height</div>
                                <div class="hm-value">20 cm</div>
                            </div>
                            <div class="hr-metric">
                                <div class="hm-label"><i class="bi bi-heart-fill"></i> Foetal Heart</div>
                                <div class="hm-value">
                                    <span class="fhs-badge normal"><i class="bi bi-check-circle-fill"></i> Normal</span>
                                </div>
                            </div>
                            <div class="hr-metric" style="grid-column: span 2;">
                                <div class="hm-label"><i class="bi bi-arrow-down-circle-fill"></i> Presentation</div>
                                <div class="hm-value" style="font-size:13px;">Cephalic</div>
                            </div>
                            <div class="hr-metric" style="grid-column: span 2;">
                                <div class="hm-label"><i class="bi bi-activity"></i> Foetal Movement</div>
                                <div class="hm-value" style="font-size:13px;color:#16a34a;">Present</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        
        <!-- ── MEDICINES & NUTRITION ── -->
<div class="panel" id="section-meds" style="margin-bottom:0;">
    <div class="panel-header">
        <h5>
            <span class="ph-icon purple">
                <i class="bi bi-capsule"></i>
            </span>
            Medicines &amp; Nutrition
        </h5>

        <span style="font-size:12px;color:#94a3b8;font-weight:500;">
            {{ $medicines->count() }} {{ Str::plural('record', $medicines->count()) }}
        </span>
    </div>

    <div class="panel-body">
        <table class="med-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Date Given</th>
                </tr>
            </thead>

            <tbody>

                @forelse($medicines as $medicine)

                <tr>

                    <td>
                        <span class="type-chip {{ strtolower($medicine->type) }}">
                            {{ ucfirst($medicine->type) }}
                        </span>
                    </td>

                    <td>
                        {{ $medicine->medicine_name }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($medicine->date_given)->format('d M Y') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="3" class="text-center">
                        No medicine records found.
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
    </div>
</div>

    </div><!-- /content -->
</div><!-- /main -->

@endsection