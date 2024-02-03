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
    public function test_get_post_list(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Category::factory()->create();
        Post::factory()->count(3)->create();
        $response = $this->get('/post');
        $response->assertStatus(200);
        $response->assertSee('Blog Post Panel');
    }

    public function a_post_can_be_soft_deleted()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->delete();
        $this->assertSoftDeleted($post);

        $this->assertTrue(Post::withTrashed()->where('id', $post->id)->exists());
    }
}
