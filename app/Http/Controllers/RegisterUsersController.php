<?php

namespace App\Http\Controllers;

use App\Features\users\RegisterUsersFeature;

class RegisterUsersController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        return (new RegisterUsersFeature())->handle();
    }
}
