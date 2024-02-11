<?php

use Diglactic\Breadcrumbs\Breadcrumbs;


// Home
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard')); // Assuming you have a 'home' named route
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
