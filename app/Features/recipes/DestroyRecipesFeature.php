<?php

namespace App\Features\recipes;

use App\Domains\recipes\DestroyRecipesJob;

class DestroyRecipesFeature
{   
    public function __construct(private $request)
    {
        //
    }

    public function handle () {
        return (new DestroyRecipesJob($this->request))->handle();
    }
}