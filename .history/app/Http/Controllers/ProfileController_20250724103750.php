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
        
    }
}
