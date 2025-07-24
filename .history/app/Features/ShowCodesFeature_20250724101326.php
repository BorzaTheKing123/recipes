<?php

namespace App\Features;

use App\Domains\ShowCodesJob;

class ShowCodesFeature
{
    public function __construct(public $request)
    {
        return (new ShowCodesJob($this->request));
    }
}