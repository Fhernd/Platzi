<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\CategoryController;

Route::post('login', LoginController::class, 'store');

Route::prefix('v2')->group(function () {
    Route::get('recipes',            [CategoryController::class, 'index']);
});
