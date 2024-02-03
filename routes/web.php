<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Models\Post;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('/post', \App\Http\Controllers\PostController::class)->except(['show']);
Route::patch('post/{id}/restore', [\App\Http\Controllers\PostController::class, 'restore'])->name('post.restore');

$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/post/{slug}/{post}', [\App\Http\Controllers\PostController::class, 'show'])
    ->name('post.show')
    ->where(['id' => $idRegex, 'slug' => $slugRegex]);
Route::patch('/post/publish/{post}', [\App\Http\Controllers\PostController::class, 'publish'])
    ->name('post.publish');


Route::resource('dashboard/article', ArticleController::class)->except(['show']);
Route::patch('dashboard/article/{id}/restore', [ArticleController::class, 'restore'])->name('article.restore');

require __DIR__.'/auth.php';
