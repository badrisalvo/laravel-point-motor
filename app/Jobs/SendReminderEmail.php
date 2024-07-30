<?php

namespace App\Mail;

use App\Models\Notifikasi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $now = Carbon::now()->startOfMinute();
        $notifikasis = Notifikasi::where('remind_at', $now)->get();

        foreach ($notifikasis as $notifikasi) {
            $service = $notifikasi->service;
            $pelanggan = $service->kendaraan->pelanggan;
            $user = $pelanggan->user;

            Mail::to($user->email)->send(new InfoEmail($notifikasi));
        }
    }
}
