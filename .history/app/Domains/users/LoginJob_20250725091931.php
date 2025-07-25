<?php

namespace App\Domains\users;

use Laragear\TwoFactor\Facades\Auth2FA;

class LoginJob
{   
    public function __construct(private $request)
    {
        //
    }

    public function handle(): mixed
    {
        // If the user is trying for the first time, ensure both email and the password are
        // required to log in. If it's not, then he would issue its 2FA code. This ensures
        // the credentials are not required again when is just issuing his 2FA code alone.
        if ($this->request->isNotFilled('2fa_code')) {
            $this->request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);
        }
        
        $attempt = Auth2FA::attempt($this->request->only('email', 'password'), $this->request->filled('remember'));
        
        if ($attempt) {
            request()->session()->regenerate();
            return redirect('/');
        }
        
        return back()->withErrors(['email' => 'There is no existing user for these credentials']);
    }
}