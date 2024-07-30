<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailService;
use App\Models\Service;
use App\Models\Barang;
use Illuminate\Support\Facades\Mail;
use DB;
use Alert;
use Carbon\Carbon;
use Pdf;


class DetailServiceController extends Controller
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
        $data = DB::table('detail_services')
                    ->join('services', 'services.id', '=', 'detail_services.id_service')
                    ->where('detail_services.id_service','=',$id)
                    ->sum('total');
        $services = $service->update([
            'total_harga'=>$data,
        ]);
        return view('admin.detail_service',compact('detail','service','barang','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function item(string $id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json($barang);
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
            'item' => 'required|string|max:255',
            'satuan' => 'required|string|max:255',
        ]);
        $barang = Barang::find($request->item);
        if($barang->stok==0){
            Alert::error('Gagal','Stok barang tidak ada');
        }else if(($barang->stok)-($request->satuan)<0){
            Alert::error('Gagal','Stok barang tidak cukup');
        }else{
            DetailService::create([
                'id_barang'=>$request->item,
                'satuan'=>$request->satuan,
                'total'=>($request->satuan)*($barang->harga),
                'id_service'=>$request->id_service,
            ]);
            $barang->update([
                'stok'=>$barang->stok-$request->satuan,
            ]);
            Alert::success('Sukses','Berhasil menambahkan detail service');
        }
        return back()->with('success', 'Data kendaraan telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function selesai($id)
    {
        $service = Service::find($id);
        $service->update([
            'status'=>'selesai'
        ]);
        $detail = DetailService::where('id_service',$id)->get();
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
        $data["email"] = $service->kendaraan->pelanggan->user->email;
        $data["title"] = "Invoice";
        $data['total_harga'] = $service->total_harga;
        $data['tanggal'] = Carbon::now();
        $pdf = PDF::loadView('admin.invoice', $data);
        Mail::send('admin.email_invoice', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["email"])
                    ->attachData($pdf->output(), "invoice.pdf")
                    ->subject($data["title"]);
        });

        Alert::success('Sukses','Berhasil menyelesaikan pesanan');
        return back()->with('success','Berhasil selesaikan pesanan');
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
        $detail = DetailService::findOrFail($id);
        $detail->delete();

        return response()->json(['success' => 'Data detail telah dihapus']);
    }
}
