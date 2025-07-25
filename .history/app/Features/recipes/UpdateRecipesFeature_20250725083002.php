<?php

namespace App\Features\recipes;

use App\Domains\recipes\StoreRecipesJob;
use App\Domains\recipes\UpdateRecipesJob;
use App\Domains\recipes\ValidateRecipeJob;
use App\Domains\recipes\DestroyRecipesJob;

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