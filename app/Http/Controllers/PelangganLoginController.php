<?php

namespace App\Http\Controllers;

use DateTime;
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
            'password' => ['required'],
        ]);

        if (Auth::guard('pelangganweb')->attempt(['kode' => $credentials['username'], 'password' => $request['password'] ?? '', 'tipe' => 'PL'])) {
            $today = new DateTime();
            $tgl_lahir = DateTime::createFromFormat('Y-m-d H:i:s', Auth::guard('pelangganweb')->user()->tgl_lahir);
            $today->setTime(0, 0, 0);
            $tgl_lahir->setTime(0, 0, 0);            
            
            if ($tgl_lahir == false || $today <= $tgl_lahir) {
                $request->session()->regenerate();
                return to_route('dashboard');
            } else {
                Auth::guard('pelangganweb')->logout();
                $errorMsg = 'Akun anda tidak aktif!';
            } 
        } else {
            $errorMsg = 'Username / Password Salah!';
        }        
 
        return back()->withErrors([
            'error' => $errorMsg
        ]);
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
