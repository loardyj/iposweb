<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PelangganLoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('pelangganweb')->check()){
            return to_route('dashboard');
        } else {
            return view('login.index');
        }        
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            // 'password' => ['required'],
        ]);

        if (Auth::guard('pelangganweb')->attempt(['kode' => $credentials['username'], 'password' => $request['password'] ?? '', 'tipe' => 'PL'])) {
            $request->session()->regenerate();
            return to_route('dashboard');
        }
 
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function guest_login()
    {
        $guest = Pelanggan::where('kode', config('settings.guest_kode'))->first();
        if ($guest) {
            // Log in the user without a password check
            Auth::login($guest); 
            // $request->session()->regenerate(); // Regenerate session ID for security

            return to_route('dashboard');
        }
 
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('pelangganweb')->logout();
 
        // Invalidate session
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
 
        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
