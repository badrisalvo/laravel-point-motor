<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Service;
use App\Models\Notifikasi;
use App\Models\Kendaraan;
use Auth;
use Carbon\Carbon;
use App\Mail\ReminderEmail;
use App\Mail\InfoEmail;
use Illuminate\Support\Facades\Mail;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class ReminderController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $service = Service::with('kendaraan.pelanggan.user', 'notifikasi')->get();
            $kendaraan = Kendaraan::all();
            $pelanggan = Pelanggan::all();
        } else {
            $pelanggan = Pelanggan::where('id_user', $user->id)->first();
            $service = Service::with('kendaraan.pelanggan.user', 'notifikasi')
                            ->whereHas('kendaraan', function ($query) use ($pelanggan) {
                                $query->where('id_pelanggan', $pelanggan->id);
                            })->get();
            $kendaraan = Kendaraan::where('id_pelanggan', $pelanggan->id)->get();
        }
    
        return view('admin.notifikasi', compact('pelanggan', 'service', 'kendaraan'));
    }

    public function sendReminders(Request $request)
{
    $notifikasiToSend = Notifikasi::whereDate('remind_at', '<=', Carbon::now())
        ->with('service.kendaraan.pelanggan.user', 'service.detail_service.barang')
        ->get();

    foreach ($notifikasiToSend as $notifikasi) {
        $pelanggan = $notifikasi->service->kendaraan->pelanggan;
        $user = $pelanggan->user;

        Mail::to($user->email)->send(new ReminderEmail($notifikasi));

        $whatsappMessage = "Pengingat Untuk Jadwal Service Kendaraan Anda\n*_Point Motor - Service Reminder_*\n\n";
        $whatsappMessage .= "Halo *{$pelanggan->nama}*,\n\n";
        $whatsappMessage .= "Kami ingin memberitahukan bahwa kendaraan Anda\n*{$notifikasi->service->kendaraan->merek_kendaraan}* - *{$notifikasi->service->kendaraan->no_kendaraan}*\nTelah memasuki jadwal service. Berikut adalah detailnya:\n\n";
        
        if ($notifikasi->service->detail_service->count() > 0) {
            $whatsappMessage .= "Barang yang Perlu Diservice:\n";
            foreach ($notifikasi->service->detail_service as $detailService) {
                $whatsappMessage .= "- {$detailService->barang->nama_barang}\n";
            }
        } else {
            $whatsappMessage .= "Tidak ada barang yang perlu diservice saat ini.\n";
        }

        $whatsappMessage .= "\nHarap segera melakukan service untuk menjaga performa kendaraan Anda.\nTerima Kasih sudah menjadi pelanggan setia Point Motor\nBest Regards";

        try {
            $this->whatsAppService->sendWhatsAppMessage($pelanggan->no_hp, $whatsappMessage);
        } catch (\Exception $e) {
            Log::error('Failed to send WhatsApp message to ' . $pelanggan->no_hp . ': ' . $e->getMessage());
        }

        $notifikasi->update(['sent_at' => Carbon::now()]);
    }

    return back()->with('success', 'Pengingat berhasil dikirim');
}


public function store(Request $request)
{
    $request->validate([
        'id_service' => 'required|exists:services,id',
        'jumlah_hari' => 'required|integer|min:1',
    ]);

    $service = Service::find($request->id_service);
    $tanggal_pengingat = Carbon::now()->addDays($request->jumlah_hari);

    $notifikasi = Notifikasi::where('id_service', $service->id)->first();

    if ($notifikasi) {
        $notifikasi->update([
            'remind_at' => $tanggal_pengingat,
        ]);
    } else {
        $notifikasi = Notifikasi::create([
            'id_service' => $service->id,
            'remind_at' => $tanggal_pengingat,
        ]);
    }

    $pelanggan = $service->kendaraan->pelanggan;
    $user = $pelanggan->user;

    Mail::to($user->email)->send(new InfoEmail($notifikasi));

    $whatsappMessage = "Pengingat Untuk Jadwal Service Kendaraan Anda\n*_Point Motor - Service Reminder_*\n\n";
    $whatsappMessage .= "Halo *{$pelanggan->nama}*, pemilik kendaraan : \n{$notifikasi->service->kendaraan->merek_kendaraan} - {$notifikasi->service->kendaraan->no_kendaraan} \n\n";
    $whatsappMessage .= "Kami ingin memberitahukan bahwa Notifikasi Pengingat telah ditambahkan ke Akun Anda.\nDengan Informasi Service Berikut :\n\n";
    
    if ($notifikasi->service->detail_service->count() > 0) {
        $whatsappMessage .= "Barang yang Perlu Diservice:\n";
        foreach ($notifikasi->service->detail_service as $detailService) {
            $whatsappMessage .= "- *{$detailService->barang->nama_barang}*\n";
        }
    } else {
        $whatsappMessage .= "Tidak ada barang yang perlu diservice saat ini.\n";
    }

    $whatsappMessage .= "\nTerima Kasih sudah menjadi pelanggan setia Point Motor\nBest Regards";

    try {
        $this->whatsAppService->sendWhatsAppMessage($pelanggan->no_hp, $whatsappMessage);
    } catch (\Exception $e) {
        Log::error('Failed to send WhatsApp message to ' . $pelanggan->no_hp . ': ' . $e->getMessage());
    }

    return back()->with('success', 'Pengingat berhasil diatur dan email dikirim');
}

}
