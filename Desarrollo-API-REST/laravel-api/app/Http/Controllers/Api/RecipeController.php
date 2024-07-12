<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest


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

    public function store(StoreRecipeRequest $request)
    {
        $recipe = $request->user()->recipes()->create($request->all());
        
        return response(new RecipeResource($recipe), Response::HTTP_CREATED);
    }

    public function UpdateRecipeRequest(Request $request, Recipe $recipe) 
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
