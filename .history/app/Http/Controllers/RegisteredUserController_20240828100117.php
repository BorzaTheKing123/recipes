<?php

namespace App\Http\Controllers;

use App\Data\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUsersController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
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
