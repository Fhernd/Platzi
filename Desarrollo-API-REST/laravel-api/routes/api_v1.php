<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\TagController;
use App\Http\Controllers\Api\V1\RecipeController;

Route::post('login', LoginController::class, 'store');

Route::prefix('v1')->group(function () {
    Route::get('categories',            [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    
    Route::delete('recipes/{recipe}',   [RecipeController::class, 'delete']);
    Route::apiResource('recipes', RecipeController::class);

    Route::get('tags',            [TagController::class, 'index']);
    Route::get('tags/{tag}', [TagController::class, 'show']);
});
