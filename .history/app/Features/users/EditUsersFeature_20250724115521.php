<?php

namespace App\Features\users;

use App\Domains\users\RegisterUserJobb;

class EditusersFeature
{
    public function validate ()
    {
        return (new ValidateRecipeJob($this->request))->validate();
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