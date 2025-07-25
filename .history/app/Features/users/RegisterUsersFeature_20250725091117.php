<?php

namespace App\Features\users;

use App\Domains\users\RegisterUserJob;

class RegisterUsersFeature
{

    public function handle ()
    {
        return (new RegisterUserJob())->handle();
    }
}