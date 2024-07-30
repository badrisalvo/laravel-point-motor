<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Pelanggan;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $kendaraan = Kendaraan::all();
        } else {
            $pelanggan = Pelanggan::where('id_user', $user->id)->first();
            $kendaraan = Kendaraan::where('id_pelanggan', $pelanggan->id)->get();
        }
        
        return view('admin.kendaraan', compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required|string|max:255',
            'merek_kendaraan' => 'required|string|max:255',
            'no_kendaraan' => 'required|string|max:255',
        ]);

        $pelanggan = Pelanggan::where('id_user', Auth::id())->first();

        Kendaraan::create([
            'id_pelanggan' => $pelanggan->id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'merek_kendaraan' => $request->merek_kendaraan,
            'no_kendaraan' => $request->no_kendaraan,
        ]);

        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan telah ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $kendaraan = Kendaraan::findOrFail($id);
        return response()->json($kendaraan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus data kendaraan yang dipilih
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return response()->json(['success' => 'Data kendaraan telah dihapus']);
    }
}
