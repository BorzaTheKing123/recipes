<?php

namespace App\Domains\recipes;

class UpdateRecipesJob
{   
    public function __construct(private $recipe)
    {
        //
    }
    public function update ()
    {
        $categories = ["Stranske jedi", "Glavne jedi", "Sladice", "Pijača"];
    }
}