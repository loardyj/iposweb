<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{    
    public function index()
    {
        return view('admin_dashboard.index');
    }
}
