<?php

namespace App\Domains\users;

use Illuminate\Validation\Rules\Password;
use App\Data\Models\User;

class RegisterUserJobb
{
    public function __construct(private $recipe)
    {
        //
    }

    public function store (): mixed
    {
        $attributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(6), 'confirmed']
        ]);

        $attributes['name'] = htmlspecialchars($attributes['name']);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/recipes');
    }
}