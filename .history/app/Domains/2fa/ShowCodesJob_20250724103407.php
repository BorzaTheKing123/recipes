<?php

namespace App\Domains\2fa;

class ShowCodesJob
{
    public function __construct(public $request)
    {
        //
    }

    public function showCodes (): mixed
    {
        $secret = $this->request->user()->createTwoFactorAuth();
        return view('profile.2fa', [
            'qr_code' => $secret->toQr(),     // As QR Code
            'uri'     => $secret->toUri(),    // As "otpauth://" URI.
            'string'  => $secret->toString(), // As a string
        ]);
    }
}