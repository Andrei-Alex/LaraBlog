<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\AuthController;

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
 * @return View Returns the Auth Routes .
 */
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'auth']);

/**
 * Blog-related routes
 */
Route::prefix('/blog')->name('blog.')->controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/new', 'create')->name('create');
    Route::Post('/new', 'store')->name('create');
    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::patch('/{post}/edit', 'update')->name('update');
    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]+',
        'slug' => '[a-zA-Z0-9\-]+'
    ])->name('show');
});

