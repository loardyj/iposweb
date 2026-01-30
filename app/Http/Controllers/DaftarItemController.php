<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kantor;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DaftarItemController extends Controller
{
    public function index()
    {
        $kantor = Kantor::query()
                ->where('kodekantor', '=', Auth::user()->kodeKantor)
                ->first();

        $kantorUTM = Kantor::query()
                    ->where('kodekantor', '=', 'UTM')
                    ->first();
        // dd($kantor);
        return view('daftar_item.index',
                    ['kantor' => $kantor,
                    'kantorUTM' => $kantorUTM]);
    }

    public function json()
    {
        $model = Item::query()
                ->join('tbl_itemhj', 'tbl_item.kodeitem', '=', 'tbl_itemhj.kodeitem')
                ->join('tbl_supelgrup', 'tbl_itemhj.level', '=', 'tbl_supelgrup.levelharga')
                ->join('tbl_itemjenis', 'tbl_item.jenis', '=', 'tbl_itemjenis.jenis')
                ->join('tbl_itemmerek', 'tbl_item.merek', '=', 'tbl_itemmerek.merek')
                ->leftJoin('tbl_itemstok', function ($join) {
                    $join->on('tbl_item.kodeitem', '=', 'tbl_itemstok.kodeitem') // First join condition (ON)
                         ->where('tbl_itemstok.kantor', '=', Auth::user()->kodeKantor);     // Second condition (AND WHERE)
                })
                ->select('tbl_item.kodeitem', 'tbl_item.namaitem', 'tbl_itemjenis.ketjenis',
                        'tbl_item.satuan', 'tbl_itemmerek.ketmerek')
                ->selectRaw('TRUNC(tbl_itemhj.hargajual, 0) hargajual')
                ->addSelect('tbl_itemstok.stok')
                ->where('tbl_supelgrup.kgrup', '=', Auth::user()->kgrup)
                ->where('tbl_item.statusjual', '=', 'Y')
                ->where('tbl_itemhj.hargajual', '>', 1)
                ->orderBy('tbl_itemstok.stok', 'asc')
                ->orderBy('tbl_item.jenis', 'asc')
                ->orderBy('tbl_item.merek', 'asc')
                ->orderBy('tbl_item.namaitem', 'asc')
                ->get();

        // $model = Item::select(DB::raw('
        //             select "tbl_item"."kodeitem", "tbl_item"."namaitem", "tbl_itemjenis"."ketjenis", "tbl_item"."satuan", "tbl_itemmerek"."ketmerek", TRUNC(tbl_itemhj.hargajual, 0) hargajual,
        //             "tbl_itemstok"."stok" from "tbl_item" inner join "tbl_itemhj" on "tbl_item"."kodeitem" = "tbl_itemhj"."kodeitem" inner join "tbl_supelgrup" on "tbl_itemhj"."level" = "tbl_supelgrup"."levelharga" inner join "tbl_itemjenis" on "tbl_item"."jenis" = "tbl_itemjenis"."jenis" inner join "tbl_itemmerek" on "tbl_item"."merek" = "tbl_itemmerek"."merek" left join "tbl_itemstok" on "tbl_item"."kodeitem" = "tbl_itemstok"."kodeitem" and "tbl_itemstok"."kantor" = ? where "tbl_supelgrup"."kgrup" = ? and "tbl_item"."statusjual" = ? and "tbl_itemhj"."hargajual" > ? order by "tbl_itemstok"."stok" asc, "tbl_item"."jenis" asc, "tbl_item"."merek" asc, "tbl_item"."namaitem" asc'))
        // dd($model);
 
        return DataTables::of($model)->toJson();
    }

    public function filter_json()
    {
        $jenis = Item::query()
                ->join('tbl_itemhj', 'tbl_item.kodeitem', '=', 'tbl_itemhj.kodeitem')
                ->join('tbl_supelgrup', 'tbl_itemhj.level', '=', 'tbl_supelgrup.levelharga')
                ->join('tbl_itemjenis', 'tbl_item.jenis', '=', 'tbl_itemjenis.jenis')
                ->selectRaw('DISTINCT(tbl_item.jenis) id, tbl_itemjenis.ketjenis AS text')
                ->where('tbl_supelgrup.kgrup', '=', Auth::user()->kgrup)
                ->where('tbl_item.statusjual', '=', 'Y')
                ->where('tbl_itemhj.hargajual', '>', 1)
                ->orderBy('tbl_itemjenis.ketjenis', 'asc')
                ->get();

        $merek = Item::query()
        ->join('tbl_itemhj', 'tbl_item.kodeitem', '=', 'tbl_itemhj.kodeitem')
        ->join('tbl_supelgrup', 'tbl_itemhj.level', '=', 'tbl_supelgrup.levelharga')
        ->join('tbl_itemmerek', 'tbl_item.merek', '=', 'tbl_itemmerek.merek')
        ->selectRaw('DISTINCT(tbl_item.merek) id, tbl_itemmerek.ketmerek AS text')
        ->where('tbl_supelgrup.kgrup', '=', Auth::user()->kgrup)
        ->where('tbl_item.statusjual', '=', 'Y')
        ->where('tbl_itemhj.hargajual', '>', 1)
        ->orderBy('tbl_itemmerek.ketmerek', 'asc')
        ->get();

        $data = [
            'jenis' => $jenis,
            'merek' => $merek
        ];
 
        return response()->json($data);
    }
}
