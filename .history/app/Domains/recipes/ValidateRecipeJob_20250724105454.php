<?php

namespace App\Domains\recipes;

use Illuminate\Support\Facades\Validator;

class ValidateRecipeJob
{
    public function __construct(public $request)
    {
        //
    }

    public function validate (): mixed
    {
        $categories = ["Stranske jedi", "Glavne jedi", "Sladice", "Pijača"];
        $validator = Validator::make($this->request->all(), [
            'ingredients' => 'required|array|min:1',
            'name' => ['required', 'string', 'min:3'],
            'recipe' => ['required', 'string'],
            'category' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect('back')->withErrors($validator)->withInput();
        }

        if (!in_array($this->request->category, $categories)) {
            return redirect('back')->withErrors(['category' => 'Neveljavna kategorija'])->withInput();
        }

        foreach ($this->request->ingredients as $key => $ingredient) {
            if (!(is_numeric($key) && !is_numeric($ingredient) && strlen(strval($ingredient)) > 1)) {
                return redirect('back')->withErrors(['ingredients' => 'Neveljavna sestavina'])->withInput();
            }
        }

        $return = [];
        $ingredientLine = [];
        foreach ($this->request->all() as $key => $line) {
            if (gettype($line) != 'string' && $key === 'ingredients') {
                foreach ($line as $ingredient) {
                    $ingredientLine[] = htmlspecialchars($ingredient);
                }
                $return['ingredients'] = $ingredientLine;
            } elseif (gettype($line) == 'string') {
                $return[$key] = htmlspecialchars($line);
            } else {
                return redirect('back')->withErrors(['input' => 'Neveljaven vnos!'])->withInput();
            }
        }

        return $return;
    }
}