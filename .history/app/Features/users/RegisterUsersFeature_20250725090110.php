<?php

namespace App\Features\users;

use App\Domains\users\RegisterUserJob;
use App\Domains\users\LoginJob;
use App\Domains\users\LogoutJob;

class RegisterUsersFeature
{
    public function login ($request)
    {
        return (new LoginJob($request))->login();
    }

    public function handle ()
    {
        return (new RegisterUserJob())->handle();
    }

    public function logout () {
        return (new LogoutJob())->logout();
    }
}