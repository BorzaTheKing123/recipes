<?php

namespace App\Http\Controllers;

use App\Features\ConfirmTwoFactorFeature;
use Auth;
use Illuminate\Http\Request;
use App\Features\twofa\ShowCodesFeature;

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
        return (new ConfirmTwoFactorFeature($request))->confirm();
    }
}
