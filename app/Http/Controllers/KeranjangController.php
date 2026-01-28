<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\KeranjangDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function json()
    {
        $data = Keranjang::
                with(['details',
                    'details.item_details:kodeitem,namaitem,merek',
                    'details.item_details.harga_jual' => function ($query) {
                        $query->select('kodeitem','hargajual'); 
                        $query->where('level', Auth::guard('pelangganweb')->user()->levelharga);
                    }
                    ])
                ->where('kode_supel', Auth::guard('pelangganweb')->user()->kode)
                ->get();
        
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        DB::beginTransaction();

        try {
            $kode_supel = Auth::guard('pelangganweb')->user()->kode;
            // $kode_supel = 'UMUM';

            $order = Keranjang::updateOrCreate(
                ['kode_supel' => $kode_supel],
                ['kode_supel' => $kode_supel],
            );

            $isInsert = $data['isInsert'];

            $order = KeranjangDetail::updateOrCreate(
                [
                    'keranjang_id' => $order->id,
                    'kode_item' => $data['kode'],
                ],
                [
                    'keranjang_id' => $order->id,
                    'kode_item' => $data['kode'],
                    'qty' => $isInsert ? DB::raw('qty + ' . $data['qty']) : $data['qty'],
                ],
            );

            DB::commit();
            return response()->json(['message' => 'Data received successfully', 'data' => $data]);            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error ' . $e, 'data' => $data]);
        }        
    }

    public function destroy(Request $request)
    {
        $data = $request->all();

        $query = KeranjangDetail::findOrFail($data['id']);
        $query->delete();

        return response()->json(['message' => 'Data deleted successfully', 'data' => $data]);
    }
}
