<?php

namespace App\Features\search;

use App\Domains\search\SearchJob;

class SearchFeature
{
    public function __construct(public $user)
    {
        //
    }

    public function search()
    {
        return (new SearchJob($this->user))->search();
    }
}