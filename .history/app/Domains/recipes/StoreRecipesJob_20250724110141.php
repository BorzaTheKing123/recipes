<?php

namespace App\Domains\recipes;

use Illuminate\Support\Facades\Validator;

class ValidateRecipeJob
{
    public function __construct(public $request)
    {
        //
    }

    public function store (): mixed
    {
        
    }
}