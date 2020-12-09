<?php

namespace App\Providers;

use App\Models\Categories\Category;
use App\Models\Comments\Comment;
use App\Models\Users\User;
use App\Observers\Categories\CategoryObserver;
use App\Observers\Comments\CommentObserver;
use App\Observers\Users\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
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
        Category::observe(CategoryObserver::class);
        User::observe(UserObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
