<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Data\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Controllers\ProfileController; 

Route::middleware(['auth', 'two-factor-protected'])->group(function () {
    // Te poti so zaščitene in zahtevajo, da je 2FA seje že potrjena
    Route::get('/recipes', function () {
        return view('recipes'); // Ali kateri koli pogled vašega 'dashboarda'
    })->name('recipes');
});

// Route::middleware(['auth', 'two-factor'])->group(function () {
//     // Te poti so za upravljanje 2FA in vas preusmerijo na izziv, če 2FA ni potrjen
//     Route::get('/profile/security', [ProfileController::class, 'showSecurity'])->name('profile.security');
//     Route::post('/profile/security/enable', [ProfileController::class, 'enableTwoFactor'])->name('two-factor.enable');
//     Route::post('/profile/security/disable', [ProfileController::class, 'disableTwoFactor'])->name('two-factor.disable');
//     Route::post('/profile/security/generate-recovery-codes', [ProfileController::class, 'generateRecoveryCodes'])->name('two-factor.generate-recovery-codes');
// });

// // Pot za 2FA izziv po prijavi (ni pod 'auth' middleware, ker se zažene PRED popolno prijavo)
// Route::get('/two-factor-challenge', [ProfileController::class, 'showTwoFactorChallenge'])->name('two-factor.challenge');
// Route::post('/two-factor-challenge', [ProfileController::class, 'verifyTwoFactorChallenge']);

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
Route::post("/login", [SessionController::class, 'login'])->middleware('throttle:6,1'); //store
Route::post("/logout", [SessionController::class, 'destroy']);

Route::get('/profile/{id}', [SessionController::class, 'edit'])
    ->name('edit');

Route::get('/profile/{id}/2fa', [ProfileController::class, 'show'])
    ->name('show');

Route::get('/profile/{id}/2fa/confirm', [ProfileController::class, 'confirm'])
    ->name('confirm');

Route::post('/profile/{id}/2fa/confirm/c', [ProfileController::class, 'confirmTwoFactor'])
    ->middleware('auth');

Route::view('2fa-required', 'two-factor::notice', [
    'url' => url('profile/{id}')
])->name('2fa.notice');