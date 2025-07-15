<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::get('/recipes', [RecipesController::class, 'index']);
Route::get('/recipes/create', [RecipesController::class, 'create']);
Route::post('/recipes', [RecipesController::class, 'store'])->middleware('auth');
Route::get('/recipes/{recipe}', [RecipesController::class, 'show']);
Route::get('/search', SearchController::class);

Route::get('/recipes/{recipe}/edit', [RecipesController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'recipe');

Route::patch('/recipes/{recipe}', [RecipesController::class, 'update'])
    ->middleware('auth')
    ->can('edit', 'recipe');

Route::delete('/recipes/{recipe}', [RecipesController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit', 'recipe');


Route::get("/register", [RegisteredUserController::class, 'create']); // Imena kontrolerjev so poljubna
Route::post("/register", [RegisteredUserController::class, 'store']);
Route::get("/login", [SessionController::class, 'create'])->name('login');
Route::post("/login", [SessionController::class, 'store'])->middleware('throttle:6,1');
Route::post("/logout", [SessionController::class, 'destroy']);

Route::get('/profile/{id}', [SessionController::class, 'edit'])
    ->name('edit')
    ->middleware('auth');
