<?php

namespace App\Http\Controllers;

use App\Data\Models\Recipe;
use App\Data\Models\User;
use App\Features\search\SearchFeature;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(User $user) {
        return (new SearchFeature($user))->search();
    }
}
