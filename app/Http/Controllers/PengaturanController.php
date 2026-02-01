<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('admin_pengaturan.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico',
            'nama_perusahaan' => 'required|max:255',
            'tampil_stok' => 'required',
        ]);
        
        $faviconFileName = null;
        $favicon = $request->file('favicon');
        if (!is_null($favicon)) {
            $faviconPath = public_path('uploads/favicon');
            $faviconFileName = $favicon->getClientOriginalName();
            $favicon->move($faviconPath, $faviconFileName);
        }     
        
        $logoFileName = null;
        $logo = $request->file('logo');
        if (!is_null($logo)) {
            $logoPath = public_path('uploads/logo');
            $logoFileName = $logo->getClientOriginalName();
            $logo->move($logoPath, $logoFileName);
        }      

        $data = [
            'favicon' => ['value' => $faviconFileName],
            'logo' => ['value' => $logoFileName],
            'nama_perusahaan' => ['value' => $request->nama_perusahaan],
            'tampil_stok' => ['value' => $request->tampil_stok],
            'guest_kode' => ['value' => $request->guest_kode]
        ];
        
        foreach ($data as $id => $d) {
            $pengaturan = Pengaturan::find($id);
            if ($pengaturan) {
                if (!is_null($d['value'])) {
                    $pengaturan->fill($d);
                    $pengaturan->save();
                }    
            }
        }

        return to_route('pengaturan')->with('success', 'Data updated successfully!');
    }
}
