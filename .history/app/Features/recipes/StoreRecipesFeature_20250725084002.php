public function store ()
    {
        
    }
<?php

namespace App\Features\recipes;

use App\Domains\recipes\UpdateRecipesJob;

class StoreRecipesFeature
{   
    public function __construct(private $request, private $recipe)
    {
        //
    }

    public function handle ()
    {
        return (new StoreRecipesJob($this->request))->handle();
    }
}