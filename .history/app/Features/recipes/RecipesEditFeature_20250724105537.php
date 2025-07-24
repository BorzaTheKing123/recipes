<?php

namespace App\Features\recipes;

use App\Domains\recipes\ValidateRecipeJob;

class RecipesEditFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function validate ()
    {
        return (new ValidateRecipeJob($this->request))->validate();
    }
}