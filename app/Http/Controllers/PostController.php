<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Http\Requests\PostFilterRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * @return Illuminate\View\View
     *   A paginated View.
     */
    public function index(): View
    {
        return view('blog.index', ['posts' => Post::paginate(1)]);
    }

    /**
     * Display the specified post.
     *
     * @param string $slug The slug of the post.
     * @param string $id The ID of the post.
     * @return Illuminate\View\View
     *   Either a redirect response to the correct slug if it's mismatched, or the Post model instance.
     */
    public function show(string $slug, Post $post): \Illuminate\Http\RedirectResponse|View
    {


        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('blog.show', ['post' => $post]);

    }

    public function create()
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post
        ]);
    }

    public function store(FormPostRequest $request)
    {
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post Added Successfully!');
    }
    public function edit(Post $post)
    {
        return view('blog.edit', [
            'post' =>$post
        ]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post Updated Successfully!');
    }
}

