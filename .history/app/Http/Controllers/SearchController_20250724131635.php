<?php

namespace App\Http\Controllers;

use App\Data\Models\User;
use App\Features\search\SearchFeature;

class SearchController extends Controller
{
    public function __invoke(User $user) {
        return (new SearchFeature($user))->search();
    }
}
