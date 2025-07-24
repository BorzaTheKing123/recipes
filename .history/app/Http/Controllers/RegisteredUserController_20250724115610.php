<?php

namespace App\Http\Controllers;

use App\Features\users\EditusersFeature;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        return (new EditUsersFeature())->store();
    }
}
