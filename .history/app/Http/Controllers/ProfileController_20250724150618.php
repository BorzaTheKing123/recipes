<?php

namespace App\Http\Controllers;

use App\Features\twofa\ConfirmTwoFactorFeature;
use Auth;
use Illuminate\Http\Request;
use App\Features\twofa\ShowCodesFeature;

class ProfileController extends Controller
{
    public function show(Request $request)
    {   
        return (new Show2faCodesFeature($request))->handle();
    }

    public function confirm() {
        return view('vendor.two-factor.confirm', ['id' => Auth::id()]);
    }

    public function confirmTwoFactor(Request $request)
    {
        return (new ConfirmTwoFactorFeature($request))->handle();
    }
}
