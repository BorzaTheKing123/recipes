<?php

namespace App\Domains\recipes;

class UpdateRecipesJob
{   
    public function __construct(private $request, private $recipe)
    {
        //
    }
    public function handle()
    {
        $categories = ["Stranske jedi", "Glavne jedi", "Sladice", "Pijača"];

        if (is_array($this->request)) {
            $belonging = $this->request['category'];
            $ingredients = join('<', $this->request['ingredients']);
            $this->recipe->update([
                'belonging' => (array_search($belonging, $categories) + 1), // Connected to category
                'name' => $this->request['name'],
                'ingredients' => $ingredients,
                'recipe' => $this->request['recipe'],
                'updated_at' => now()
            ]);
            return redirect('/recipes/' . $this->recipe->id);
        } else {
            return redirect('/recipes/' . $this->recipe->id . '/edit');
        }
    }
}