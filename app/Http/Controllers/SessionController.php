<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Podatki se ne ujemajo!',
            ]);
        }
        request()->session()->regenerate();

        return redirect('/recipes');
    }

    public function edit(Int $id) {
        if ($id == Auth::id()) {
            return view('auth.profile', ['user' => Auth::user()]);
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
