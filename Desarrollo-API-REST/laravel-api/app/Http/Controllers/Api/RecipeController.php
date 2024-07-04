<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;

use App\Http\Resources\RecipeResource;


class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('category', 'tags', 'user')->get();
        return RecipeResource::collection($recipes);
    }

    public function show(Recipe $recipe)
    {
        $ecipe = $recipe->load('category', 'tags', 'user');
        
        return new RecipeResource($recipe);
    }

    public function store(Request $request) {}

    public function update(Request $request, Recipe $recipe) {}

    public function delete(Recipe $recipe) {}
}
