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
        return (new RecipesEditFeature(request()))->store();
        $categories = ["Stranske jedi", "Glavne jedi", "Sladice", "Pijača"];
        $request = RecipesController::validateRecipe(request());
        if (is_array($request)) {
            $user = Auth::user();
            $ingredients = join('<', $request['ingredients']);
            $belonging = $request['category'];
            $recipe = Recipe::create([
                'belonging' => (array_search($belonging, $categories)+1),
                'user_id' => $user->id,
                'name' => $request['name'],
                'ingredients' => $ingredients,
                'recipe' => $request['recipe'],
                'updated_at' => now()
            ]);

            RecipeTag::create([
                'recipes_id' => $recipe->id,
                'tag_id' => (array_search($belonging, $categories)+1),
            ]);

            Mail::to($recipe->user)->queue(new RecipePosted($recipe));
            return redirect('/recipes');
        } else {
            return redirect('/recipes/create');
        }
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function update(Recipe $recipe)
    {
        $categories = ["Stranske jedi", "Glavne jedi", "Sladice", "Pijača"];
        $request = RecipesController::validateRecipe(request());

        if (is_array($request)) {
            $belonging = $request['category'];
            $ingredients = join('<', $request['ingredients']);
            $recipe->update([
                'belonging' => (array_search($belonging, $categories) + 1), // Connected to category
                'name' => $request['name'],
                'ingredients' => $ingredients,
                'recipe' => $request['recipe'],
                'updated_at' => now()
            ]);
            return redirect('/recipes/' . $recipe->id);
        } else {
            return redirect('/recipes/' . $recipe->id . '/edit');
        }
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/recipes');
    }
}
