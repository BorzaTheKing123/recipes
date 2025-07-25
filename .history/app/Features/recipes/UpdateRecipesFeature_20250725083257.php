<?php

namespace App\Features\recipes;

use App\Domains\recipes\UpdateRecipesJob;

class RecipesEditFeature
{   
    public function __construct(private $request, private $recipe)
    {
        //
    }

    public function update ()
    {
        return (new UpdateRecipesJob($this->request, $this->recipe))->update();
    }
}