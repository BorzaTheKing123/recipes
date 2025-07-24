<?php

namespace App\Http\Controllers;

use App\Mail\RecipePosted;
use App\Data\Models\RecipeTag;
use App\Data\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Data\Models\Recipe;
use App\Features\recipes\RecipesEditFeature;

class RecipesController extends Controller
{
    public function validateRecipe(Request $request)
    {
        return (new RecipesEditFeature($request))->validate();
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
        return (new RecipesEditFeature(RecipesController::validateRecipe(request())))->store();
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function update(Recipe $recipe)
    {   
        return (new RecipesEditFeature(RecipesController::validateRecipe(request())))
                ->update($recipe);
    }

    public function destroy(Recipe $recipe)
    {
        return (new RecipesEditFeature())->destroy();
    }
}
