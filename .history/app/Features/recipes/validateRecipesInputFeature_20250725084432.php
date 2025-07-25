<?php

namespace App\Features\recipes;

use App\Domains\recipes\ValidateRecipeJob;

class ValidateRecipesInputFeature
{   

    // Spravi 
    public function __construct(private $request)
    {
        //
    }

    public function handle ()
    {
        return (new ValidateRecipeJob($this->request))->handle();
    }
}