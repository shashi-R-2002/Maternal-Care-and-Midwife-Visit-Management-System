<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Midwife;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $midwives = Midwife::latest()->get();

        $pendingCount  = Midwife::where('status', 'Pending')->count();
        $approvedCount = Midwife::where('status', 'Approved')->count();
        $rejectedCount = Midwife::where('status', 'Rejected')->count();
        $totalCount    = Midwife::count();

        return view('admin.dashboard', compact(
            'midwives',
            'pendingCount',
            'approvedCount',
            'rejectedCount',
            'totalCount'
        ));
    }

    // Approved Midwife List
    public function midwives()
    {
        $midwives = Midwife::where('status', 'Approved')
            ->latest()
            ->get();

        return view('admin.midwives', compact('midwives'));
    }
    public function approve(Midwife $midwife)
{
    if (!$midwife->registration_no) {

        $last = Midwife::whereNotNull('registration_no')
                    ->orderBy('id', 'desc')
                    ->first();

        if ($last) {
            $number = (int) substr($last->registration_no, 2) + 1;
        } else {
            $number = 1;
        }

        $midwife->registration_no = 'MW' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    $midwife->status = 'Approved';
    $midwife->save();

    return redirect()
        ->route('admin.dashboard')
        ->with('success', 'Midwife approved successfully.');
}

public function reject(Midwife $midwife)
{
    $midwife->status = 'Rejected';
    $midwife->save();

    return redirect()
        ->route('admin.dashboard')
        ->with('success', 'Midwife rejected successfully.');
}
}