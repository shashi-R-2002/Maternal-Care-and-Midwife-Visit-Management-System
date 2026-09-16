@extends('layouts.midwife')

@section('title','Mother List')

@section('content')

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


<!-- ══ MAIN ══ -->
<div class="main">

    <!-- Topbar -->
    <div class="topbar">
        <div class="topbar-left">
            <h5>Mother List</h5>
            <p>Manage and view all registered pregnant mothers</p>
        </div>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3"></i>
                <span id="todayDate"></span>
            </span>
        </div>
    </div>

    <div class="content">

        <!-- Stat Cards -->
        <div class="stat-cards">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-people-fill"></i></div>
                <div>
    <div class="stat-val" id="totalCount">{{ $totalMothers }}</div>
    <div class="stat-lbl">Total Mothers</div>
</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="bi bi-heart-pulse-fill"></i></div>
                <div>
                    <div class="stat-val">{{ $pregnantCount }}</div>
                     <div class="stat-lbl">Pregnant</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-balloon-heart-fill"></i></div>
                <div>
                    <div class="stat-val">{{ $deliveredCount }}</div>
                    <div class="stat-lbl">Delivered</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple"><i class="bi bi-alarm-fill"></i></div>
                <div>
                    <div class="stat-val" id="soonCount">1</div>
                    <div class="stat-lbl">Due This Month</div>
                </div>
            </div>
        </div>

        <!-- Table Box -->
        <div class="table-box">

            <div class="table-header">
                <div class="table-header-left">
    <h6>All Mothers</h6>
             <p>
                 Showing
               <span id="showCount">{{ $totalMothers }}</span>
                registered mothers
             </p>
            </div>
                <div class="table-header-right">
                    <div class="search-wrap">
                        <i class="bi bi-search"></i>
                        <input type="text" class="search-input" id="searchInput"
                               placeholder="Search by name or Reg No…"
                               oninput="filterTable()">
                    </div>
                    <select class="filter-select" id="statusFilter" onchange="filterTable()">
                        <option value="">All Status</option>
                        <option value="Pregnant">Pregnant</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <a href="{{ route('mothers.create') }}" class="btn-add">
                        <i class="bi bi-person-plus-fill"></i> Add Mother
                    </a>
                </div>
            </div>
<div class="table-wrap">

    <table id="motherTable">

        <thead>
            <tr>
                <th>Reg No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Status</th>
                <th>EDD</th>
                <th>Last Visit</th>
                <th>Actions</th>
            </tr>
        </thead>
           <tbody id="tableBody">

@forelse($mothers as $mother)

<tr
    data-name="{{ $mother->full_name }}"
    data-reg="{{ $mother->registration_no }}"
    data-status="{{ $mother->status }}"
>

    <td>
        <span class="reg-badge">
            {{ $mother->registration_no }}
        </span>
    </td>

    <td>
        <div class="name-cell">

            <div class="name-avatar">
                {{ strtoupper(substr($mother->full_name,0,1)) }}
            </div>

            <div>
                <div class="name-text">
                    {{ $mother->full_name }}
                </div>

                <div class="name-sub">
                    G{{ $mother->gravida }}
                    P{{ $mother->para }}
                </div>
            </div>

        </div>
    </td>

    <td>
        <i class="bi bi-telephone-fill"
           style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>

        {{ $mother->phone }}
    </td>

    <td>

        @if($mother->status=='Pregnant')

            <span class="status-badge pregnant">
                <span class="dot"></span>
                Pregnant
            </span>

        @else

            <span class="status-badge delivered">
                <span class="dot"></span>
                Delivered
            </span>

        @endif

    </td>

    <td>
        {{ $mother->edd }}
    </td>

    <td>
        -
    </td>

    <td>

        <div class="action-btns">

            <a href="{{ route('mothers.show', $mother->id) }}" class="btn-view">
    <i class="bi bi-eye-fill"></i> View
</a>

            <a href="#" class="btn-edit">
                <i class="bi bi-pencil-fill"></i>
                Edit
            </a>

            <a href="#" class="btn-health">
                <i class="bi bi-file-earmark-medical-fill"></i>
                Health
            </a>

        </div>

    </td>

</tr>

@empty

<tr>

    <td colspan="7" class="text-center py-4">
        No mothers found.
    </td>

</tr>

@endforelse

</tbody>
  </table>
</div>
                <!-- Empty state (hidden by default) -->
                <div class="empty-state" id="emptyState" style="display:none;">
                    <i class="bi bi-people"></i>
                    <p>No mothers found matching your search.</p>
                </div>
            </div>

            <div class="table-footer">
                <span id="footerCount">
                Showing {{ $totalMothers }} of {{ $totalMothers }} mothers
                       </span>
                <div class="page-btns">
                    <button class="pg-btn active">1</button>
                </div>
            </div>

        </div>

    </div><!-- /content -->
</div><!-- /main -->
@endsection