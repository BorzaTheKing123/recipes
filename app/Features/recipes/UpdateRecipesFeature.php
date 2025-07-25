<?php

namespace App\Features\recipes;

use App\Domains\recipes\UpdateRecipesJob;

class UpdateRecipesFeature
{   
    public function __construct(private $request, private $recipe)
    {
        //
    }

    public function handle ()
    {
        return (new UpdateRecipesJob($this->request, $this->recipe))->handle();
    }
}