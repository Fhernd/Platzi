<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use App\Models\Category;
use App\Models\User;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $categories = Category::factory(2)->create();

        $response = $this->getJson('/api/categories')
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    ['id', 'name', 'type', 'attributes' => ['name']]
                ]
            ]);
    }

    public function test_show(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $category = Category::factory()->create();

        $response = $this->getJson('/api/categories/' . $category->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'type', 'attributes' => ['name']
                ]
            ]);
    }
}
