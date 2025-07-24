<?php

namespace App\Domains\users;

use Laragear\TwoFactor\Facades\Auth2FA;

class LogoutJob
{
    public function login (): mixed
    {
        Auth::logout();
        return redirect('/');
    }
}