<?php

namespace App\Features\recipes;

use App\Domains\recipes\UpdateRecipesJob;

class RecipesEditFeature
{   
    public function __construct(private $request)
    {
        //
    }

    public function update ($recipe)
    {
        return (new UpdateRecipesJob($this->request, $recipe))->update();
    }
}