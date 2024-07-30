<?php

namespace App\Services;

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendWhatsAppMessage($to, $message)
    {
        try {
            $from = 'whatsapp:' . env('TWILIO_WHATSAPP_NUMBER');
            $to = 'whatsapp:' . ($to);

            Log::info("Sending WhatsApp message to $to from $from with message: $message");

            $this->twilio->messages->create(
                $to,
                [
                    'from' => $from,
                    'body' => $message,
                ]
            );

            Log::info("WhatsApp message sent to $to: $message");
        } catch (TwilioException $e) {
            Log::error('Error sending WhatsApp message to ' . $to . ': ' . $e->getMessage());
            throw new \Exception('Failed to send WhatsApp message: ' . $e->getMessage());
        }
    }

    private function formatPhoneNumber($phoneNumber)
    {
        if (substr($phoneNumber, 0, 1) !== '+') {
            $phoneNumber = '+' . $phoneNumber;
        }
        return $phoneNumber;
    }
}
