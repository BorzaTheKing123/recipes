<?php

namespace App\Features\twofa;

use App\Domains\twofa\ConfirmTwoFactorJob;

class ConfirmTwoFactorFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function handle()
    {
        return (new ConfirmTwoFactorJob($this->request))->handle();
    }
}