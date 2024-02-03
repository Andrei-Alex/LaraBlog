<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Handles web requests related to Articles.
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of articles, including those that are soft-deleted.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('crud/article/index', ['articles' => Article::withTrashed()->paginate(10)]);
    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified article.
     *
     * @param  string  $id Article ID
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  string  $id Article ID
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id Article ID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified article from storage.
     *
     * Performs a soft delete.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return to_route('article.index')->with([
            'messageType' => 'success',
            'message' => 'Deleted successfully!',
        ]);
    }

    /**
     * Restore the specified soft-deleted article.
     *
     * @param  string  $id Article ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();
        return to_route('article.index')->with([
            'messageType' => 'success',
            'message' => 'Restored successfully!',
        ]);
    }
}
