@extends('layouts.midwife')

@section('title','Medicines')

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
        <a href="{{route('mothers.index') }}">
            <span class="nav-icon"><i class="bi bi-people-fill"></i></span>Mother List
        </a>
        <a href="{{ route('midwife.visits') }}">
            <span class="nav-icon"><i class="bi bi-calendar2-check-fill"></i></span>Visits
        </a>
        <a href="{{ route('midwife.medicines') }}"class="active">
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
            <h5>Medicine &amp; Nutrition</h5>
            <p>Record medicines, vitamins and nutrition support given to mothers</p>
        </div>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3"></i>
                <span id="todayDate"></span>
            </span>
        </div>
    </div>

    <div class="content">

       <!-- Success Message -->
@if(session('success'))
<div class="alert alert-success mb-4">
    {{ session('success') }}
</div>
@endif

<!-- Select Mother -->
<div class="box mb-4">

    <div class="box-header">

        <div class="box-icon purple">
            <i class="bi bi-person-check-fill"></i>
        </div>

        <div>
            <h5>Select Mother</h5>
            <p>Select a mother to manage medicines</p>
        </div>

    </div>

    <div class="box-body">

        <form method="GET" action="{{ route('midwife.medicines') }}">

            <select
                name="mother"
                class="field-input"
                onchange="this.form.submit()">

                @foreach($mothers as $mother)

                    <option
                        value="{{ $mother->id }}"
                        {{ optional($selectedMother)->id == $mother->id ? 'selected' : '' }}>

                        {{ $mother->registration_no }}
                        -
                        {{ $mother->full_name }}

                    </option>

                @endforeach

            </select>

        </form>

    </div>

</div>

@if(!$selectedMother)

<div class="alert alert-warning">

    No mothers available.

</div>

@else

<div class="mother-banner">

    <div class="banner-left">

        <div class="banner-avatar">

            {{ strtoupper(substr($selectedMother->full_name,0,2)) }}

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

                    {{ $selectedMother->blood_group }}

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

            EDD :
            {{ \Carbon\Carbon::parse($selectedMother->edd)->format('d M Y') }}

        </span>

    </div>

</div>

       <!-- ══ ADD MEDICINE ══ -->
<div class="box">

    <div class="box-header">

        <div class="box-icon purple">
            <i class="bi bi-capsule-pill"></i>
        </div>

        <div>
            <h5>Add Medicine</h5>
            <p>Record medicines given during the mother's visit</p>
        </div>

    </div>

    <div class="box-body">

        <form action="{{ route('medicines.store') }}" method="POST">

            @csrf

            <input
                type="hidden"
                name="mother_id"
                value="{{ $selectedMother->id }}">

                <table class="table table-bordered" id="medicineTable">
    <thead>
        <tr>
            <th style="width:25%">Medicine</th>
            <th style="width:25%">Dosage</th>
            <th style="width:15%">Quantity</th>
            <th style="width:25%">Remarks</th>
            <th style="width:10%">Action</th>
        </tr>
    </thead>

    <tbody>

        <tr>

            <td>
                <select name="medicine_name[]" class="field-input" required>
                    <option value="">Select Medicine</option>
                    <option value="Iron Tablets">Iron Tablets</option>
                    <option value="Folic Acid">Folic Acid</option>
                    <option value="Calcium">Calcium</option>
                    <option value="Vitamin C">Vitamin C</option>
                    <option value="Multivitamin">Multivitamin</option>
                </select>
            </td>

            <td>
                <input
                    type="text"
                    name="dosage[]"
                    class="field-input"
                    placeholder="1 tablet daily"
                    required>
            </td>

            <td>
                <input
                    type="number"
                    name="quantity[]"
                    class="field-input"
                    min="1"
                    required>
            </td>

            <td>
                <input
                    type="text"
                    name="remarks[]"
                    class="field-input"
                    placeholder="Remarks">
            </td>

            <td class="text-center">
                <button type="button"
                        class="btn btn-danger removeRow">
                    <i class="bi bi-trash"></i>
                </button>
            </td>

        </tr>

    </tbody>
</table>

<div class="mt-3">

    <button type="button"
            id="addRow"
            class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>

        Add Medicine

    </button>

    <button type="submit"
            class="btn-save float-end">

        <i class="bi bi-check-circle-fill"></i>

        Save All Medicines

    </button>

</div>

<script>
document.getElementById('addRow').addEventListener('click', function () {

    let tbody = document.querySelector('#medicineTable tbody');

    let row = tbody.rows[0].cloneNode(true);

    row.querySelectorAll('input').forEach(function(input){
        input.value = '';
    });

    row.querySelector('select').selectedIndex = 0;

    tbody.appendChild(row);

});

document.addEventListener('click', function(e){

    if(e.target.closest('.removeRow')){

        let tbody = document.querySelector('#medicineTable tbody');

        if(tbody.rows.length > 1){

            e.target.closest('tr').remove();

        }

    }

});
</script>
         </form>
</div>
</div> <!-- box -->

            
       
        <!-- ══ MEDICINE HISTORY ══ -->
<div class="box">

    <div class="box-header">

        <div class="box-icon teal">
            <i class="bi bi-clock-history"></i>
        </div>

        <div>
            <h5>Medicine History</h5>
            <p>All medicines recorded for the selected mother</p>
        </div>

    </div>

    <div class="table-wrap">

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Medicine</th>
                    <th>Dosage</th>
                    <th>Quantity</th>
                    <th>Remarks</th>
                    <th>Actions</th>
                </tr>

            </thead>

            <tbody>

            @forelse($medicines as $medicine)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $medicine->medicine_name }}</td>

                    <td>{{ $medicine->dosage }}</td>

                    <td>{{ $medicine->quantity }}</td>

                    <td>{{ $medicine->remarks }}</td>

                    <td>

                        <div class="action-btns">

                            <form action="{{ route('medicines.destroy',$medicine->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this medicine record?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn-tbl del">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No medicine records found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="table-footer">

        <span>

            Total Medicines :

            <strong>{{ $medicines->count() }}</strong>

        </span>

    </div>

</div>

@endif

@endsection