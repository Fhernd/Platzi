<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\RecipeController;

Route::post('login', LoginController::class, 'store');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('categories',            [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    
    Route::delete('recipes/{recipe}',   [RecipeController::class, 'delete']);
    Route::apiResource('recipes', RecipeController::class);

    Route::get('tags',            [TagController::class, 'index']);
    Route::get('tags/{tag}', [TagController::class, 'show']);
});
