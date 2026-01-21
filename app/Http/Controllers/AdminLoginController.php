<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller 
{    
    public function index()
    {      
        if(Auth::guard('adminweb')->check()){
            return to_route('admin_dashboard');
        } else {            
            return view('login_admin.index');
        }        
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            // 'password' => ['required'],
        ]);

        $errorMsg = 'The provided credentials do not match our records.';

        if (Auth::guard('adminweb')->attempt(['username' => $credentials['username'], 'password' => $request['password']])) {            
            if (Auth::guard('adminweb')->user()->status == 'Aktif') {
                $request->session()->regenerate();
                return to_route('admin_dashboard');
            } else {
                Auth::logout();
                $errorMsg = 'Akun anda tidak aktif!';
            }            
        }
 
        return back()->withErrors([
            'error' => $errorMsg,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('adminweb')->logout();
 
        // Invalidate session
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
 
        return to_route('url_admin_login')->with('success', 'You have been logged out.');
    }
}
