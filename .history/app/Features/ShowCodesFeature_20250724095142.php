<?php

namespace App\Features;

class ShowCodesFeature
{
    public function __construct(public $request)
    {
        $secret = $request->user()->createTwoFactorAuth();
        
        return view('profile.2fa', [
            'qr_code' => $secret->toQr(),     // As QR Code
            'uri'     => $secret->toUri(),    // As "otpauth://" URI.
            'string'  => $secret->toString(), // As a string
        ]);
    }
}