<?php

namespace App\Features\users;

use App\Domains\users\RegisterUserJob;
use App\Domains\users\LoginJob;

class EditusersFeature
{
    public function login ($request)
    {
        return (new LoginJob($request))->login();
    }

    public function store ()
    {
        return (new RegisterUserJob())->store();
    }

    public function update ($recipe)
    {
        return (new UpdateRecipesJob($this->request, $recipe))->update();
    }

    public function destroy () {
        return (new DestroyRecipesJob($this->request))->destroy();
    }
}