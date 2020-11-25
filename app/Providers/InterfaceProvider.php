<?php

namespace App\Providers;

use App\Interfaces\Auth\AuthServiceInterface;
use App\Interfaces\Auth\VerifyServiceInterface;
use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Interfaces\Categories\CategoryServiceInterface;
use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\Translations\TranslateServiceInterface;
use App\Repositories\Categories\CategoryRepository;
use App\Services\Auth\AuthService;
use App\Services\Auth\VerifyService;
use App\Services\Categories\CategoryService;
use App\Services\Mail\MailService;
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
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(VerifyServiceInterface::class, VerifyService::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);
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
