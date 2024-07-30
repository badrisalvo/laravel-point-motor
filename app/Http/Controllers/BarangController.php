<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $kategori = Kategori::all();
        return view('admin.barang', compact('barang','kategori'));
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
            'id_kategori' => 'required',
            'nama_barang' => 'required|string|max:255',
            'merek_barang' => 'required|string|max:255',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'keterangan' => 'required|string|max:255',
        ]);

        Barang::create([
            'id_kategori' => $request->id_kategori,
            'nama_barang' => $request->nama_barang,
            'merek_barang' => $request->merek_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
        ]);
        
        return redirect()->route('barang.index')->with('success', 'Data barang telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json($barang);
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
            'edit_id_kategori' => 'required',
            'edit_nama_barang' => 'required|string|max:255',
            'edit_merek_barang' => 'required|string|max:255',
            'edit_harga' => 'required|integer',
            'edit_stok' => 'required|integer',
            'edit_keterangan' => 'required|string|max:255',
        ]);
        $barang = Barang::findOrFail($id);
        $barang->id_kategori = $request->edit_id_kategori;
        $barang->nama_barang = $request->edit_nama_barang;
        $barang->merek_barang = $request->edit_merek_barang;
        $barang->harga = $request->edit_harga;
        $barang->stok = $request->edit_stok;
        $barang->keterangan = $request->edit_keterangan;
        $barang->save();

        return response()->json($barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json(['success' => 'Data barang telah dihapus']);
    }
}
