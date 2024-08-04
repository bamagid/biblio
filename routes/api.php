<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\LivreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
// Routes pour le contrôleur LivreController
Route::apiResource('livres', LivreController::class)->only('index', 'show');
Route::middleware('auth')->group(function () {
    /********************* Gestion profile  **************************/
    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh", [AuthController::class, "refreshToken"]);
    Route::get("logout", [AuthController::class, "logout"]);
    /********************* Gestion profile  **************************/

    /********************* Gestion Categories  **************************/

    // Routes pour le contrôleur CategorieController
    Route::apiResource('categories', CategorieController::class);

    // Route pour restaurer une catégorie supprimée
    Route::post('categories/{id}/restore', [CategorieController::class, 'restore']);

    // Route pour supprimer définitivement une catégorie
    Route::delete('categories/{id}/force-delete', [CategorieController::class, 'forceDelete']);

    // Route pour récupérer les catégories supprimées
    Route::get('categories/trashed', [CategorieController::class, 'Trashed']);
    /********************* Gestion Categories  **************************/

    /********************* Gestion Livres  **************************/
    // Routes pour le contrôleur LivreController
    Route::apiResource('livres', LivreController::class)->except('index', 'show', 'update');
    //Route pour mettre a jour un livre
    Route::post('livres/{livre}', [LivreController::class, "update"]);

    // Route pour restaurer un livre supprimé
    Route::post('livres/{id}/restore', [LivreController::class, 'restore']);

    // Route pour supprimer définitivement un livre
    Route::delete('livres/{id}/force-delete', [LivreController::class, 'forceDelete']);

    // Route pour récupérer les livres supprimés
    Route::get('livres/trashed', [LivreController::class, 'trashed']);
    /********************* Gestion Livres  **************************/

    /********************* Gestion Emprunts  **************************/

    // Routes pour le contrôleur EmpruntController
    Route::apiResource('emprunts', EmpruntController::class)->except('destroy');

    /********************* Gestion Emprunts  **************************/
});
