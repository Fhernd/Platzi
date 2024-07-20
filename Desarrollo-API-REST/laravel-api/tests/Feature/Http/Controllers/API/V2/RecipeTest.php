<?php

namespace Tests\Feature\Http\Controllers\API\V2;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_v2(): void
    {
        Sanctum::actingAs(User::factory()->create());
        Category::factory()->create();

        $recipes = Recipe::factory(5)->create();

        $response = $this->getJson('/api/v2/recipes')
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [],
                'links' => [],
                'meta' => [],
            ]);
    }
}
