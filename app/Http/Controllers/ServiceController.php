<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Service;
use Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $service = Service::all();
            $kendaraan = Kendaraan::all();
        } else {
            $pelanggan = $user->pelanggan;
            $service = Service::whereHas('kendaraan', function ($query) use ($pelanggan) {
                $query->where('id_pelanggan', $pelanggan->id);
            })->get();
            $kendaraan = Kendaraan::where('id_pelanggan', $pelanggan->id)->get();
        }

        return view('admin.service', compact('service', 'kendaraan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kendaraan' => 'required|string|max:255',
        ]);

        $kendaraan = Kendaraan::where('no_kendaraan', $request->no_kendaraan)->first();
        Service::create([
            'id_kendaraan' => $kendaraan->id,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan telah ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return response()->json($kendaraan);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'edit_jenis_kendaraan' => 'required|string|max:255',
            'edit_merek_kendaraan' => 'required|string|max:255',
            'edit_no_kendaraan' => 'required|string|max:255',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->jenis_kendaraan = $request->edit_jenis_kendaraan;
        $kendaraan->merek_kendaraan = $request->edit_merek_kendaraan;
        $kendaraan->no_kendaraan = $request->edit_no_kendaraan;
        $kendaraan->save();

        return response()->json($kendaraan);
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();
            return response()->json(['success' => 'Data service telah dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}
