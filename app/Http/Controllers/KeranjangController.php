<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\KeranjangDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class KeranjangController extends Controller
{
    public function toWA()
    {
        $data = Keranjang::
                with(['details',
                    'details.item_details:kodeitem,namaitem,merek',
                    'details.item_details.harga_jual' => function ($query) {
                        $query->select('kodeitem','hargajual','satuan'); 
                        $query->where('level', Auth::guard('pelangganweb')->user()->levelharga);
                    }
                    ])
                ->where('kode_supel', Auth::guard('pelangganweb')->user()->kode)
                ->get();
        
        $total = 0;
        
        $text = "Halo kami,<br>";
        // $text .= 
        $text .= '[' . Auth::guard('pelangganweb')->user()->kode . '] - ' . Auth::guard('pelangganweb')->user()->nama . '<br><br>';
        $text .= "Mau Order:<br>";
        foreach ($data[0]['details'] as $d) {
            $satuan = ucwords(strtolower($d->item_details->harga_jual[0]->satuan));
            $qty = $d->qty;
            $hargajual = $d->item_details->harga_jual[0]->hargajual;
            $subtotal = $qty * $hargajual;
            $total += $subtotal;

            $strHargaJual = number_format($d->item_details->harga_jual[0]->hargajual, 0, ',', '.');            

            $text .= '- ' . $qty . ' ' . $satuan . ' [' 
                    . $d->item_details->kodeitem . '] ' 
                    . $d->item_details->namaitem 
                    . ' @Rp' . $strHargaJual . '<br>';
            // $text .= $d->qty;
        }

        if (count($data[0]['details']) > 0) {
            $strTotal = number_format($total, 0, ',', '.');
            $text .= '<br>Total: Rp' . $strTotal;
        }

        // echo $text;

        $textWA = str_replace('<br>', "\n", $text);

        $phoneNumber = Auth::guard('pelangganweb')->user()->WAKantor; // Include country code
        $message = urlencode($textWA);

        return Redirect::away("https://wa.me/+62{$phoneNumber}?text={$message}");
    }

    public function json()
    {
        Keranjang::updateOrCreate(
            ['kode_supel' => Auth::guard('pelangganweb')->user()->kode],
            ['kode_supel' => Auth::guard('pelangganweb')->user()->kode],
        );

        $data = Keranjang::
                with(['details',
                    'details.item_details:kodeitem,namaitem,merek',
                    'details.item_details.harga_jual' => function ($query) {
                        $query->select('kodeitem','hargajual','satuan'); 
                        $query->where('level', Auth::guard('pelangganweb')->user()->levelharga);
                    }
                    ])
                ->where('kode_supel', Auth::guard('pelangganweb')->user()->kode)
                ->get();
        
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'qty' => 'numeric|gt:0',
        ]);

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

    public function reset()
    {
        $keranjang_id = Keranjang::where('kode_supel', Auth::guard('pelangganweb')->user()->kode)->value('id');
        
        KeranjangDetail::where('keranjang_id', $keranjang_id)->delete();

        return response()->json(['message' => 'Cart reset successfully', 'data' => $keranjang_id]);
    }
}
