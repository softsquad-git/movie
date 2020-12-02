<?php

namespace App\Providers;

use App\Interfaces\Albums\AlbumRepositoryInterface;
use App\Interfaces\Albums\AlbumServiceInterface;
use App\Interfaces\Albums\Photos\PhotoRepositoryInterface;
use App\Interfaces\Albums\Photos\PhotoServiceInterface;
use App\Interfaces\Auth\AuthServiceInterface;
use App\Interfaces\Auth\VerifyServiceInterface;
use App\Interfaces\Categories\CategoryRepositoryInterface;
use App\Interfaces\Categories\CategoryServiceInterface;
use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\Movies\MovieRepositoryInterface;
use App\Interfaces\Movies\MovieServiceInterface;
use App\Interfaces\Stories\StoryRepositoryInterface;
use App\Interfaces\Stories\StoryServiceInterface;
use App\Repositories\Albums\AlbumRepository;
use App\Repositories\Albums\Photos\PhotoRepository;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\Movies\MovieRepository;
use App\Repositories\Stories\StoryRepository;
use App\Services\Albums\AlbumService;
use App\Services\Albums\Photos\PhotoService;
use App\Services\Auth\AuthService;
use App\Services\Auth\VerifyService;
use App\Services\Categories\CategoryService;
use App\Services\Mail\MailService;
use App\Services\Movies\MovieService;
use App\Services\Stories\StoryService;
use Illuminate\Support\ServiceProvider;

class InterfaceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(VerifyServiceInterface::class, VerifyService::class);
        $this->app->bind(MailServiceInterface::class, MailService::class);
        $this->app->bind(MovieRepositoryInterface::class, MovieRepository::class);
        $this->app->bind(MovieServiceInterface::class, MovieService::class);
        $this->app->bind(StoryRepositoryInterface::class, StoryRepository::class);
        $this->app->bind(StoryServiceInterface::class, StoryService::class);
        $this->app->bind(AlbumServiceInterface::class, AlbumService::class);
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        $this->app->bind(PhotoServiceInterface::class, PhotoService::class);
        $this->app->bind(PhotoRepositoryInterface::class, PhotoRepository::class);
    }

    /**
     * @return void
     */
    public function boot()
    {
        //
    }
}
