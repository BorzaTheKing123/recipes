<?php

namespace App\Features\twofa;

use App\Domains\twofa\ShowCodesJob;

class ShowCodesFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function handle()
    {
        return (new ShowCodesJob($this->request))->handle();
    }
}