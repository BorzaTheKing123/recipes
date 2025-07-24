<?php

namespace App\Domains\users;

use Illuminate\Support\Facades\Auth;

class LogoutJob
{
    public function logout (): mixed
    {
        Auth::logout();
        return redirect('/');
    }
}