<?php

namespace App\Features\twofa;

use App\Domains\twofa\Show2faCodesJob;

class Show2faCodesFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function handle()
    {
        return (new Show2faCodesJob($this->request))->handle();
    }
}