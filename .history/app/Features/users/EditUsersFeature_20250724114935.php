<?php

namespace App\Features\recipes;

class RecipesEditFeature
{
    public function __construct(private $request)
    {
        //
    }

    public function validate ()
    {
        return (new ValidateRecipeJob($this->request))->validate();
    }

    public function store ()
    {
        return (new StoreRecipesJob($this->request))->store();
    }

    public function update ($recipe)
    {
        return (new UpdateRecipesJob($this->request, $recipe))->update();
    }

    public function destroy () {
        return (new DestroyRecipesJob($this->request))->destroy();
    }
}