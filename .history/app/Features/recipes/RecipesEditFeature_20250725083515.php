<?php

namespace App\Features\recipes;

use App\Domains\recipes\StoreRecipesJob;
use App\Domains\recipes\UpdateRecipesJob;
use App\Domains\recipes\ValidateRecipeJob;
use App\Domains\recipes\DestroyRecipesJob;

class RecipesEditFeature
{   

    // Spravi 
    public function __construct(private $request)
    {
        //
    }

    public function validate ()
    {
        return (new ValidateRecipeJob($this->request))->validate();
    }
}