<?php

namespace App\Domains\twofa;

class Show2faCodesJob
{
    public function __construct(public $request)
    {
        //
    }

    public function handle(): mixed
    {
        $secret = $this->request->user()->createTwoFactorAuth();
        return view('profile.2fa', [
            'qr_code' => $secret->toQr(),     // As QR Code
            'uri'     => $secret->toUri(),    // As "otpauth://" URI.
            'string'  => $secret->toString(), // As a string
        ]);
    }
}