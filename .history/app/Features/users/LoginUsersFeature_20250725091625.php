<?php

namespace App\Features\users;

use App\Domains\users\LoginJob;

class LoginUsersFeature
{
    public function __construct(private $request)
    {
        
    }
    public function handle()
    {
        return (new LoginJob($this->request))->handle();
    }
}