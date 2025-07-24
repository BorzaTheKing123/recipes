<?php

namespace App\Http\Controllers;

use App\Data\Models\Recipe;
use App\Data\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(User $user) {
        $recipes = Recipe::where('name', 'like', '%' . request('q') . '%')->get();

        return view('results', ['recipes' => $recipes, 'user' => $user]);
    }
}
