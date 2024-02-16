<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Notifications\PostPublished;

/**
 * Controller responsible for handling blog post operations.
 *
 * It provides functionality to create, read, update, and delete blog posts,
 * as well as publishing and restoring them. It supports filtering and sorting
 * posts based on user input, and integrates with models to interact with the database.
 */
class PostController extends Controller
{
    /**
     * Display a paginated list of posts with optional filtering and sorting.
     *
     * @param Request $request HTTP request containing filter and sort parameters.
     * @return View The view displaying posts based on applied filters and sorting.
     */
    public function index(Request $request): View
    {
        $posts = Post::query();
        $filters = $request->all(['user_id', 'order_by', 'direction', 'search']);

        if (!empty($filters['search'])) {
            $posts->where('title', 'LIKE', '%' . $filters['search'] . '%');
        }

        if (!empty($filters['user_id'])) {
            $posts->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['order_by']) && !empty($filters['direction'])) {
            $posts->orderBy($filters['order_by'], $filters['direction']);
        }

        $posts = $posts->with(['tags', 'category'])->withTrashed()->paginate(5)->appends($filters);

        return view('crud/post/index', [
            'posts' => $posts,
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View The view containing the form to create a new post.
     */
    public function create(): View
    {
        return view('crud/post/create', [
            'post' => new Post(),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created post in the database.
     *
     * @param FormPostRequest $request Validated post data.
     * @return RedirectResponse Redirect to the created post with a success message.
     */
    public function store(FormPostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = Post::create($data);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return to_route('post.show', [$post->slug])->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified post.
     *
     * @param Post $post The post model instance.
     * @return RedirectResponse|View The view displaying the specified post.
     */
    public function show(string $slug, Post $post): RedirectResponse|view
    {
        if ($post->slug !== $slug) {
            return to_route('post.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('crud/post/show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param Post $post The post model instance.
     * @return View The view containing the form to edit the post.
     */
    public function edit(Post $post): View
    {
        return view('crud/post/edit', [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified post in the database.
     *
     * @param FormPostRequest $request Validated post data.
     * @param Post $post The post model instance to update.
     * @return RedirectResponse Redirect to the updated post with a success message.
     */
    public function update(FormPostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();
        $post->update($data);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }
        return to_route('post.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Post updated successfully.');

    }

    /**
     * Remove the specified post from the database.
     *
     * @param Post $post The post model instance to delete.
     * @return RedirectResponse Redirect to the posts list with a success message.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return to_route('post.index')->with('success', 'Post deleted successfully.');
    }

    /**
     * Restore the specified soft-deleted post.
     *
     * @param int $id The ID of the post to restore.
     * @return RedirectResponse Redirect to the posts list with a success message.
     */
    public function restore(int $id): RedirectResponse
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return to_route('post.index')->with('success', 'Post restored successfully.');
    }

    /**
     * Publish the specified post.
     *
     * @param Post $post The post model instance to publish.
     * @return RedirectResponse Redirect to the posts list with a success message.
     */
    public function publish(Post $post): RedirectResponse
    {
        $post->update(['draft' => false]);
        try {
            $post->user->notify(new PostPublished($post));
        } catch (\Exception $e) {
            \Log::error('Failed to send post published notification.', [
                'post_id' => $post->id,
                'error' => $e->getMessage(),
            ]);
            return to_route('post.index')->with('error', 'Post published without notification.');
        }
        return to_route('post.index')->with('success', 'Post published successfully.');
    }
}
