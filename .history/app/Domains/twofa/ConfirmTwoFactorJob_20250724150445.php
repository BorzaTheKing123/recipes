<?php

namespace App\Domains\twofa;

class ConfirmTwoFactorJob
{
    public function __construct(public $request)
    {
        //
    }

    public function handle (): mixed
    {
        $this->request->validate(['code' => 'required|numeric' ]);
        $activated = $this->request->user()->confirmTwoFactorAuth($this->request->code);

        if ($activated) { // Preveri, če je $activated resnično (true)
            return view('profile.recovery', ['codes' => $this->request->user()->getRecoveryCodes()]);
        }
        return 'Try again!';
    }
}