<?php

namespace App\Features\recipes;

use App\Domains\recipes\ValidateRecipeJob;

class validateRecipesInputFeature
{   

    // Spravi 
    public function __construct(private $request)
    {
        //
    }

    public function validate ()
    {
        return (new ValidateRecipeJob($this->request))->handle();
    }
}