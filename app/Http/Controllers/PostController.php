<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use \App\Notifications\PostPublished;

/**
 * Class PostController
 *
 * Controller for handling operations related to the Post model.
 *
 * This class extends Laravel's base Controller class. It provides methods
 * to handle CRUD operations for blog posts.
 */
class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return View
     * Returns a view with a paginated list of posts.
     */
    public function index(): View
    {
        return view('crud/post/index', [
            'posts' => Post::with(['tags', 'category'])->withTrashed()->paginate(10)
        ]);
    }

    /**
     * Display the specified post.
     *
     * @param string $slug The slug of the post.
     * @param Post $post The Post model instance.
     * @return RedirectResponse|View
     * Either a redirect response to the correct slug if it's mismatched, or the view with the Post model instance.
     */
    public function show(string $slug, Post $post): View
    {
        if ($post->slug !== $slug) {
            return to_route('post.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view('crud/post/show', ['post' => $post]);
    }

    /**
     * Show the form for creating a new post.
     *
     * @return View
     * Returns the view for creating a new post.
     */
    public function create(): View
    {
        $post = new Post();
        return view('crud/post/create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param FormPostRequest $request The request containing post data.
     * @return RedirectResponse
     * Redirects to the newly created post with a success message.
     */
    public function store(FormPostRequest $request): RedirectResponse
    {
        $data = $this->extractData(new Post(), $request);
        $data['user_id'] = auth()->id();

        $post = Post::create($data);
        if ($request->filled('tags')) {
            $post->tags()->sync($request->validated('tags'));
        }
        return redirect()->route('post.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Created successfully!');
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param Post $post The Post model instance.
     * @return View
     * Returns the view for editing the specified post.
     */
    public function edit(Post $post): View
    {
        return view('crud/post/edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags' => Tag::select('id', 'name')->get(),
        ]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param Post $post The Post model instance.
     * @param FormPostRequest $request The request containing updated post data.
     * @return RedirectResponse
     * Redirects to the updated post with a success message.
     */
    public function update(Post $post, FormPostRequest $request): RedirectResponse
    {
        $post->update($this->extractData($post, $request));
        $post->tags()->sync($request->validated('tags'));

        return redirect()->route('post.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', 'Updated successfully!');
    }

    /**
     * Extract and process data from the request.
     *
     * @param Post $post The Post model instance.
     * @param FormPostRequest $request The request containing post data.
     * @return array
     * Returns an array of processed data.
     * @var UploadedFile|null $image
     */
    private function extractData(Post $post, FormPostRequest $request): array
    {
        $data = $request->validated();
        $image = $request->file('image');
        if ($image && !$image->getError()) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $image->store('blog', 'public');
        }
        return $data;
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return to_route('post.index')->with('success', 'Deleted successfully!');
    }

    /**
     * Restore the specified soft-deleted article.
     *
     * @param string $id Article ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id): RedirectResponse
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        return to_route('post.index')->with('success', 'Restored successfully!');
    }

    public function publish(Post $post): RedirectResponse
    {
        $this->authorize('update', $post);
        $post->update(['draft' => false]);
        $post->user->notify(new PostPublished($post));

        return redirect()->route('post.index')->with('success', 'Post published successfully!');
    }
}
