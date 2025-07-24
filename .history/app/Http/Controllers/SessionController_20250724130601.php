<?php

namespace App\Http\Controllers;

use App\Features\users\EditusersFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        return (new EditusersFeature())->login($request);
    }

    public function edit(Int $id) {
        if ($id == Auth::id()) {
            return view('auth.profile', ['user' => Auth::user()]);
        }
    }

    public function destroy()
    {
        return (new EditusersFeature())->logout();
    }
}
