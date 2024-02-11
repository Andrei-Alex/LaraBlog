<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            // Collect all filter-related request parameters
            $filters = request()->all(['user_id', 'order_by', 'direction']);

            // Share `$filters` with all views
            $view->with('filters', $filters);
        });
    }
}
