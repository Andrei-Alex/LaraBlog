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
     * Bootstrap any application services.
     *
     * This method is called after all other service providers have been registered,
     * meaning you have access to all other services that have been registered by the framework.
     * This is where you can register view composers or share data with views.
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $filters = request()->all(['user_id', 'order_by', 'direction']);

            $view->with('filters', $filters);
        });
    }
}
