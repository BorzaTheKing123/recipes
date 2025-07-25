<?php

namespace App\Features\users;

use App\Domains\users\LogoutJob;

class LogoutUsersFeature
{
    public function handle() {
        return (new LogoutJob())->logout();
    }
}