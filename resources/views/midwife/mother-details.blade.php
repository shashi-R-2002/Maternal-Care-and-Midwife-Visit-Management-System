@extends('layouts.midwife')

@section('title', 'Mother Details')

@section('content')

@include('partials.midwife-sidebar')

<div class="main">

    <div class="topbar">
        <div>
            <h2>Mother Details</h2>
            <p>View complete information of the registered mother</p>
        </div>

        <a href="{{ route('mothers.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="content">

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="row">

<div class="col-md-3 text-center">

<div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
style="width:120px;height:120px;font-size:42px;">

{{ strtoupper(substr($mother->full_name,0,1)) }}

</div>

<h4 class="mt-3">{{ $mother->full_name }}</h4>

<p class="text-muted">
{{ $mother->registration_no }}
</p>

</div>

<div class="col-md-9">

<div class="row">
    <div class="col-md-6 mb-3">
    <label class="fw-bold">NIC Number</label>
    <p>{{ $mother->nic }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Phone Number</label>
    <p>{{ $mother->phone }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Date of Birth</label>
    <p>{{ $mother->dob }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Age</label>
    <p>{{ $mother->age }} Years</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Blood Group</label>
    <p>{{ $mother->blood_group }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Address</label>
    <p>{{ $mother->address }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Last Menstrual Period (LMP)</label>
    <p>{{ $mother->lmp }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Expected Delivery Date (EDD)</label>
    <p>{{ $mother->edd }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Gravida</label>
    <p>{{ $mother->gravida }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Para</label>
    <p>{{ $mother->para }}</p>
</div>

<div class="col-md-6 mb-3">
    <label class="fw-bold">Status</label>
    <span class="badge bg-success">{{ $mother->status }}</span>
</div>

</div> {{-- row --}}
</div> {{-- col-md-9 --}}
</div> {{-- row --}}
</div> {{-- card-body --}}
</div> {{-- card --}}

</div> {{-- content --}}
</div> {{-- main --}}

@endsection