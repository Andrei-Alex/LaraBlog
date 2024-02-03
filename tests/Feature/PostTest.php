<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\Category;
use \App\Models\Post;

class postTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_list(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Category::factory()->create();
        Post::factory()->count(3)->create();
        $response = $this->get('/post');
        $response->assertStatus(200);
        $response->assertSee('Blog Post Panel');
    }
}
