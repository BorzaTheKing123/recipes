<?php

namespace App\Features\recipes;

use App\Domains\recipes\ValidateRecipeJob;

class RecipesEditFeature
{
    public function __construct(public $request)
    {
        //
    }

    public function confirm ()
    {
        return (new ConfirmTwoFactorJob($this->request))->confirm();
    }
}