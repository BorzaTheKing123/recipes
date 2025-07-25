<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Features\users\LoginUsersFeature;
use App\Features\users\LogoutUsersFeature;

class LoginedUserController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        return (new LoginUsersFeature($request))->handle();
    }

    public function edit(Int $id) {
        if ($id == Auth::id()) {
            return view('auth.profile', ['user' => Auth::user()]);
        }
    }

    public function destroy()
    {
        return (new LogoutUsersFeature())->logout();
    }
}
