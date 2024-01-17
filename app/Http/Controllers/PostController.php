<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class PostController
 *
 * Controller for handling operations related to the Post model.
 *
 * This class extends Laravel's base Controller class. It provides methods
 * to handle listing and showing individual posts.
 */
class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     *   A paginator instance containing the posts, paginated.
     */
    public function index(): \Illuminate\Contracts\Pagination\Paginator {
        return \App\Models\Post::paginate(25);
    }

    /**
     * Display the specified post.
     *
     * @param string $slug The slug of the post.
     * @param string $id The ID of the post.
     * @return \Illuminate\Http\RedirectResponse|\App\Models\Post
     *   Either a redirect response to the correct slug if it's mismatched, or the Post model instance.
     */
    public function show(string $slug, string $id): \Illuminate\Http\RedirectResponse|\App\Models\Post {
        $post = \App\Models\Post::findOrFail($id);

        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return $post;
    }
}

