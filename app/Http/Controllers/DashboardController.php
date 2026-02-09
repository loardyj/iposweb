<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {        
        $omsetBulanIni = Penjualan::where('kodesupel', Auth::guard('pelangganweb')->user()->kode)
                        ->whereMonth('tanggal', Carbon::now()->month)
                        ->sum('subtotal');
        
        $point = Penjualan::where('kodesupel', Auth::guard('pelangganweb')->user()->kode)
                ->sum('point_ik');

        // dd($omsetBulanIni);

        
        return view('dashboard.index', ['omset' => $omsetBulanIni, 'point' => $point]);
    }
}
