<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Diglactic\Breadcrumbs\Manager as BreadcrumbsManager;
use Tests\TestCase;
use \App\Models\Category;
use \App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $breadcrumbsMock = \Mockery::mock(BreadcrumbsManager::class);
        $breadcrumbsMock->shouldReceive('generate')->andReturn([
            ['title' => 'Dashboard', 'url' => '/dashboard'],
            ['title' => 'Post', 'url' => '/post'],
        ]);

        $breadcrumbsMock->shouldReceive('render')->andReturn('
        <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
             <li class="breadcrumb-item">
                 <a href="/dashboard">Dashboard</a></li>
             <li class="breadcrumb-item active" aria-current="page">Post</li>
         </ol>
        </nav>');

        $this->app->instance(BreadcrumbsManager::class, $breadcrumbsMock);
    }

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
        $response->assertSee('Post');
    }

    public function a_post_can_be_soft_deleted()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $post->delete();
        $this->assertSoftDeleted($post);

        $this->assertTrue(Post::withTrashed()->where('id', $post->id)->exists());
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }
}
