<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminLoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check()){
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

        if (Auth::guard('web')->attempt(['username' => $credentials['username'], 'password' => $request['password']])) {
            $request->session()->regenerate();
            return to_route('admin_dashboard');
        }
 
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return to_route('url_admin_login')->with('success', 'You have been logged out.');
    }
}
