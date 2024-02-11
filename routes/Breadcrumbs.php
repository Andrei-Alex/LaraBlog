<?php

use Tabuna\Breadcrumbs\Breadcrumbs;
use Tabuna\Breadcrumbs\Trail;

Breadcrumbs::for('dashboard', function (Trail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

Breadcrumbs::for('post.index', function (Trail $trail) {
    $trail->parent('home')
        ->push('Post', route('post.index'));
});

