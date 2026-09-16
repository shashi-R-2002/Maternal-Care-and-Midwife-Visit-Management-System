<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use App\Models\Midwife;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Visit;
use App\Models\HealthRecord;
use App\Models\Medicine;

class MotherController extends Controller
{
    // Display Mothers
    public function index()
    {
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->first();

        if (!$midwife) {
            return redirect()->back()->with('error', 'Midwife record not found.');
        }

        $mothers = Mother::with('midwife', 'user')
            ->where('midwife_id', $midwife->id)
            ->latest()
            ->get();

        $totalMothers = $mothers->count();
        $pregnantCount = $mothers->where('status', 'Pregnant')->count();
        $deliveredCount = $mothers->where('status', 'Delivered')->count();

        return view('midwife.mother', compact(
            'mothers',
            'totalMothers',
            'pregnantCount',
            'deliveredCount'
        ));
    }

    // Show Add Mother Form
    public function create()
    {
        return view('midwife.add-mother');
    }

    // Store Mother
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'   => 'required|string|max:255',
            'nic'         => 'required|string|max:20|unique:mothers,nic',
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string',
            'blood_group' => 'required|string',
            'lmp'         => 'required|date',
            'edd'         => 'required|date',
            'gravida'     => 'required|integer',
            'para'        => 'required|integer',
            'status'      => 'required|string',
        ]);

        // Logged-in Midwife
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->first();

        if (!$midwife) {
            return back()->withErrors([
                'error' => 'Midwife record not found.'
            ]);
        }

        // Generate Registration Number
        $lastMother = Mother::latest()->first();

        if ($lastMother && $lastMother->registration_no) {
            $number = (int) substr($lastMother->registration_no, 1);
            $number++;
        } else {
            $number = 1;
        }

        $registrationNo = 'M' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // Calculate Age
        $age = Carbon::parse($validated['dob'])->age;

        // Create Mother Login
       $motherUser = User::create([
    'name'     => $validated['full_name'],
    'email'    => $validated['nic'],          // User ID (NIC)
    'password' => Hash::make($registrationNo), // Password (Registration No)
    'role'     => 'mother',
]);

        // Save Mother
        Mother::create([
            'user_id'         => $motherUser->id,
            'midwife_id'      => $midwife->id,
            'registration_no' => $registrationNo,
            'full_name'       => $validated['full_name'],
            'nic'             => $validated['nic'],
            'dob'             => $validated['dob'],
            'age'             => $age,
            'phone'           => $validated['phone'],
            'address'         => $validated['address'],
            'blood_group'     => $validated['blood_group'],
            'lmp'             => $validated['lmp'],
            'edd'             => $validated['edd'],
            'gravida'         => $validated['gravida'],
            'para'            => $validated['para'],
            'status'          => $validated['status'],
        ]);

        return redirect()
    ->route('mothers.index')
    ->with(
        'success',
        'Mother registered successfully. Login User ID: ' .
        $validated['nic'] .
        ' | Password: ' .
        $registrationNo
    );
    }

    // Show Mother
    public function show(Mother $mother)
    {
        return view('midwife.mother-details', compact('mother'));
    }

    // Edit Mother
    public function edit(Mother $mother)
    {
        return view('midwife.edit-mother', compact('mother'));
    }

    // Update Mother
    public function update(Request $request, Mother $mother)
    {
        $validated = $request->validate([
            'full_name'   => 'required|string|max:255',
            'nic'         => 'required|string|max:20|unique:mothers,nic,' . $mother->id,
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string',
            'blood_group' => 'required|string',
            'lmp'         => 'required|date',
            'edd'         => 'required|date',
            'gravida'     => 'required|integer',
            'para'        => 'required|integer',
            'status'      => 'required|string',
        ]);

        $age = Carbon::parse($validated['dob'])->age;

        $mother->update([
            'full_name'   => $validated['full_name'],
            'nic'         => $validated['nic'],
            'dob'         => $validated['dob'],
            'age'         => $age,
            'phone'       => $validated['phone'],
            'address'     => $validated['address'],
            'blood_group' => $validated['blood_group'],
            'lmp'         => $validated['lmp'],
            'edd'         => $validated['edd'],
            'gravida'     => $validated['gravida'],
            'para'        => $validated['para'],
            'status'      => $validated['status'],
        ]);

       if ($mother->user) {
    $mother->user->update([
        'name'  => $validated['full_name'],
        'email' => $validated['nic'],
    ]);
}

        return redirect()
            ->route('mothers.index')
            ->with('success', 'Mother updated successfully.');
    }
public function dashboard()
{
    $user = Auth::user();

    $mother = Mother::where('user_id', $user->id)->first();

    if (!$mother) {
        abort(404, 'Mother record not found.');
    }

    $visits = Visit::where('mother_id', $mother->id)
        ->latest('visit_date')
        ->get();

    $latestVisit = $visits->first();

    $healthRecords = HealthRecord::where('mother_id', $mother->id)
        ->with('visit')
        ->latest()
        ->get();

    $medicines = Medicine::where('mother_id', $mother->id)
        ->latest()
        ->get();

    return view('mother.dashboard', compact(
        'mother',
        'visits',
        'latestVisit',
        'healthRecords',
        'medicines'
    ));
}

}

