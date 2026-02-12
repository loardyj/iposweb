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
                    },
                    'details.item_details.stok' => function ($query) {
                        $query->select('kodeitem','kantor','stok'); 
                        $query->where('kantor', Auth::guard('pelangganweb')->user()->kodeKantor);
                    }
                    ])
                ->where('kode_supel', Auth::guard('pelangganweb')->user()->kode)
                ->get();
        
        
        
        $text = "Halo kami,<br>";
        // $text .= 
        $text .= '[' . Auth::guard('pelangganweb')->user()->kode . '] - ' . Auth::guard('pelangganweb')->user()->nama;
        $total = 0;
        $display_order = true;

        $display_PO = true;
        $textPO = '';
        $totalPO = 0;

        foreach ($data[0]['details'] as $d) {
            $satuan = ucwords(strtolower($d->item_details->harga_jual[0]->satuan));
            $qty = $d->qty;
            $hargajual = $d->item_details->harga_jual[0]->hargajual;            

            $strHargaJual = number_format($d->item_details->harga_jual[0]->hargajual, 0, ',', '.');            

            // $text .= '- ' . $qty . ' ' . $satuan . ' [' 
            //         . $d->item_details->kodeitem . '] ' 
            //         . $d->item_details->namaitem 
            //         . ' @Rp' . $strHargaJual . '<br>';
            if (count($d->item_details->stok) !== 0 && $d->item_details->stok[0]->stok > 0) {
                if ($display_order) {
                    $text .= "<br><br>Mau Order:";
                    $display_order = false;
                }

                $realQty = $qty;
                if ($qty > $d->item_details->stok[0]->stok) {
                    $realQty = (int)$d->item_details->stok[0]->stok;
                }

                $text .= '<br>- ' . $realQty . ' ' . $satuan . ' [' 
                        . $d->item_details->kodeitem . '] ' 
                        . $d->item_details->namaitem 
                        . ' @Rp' . $strHargaJual;

                $subtotal = $realQty * $hargajual;
                $total += $subtotal;

                if ($qty > $d->item_details->stok[0]->stok) {
                    $sisaQtyPO = $qty - $d->item_details->stok[0]->stok;
                    if ($display_PO) {
                        $textPO .= "<br><br>Mau PreOrder:";
                        $display_PO = false;
                    }
                    $textPO .= '<br>- ' . $sisaQtyPO . ' ' . $satuan . ' [' 
                                . $d->item_details->kodeitem . '] ' 
                                . $d->item_details->namaitem 
                                . ' @Rp' . $strHargaJual;
                    $subtotal = $sisaQtyPO * $hargajual;
                    $totalPO += $subtotal;
                }
            } else {
                if ($display_PO) {
                    $textPO .= "<br><br>Mau PreOrder:";
                    $display_PO = false;
                }
                $textPO .= '<br>- ' . $qty . ' ' . $satuan . ' [' 
                            . $d->item_details->kodeitem . '] ' 
                            . $d->item_details->namaitem 
                            . ' @Rp' . $strHargaJual;
                $subtotal = $qty * $hargajual;
                $totalPO += $subtotal;
            }
            
            // if (count($d->item_details->stok) !== 0 && $d->item_details->stok[0]->stok > 0) { // jika ada stok
            //     if ($display_order) {
            //         $text .= "<br><br>Mau Order:";
            //         $display_order = false;
            //     }
            //     $text .= '<br>- ' . $qty . ' ' . $satuan . ' [' 
            //             . $d->item_details->kodeitem . '] ' 
            //             . $d->item_details->namaitem 
            //             . ' @Rp' . $strHargaJual;

            //     $subtotal = $qty * $hargajual;
            //     $total += $subtotal;
            // } else {
            //     if ($display_PO) {
            //         $textPO .= "<br><br>Mau PreOrder:";
            //         $display_PO = false;
            //     }
            //     $textPO .= '<br>- ' . $qty . ' ' . $satuan . ' [' 
            //                 . $d->item_details->kodeitem . '] ' 
            //                 . $d->item_details->namaitem 
            //                 . ' @Rp' . $strHargaJual;
            //     $subtotal = $qty * $hargajual;
            //     $totalPO += $subtotal;
            // }
        }

        $totalText = '';
        if (count($data[0]['details']) > 0) {
            $totalAll = $total + $totalPO;

            if (!$display_order) {
                $totalText .= '<br>Total Order: Rp' . number_format($total, 0, ',', '.');
            }

            if (!$display_PO) {
                $totalText .= '<br>Total PreOrder: Rp' . number_format($totalPO, 0, ',', '.');
            }
            
            if (!$display_order && !$display_PO) {
                $totalText .= '<br>Total All: Rp' . number_format($totalAll, 0, ',', '.');
            }            
        } else {
            $totalText .= "<br>Mau Order:<br>";
        }

        $sendText = $text . $textPO . '<br>' . $totalText;

        // echo $sendText;

        $textWA = str_replace('<br>', "\n", $sendText);

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

        $data = Keranjang::query()
                ->with(['details',
                    'details.item_details:kodeitem,namaitem,merek',
                    'details.item_details.harga_jual' => function ($query) {
                        $query->select('kodeitem','hargajual','satuan'); 
                        $query->where('level', Auth::guard('pelangganweb')->user()->levelharga);
                    },
                    'details.item_details.stok' => function ($query) {
                        $query->select('kodeitem','kantor','stok'); 
                        $query->where('kantor', Auth::guard('pelangganweb')->user()->kodeKantor);
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

        try {
            if (Auth::guard('pelangganweb')->user()->kode == config('settings.guest_kode')) {
                return response()->json(['message' => 'Tamu/Guest Tidak Dapat Menggunakan Fitur Ini!'], 401);
            }

            DB::beginTransaction();

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
