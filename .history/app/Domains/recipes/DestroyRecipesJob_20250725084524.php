<?php

namespace App\Domains\recipes;

class DestroyRecipesJob
{
    public function __construct(private $recipe)
    {
        //
    }

    public function handle (): mixed
    {
        $this->recipe->delete();
        return redirect('/recipes');
    }
}