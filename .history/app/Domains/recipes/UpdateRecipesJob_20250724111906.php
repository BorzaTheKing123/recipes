<?php

namespace App\Domains\recipes;

class UpdateRecipesJob
{   
    public function __construct(private $recipe)
    {
        //
    }
    public function update ()
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
}