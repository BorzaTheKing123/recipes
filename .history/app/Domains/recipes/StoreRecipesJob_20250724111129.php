<?php

namespace App\Domains\recipes;

use App\Data\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class StoreRecipesJob
{
    public function __construct(private $request)
    {
        //
    }

    public function store (): mixed
    {
        $categories = ["Stranske jedi", "Glavne jedi", "Sladice", "Pijača"];
        if (is_array($this->request)) {
            $user = Auth::user();
            $ingredients = join('<', $this->request['ingredients']);
            $belonging = $this->request['category'];
            $recipe = Recipe::create([
                'belonging' => (array_search($belonging, $categories)+1),
                'user_id' => $user->id,
                'name' => $this->request['name'],
                'ingredients' => $ingredients,
                'recipe' => $this->request['recipe'],
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
}