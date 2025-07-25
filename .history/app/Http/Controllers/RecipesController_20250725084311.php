<?php

namespace App\Http\Controllers;

use App\Data\Models\User;
use Illuminate\Http\Request;
use App\Data\Models\Recipe;
use App\Features\recipes\validateRecipesInputFeature;
use App\Features\recipes\StoreRecipesFeature;
use App\Features\recipes\UpdateRecipesFeature;

class RecipesController, UpdateRecipesFeatureextends Controller
{
    public function validateRecipe(Request $request)
    {
        return (new validateRecipesInputFeature($request))->handle();
    }

    public function index()
    {
        $recipes = Recipe::paginate(10); // Pazi na lazy loading pri večjih aplikacijah
        return view('recipes.index', [
            'recipes' => $recipes,
            'user' => User::all('name', 'id'),
        ]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', ['recipe' => $recipe]);
    }

    public function store()
    {   
        return (new StoreRecipesFeature(RecipesController::validateRecipe(request())))->handle();
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function update(Recipe $recipe)
    {   
        return (new UpdateRecipesFeature(RecipesController::validateRecipe(request()), $recipe))
                ->handle();
    }

    public function destroy(Recipe $recipe)
    {
        return (new RecipesEditFeature($recipe))->handle();
    }
}
