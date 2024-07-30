<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailService;
use App\Models\Service;
use App\Models\Barang;
use App\Models\Jasa;
use DB;
use Pdf;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $id)
    {
        $detail = DetailService::where('id_service',$id)->get();
        $service = Service::find($id);
        $barang = Barang::all();
        $data2 = DB::table('detail_services')
                    ->join('services', 'services.id', '=', 'detail_services.id_service')
                    ->where('detail_services.id_service','=',$id)
                    ->sum('total');    
        $tanggal= Carbon::now(); 
        $data=[
            'service'=>$service,
            'detail'=>$detail,
            'barang'=>$barang,
            'data2'=>$data2,
            'tanggal'=>$tanggal,
        ];
        $pdf = Pdf::loadview('admin.invoice',$data);
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
