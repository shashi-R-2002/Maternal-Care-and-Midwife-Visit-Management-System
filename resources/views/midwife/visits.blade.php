@extends('layouts.midwife')

@section('title','Visit Management')

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
        <a href="{{ route('mothers.index') }}">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
        </a>
        <a href="{{ route('midwife.visits') }}"class="active">
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
            <h5>Visit Management</h5>
            <p>Record and track antenatal visit details for each mother</p>
        </div>

        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3"></i>
                <span id="todayDate"></span>
            </span>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
        @endif

        <!-- Mother Context Banner -->
        <div class="box mb-4">

    <div class="box-header">
        <div class="box-icon blue">
            <i class="bi bi-person-check-fill"></i>
        </div>

        <div>
            <h5>Select Mother</h5>
            <p>Select a mother to record visits</p>
        </div>
    </div>

    <div class="box-body">

        <form method="GET" action="{{ route('midwife.visits') }}">

    <select name="mother"
            class="field-input"
            onchange="this.form.submit()">

        @foreach($mothers as $mother)

            <option value="{{ $mother->id }}"
                {{ optional($selectedMother)->id == $mother->id ? 'selected' : '' }}>

                {{ $mother->registration_no }} - {{ $mother->full_name }}

            </option>

        @endforeach

    </select>

</form>

@if(!$selectedMother)

<div class="alert alert-warning">

    No mothers available.

</div>

@else

        <div class="mother-banner">

            <div class="banner-left">

                <div class="banner-avatar">
                    {{ $selectedMother ? strtoupper(substr($selectedMother->full_name,0,2)) : '--' }}
                </div>

                <div>

                    <p class="banner-name">
                        {{ $selectedMother->full_name }}
                    </p>

                    <div class="banner-meta">

                        <span>
                            <i class="bi bi-hash"></i>
                            {{ $selectedMother->registration_no }}
                        </span>

                        <span>
                            <i class="bi bi-telephone-fill"></i>
                            {{ $selectedMother->phone }}
                        </span>

                        <span>
                            <i class="bi bi-droplet-fill"></i>
                            {{$selectedMother->blood_group }}
                        </span>

                        <span>
                            <i class="bi bi-clipboard2-pulse-fill"></i>
                            G{{ $selectedMother->gravida }}
                            P{{ $selectedMother->para }}
                        </span>

                    </div>

                </div>

            </div>

            <div class="banner-pills">

                @if($selectedMother->status == 'Pregnant')

                    <span class="banner-pill pregnant">
                        🤱 Pregnant
                    </span>

                @else

                    <span class="banner-pill delivered">
                        👶 Delivered
                    </span>

                @endif

                <span class="banner-pill edd">
                    <i class="bi bi-calendar-event-fill"></i>
                    EDD : {{ \Carbon\Carbon::parse($selectedMother->edd)->format('d M Y') }}
                </span>

            </div>

        </div>
        <!-- ══ ADD NEW VISIT ══ -->
        <div class="box">
            <div class="box-header">
                <div class="box-icon blue"><i class="bi bi-calendar2-plus-fill"></i></div>
                <div>
                    <h5>Add New Visit</h5>
                    <p>Record measurements and notes from today's antenatal visit</p>
                </div>
            </div>

            <div class="box-body">

    <form action="{{ route('visits.store') }}" method="POST">

        @csrf

        <input type="hidden"
       name="mother_id"
       value="{{ $selectedMother->id }}">

        <div class="row g-3">

            <!-- Visit Date -->
            <div class="col-md-4">
                <div class="field-label">
                    <i class="bi bi-calendar3"></i>
                    Visit Date
                </div>

                <input
                    type="date"
                    name="visit_date"
                    class="field-input"
                    value="{{ old('visit_date', date('Y-m-d')) }}"
                    required>
            </div>

            <!-- Weight -->
            <div class="col-md-4">
                <div class="field-label">
                    <i class="bi bi-speedometer2"></i>
                    Weight (kg)
                </div>

                <input
                    type="number"
                    step="0.1"
                    name="weight"
                    class="field-input"
                    placeholder="e.g. 62.5"
                    value="{{ old('weight') }}"
                    required>
            </div>

            <!-- Blood Pressure -->
            <div class="col-md-4">
                <div class="field-label">
                    <i class="bi bi-heart-pulse-fill"></i>
                    Blood Pressure
                </div>

                <input
                    type="text"
                    name="blood_pressure"
                    class="field-input"
                    placeholder="e.g. 120/80"
                    value="{{ old('blood_pressure') }}"
                    required>
            </div>

            <!-- Visit Type -->
            <div class="col-md-4">
                <div class="field-label">
                    <i class="bi bi-clipboard2-pulse"></i>
                    Visit Type
                </div>

                <select
                    name="visit_type"
                    class="field-input"
                    required>

                    <option value="">Select Visit Type</option>

<option value="Clinic Visit"
    {{ old('visit_type')=='Clinic Visit' ? 'selected' : '' }}>
    Clinic Visit
</option>

<option value="Home Visit"
    {{ old('visit_type')=='Home Visit' ? 'selected' : '' }}>
    Home Visit
