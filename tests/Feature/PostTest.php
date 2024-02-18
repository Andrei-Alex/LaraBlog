<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Post;

/**
 * Feature tests for post operations.
 *
 * This test class utilizes Laravel's testing functionality to ensure that
 * post-related features work as expected. It extends the base TestCase class
 * provided by Laravel and uses the RefreshDatabase trait to reset the database
 * after each test, ensuring a clean state.
 */
class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the retrieval of the post list.
     *
     * This test verifies that authenticated users can access the post index
     * route and see the content related to posts. It ensures the application
     * returns a successful response status and the presence of post-related
     * content on the page.
     */
    public function test_get_post_list(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Category::factory()->create();
        Post::factory()->count(3)->create();

        $response = $this->get('/post');

        $response->assertStatus(200);
        $response->assertSee('Post');
    }

    /**
     * Test that a post can be soft deleted.
     *
     * This test ensures that posts can be soft deleted, verifying the soft delete
     * functionality works as expected. It asserts that the post is marked as soft
     * deleted in the database and can still be retrieved with the appropriate query.
     */
    public function test_a_post_can_be_soft_deleted(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $post = Post::factory()->create(['user_id' => $user->id, 'category_id' => $category->id]);

        $post->delete();

        $this->assertSoftDeleted($post);

        $this->assertTrue(Post::withTrashed()->where('id', $post->id)->exists());
    }
    public function test_a_post_can_be_added(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $tag = Tag::factory()->create();
        $this->actingAs($user);

        $postData = [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
            'category_id' => $category->id,
            'tags' => [$tag->id],
        ];

        $this->post(route('post.store'), $postData);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'content' => 'This is a test post.',
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);

        $post = Post::where('title', 'Test Post')->first();
        $this->assertTrue($post->tags->contains($tag->id));
    }

}
