<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Midwife;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Midwife Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|max:20',
            'nic' => 'required|unique:midwives,nic',
            'address' => 'required|string',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'midwife',
        ]);

        // Create Midwife
        Midwife::create([
            'user_id' => $user->id,
            'full_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nic' => $request->nic,
            'address' => $request->address,
            'status' => 'Pending',
        ]);

        return redirect('/')
            ->with('success', 'Registration submitted successfully. Please wait for Admin approval.');
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return back()->with('error', 'Invalid User ID or Password.');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Midwife
        if ($user->role === 'midwife') {

            $midwife = Midwife::where('user_id', $user->id)->first();

            if (!$midwife) {
                Auth::logout();
                return back()->with('error', 'Midwife account not found.');
            }

            if ($midwife->status !== 'Approved') {
                Auth::logout();
                return back()->with(
                    'error',
                    'Your account is waiting for Admin approval.'
                );
            }

            return redirect()->route('midwife.dashboard');
        }

        // Mother
        if ($user->role === 'mother') {
            return redirect()->route('mother.dashboard');
        }

        Auth::logout();

        return back()->with('error', 'Unauthorized account.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}