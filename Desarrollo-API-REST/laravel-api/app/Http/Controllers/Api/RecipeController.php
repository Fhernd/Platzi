<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;


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

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'required',
        ]);
        
        $recipe = Recipe::create($request->all());

        if ($tags = json_decode($request->tags)) {
            $recipe->tags()->attach($tags);
        }
        
        return response(new RecipeResource($recipe), Response::HTTP_CREATED);
    }

    public function update(Request $request, Recipe $recipe) 
    {
        $recipe->update($request->all());

        if ($tags = json_decode($request->tags)) {
            $recipe->tags()->sync($tags);
        }
        
        return response(new RecipeResource($recipe), Response::HTTP_OK);
    }

    public function delete(Recipe $recipe) 
    {
        $recipe->delete();
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
