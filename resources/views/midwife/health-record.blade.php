@extends('layouts.midwife')

@section('title','Health-record')

@section('content')

<!-- ══ SIDEBAR ══ -->
<div class="sidebar">
  <div class="sidebar-brand">
    <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M22 3 L38 9 L38 22 C38 31 30 38.5 22 41 C14 38.5 6 31 6 22 L6 9 Z" fill="url(#sbG)" opacity="0.9"/>
      <path d="M22 30 C22 30 12 23 12 17 C12 13.5 14.5 11 17.5 11 C19.5 11 21 12 22 13.5 C23 12 24.5 11 26.5 11 C29.5 11 32 13.5 32 17 C32 23 22 30 22 30Z" fill="white" opacity="0.95"/>
      <path d="M15 18 L18 18 L19.5 15 L21 21 L22.5 16 L24 18 L29 18" stroke="#67e8f9" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
      <defs><linearGradient id="sbG" x1="6" y1="3" x2="38" y2="41" gradientUnits="userSpaceOnUse"><stop offset="0%" stop-color="#1e40af"/><stop offset="100%" stop-color="#0891b2"/></linearGradient></defs>
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
        <a href="{{ route('midwife.visits') }}">
            <span class="nav-icon"><i class="bi bi-calendar2-check-fill"></i></span>Visits
        </a>
        <a href="{{ route('midwife.medicines') }}">
            <span class="nav-icon"><i class="bi bi-capsule"></i></span>Medicines
        </a>
         <a href="{{ route('midwife.health-record') }}" class="active">
          <span class="nav-icon"><i class="bi bi-heart-pulse me-2"></i></span>
            Health Records
        </a>
        <a href="{{ route('midwife.reports') }}">
            <span class="nav-icon"><i class="bi bi-bar-chart-fill"></i></span>Reports
            
        </a>
  </nav>
  <div class="sidebar-footer">
    <a href="{{ route('home') }}" class="logout-btn"><i class="bi bi-box-arrow-left"></i>Sign Out</a>
  </div>
</div>

<!-- ══ MAIN ══ -->
<div class="main">
  <div class="topbar">
    <div class="topbar-left">
      <h5>Health Records</h5>
      <p>Complete antenatal, delivery &amp; postnatal records for each mother</p>
    </div>
    <div class="topbar-right">
      <span class="topbar-date"><i class="bi bi-calendar3"></i><span id="todayDate"></span></span>
    </div>
  </div>

  <div class="content">

    
    
      <!-- Mother Selection -->
<div class="box mb-4">

    <div class="box-header">
        <div class="box-header-left">
            <div class="box-icon blue">
                <i class="bi bi-person-vcard-fill"></i>
            </div>

            <div>
                <h5>Select Mother</h5>
                <p>Select a registered mother to manage health records</p>
            </div>

        </div>
    </div>

    <div class="box-body">

        <form method="GET" action="{{ route('midwife.health-record') }}">

            <div class="row">

                <div class="col-md-10">

                    <select
                        name="mother_id"
                        class="form-select"
                        onchange="this.form.submit()">

                        <option value="">
                            -- Select Mother --
                        </option>

                        @foreach($mothers as $mother)

                            <option
                                value="{{ $mother->id }}"
                                {{ request('mother_id') == $mother->id ? 'selected' : '' }}>

                                {{ $mother->registration_no }}
                                -
                                {{ $mother->full_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </form>

    </div>

</div>

@if($selectedMother)

<div class="box">

    <div class="box-header">
        <div class="box-header-left">
            <div class="box-icon blue">
                <i class="bi bi-person-fill"></i>
            </div>

            <div>
                <h5>Mother Information</h5>
                <p>Information loaded from database</p>
            </div>
        </div>
    </div>

    <div class="box-body">

        <div class="info-grid">

            <div class="info-box">
                <div class="ib-label">Registration No</div>
                <div class="ib-value">{{ $selectedMother->registration_no }}</div>
            </div>

            <div class="info-box">
                <div class="ib-label">Mother Name</div>
                <div class="ib-value">{{ $selectedMother->full_name }}</div>
            </div>

            <div class="info-box">
                <div class="ib-label">NIC</div>
                <div class="ib-value">{{ $selectedMother->nic }}</div>
            </div>

            <div class="info-box">
                <div class="ib-label">Phone</div>
                <div class="ib-value">{{ $selectedMother->phone }}</div>
            </div>

            <div class="info-box">
                <div class="ib-label">Address</div>
                <div class="ib-value">{{ $selectedMother->address }}</div>
            </div>

            <div class="info-box">
                <div class="ib-label">Status</div>
                <div class="ib-value">{{ $selectedMother->status }}</div>
            </div>

        </div>

    </div>

</div>

@endif
  

    <!-- ══ QUICK STATS ══ -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon" style="background:#eff6ff;color:#2563eb;"><i class="bi bi-clipboard2-pulse-fill"></i></div>
        <div><div class="stat-val">2</div><div class="stat-lbl">Clinic Visits</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-rulers"></i></div>
        <div><div class="stat-val">36 cm</div><div class="stat-lbl">Latest Fundal Ht.</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background:#fff7ed;color:#ea580c;"><i class="bi bi-droplet-fill"></i></div>
        <div><div class="stat-val">11.8</div><div class="stat-lbl">Haemoglobin (g/dL)</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background:#fef3c7;color:#d97706;"><i class="bi bi-droplet-half"></i></div>
        <div><div class="stat-val">124</div><div class="stat-lbl">Blood Sugar (mg/dL)</div></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon" style="background:#f5f3ff;color:#7c3aed;"><i class="bi bi-heart-pulse-fill"></i></div>
        <div><div class="stat-val">120/80</div><div class="stat-lbl">Latest BP</div></div>
      </div>
    </div>

    <!-- ══ TABS ══ -->
    <div class="tab-nav">
      <button class="tab-btn active" onclick="switchTab('antenatal',this)"><i class="bi bi-clipboard2-pulse-fill"></i> Antenatal</button>
      <button class="tab-btn" onclick="switchTab('supplements',this)"><i class="bi bi-capsule"></i> Supplements</button>
      <button class="tab-btn" onclick="switchTab('screening',this)"><i class="bi bi-shield-plus-fill"></i> Screening &amp; Immunisation</button>
      <button class="tab-btn" onclick="switchTab('weight',this)"><i class="bi bi-graph-up-arrow"></i> Weight Chart</button>
      <button class="tab-btn" onclick="switchTab('delivery',this)"><i class="bi bi-hospital-fill"></i> Delivery &amp; Postnatal</button>
    </div>

    <!-- TAB: ANTENATAL -->
    <div class="tab-panel active" id="tab-antenatal">

      <!-- ADD RECORD FORM -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon rose"><i class="bi bi-file-earmark-plus-fill"></i></div>
            <div><h5>Add New Antenatal Record</h5><p>Record clinical measurements from today's clinic visit</p></div>
          </div>
        </div>
        <div class="box-body">
          <form method="POST" action="{{ route('health-record.store') }}">
    @csrf

    <input type="hidden" name="mother_id" value="{{ $selectedMother->id ?? '' }}">

            <!-- Visit Details -->
            <div class="sub-label"><i class="bi bi-calendar2-check-fill"></i> Visit Details</div>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-calendar3"></i> Visit Date</div>
                <input type="date" class="field-input" id="visitDate">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-hourglass-split"></i> POA — Period of Amenorrhoea (wks)</div>
                <input type="number" class="field-input" placeholder="e.g. 28" min="1" max="45">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-calendar-plus"></i> Next Clinic Date</div>
                <input type="date" class="field-input">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-speedometer2"></i> Weight (kg)</div>
                <input type="number"
       name="weight"
       class="field-input"
       placeholder="e.g. 77.5"
       step="0.1"
       required>
              </div>
            </div>

            <!-- Vital Signs -->
            <div class="sub-label"><i class="bi bi-heart-pulse-fill"></i> Vital Signs</div>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-heart-pulse-fill"></i> Blood Pressure</div>
                <input type="text"
       name="blood_pressure"
       class="field-input"
       placeholder="120/80"
       required>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-droplet-fill"></i> Haemoglobin (g/dL)</div>
                <input type="text"
       name="hemoglobin"
       class="field-input"
       placeholder="11.8">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-droplet-half"></i> Blood Sugar (mg/dL)</div>
                <input type="text"
       name="blood_sugar"
       class="field-input"
       placeholder="124">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-thermometer-half"></i> Temperature (°C)</div>
                <input type="text" class="field-input" placeholder="e.g. 36.8">
              </div>
            </div>

            <!-- Urine Analysis -->
            <div class="sub-label"><i class="bi bi-eyedropper"></i> Urine Analysis</div>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-circle-fill" style="font-size:10px;color:#fbbf24;"></i> Urine Sugar</div>
                <select name="urine_sugar" class="field-input">
    <option value="" disabled selected>Select result</option>
    <option value="Negative">Negative</option>
    <option value="Trace">Trace</option>
    <option value="+1">+1</option>
    <option value="+2">+2</option>
    <option value="+3">+3</option>
</select>
              </div>
             <div class="col-md-3">

    <div class="field-label">
        <i class="bi bi-circle-fill" style="font-size:10px;color:#818cf8;"></i>
        Urine Albumin
    </div>

    <select name="urine_protein" class="field-input">
        <option value="" disabled selected>Select result</option>
        <option value="Negative">Negative</option>
        <option value="Trace">Trace</option>
        <option value="+1">+1</option>
        <option value="+2">+2</option>
        <option value="+3">+3</option>
    </select>

</div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-droplet"></i> Oedema — Ankle</div>
                <select class="field-input">
                  <option value="" disabled selected>Select</option>
                  <option>None</option><option>Trace</option>
                  <option>+1</option><option>+2</option><option>+3</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-droplet"></i> Oedema — Facial</div>
                <select class="field-input">
                  <option value="" disabled selected>Select</option>
                  <option>None</option><option>Present</option>
                </select>
              </div>
            </div>

            <!-- Obstetric Examination -->
            <div class="sub-label"><i class="bi bi-clipboard2-pulse-fill"></i> Obstetric Examination</div>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-rulers"></i> Fundal Height (cm)</div>
                <input type="text" class="field-input" placeholder="e.g. 27">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-arrow-down-circle-fill"></i> Foetal Lie</div>
                <select class="field-input">
                  <option value="" disabled selected>Select lie</option>
                  <option>Longitudinal</option><option>Transverse</option><option>Oblique</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-arrow-down-circle"></i> Presentation</div>
                <select class="field-input">
                  <option value="" disabled selected>Select presentation</option>
                  <option>Cephalic</option><option>Breech</option>
                  <option>Transverse</option><option>Not Determined</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-circle-half"></i> Engagement of Presenting Part</div>
                <select class="field-input">
                  <option value="" disabled selected>Select</option>
                  <option>Not Engaged</option><option>Engaged</option><option>Partially Engaged</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-heart-fill"></i> FHS — Foetal Heart Sounds</div>
                <select class="field-input">
                  <option value="" disabled selected>Select result</option>
                  <option>Normal</option><option>Abnormal</option><option>Not Heard</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-activity"></i> Foetal Movement (FM)</div>
                <select class="field-input">
                  <option value="" disabled selected>Select</option>
                  <option>Present (+)</option><option>Reduced</option><option>Absent</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-lungs-fill"></i> Respiratory System</div>
                <select class="field-input">
                  <option value="" disabled selected>Select</option>
                  <option>Normal (N)</option><option>Abnormal</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-gender-female"></i> Breast Examination</div>
                <select class="field-input">
                  <option value="" disabled selected>Select</option>
                  <option>Normal</option><option>Abnormal</option><option>Not Done</option>
                </select>
              </div>
            </div>

            <!-- Auscultation / Clinical Findings -->
            <div class="sub-label"><i class="bi bi-stethoscope"></i> Auscultation &amp; Clinical Findings</div>
            <div class="row g-3 mb-4">
              <div class="col-md-4">
                <div class="field-label"><i class="bi bi-1-circle-fill"></i> T1 — Auscultation Finding</div>
                <input type="text" class="field-input" placeholder="e.g. DDJm NA">
              </div>
              <div class="col-md-4">
                <div class="field-label"><i class="bi bi-2-circle-fill"></i> T2 — Auscultation Finding</div>
                <input type="text" class="field-input" placeholder="e.g. DR+ NAD">
              </div>
              <div class="col-md-4">
                <div class="field-label"><i class="bi bi-3-circle-fill"></i> T3 — Auscultation Finding</div>
                <input type="text" class="field-input" placeholder="e.g. DR+ NAD">
              </div>
            </div>

            <!-- Dental & Other Investigations -->
            <div class="sub-label"><i class="bi bi-journal-text"></i> Dental &amp; Investigations</div>
            <div class="row g-3 mb-4">
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-calendar3"></i> Dental Referral Date</div>
                <input type="date" class="field-input">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-pencil-fill"></i> Dental Treatment Notes</div>
                <input type="text" class="field-input" placeholder="e.g. Scaling done">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-calendar3"></i> Kick Count Chart Issued Date</div>
                <input type="date" class="field-input">
              </div>
              <div class="col-md-3">
                <div class="field-label"><i class="bi bi-search"></i> Other Investigations</div>
                <input type="text" class="field-input" placeholder="e.g. USS, ECG notes">
              </div>
            </div>

            <!-- Medical Notes -->
            <div class="sub-label"><i class="bi bi-journal-text"></i> Medical Notes</div>
            <div class="row g-3">
              <div class="col-12">
                <div class="field-label"><i class="bi bi-journal-medical"></i> Clinical Notes &amp; Advice</div>
                <textarea
    name="notes"
    class="field-input"
    rows="3"
    placeholder="Clinical Notes"></textarea>
              </div>
            </div>
            <div class="mt-4 text-end">
    <button type="submit" class="btn btn-primary">
        <i class="bi bi-save"></i> Save Health Record
    </button>
</div>


          </form>
        </div>
        <div class="form-footer">
          <div class="footer-hint"><i class="bi bi-shield-check-fill"></i> Record will be saved under MOM001 — Nimali Silva</div>
          <div style="display:flex;gap:10px;">
            <button class="btn-clear" onclick="document.getElementById('healthForm').reset();document.getElementById('visitDate').value=new Date().toISOString().split('T')[0];">
              <i class="bi bi-x-lg"></i> Clear
            </button>
           
          </div>
        </div>
      </div>

      <!-- PREVIOUS RECORDS TABLE -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon teal"><i class="bi bi-clock-history"></i></div>
            <div><h5>Previous Antenatal Records</h5><p>All recorded clinic visit entries for Nimali Silva</p></div>
          </div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Visit Date</th><th>POA</th><th>Weight</th><th>Blood Pressure</th>
                <th>Blood Sugar</th><th>Haemoglobin</th><th>Urine Sugar</th><th>Urine Albumin</th>
                <th>Oedema</th><th>Fundal Ht.</th><th>Lie</th><th>Presentation</th><th>FM</th><th>FHS</th><th>Actions</th>
              </tr>
            </thead>
            <tbody>
             
@forelse($healthRecords as $record)
<tr>
    <td>
        <i class="bi bi-calendar3" style="color:#94a3b8;font-size:11px;margin-right:3px;"></i>
        {{ optional($record->visit)->visit_date }}
    </td>

    <td>
        <span class="poa-badge">--</span>
    </td>

    <td>{{ $record->weight }} kg</td>

    <td>
        <span class="bp-cell bp-normal">
            {{ $record->blood_pressure }}
        </span>
    </td>

    <td>{{ $record->blood_sugar }}</td>

    <td>{{ $record->hemoglobin }}</td>

    <td>{{ $record->urine_sugar }}</td>

    <td>{{ $record->urine_protein }}</td>

    <td>--</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>

    <td>
        <div class="action-btns">

            <form action="{{ route('health-record.destroy', $record->id) }}"
                  method="POST"
                  onsubmit="return confirm('Delete this record?')">

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
    <td colspan="15" class="text-center">
        No Health Records Found
    </td>
</tr>
@endforelse
</tbody>            
          </table>
        </div>
        <div class="table-footer">
          <span>Record will be saved under
{{ $selectedMother->registration_no ?? '-' }}
—
{{ $selectedMother->full_name ?? 'No Mother Selected' }}</span>
          <span style="color:#16a34a;font-weight:600;font-size:12px;">
            <i class="bi bi-calendar-check-fill"></i> Latest: 2026-08-10 — 32 weeks
          </span>
        </div>
      </div>
    </div>

    <!-- ══════════════════════ TAB: SUPPLEMENTS ══════════════════════ -->
    <div class="tab-panel" id="tab-supplements">
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon violet"><i class="bi bi-capsule"></i></div>
            <div><h5>Supplements &amp; Medications</h5><p>Iron, Folate, Calcium, Vitamin C &amp; other prescriptions</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="sub-label"><i class="bi bi-plus-circle-fill"></i> Add Supplement Record (per Visit)</div>
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> Visit Date / POA (wks)</div>
              <input type="date" class="field-input">
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-capsule-pill"></i> Iron Given</div>
              <select class="field-input">
                <option value="" disabled selected>Select</option>
                <option>Yes</option><option>No</option>
              </select>
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-capsule-pill"></i> Folate Given</div>
              <select class="field-input">
                <option value="" disabled selected>Select</option>
                <option>Yes</option><option>No</option>
              </select>
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-capsule-pill"></i> Calcium Given</div>
              <select class="field-input">
                <option value="" disabled selected>Select</option>
                <option>Yes</option><option>No</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-capsule-pill"></i> Vitamin C Given</div>
              <select class="field-input">
                <option value="" disabled selected>Select</option>
                <option>Yes</option><option>No</option>
              </select>
            </div>
          </div>
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-capsule"></i> Food Supplementation</div>
              <input type="text" class="field-input" placeholder="e.g. TP2">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-shield-plus-fill"></i> Antihelminthic Drugs</div>
              <select class="field-input">
                <option value="" disabled selected>Select</option>
                <option>Given</option><option>Not Given</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="field-label"><i class="bi bi-journal-text"></i> Notes</div>
              <input type="text" class="field-input" placeholder="Any additional supplement notes">
            </div>
          </div>
          <div style="display:flex;justify-content:flex-end;gap:10px;">
            <button class="btn-save" onclick="showToast()"><i class="bi bi-check-circle-fill"></i> Save Supplement Record</button>
          </div>
        </div>
      </div>

      <!-- Supplement History -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon teal"><i class="bi bi-clock-history"></i></div>
            <div><h5>Supplement History</h5><p>Recorded supplement dispensing per visit</p></div>
          </div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr><th>Visit Date</th><th>POA</th><th>Iron</th><th>Folate</th><th>Calcium</th><th>Vit. C</th><th>Food Supp.</th><th>Antihelminthic</th></tr>
            </thead>
            <tbody>
              <tr><td>2026-05-10</td><td><span class="poa-badge">20 wks</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td>TP2</td><td><span class="pill-yes">Given</span></td></tr>
              <tr><td>2026-06-10</td><td><span class="poa-badge">24 wks</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td>TP2</td><td><span class="pill-nr">—</span></td></tr>
              <tr><td>2026-07-10</td><td><span class="poa-badge">28 wks</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td><span class="pill-yes">✓ Yes</span></td><td>—</td><td><span class="pill-nr">—</span></td></tr>
            </tbody>
          </table>
        </div>
        <div class="table-footer"><span>3 supplement records</span></div>
      </div>
    </div>

    <!-- ══════════════════════ TAB: SCREENING & IMMUNISATION ══════════════════════ -->
    <div class="tab-panel" id="tab-screening">

      <!-- Syphilis Screening -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon amber"><i class="bi bi-shield-plus-fill"></i></div>
            <div><h5>Syphilis Screening</h5><p>VDRL / RPR blood sampling record</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-hourglass-split"></i> POA at Blood Sampling (wks)</div>
              <input type="number" class="field-input" placeholder="e.g. 85 (days)" value="85">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> Date of Blood Sampling</div>
              <input type="date" class="field-input" value="2025-08-27">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar-check"></i> Date of Receiving Result</div>
              <input type="date" class="field-input" value="2025-09-03">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-clipboard2-check-fill"></i> Result</div>
              <select class="field-input">
                <option>NR (Non-Reactive)</option><option>R (Reactive)</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> If Reactive — Date of Referral</div>
              <input type="date" class="field-input">
            </div>
          </div>
        </div>
      </div>

      <!-- HIV Screening -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon sky"><i class="bi bi-droplet-half"></i></div>
            <div><h5>HIV Screening</h5><p>Blood sampling and result tracking</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> Date of Blood Sample for HIV</div>
              <input type="date" class="field-input" value="2025-08-27">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar-check"></i> Date of Informing Result to Mother</div>
              <input type="date" class="field-input">
            </div>
          </div>
        </div>
      </div>

      <!-- Tetanus Toxoid Immunisation -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon emerald"><i class="bi bi-syringe"></i></div>
            <div><h5>Tetanus Toxoid Immunisation</h5><p>TT dose schedule &amp; batch numbers</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="sub-label"><i class="bi bi-plus-circle-fill"></i> Add Dose Record</div>
          <div class="row g-3 mb-4">
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-123"></i> Dose Number</div>
              <select class="field-input">
                <option>Dose 1</option><option>Dose 2</option><option>Dose 3</option>
                <option>Dose 4</option><option>Dose 5</option><option>NE</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> Date Given</div>
              <input type="date" class="field-input">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-upc-scan"></i> Batch Number</div>
              <input type="text" class="field-input" placeholder="e.g. 223 A">
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-droplet"></i> Volume (mL)</div>
              <input type="text" class="field-input" placeholder="e.g. 220">
            </div>
            <div class="col-md-2" style="display:flex;align-items:flex-end;">
              <button class="btn-save" style="width:100%;justify-content:center;" onclick="showToast()">
                <i class="bi bi-plus-lg"></i> Add Dose
              </button>
            </div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr><th>Dose</th><th>Date</th><th>Batch No.</th><th>Volume (mL)</th></tr>
              </thead>
              <tbody>
                <tr><td>Dose 1</td><td>2025-09-09</td><td>223 0</td><td>220</td></tr>
                <tr><td>Dose 2</td><td>2025-10-08</td><td>223 B</td><td>230</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Antenatal Classes -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon orange"><i class="bi bi-people-fill"></i></div>
            <div><h5>Attendance at Antenatal Classes</h5><p>Session attendance by mother &amp; husband</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="table-wrap">
            <table>
              <thead>
                <tr><th>Session</th><th>Date</th><th>Husband Attended</th><th>Wife Attended</th><th>Other</th><th>Signature</th></tr>
              </thead>
              <tbody>
                <tr><td>1st Trimester</td><td>2025-09-16</td><td><span class="pill-nr">—</span></td><td><span class="pill-yes">✓ Yes</span></td><td>—</td><td>PHm</td></tr>
                <tr><td>2nd Trimester</td><td>2025-12-16</td><td><span class="pill-nr">—</span></td><td><span class="pill-yes">✓ Yes</span></td><td>—</td><td>PHm</td></tr>
                <tr><td>3rd Trimester</td><td>—</td><td>—</td><td>—</td><td>—</td><td>—</td></tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

    <!-- ══════════════════════ TAB: WEIGHT CHART ══════════════════════ -->
    <div class="tab-panel" id="tab-weight">

      <!-- ADD ENTRY FORM -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon violet"><i class="bi bi-plus-circle-fill"></i></div>
            <div><h5>Add Weight &amp; SFH Entry</h5><p>Enter a new reading — chart and table update instantly</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="row g-3 align-items-end">
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-calendar3"></i> Visit Date</div>
              <input type="date" class="field-input" id="wt-date">
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-hourglass-split"></i> POA (weeks)</div>
              <input type="number" class="field-input" id="wt-poa" placeholder="e.g. 28" min="4" max="45">
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-speedometer2"></i> Weight (kg)</div>
              <input type="number" class="field-input" id="wt-weight" placeholder="e.g. 67.5" step="0.1">
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-rulers"></i> Fundal Height (cm)</div>
              <input type="number" class="field-input" id="wt-sfh" placeholder="e.g. 28" step="0.5">
            </div>
            <div class="col-md-2">
              <div class="field-label"><i class="bi bi-calculator"></i> Pre-pregnancy Weight (kg)</div>
              <input type="number" class="field-input" id="wt-pre" placeholder="e.g. 58" step="0.1" title="Used for weight gain calculation">
            </div>
            <div class="col-md-2">
              <button class="btn-save" style="width:100%;justify-content:center;margin-top:2px;" onclick="addWeightEntry()">
                <i class="bi bi-plus-lg"></i> Add Entry
              </button>
            </div>
          </div>
          <!-- inline validation msg -->
          <div id="wt-error" style="display:none;margin-top:10px;padding:10px 14px;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;font-size:12.5px;color:#b91c1c;">
            <i class="bi bi-exclamation-triangle-fill"></i> <span id="wt-error-msg"></span>
          </div>
        </div>
      </div>

      <!-- SUMMARY STATS -->
      <div id="wt-stats-row" class="stats-row" style="grid-template-columns:repeat(4,1fr);">
        <div class="stat-card">
          <div class="stat-icon" style="background:#f5f3ff;color:#7c3aed;"><i class="bi bi-arrow-up-circle-fill"></i></div>
          <div><div class="stat-val" id="stat-gain">—</div><div class="stat-lbl">Total Gain (kg)</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#eff6ff;color:#2563eb;"><i class="bi bi-speedometer2"></i></div>
          <div><div class="stat-val" id="stat-latest-wt">—</div><div class="stat-lbl">Latest Weight (kg)</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-rulers"></i></div>
          <div><div class="stat-val" id="stat-latest-sfh">—</div><div class="stat-lbl">Latest Fundal Ht. (cm)</div></div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background:#fff7ed;color:#ea580c;"><i class="bi bi-calendar3"></i></div>
          <div><div class="stat-val" id="stat-entries">0</div><div class="stat-lbl">Total Entries</div></div>
        </div>
      </div>

      <!-- CHARTS -->
      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="box" style="margin-bottom:0;">
            <div class="box-header" style="padding:16px 22px;">
              <div class="box-header-left">
                <div class="box-icon violet" style="width:34px;height:34px;font-size:15px;"><i class="bi bi-graph-up-arrow"></i></div>
                <div><h5 style="font-size:15px;">Weight Gain Chart</h5><p>Maternal weight vs POA (weeks)</p></div>
              </div>
            </div>
            <div style="padding:18px 22px 22px;">
              <canvas id="weightChart" height="220"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box" style="margin-bottom:0;">
            <div class="box-header" style="padding:16px 22px;">
              <div class="box-header-left">
                <div class="box-icon emerald" style="width:34px;height:34px;font-size:15px;"><i class="bi bi-rulers"></i></div>
                <div><h5 style="font-size:15px;">Symphysis-Fundal Height Chart</h5><p>SFH vs POA (weeks)</p></div>
              </div>
            </div>
            <div style="padding:18px 22px 22px;">
              <canvas id="sfhChart" height="220"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- DATA TABLE -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon teal"><i class="bi bi-table"></i></div>
            <div><h5>Weight &amp; SFH Log</h5><p>All recorded entries — sorted by POA</p></div>
          </div>
          <button class="btn-clear" onclick="clearAllEntries()" style="font-size:12px;padding:7px 14px;">
            <i class="bi bi-trash-fill"></i> Clear All
          </button>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Visit Date</th>
                <th>POA (wks)</th>
                <th>Weight (kg)</th>
                <th>Weight Gain (kg)</th>
                <th>Fundal Height (cm)</th>
                <th>BMI Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="wt-tbody">
              <tr id="wt-empty-row">
                <td colspan="8" style="text-align:center;color:#94a3b8;padding:28px 0;font-size:13px;">
                  <i class="bi bi-plus-circle" style="font-size:22px;display:block;margin-bottom:8px;"></i>
                  No entries yet — add the first weight reading above
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="table-footer">
          <span id="wt-table-footer">0 entries recorded</span>
          <span style="font-size:12px;color:#94a3b8;">
            <i class="bi bi-info-circle-fill" style="color:#2563eb;"></i>
            Weight gain = current weight − pre-pregnancy weight
          </span>
        </div>
      </div>

      <!-- BMI Reference -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon amber"><i class="bi bi-info-circle-fill"></i></div>
            <div><h5>BMI Category Reference</h5><p>Weight gain targets by pre-pregnancy BMI (WHO guidelines)</p></div>
          </div>
        </div>
        <div class="box-body">
          <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;">
            <div style="background:#f0fdf4;border:1.5px solid #bbf7d0;border-radius:14px;padding:16px;">
              <div style="font-size:11px;font-weight:700;color:#166534;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:6px;">A &amp; B</div>
              <div style="font-family:'DM Serif Display',serif;font-size:18px;color:#15803d;">BMI &lt; 18.5</div>
              <div style="font-size:12px;color:#166534;margin-top:4px;">Underweight</div>
              <div style="font-size:11.5px;color:#64748b;margin-top:8px;">Recommended gain: <strong>12.5–18 kg</strong></div>
            </div>
            <div style="background:#fffbeb;border:1.5px solid #fde68a;border-radius:14px;padding:16px;">
              <div style="font-size:11px;font-weight:700;color:#92400e;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:6px;">B &amp; C</div>
              <div style="font-family:'DM Serif Display',serif;font-size:18px;color:#d97706;">BMI 18.5–24.9</div>
              <div style="font-size:12px;color:#92400e;margin-top:4px;">Normal</div>
              <div style="font-size:11.5px;color:#64748b;margin-top:8px;">Recommended gain: <strong>11.5–16 kg</strong></div>
            </div>
            <div style="background:#fff7ed;border:1.5px solid #fed7aa;border-radius:14px;padding:16px;">
              <div style="font-size:11px;font-weight:700;color:#9a3412;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:6px;">D &amp; E</div>
              <div style="font-family:'DM Serif Display',serif;font-size:18px;color:#ea580c;">BMI 25–29.9</div>
              <div style="font-size:12px;color:#9a3412;margin-top:4px;">Overweight</div>
              <div style="font-size:11.5px;color:#64748b;margin-top:8px;">Recommended gain: <strong>7–11.5 kg</strong></div>
            </div>
            <div style="background:#fef2f2;border:1.5px solid #fecaca;border-radius:14px;padding:16px;">
              <div style="font-size:11px;font-weight:700;color:#991b1b;text-transform:uppercase;letter-spacing:0.8px;margin-bottom:6px;">E &amp; F</div>
              <div style="font-family:'DM Serif Display',serif;font-size:18px;color:#dc2626;">BMI ≥ 30</div>
              <div style="font-size:12px;color:#991b1b;margin-top:4px;">Obese</div>
              <div style="font-size:11.5px;color:#64748b;margin-top:8px;">Recommended gain: <strong>5–9 kg</strong></div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- ══════════════════════ TAB: DELIVERY & POSTNATAL ══════════════════════ -->
    <div class="tab-panel" id="tab-delivery">
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon rose"><i class="bi bi-hospital-fill"></i></div>
            <div><h5>Delivery &amp; Postnatal Care</h5><p>Intrapartum &amp; discharge summary · T.N. Hospital: Ku/galk</p></div>
          </div>
        </div>
        <div class="box-body">

          <!-- Delivery Details -->
          <div class="sub-label"><i class="bi bi-calendar-event-fill"></i> Delivery Details</div>
          <div class="row g-3 mb-4">
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> Date of Delivery</div>
              <input type="date" class="field-input" value="2026-02-20">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-gender-ambiguous"></i> Sex of Baby</div>
              <select class="field-input">
                <option selected>Female</option><option>Male</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-heart-pulse-fill"></i> Birth Outcome</div>
              <select class="field-input">
                <option selected>Live Birth</option><option>Stillbirth</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-speedometer2"></i> Birth Weight (g)</div>
              <input type="number" class="field-input" value="3150" placeholder="e.g. 3150">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-scissors"></i> Mode of Delivery</div>
              <select class="field-input">
                <option>Normal (SVD)</option><option>Forceps/Vacuum</option>
                <option selected>LSCS (Caesarean)</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-scissors"></i> Episiotomy</div>
              <select class="field-input">
                <option selected>No</option><option>Yes</option>
              </select>
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-calendar3"></i> Date of Discharge</div>
              <input type="date" class="field-input" value="2026-02-23">
            </div>
            <div class="col-md-3">
              <div class="field-label"><i class="bi bi-person-fill"></i> Pre-delivery Maternal Weight (kg)</div>
              <input type="number" class="field-input" placeholder="e.g. 79" step="0.1">
            </div>
          </div>

          <!-- Postnatal Checklist -->
          <div class="sub-label"><i class="bi bi-clipboard2-check-fill"></i> Postnatal Discharge Checklist</div>
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-thermometer"></i> Body Temp Normal (Last 2 Days)</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-search"></i> Vaginal Examination Done to Check Packs</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-exclamation-triangle-fill"></i> Maternal Complications (If Any)</div>
              <input type="text" class="field-input" placeholder="Specify or leave blank (None)">
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-shield-check-fill"></i> Rubella Immunisation Completed</div>
              <select class="field-input"><option selected>No</option><option>Yes</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-droplet-fill"></i> Anti-D Antibodies Given</div>
              <select class="field-input"><option selected>No</option><option>Yes</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-capsule"></i> Vitamin A Megadose Given</div>
              <select class="field-input"><option selected>No</option><option>Yes</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-file-earmark-medical-fill"></i> Diagnosis Card Given (if Indicated)</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-book-fill"></i> CHDR Completed &amp; Handed Over</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-prescription2"></i> Prescription Given (if Needed)</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-people-fill"></i> Referred to Field Public Health Midwife</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-exclamation-circle-fill"></i> Post Partum Danger Signals Explained</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-gender-female"></i> Breastfeeding Established</div>
              <select class="field-input"><option selected>Yes</option><option>No</option></select>
            </div>
          </div>

          <!-- Family Planning -->
          <div class="sub-label"><i class="bi bi-calendar-heart-fill"></i> Family Planning</div>
          <div class="row g-3 mb-4">
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-check-circle-fill"></i> Method Given</div>
              <div class="radio-group" id="fpMethod">
                <label class="radio-option" onclick="toggleRadio(this,'fpMethod')"><input type="radio" name="fp"> T (Tubectomy)</label>
                <label class="radio-option" onclick="toggleRadio(this,'fpMethod')"><input type="radio" name="fp"> PL (Pills)</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-ui-checks"></i> Chosen Method</div>
              <div class="radio-group" id="chosenMethod">
                <label class="radio-option" onclick="toggleRadio(this,'chosenMethod')"><input type="radio" name="cm"> T</label>
                <label class="radio-option" onclick="toggleRadio(this,'chosenMethod')"><input type="radio" name="cm"> L</label>
                <label class="radio-option" onclick="toggleRadio(this,'chosenMethod')"><input type="radio" name="cm"> IP</label>
                <label class="radio-option" onclick="toggleRadio(this,'chosenMethod')"><input type="radio" name="cm"> N</label>
                <label class="radio-option" onclick="toggleRadio(this,'chosenMethod')"><input type="radio" name="cm"> V</label>
                <label class="radio-option" onclick="toggleRadio(this,'chosenMethod')"><input type="radio" name="cm"> C</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="field-label"><i class="bi bi-journal-text"></i> Reason if Not Adopting</div>
              <input type="text" class="field-input" placeholder="Leave blank if adopted">
            </div>
          </div>

          <!-- Special Notes -->
          <div class="sub-label"><i class="bi bi-journal-bookmark-fill"></i> Special Notes</div>
          <div class="row g-3">
            <div class="col-12">
              <textarea class="field-input" rows="3" placeholder="Special notes / observations at delivery or discharge…"></textarea>
            </div>
          </div>

        </div>
        <div class="form-footer">
          <div class="footer-hint"><i class="bi bi-shield-check-fill"></i> Delivery record saved under MOM001 — Nimali Silva</div>
          <div style="display:flex;gap:10px;">
            <button class="btn-clear"><i class="bi bi-x-lg"></i> Clear</button>
            <button class="btn-save" onclick="showToast()"><i class="bi bi-check-circle-fill"></i> Save Delivery Record</button>
          </div>
        </div>
      </div>

      <!-- Delivery Summary Card -->
      <div class="box">
        <div class="box-header">
          <div class="box-header-left">
            <div class="box-icon emerald"><i class="bi bi-card-checklist"></i></div>
            <div><h5>Delivery Summary</h5><p>Recorded delivery data for Nimali Silva</p></div>
          </div>
        </div>
        <div class="box-body">
          <div class="info-grid">
            <div class="info-box"><div class="ib-label"><i class="bi bi-calendar3"></i> Date of Delivery</div><div class="ib-value">2026-02-20</div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-scissors"></i> Mode</div><div class="ib-value"><span class="badge-lscs">LSCS</span></div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-heart-fill"></i> Birth Outcome</div><div class="ib-value"><span class="badge-live">Live Birth</span></div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-gender-female"></i> Sex</div><div class="ib-value">Female</div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-speedometer2"></i> Birth Weight</div><div class="ib-value">3,150 g</div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-calendar-check"></i> Discharge Date</div><div class="ib-value">2026-02-23</div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-person-badge-fill"></i> Attending Officer</div><div class="ib-value" style="font-size:13px;">Dr. / MW Signed</div></div>
            <div class="info-box"><div class="ib-label"><i class="bi bi-hospital-fill"></i> Hospital</div><div class="ib-value" style="font-size:13px;">TN / Ku-galk</div></div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /content -->
</div><!-- /main -->

<!-- TOAST -->
<div class="toast-wrap" id="successToast">
  <div class="toast-card">
    <div class="toast-icon"><i class="bi bi-check-circle-fill"></i></div>
    <div>
      <div class="toast-title">Record Saved!</div>
      <div class="toast-sub">Health record updated for Nimali Silva</div>
    </div>
  </div>
</div>
@endsection
