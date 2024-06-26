<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\RecipeController;


Route::get('categories',            [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

Route::get('recipes',            [RecipeController::class, 'index']);
Route::get('recipes/{recipe}', [RecipeController::class, 'show']);

Route::get('tags',            [TagController::class, 'index']);
Route::get('tags/{tag}', [TagController::class, 'show']);
