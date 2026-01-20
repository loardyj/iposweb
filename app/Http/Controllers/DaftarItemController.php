<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DaftarItemController extends Controller
{
    public function index()
    {
        return view('daftar_item.index');
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
