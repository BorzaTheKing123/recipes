<?php

namespace App\Features\users;

use App\Domains\users\LogoutJob;

class RegisterUsersFeature
{
    public function handle() {
        return (new LogoutJob())->logout();
    }
}