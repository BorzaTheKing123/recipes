<?php

namespace App\Domains\users;

use Illuminate\Support\Facades\Auth;

class LogoutJob
{
    public function handle(): mixed
    {
        Auth::logout();
        return redirect('/');
    }
}