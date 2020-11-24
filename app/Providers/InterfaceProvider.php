<?php

namespace App\Providers;

use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Interfaces\Categories\CategoryServiceInterface;
use App\Interfaces\Translations\TranslateServiceInterface;
use App\Repositories\Categories\CategoryRepository;
use App\Services\Categories\CategoryService;
use App\Services\Translations\TranslateService;
use Illuminate\Support\ServiceProvider;

class InterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(TranslateServiceInterface::class, TranslateService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
