<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Penjualan;
use App\Models\SettingPel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {   
        $str_tgl_lahir = '';
        $tgl_lahir = DateTime::createFromFormat('Y-m-d H:i:s', Auth::guard('pelangganweb')->user()->tgl_lahir);
        if ($tgl_lahir !== false) {
            $str_tgl_lahir = 'Expired Login: ' . $tgl_lahir->format('d-m-Y');
        }

        // dd($str_tgl_lahir);

        $omsetBulanIni = Penjualan::where('kodesupel', Auth::guard('pelangganweb')->user()->kode)
                        ->whereMonth('tanggal', Carbon::now()->month)
                        ->sum('subtotal');
        
        $point = Penjualan::where('kodesupel', Auth::guard('pelangganweb')->user()->kode)
                ->sum('point_ik');
                
        $tglExpPoint = DateTime::createFromFormat('Y-m-d H:i:s', SettingPel::value('pmtukarsampai'));
        $str_tglExpPoint = $tglExpPoint->format('d-m-Y');

        // dd($pointExpired);

        // dd($omsetBulanIni);

        
        return view('dashboard.index', ['omset' => $omsetBulanIni, 'point' => $point,
                                        'tgl_lahir' => $str_tgl_lahir, 'pointExpired' => $str_tglExpPoint]);
    }
}
