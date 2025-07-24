<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Http\Request;
use App\Features\ShowCodesFeature;

class ProfileController extends Controller
{
    public function show(Request $request)
    {   
        (new ShowCodesFeature($request))->checkDomain();
        $secret = $request->user()->createTwoFactorAuth();
        
        return view('profile.2fa', [
            'qr_code' => $secret->toQr(),     // As QR Code
            'uri'     => $secret->toUri(),    // As "otpauth://" URI.
            'string'  => $secret->toString(), // As a string
        ]);
    }

    public function confirm() {
        return view('vendor.two-factor.confirm', ['id' => Auth::id()]);
    }

    public function confirmTwoFactor(Request $request)
    {
        //dd($request);
        $request->validate([
            'code' => 'required|numeric'
        ]);
        $activated = $request->user()->confirmTwoFactorAuth($request->code);

        if ($activated) { // Preveri, če je $activated resnično (true)
            return view('profile.recovery', ['codes' => $request->user()->getRecoveryCodes()]);
        }
    
        return 'Try again!';
    }
}
