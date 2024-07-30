<?php

namespace App\Mail;

use App\Models\Notifikasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InfoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $notifikasi;

    public function __construct(Notifikasi $notifikasi)
    {
        $this->notifikasi = $notifikasi;
    }

    public function build()
    {
        return $this->subject('Pengingat Service Kendaraan')
                    ->view('emails.info');
    }
}
