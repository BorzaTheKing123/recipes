<?php

namespace App\Features\recipes;

use App\Domains\recipes\DestroyRecipesJob;

class RecipesEditFeature
{   
    public function __construct(private $request)
    {
        //
    }

    public function handle () {
        return (new DestroyRecipesJob($this->request))->destroy();
    }
}