<?php

namespace App\Features\recipes;

use App\Domains\recipes\StoreRecipesJob;

class StoreRecipesFeature
{   
    public function __construct(private $request)
    {
        //
    }

    public function handle ()
    {
        return (new StoreRecipesJob($this->request))->handle();
    }
}