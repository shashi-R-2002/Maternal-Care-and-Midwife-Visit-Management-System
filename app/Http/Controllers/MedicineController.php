<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;
use App\Models\Midwife;
use App\Models\Mother;
use App\Models\Visit;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->firstOrFail();

        // Logged-in midwife's mothers
        $mothers = Mother::where('midwife_id', $midwife->id)
            ->orderBy('full_name')
            ->get();

        $selectedMother = null;

        if ($request->filled('mother')) {
            $selectedMother = Mother::where('id', $request->mother)
                ->where('midwife_id', $midwife->id)
                ->first();
        }

        if (!$selectedMother && $mothers->count()) {
            $selectedMother = $mothers->first();
        }

        $medicines = collect();

        if ($selectedMother) {
            $medicines = Medicine::where('mother_id', $selectedMother->id)
                ->latest()
                ->get();
        }

        return view('midwife.medicines', compact(
            'mothers',
            'selectedMother',
            'medicines'
        ));
    }

    public function store(Request $request)
{
    $request->validate([
        'mother_id' => 'required|exists:mothers,id',
        'medicine_name.*' => 'required|string|max:255',
        'dosage.*' => 'required|string|max:255',
        'quantity.*' => 'required|integer|min:1',
        'remarks.*' => 'nullable|string',
    ]);

    

    $visit = Visit::where('mother_id', $request->mother_id)
        ->latest()
        ->first();

    if (!$visit) {
        return redirect()->back()
            ->with('error', 'Please add a visit before adding medicines.');
    }

    foreach ($request->medicine_name as $index => $medicine) {

    Medicine::create([
        'visit_id'      => $visit->id,
        'mother_id'     => $request->mother_id,
        'medicine_name' => $medicine,
        'dosage'        => $request->dosage[$index],
        'quantity'      => $request->quantity[$index],
        'remarks'       => $request->remarks[$index] ?? null,
    ]);

}

    return redirect()->route('midwife.medicines', [
        'mother' => $request->mother_id
    ])->with('success', 'Medicines added successfully.');
}

    public function destroy(Medicine $medicine)
    {
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->firstOrFail();

        $mother = Mother::find($medicine->mother_id);

        if (!$mother || $mother->midwife_id != $midwife->id) {
            abort(403);
        }

        $motherId = $medicine->mother_id;

        $medicine->delete();

        return redirect()->route('midwife.medicines', [
            'mother' => $motherId
        ])->with('success', 'Medicine deleted successfully.');
    }
}