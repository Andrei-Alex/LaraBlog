<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as Trail;

// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Article
Breadcrumbs::for('article.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Article', route('article.index'));
});

// Home > Posts
Breadcrumbs::for('post.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Posts', route('post.index'));
});

// Home > Posts > [Post]
Breadcrumbs::for('post.show', function ($trail, $post) {
    $trail->parent('post.index');
    $trail->push($post->title, route('post.show', ['slug' => $post->slug, 'post' => $post]));
});

// Home > Posts > Edit
Breadcrumbs::for('post.edit', function ($trail, $post) {
    $trail->parent('post.index');
    $trail->push($post->title, route('post.edit', ['slug' => $post->slug, 'post' => $post]));
});

// Home > Posts > New Post
Breadcrumbs::for('post.create', function ($trail) {
    $trail->parent('post.index');
    $trail->push('New Post', route('post.create'));
});
