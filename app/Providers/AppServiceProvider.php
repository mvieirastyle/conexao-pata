<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        if (!Cache::has('animals_cache_version')) {
        Cache::put('animals_cache_version', 1);
    }

    if (!Cache::has('users_cache_version')) {
        Cache::put('users_cache_version', 1);
    }

    if (!Cache::has('posts_cache_version')) {
        Cache::put('posts_cache_version', 1);
    }
    }
}
