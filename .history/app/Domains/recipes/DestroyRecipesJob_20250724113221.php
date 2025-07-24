<?php

namespace App\Domains\recipes;

class DestroyRecipesJob
{
    public function __construct(private $recipe)
    {
        //
    }

    public function destroy ()
    {
        $this->recipe->delete();
        return redirect('/recipes');
    }
}