<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Midwife;
use App\Models\Mother;
use App\Models\Visit;
use Carbon\Carbon;

class MidwifeController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $midwife = Midwife::where('user_id', $user->id)->first();

        if (!$midwife) {
            return redirect()->route('home')
                ->with('error', 'Midwife profile not found.');
        }

        $totalMothers = Mother::where('midwife_id', $midwife->id)->count();

        $pregnantMothers = Mother::where('midwife_id', $midwife->id)
            ->where('status', 'Pregnant')
            ->count();

        $deliveredMothers = Mother::where('midwife_id', $midwife->id)
            ->where('status', 'Delivered')
            ->count();

            // Today's Visits
$todayVisits = Visit::where('midwife_id', $midwife->id)
    ->whereDate('visit_date', Carbon::today())
    ->count();

// Upcoming Visits
$upcomingVisits = Visit::where('midwife_id', $midwife->id)
    ->whereDate('next_visit_date', '>=', Carbon::today())
    ->count();

// Recent Visits
$recentVisits = Visit::where('midwife_id', $midwife->id)
    ->with('mother')
    ->latest('visit_date')
    ->take(5)
    ->get();

        $recentMothers = Mother::where('midwife_id', $midwife->id)
            ->latest()
            ->take(5)
            ->get();

        return view('midwife.dashboard', compact(
    'midwife',
    'totalMothers',
    'pregnantMothers',
    'deliveredMothers',
    'todayVisits',
    'upcomingVisits',
    'recentVisits',
    'recentMothers'
));
    }
}