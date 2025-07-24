<?php

namespace App\Domains\users;

class RegisterUserJobb
{
    public function __construct(private $recipe)
    {
        //
    }

    public function store (): mixed
    {
        $this->recipe->delete();
        return redirect('/recipes');
    }
}