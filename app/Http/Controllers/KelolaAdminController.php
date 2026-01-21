<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Symfony\Component\HttpFoundation\RedirectResponse;

class KelolaAdminController extends Controller
{
    public function index()
    {
        return view('admin_user.index');
    }

    public function json()
    {
        $model = User::orderBy('status')
                ->orderBy('id')
                ->get();

        return DataTables::of($model)->toJson();
    }

    public function json_show($id)
    {
        $model = User::findOrFail($id);

        return response()->json($model);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|unique:users',
            'password' => 'required',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);
    
        // Insert data into the database
        User::create($validatedData);
        
        // Redirect the user
        return to_route('kelola_admin')->with('success', 'Data added successfully!');
    }

    public function update(Request $request)
    {
        
        // 1. Validate the request data
        $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|unique:users,username,' . $request->id,
            // 'password' => 'required',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);                
        
        // 2. Find the item
        $data = User::findOrFail($request->id);

        // skip null
        $request = array_filter($request->all());

        // 3. Update the item attributes
        $data->update($request);

        // 4. Redirect the user with a success message
        return to_route('kelola_admin')->with('success', 'Data updated successfully!');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return to_route('kelola_admin')->with('success', 'Data deleted successfully.');
    }

    
}
