<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laragear\TwoFactor\Facades\Auth2FA;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // If the user is trying for the first time, ensure both email and the password are
        // required to log in. If it's not, then he would issue its 2FA code. This ensures
        // the credentials are not required again when is just issuing his 2FA code alone.
        if ($request->isNotFilled('2fa_code')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);
        }
        
        $attempt = Auth2FA::attempt($request->only('email', 'password'), $request->filled('remember'));
        
        if ($attempt) {
            request()->session()->regenerate();
            return redirect('/');
        }
        
        return back()->withErrors(['email' => 'There is no existing user for these credentials']);
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
