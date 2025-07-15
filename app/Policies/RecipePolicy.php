<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class RecipePolicy
{
    public function edit(User $user, Recipe $recipe): bool
    {
        if ($user->id === 1) {
            return true;
        } else {
            return $recipe->user->is($user);
        }
    }

    public function see(User $user, $id): int
    {
        if ($id == 1) {
            return true;
        } else {
            return $id === $user->id;
        }
    }
}
