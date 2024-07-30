<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailService;
use App\Models\Service;
use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang= Barang::all();
        $pelanggan = Pelanggan::all();
        $service = Service::all();
        $kendaraan = Kendaraan::all();
        return view('admin.laporan',compact('barang','pelanggan','service','kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pelanggan(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;
        $pelanggan = Pelanggan::whereBetween('created_at',["$tgl_mulai 00:00","$tgl_akhir 23:59"])->get();
        $data = [
            'pelanggan'=>$pelanggan,
            'tgl_mulai'=>$tgl_mulai,
            'tgl_akhir'=>$tgl_akhir,
            // 'date'=>$date
        ];
        $pdf = Pdf::loadview('admin.laporan.pelanggan',$data);
        return $pdf->stream();
    }

    public function service(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;
        $service = Service::whereBetween('created_at',["$tgl_mulai 00:00","$tgl_akhir 23:59"])->get();
        $data = [
            'service'=>$service,
            'tgl_mulai'=>$tgl_mulai,
            'tgl_akhir'=>$tgl_akhir,
        ];
        $pdf = Pdf::loadview('admin.laporan.service',$data);
        return $pdf->stream();
    }

    public function barang(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;
        $barang = Barang::whereBetween('created_at',["$tgl_mulai 00:00","$tgl_akhir 23:59"])->get();
        $data = [
            'barang'=>$barang,
            'tgl_mulai'=>$tgl_mulai,
            'tgl_akhir'=>$tgl_akhir,
        ];
        $pdf = Pdf::loadview('admin.laporan.barang',$data);
        return $pdf->stream();
    }

    public function kendaraan(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_akhir = $request->tgl_akhir;
        $kendaraan = Kendaraan::whereBetween('created_at',["$tgl_mulai 00:00","$tgl_akhir 23:59"])->get();
        $data = [
            'kendaraan'=>$kendaraan,
            'tgl_mulai'=>$tgl_mulai,
            'tgl_akhir'=>$tgl_akhir,
        ];
        $pdf = Pdf::loadview('admin.laporan.kendaraan',$data);
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
