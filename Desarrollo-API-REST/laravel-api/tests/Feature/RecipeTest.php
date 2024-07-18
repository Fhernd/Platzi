<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use Illuminate\Http\UploadedFile;

use App\Models\Recipe;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;

class RecipeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index(): void
    {
        Sanctum::actingAs(User::factory()->create());
        Category::factory()->create();

        $recipes = Recipe::factory(2)->create();

        $response = $this->getJson('/api/recipes')
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    ['id', 'name', 'type', 'attributes' => ['title', 'description']]
                ]
            ]);
    }

    public function test_show(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $category = Category::factory()->create();

        $recipe = Recipe::factory()->create();

        $response = $this->getJson('/api/recipes/' . $recipe->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'type', 'attributes' => ['name'], 'attributes' => ['name', 'description']
                ]
            ]);
    }

    public function test_destroy()
    {
        Sanctum::actingAs(User::factory()->create());
        $category = Category::factory()->create();
        $recipe = Recipe::factory()->create();

        $response = $this->deleteJson('/api/recipes/' . $recipe->id)
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('recipes', ['id' => $recipe->id]);
    }

    public function test_store()
    {
        Sanctum::actingAs(User::factory()->create());

        $category = Category::factory()->create();
        $tag = Tag::factory()->create();

        $data = [
            'catagory_id' => $category->id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'ingredients' => $this->faker->text,
            'instructions' => $this->faker->text,
            'tag' => $tag->id,
            'image' => UploadedFile::fake()->image('recipe.jpg')
        ];

        $response = $this->getJson('/api/recipes/' . $data)
            ->assertStatus(Response::HTTP_CREATED);
    }

    public function test_update() : void
    {
        Sanctum::actingAs(User::factory()->create());

        $category = Category::factory()->create();
        $tag = Tag::factory()->create();
        $recipe = Recipe::factory()->create();

        $data = [
            'catagory_id' => $category->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'ingredients' => 'Updated Ingredients',
            'instructions' => 'Updated Instructions'
        ];

        $response = $this->putJson('/api/recipes/' . $recipe->id, $data)
            ->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('recipes', [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
        ]);
    }
}
