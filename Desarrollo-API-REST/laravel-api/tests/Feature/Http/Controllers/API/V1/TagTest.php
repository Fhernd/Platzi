<?php

namespace Tests\Feature\Http\Controllers\API\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use App\Models\Tag;
use App\Models\User;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $categories = Tag::factory(2)->create();

        $response = $this->getJson('/api/v1/tags')
            ->assertJsonCount(2, 'data')
            ->assertJsonStructure([
                'data' => [
                    ['id', 'name', 'type', 'attributes' => ['name'], 'relationships' => ['recipes' => []]]
                ]
            ]);
    }

    public function test_show(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $tag = Tag::factory()->create();

        $response = $this->getJson('/api/v1/tags/' . $tag->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'type', 'attributes' => ['name'], 'attributes' => ['name'], 'relationships' => ['recipes' => []]
                ]
            ]);
    }
}
