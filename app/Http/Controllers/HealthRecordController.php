<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\Mother;
use App\Models\Visit;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    public function index()
    {
        $mothers = Mother::orderBy('full_name')->get();

        $selectedMother = null;
        $healthRecords = collect();

        if (request()->filled('mother_id')) {

            $selectedMother = Mother::find(request('mother_id'));

            if ($selectedMother) {
                $healthRecords = HealthRecord::where('mother_id', $selectedMother->id)
                    ->with('visit')
                    ->latest()
                    ->get();
            }
        }

        return view('midwife.health-record', compact(
            'mothers',
            'selectedMother',
            'healthRecords'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mother_id'      => 'required|exists:mothers,id',
            'blood_pressure' => 'required|string|max:20',
            'weight'         => 'required|numeric',
            'blood_sugar'    => 'nullable|numeric',
            'hemoglobin'     => 'nullable|numeric',
            'urine_protein'  => 'nullable|string',
            'urine_sugar'    => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $visit = Visit::where('mother_id', $request->mother_id)
            ->latest()
            ->first();

        if (!$visit) {
            return back()->with('error', 'Please create a visit record before adding a health record.');
        }

        HealthRecord::create([
            'visit_id'        => $visit->id,
            'mother_id'       => $request->mother_id,
            'blood_pressure'  => $request->blood_pressure,
            'weight'          => $request->weight,
            'blood_sugar'     => $request->blood_sugar,
            'hemoglobin'      => $request->hemoglobin,
            'urine_protein'   => $request->urine_protein,
            'urine_sugar'     => $request->urine_sugar,
            'notes'           => $request->notes,
        ]);

        return redirect()->route('midwife.health-record', [
            'mother_id' => $request->mother_id
        ])->with('success', 'Health Record Added Successfully!');
    }

    public function destroy(HealthRecord $healthRecord)
    {
        $healthRecord->delete();

        return redirect()->back()->with('success', 'Health Record Deleted Successfully!');
    }
}