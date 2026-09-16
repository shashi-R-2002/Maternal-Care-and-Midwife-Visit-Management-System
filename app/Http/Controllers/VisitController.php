<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Midwife;
use App\Models\Mother;
use App\Models\Visit;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->firstOrFail();

        // Logged-in midwife's mothers
        $mothers = Mother::where('midwife_id', $midwife->id)
            ->orderBy('full_name')
            ->get();

        // Selected mother
        $selectedMother = null;

        if ($request->filled('mother')) {
            $selectedMother = Mother::where('id', $request->mother)
                ->where('midwife_id', $midwife->id)
                ->first();
        }

        // If nothing selected, use first mother
        if (!$selectedMother && $mothers->count()) {
            $selectedMother = $mothers->first();
        }

        // Visits
        $visits = collect();

        if ($selectedMother) {
            $visits = Visit::where('mother_id', $selectedMother->id)
                ->latest('visit_date')
                ->get();
        }

        return view('midwife.visits', compact(
            'mothers',
            'selectedMother',
            'visits'
        ));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'mother_id' => 'required|exists:mothers,id',
            'visit_date' => 'required|date',
            'next_visit_date' => 'nullable|date|after_or_equal:visit_date',
            'visit_type' => 'required|string|max:100',
            'blood_pressure' => 'required|string|max:20',
            'weight' => 'required|numeric|min:1|max:300',
            'notes' => 'nullable|string|max:1000',
        ]);

        $mother = Mother::where('id', $request->mother_id)
            ->where('midwife_id', $midwife->id)
            ->firstOrFail();

        Visit::create([
            'mother_id' => $mother->id,
            'midwife_id' => $midwife->id,
            'visit_date' => $request->visit_date,
            'next_visit_date' => $request->next_visit_date,
            'visit_type' => $request->visit_type,
            'blood_pressure' => $request->blood_pressure,
            'weight' => $request->weight,
            'notes' => $request->notes,
        ]);

        return redirect()->route('midwife.visits', [
            'mother' => $mother->id
        ])->with('success', 'Visit added successfully.');
    }
    public function destroy(Visit $visit)
{
    $user = Auth::user();

    $midwife = Midwife::where('user_id', $user->id)->firstOrFail();

    // Ensure the visit belongs to the logged-in midwife
    if ($visit->midwife_id != $midwife->id) {
        abort(403);
    }

    $motherId = $visit->mother_id;

    $visit->delete();

    return redirect()->route('midwife.visits', [
        'mother' => $motherId
    ])->with('success', 'Visit deleted successfully.');
}

public function edit(Visit $visit)
{
    return view('midwife.edit-visit', compact('visit'));
}
}