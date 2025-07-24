<?php

namespace App\Features;

use App\Domains\twofa\ConfirmTwoFactorJob;

class ConfirmTwoFactorFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function showCodes ()
    {
        return (new ConfirmTwoFactorJob($this->request))->confirm();
    }
}