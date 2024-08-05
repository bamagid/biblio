<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\LivreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::delete('livres/emptyTrashes', [LivreController::class, "emptyTrashes"])->middleware("auth");
Route::get('livres/Trashed', [LivreController::class, "Trashed"])->middleware("auth");
Route::post('login', [AuthController::class, 'login']);
Route::apiResource("livres", LivreController::class)->only('index', 'show');
Route::middleware("auth")->group(
    function () {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refreshToken']);
        Route::apiResource("livres", LivreController::class)->except('update', "index", "show");
        Route::post('livres/{livre}', [LivreController::class, 'update']);
        Route::post('livres/{livre}/restore', [LivreController::class, 'restore']);
        Route::delete('livres/{livre}/force-delete', [LivreController::class, 'forceDelete']);
        // Route::delete('livres/emptyTrashes', [LivreController::class, "emptyTrashes"]);
        // Route::get('livres/Trashed', [LivreController::class, "Trashed"]);
        Route::apiResource('emprunts', EmpruntController::class)->except('destroy');
    }
);
