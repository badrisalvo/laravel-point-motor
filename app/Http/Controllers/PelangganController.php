<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function index()
    {

        $user = Auth::user(); 
        if ($user->role === 'admin') {
            $pelanggan = Pelanggan::with('user')->get();
        } else {
            $pelanggan = Pelanggan::with('user')->where('id_user', $user->id)->get();
        }

        return view('admin.pelanggan', compact('pelanggan'));
    }

    public function home()
    {
        $user = Auth::user(); 
        if ($user->role === 'admin') {
            $pelanggan = Pelanggan::with('user')->get();
        } else {
  
            $pelanggan = Pelanggan::with('user')->where('id_user', $user->id)->get();
        }
        return view('admin.home', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $pelanggan = Pelanggan::create([
            'id_user' => $user->id,
            'nama' => $validated['nama'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
        ]);

        return response()->json($pelanggan, 201);
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::with('user')->find($id);
    
        if ($pelanggan) {
            return response()->json($pelanggan);
        }
    
        return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_nama' => 'required|string|max:255',
            'edit_email' => 'required|email|max:255',
            'edit_no_hp' => 'required|string|max:15',
            'edit_alamat' => 'required|string|max:255',
        ]);
    
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->nama = $request->edit_nama;
            $pelanggan->user->email = $request->edit_email;
            $pelanggan->no_hp = $request->edit_no_hp;
            $pelanggan->alamat = $request->edit_alamat;
    
            if ($request->filled('edit_password')) {
                $pelanggan->user->password = bcrypt($request->edit_password);
            }
    
            $pelanggan->push();
    
            return response()->json($pelanggan);
        } catch (\Exception $e) {
            Log::error('Error updating pelanggan: '.$e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memperbarui pelanggan.'], 500);
        }
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->user()->delete();
        $pelanggan->delete();

        return response()->json(['message' => 'Pelanggan berhasil dihapus.']);
    }
}
