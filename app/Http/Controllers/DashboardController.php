<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        // dd(Auth::guard('pelangganweb')->user()->levelharga);
        $omsetBulanIni = Penjualan::where('kodesupel', Auth::guard('pelangganweb')->user()->kode)
                        ->whereMonth('tanggal', Carbon::now()->month)
                        ->sum('subtotal');

        // dd($omsetBulanIni);

        
        return view('dashboard.index', ['omset' => $omsetBulanIni]);
    }
}
