<?php

namespace App\Features;

use App\Domains\twofa\ShowCodesJob;

class ShowCodesFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function showCodes ()
    {
        return (new ShowCodesJob($this->request))->showCodes();
    }
}