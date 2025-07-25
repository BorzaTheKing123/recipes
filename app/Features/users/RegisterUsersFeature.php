<?php

namespace App\Features\users;

use App\Domains\users\RegisterUsersJob;

class RegisterUsersFeature
{
    public function handle ()
    {
        return (new RegisterUsersJob())->handle();
    }
}