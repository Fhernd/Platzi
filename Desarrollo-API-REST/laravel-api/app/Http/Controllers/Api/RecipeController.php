<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        return Recipe::with('category', 'tags', 'user')->get();
    }

    public function show(Recipe $recipe)
    {
        return $recipe->load('category', 'tags', 'user');
    }
}
