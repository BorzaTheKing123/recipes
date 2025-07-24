<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Features\ShowCodesFeature;

class ProfileController extends Controller
{
    public function show(Request $request)
    {   
        return (new ShowCodesFeature($request))->showCodes();
    }

    public function confirm() {
        return view('vendor.two-factor.confirm', ['id' => Auth::id()]);
    }

    public function confirmTwoFactor(Request $request)
    {
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
