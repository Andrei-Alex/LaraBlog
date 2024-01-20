<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
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
        return view('blog.index', ['posts' => Post::with('tags', 'category')->paginate(10)]);
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

    public function create(): View
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    public function store(FormPostRequest $request): RedirectResponse
    {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post Added Successfully!');
    }

    public function edit(Post $post): View
    {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    public function update(Post $post, FormPostRequest $request)
    {
        $post->update($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post Updated Successfully!');
    }
}

