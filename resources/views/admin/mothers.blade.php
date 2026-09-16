@extends('layouts.admin')

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
            <div class="r-name">Admin Panel</div>
            <div class="r-role">Logged in as Admin</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Main Menu</div>
        <a href="{{ route('admin.dashboard') }}" >
    <span class="nav-icon"><i class="bi bi-speedometer2"></i></span>Dashboard
</a>
       
        <a href="{{ route('mothers.index') }}"class="active">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
        </a>
        <a href="{{ route('admin.midwives') }}">
    <span class="nav-icon"><i class="bi bi-person-badge-fill"></i></span>Midwife List
</a>

<a href="{{ route('admin.reports') }}">
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
                    <div class="stat-val" id="totalCount">4</div>
                    <div class="stat-lbl">Total Mothers</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="bi bi-heart-pulse-fill"></i></div>
                <div>
                    <div class="stat-val" id="pregCount">3</div>
                    <div class="stat-lbl">Pregnant</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-balloon-heart-fill"></i></div>
                <div>
                    <div class="stat-val" id="delivCount">1</div>
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
                    <p>Showing <span id="showCount">4</span> registered mothers</p>
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

                        <tr data-name="Nimali Silva" data-reg="MOM001" data-status="Pregnant">
                            <td><span class="reg-badge">MOM001</span></td>
                            <td>
                                <div class="name-cell">
                                    <div class="name-avatar">NS</div>
                                    <div>
                                        <div class="name-text">Nimali Silva</div>
                                        <div class="name-sub">G2 P1</div>
                                    </div>
                                </div>
                            </td>
                            <td><i class="bi bi-telephone-fill" style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>071 234 5678</td>
                            <td>
                                <span class="status-badge pregnant">
                                    <span class="dot"></span>Pregnant
                                </span>
                            </td>
                            <td class="edd-cell soon" data-edd="2026-05-20">2026-05-20</td>
                            <td class="visit-cell"><i class="bi bi-clock" style="font-size:11px;margin-right:3px;"></i>2026-06-15</td>
                            <td>
                                <div class="action-btns">
                                    <a href="mother-dashboard.html" class="btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                    <a href="add-mother.html" class="btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <a href="health-record.html" class="btn-health"><i class="bi bi-file-earmark-medical-fill"></i> Health</a>
                                </div>
                            </td>
                        </tr>

                        <tr data-name="Kumari Perera" data-reg="MOM002" data-status="Delivered">
                            <td><span class="reg-badge">MOM002</span></td>
                            <td>
                                <div class="name-cell">
                                    <div class="name-avatar" style="background:linear-gradient(135deg,#dcfce7,#bbf7d0);color:#16a34a;">KP</div>
                                    <div>
                                        <div class="name-text">Kumari Perera</div>
                                        <div class="name-sub">G1 P1</div>
                                    </div>
                                </div>
                            </td>
                            <td><i class="bi bi-telephone-fill" style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>077 123 4567</td>
                            <td>
                                <span class="status-badge delivered">
                                    <span class="dot"></span>Delivered
                                </span>
                            </td>
                            <td class="edd-cell past" data-edd="2026-02-10">2026-02-10</td>
                            <td class="visit-cell"><i class="bi bi-clock" style="font-size:11px;margin-right:3px;"></i>2026-01-25</td>
                            <td>
                                <div class="action-btns">
                                    <a href="mother-dashboard.html" class="btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                    <a href="add-mother.html" class="btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <a href="health-record.html" class="btn-health"><i class="bi bi-file-earmark-medical-fill"></i> Health</a>
                                </div>
                            </td>
                        </tr>

                        <tr data-name="Sanduni Fernando" data-reg="MOM003" data-status="Pregnant">
                            <td><span class="reg-badge">MOM003</span></td>
                            <td>
                                <div class="name-cell">
                                    <div class="name-avatar" style="background:linear-gradient(135deg,#fae8ff,#e9d5ff);color:#9333ea;">SF</div>
                                    <div>
                                        <div class="name-text">Sanduni Fernando</div>
                                        <div class="name-sub">G3 P2</div>
                                    </div>
                                </div>
                            </td>
                            <td><i class="bi bi-telephone-fill" style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>076 987 6543</td>
                            <td>
                                <span class="status-badge pregnant">
                                    <span class="dot"></span>Pregnant
                                </span>
                            </td>
                            <td class="edd-cell ok" data-edd="2026-08-15">2026-08-15</td>
                            <td class="visit-cell"><i class="bi bi-clock" style="font-size:11px;margin-right:3px;"></i>2026-06-12</td>
                            <td>
                                <div class="action-btns">
                                    <a href="mother-dashboard.html" class="btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                    <a href="add-mother.html" class="btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <a href="health-record.html" class="btn-health"><i class="bi bi-file-earmark-medical-fill"></i> Health</a>
                                </div>
                            </td>
                        </tr>

                        <tr data-name="Tharushi Perera" data-reg="MOM004" data-status="Pregnant">
                            <td><span class="reg-badge">MOM004</span></td>
                            <td>
                                <div class="name-cell">
                                    <div class="name-avatar" style="background:linear-gradient(135deg,#fff7ed,#fed7aa);color:#ea580c;">TP</div>
                                    <div>
                                        <div class="name-text">Tharushi Perera</div>
                                        <div class="name-sub">G1 P0</div>
                                    </div>
                                </div>
                            </td>
                            <td><i class="bi bi-telephone-fill" style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>075 123 4567</td>
                            <td>
                                <span class="status-badge pregnant">
                                    <span class="dot"></span>Pregnant
                                </span>
                            </td>
                            <td class="edd-cell ok" data-edd="2026-10-01">2026-10-01</td>
                            <td class="visit-cell"><i class="bi bi-clock" style="font-size:11px;margin-right:3px;"></i>2026-06-05</td>
                            <td>
                                <div class="action-btns">
                                    <a href="mother-dashboard.html" class="btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                    <a href="add-mother.html" class="btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <a href="health-record.html" class="btn-health"><i class="bi bi-file-earmark-medical-fill"></i> Health</a>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <!-- Empty state (hidden by default) -->
                <div class="empty-state" id="emptyState" style="display:none;">
                    <i class="bi bi-people"></i>
                    <p>No mothers found matching your search.</p>
                </div>
            </div>

            <div class="table-footer">
                <span id="footerCount">Showing 4 of 4 mothers</span>
                <div class="page-btns">
                    <button class="pg-btn active">1</button>
                </div>
            </div>

        </div>

    </div><!-- /content -->
</div><!-- /main -->
@endsection