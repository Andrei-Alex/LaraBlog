<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * @return View Returns the welcome view.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Blog-related routes
 */
Route::prefix('/blog')->name('blog.')->group(function() {

    /**
     * @params Request $request The HTTP request object.
     * @return array Returns an array with a link to a sample blog post.
     */
    Route::get('/', function (Request $request) {
        return \App\Models\Post::paginate(25);
    })->name('index');

    /**
     * @params string $slug The slug of the blog post.
     * @params string $id The ID of the blog post.
     * @params Request $request The HTTP request object.
     * @return array Returns an array containing the slug and ID of the blog post.
     */
    Route::get('/{slug}-{id}', function (string $slug, string $id, Request $request) {
        $post = \App\Models\Post::findOrFail($id);
        if($post->slug !== $slug) {
            return to_route('blog.show', ['slug'=> $post->slug, $id => $post->id]);
        }
       return $post;

    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');;
});

