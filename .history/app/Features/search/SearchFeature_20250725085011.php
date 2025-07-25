<?php

namespace App\Features\search;

use App\Domains\search\SearchJob;

class SearchFeature
{
    public function __construct(public $user)
    {
        //
    }

    public function handle()
    {
        return (new SearchJob($this->user))->handle();
    }
}