</option>

                </select>
            </div>

            <!-- Gestational Age -->
            <div class="col-md-4">
                <div class="field-label">
                    <i class="bi bi-thermometer-half"></i>
                    Gestational Age
                </div>

                <input
                    type="text"
                    class="field-input"
                    placeholder="Available in next update"
                    disabled>
            </div>

            <!-- Haemoglobin -->
            <div class="col-md-4">
                <div class="field-label">
                    <i class="bi bi-droplet-half"></i>
                    Haemoglobin
                </div>

                <input
                    type="text"
                    class="field-input"
                    placeholder="Available in next update"
                    disabled>
            </div>

            <!-- Next Visit -->
            <div class="col-md-6">
                <div class="field-label">
                    <i class="bi bi-calendar-plus"></i>
                    Next Visit Date
                </div>

                <input
                    type="date"
                    name="next_visit_date"
                    class="field-input"
                    value="{{ old('next_visit_date') }}">
            </div>

            <!-- Notes -->
            <div class="col-12">
                <div class="field-label">
                    <i class="bi bi-journal-text"></i>
                    Notes / Advice
                </div>

                <textarea
                    name="notes"
                    class="field-input"
                    rows="4"
                    placeholder="Record clinical observations, advice given, medications prescribed...">{{ old('notes') }}</textarea>
            </div>

            <!-- Buttons -->
<div class="col-12 text-end">

    <button type="reset" class="btn-cancel">
        <i class="bi bi-arrow-clockwise"></i>
        Reset
    </button>

    <button type="submit" class="btn-save">
        <i class="bi bi-check-circle-fill"></i>
        Save Visit
    </button>

</div>

</div>

</form>

</div>

</div>

      <!-- ══ VISIT HISTORY ══ -->
<div class="box">

    <div class="box-header">
        <div class="box-icon green">
            <i class="bi bi-clock-history"></i>
        </div>

        <div>
            <h5>Visit History</h5>
            <p>All recorded antenatal visits for this mother</p>
        </div>
    </div>

    <div class="table-wrap">

        <table>

            <thead>
                <tr>
                    <th>#</th>
                    <th>Visit Date</th>
                    <th>Weight</th>
                    <th>Blood Pressure</th>
                    <th>Gest. Age</th>
                    <th>Haemoglobin</th>
                    <th>Notes</th>
                    <th>Next Visit</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            @forelse($visits as $visit)

                <tr>

                    <td>
                        <span class="visit-no">
                            V{{ str_pad($visit->id,3,'0',STR_PAD_LEFT) }}
                        </span>
                    </td>

                    <td>
                        <i class="bi bi-calendar3"
                           style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>

                        {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
                    </td>

                    <td>
                        <i class="bi bi-speedometer2"
                           style="color:#94a3b8;font-size:11px;margin-right:4px;"></i>

                        {{ $visit->weight }} kg
                    </td>

                    <td>
                        <span class="bp-cell bp-normal">
                            {{ $visit->blood_pressure }}
                        </span>
                    </td>

                    <td>-</td>

                    <td>-</td>

                    <td class="notes-cell">
                        {{ $visit->notes ?? '-' }}
                    </td>

                    <td>

                        @if($visit->next_visit_date)

                            <span class="next-date">
                                <i class="bi bi-calendar-check-fill"></i>

                                {{ \Carbon\Carbon::parse($visit->next_visit_date)->format('d M Y') }}
                            </span>

                        @else

                            -

                        @endif

                    </td>

                    <td>

                        <div class="action-btns">

                            <a href="{{ route('visits.edit', $visit->id) }}" class="btn-tbl edit">
    <i class="bi bi-pencil-fill"></i>
    Edit
</a>

                            <form action="{{ route('visits.destroy', $visit->id) }}"
      method="POST"
      style="display:inline;">

    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn-tbl del"
        onclick="return confirm('Are you sure you want to delete this visit?')">

        <i class="bi bi-trash-fill"></i>

    </button>

</form>
                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center py-4">

                        <i class="bi bi-calendar-x"
                           style="font-size:30px;color:#cbd5e1;"></i>

                        <br><br>

                        No visits recorded yet.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="table-footer">

        <span>

            {{ $visits->count() }}
            visit(s) recorded for
            <strong>{{ $selectedMother->full_name }}</strong>

        </span>

        @if($visits->count() > 0)

            <span style="color:#16a34a;font-weight:600;font-size:12px;">

                <i class="bi bi-calendar-check-fill"></i>

                Next Visit :

                {{ optional($visits->first())->next_visit_date
                    ? \Carbon\Carbon::parse($visits->first()->next_visit_date)->format('d M Y')
                    : '-' }}

            </span>

        @endif

    </div>

</div>

</div><!-- /content -->
</div><!-- /main -->

<!-- SUCCESS MESSAGE -->
@endif
@if(session('success'))

<div class="toast-wrap" id="successToast">

    <div class="toast-card">

        <div class="toast-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>

        <div>

            <div class="toast-title">
                Success!
            </div>

            <div class="toast-sub">
                {{ session('success') }}
            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const toast = document.getElementById("successToast");

    if (toast) {

        toast.style.display = "block";

        setTimeout(() => {
            toast.style.opacity = "0";

            setTimeout(() => {
                toast.style.display = "none";
            }, 500);

        }, 3000);

    }

});
</script>

@endif