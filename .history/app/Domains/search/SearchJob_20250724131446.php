<?php

namespace App\Domains\search;

use App\Data\Models\Recipe;

class SearchJob
{
    public function __construct(private $user)
    {
        //
    }

    public function search()
    {
        $recipes = Recipe::where('name', 'like', '%' . request('q') . '%')->get();
        return view('results', ['recipes' => $recipes, 'user' => $this->user]);
    }
}