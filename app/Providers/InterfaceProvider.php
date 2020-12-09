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
use App\Interfaces\Comments\Answers\CommentReplyRepositoryInterface;
use App\Interfaces\Comments\Answers\CommentReplyServiceInterface;
use App\Interfaces\Comments\CommentRepositoryInterface;
use App\Interfaces\Comments\CommentServiceInterface;
use App\Interfaces\Likes\LikeRepositoryInterface;
use App\Interfaces\Likes\LikeServiceInterface;
use App\Interfaces\Mail\MailServiceInterface;
use App\Interfaces\Movies\MovieRepositoryInterface;
use App\Interfaces\Movies\MovieServiceInterface;
use App\Interfaces\Ratings\RatingRepositoryInterface;
use App\Interfaces\Ratings\RatingServiceInterface;
use App\Interfaces\Settings\SettingRepositoryInterface;
use App\Interfaces\Settings\SettingServiceInterface;
use App\Interfaces\Stories\StoryRepositoryInterface;
use App\Interfaces\Stories\StoryServiceInterface;
use App\Interfaces\Users\UserRepositoryInterface;
use App\Repositories\Albums\AlbumRepository;
use App\Repositories\Albums\Photos\PhotoRepository;
use App\Repositories\Categories\CategoryRepository;
use App\Repositories\Comments\Answers\CommentReplyRepository;
use App\Repositories\Comments\CommentRepository;
use App\Repositories\Likes\LikeRepository;
use App\Repositories\Movies\MovieRepository;
use App\Repositories\Ratings\RatingRepository;
use App\Repositories\Settings\SettingRepository;
use App\Repositories\Stories\StoryRepository;
use App\Repositories\Users\UserRepository;
use App\Services\Albums\AlbumService;
use App\Services\Albums\Photos\PhotoService;
use App\Services\Auth\AuthService;
use App\Services\Auth\VerifyService;
use App\Services\Categories\CategoryService;
use App\Services\Comments\Answers\CommentReplyService;
use App\Services\Comments\CommentService;
use App\Services\Likes\LikeService;
use App\Services\Mail\MailService;
use App\Services\Movies\MovieService;
use App\Services\Ratings\RatingService;
use App\Services\Settings\SettingService;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(CommentReplyServiceInterface::class, CommentReplyService::class);
        $this->app->bind(CommentReplyRepositoryInterface::class, CommentReplyRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(LikeServiceInterface::class, LikeService::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(RatingRepositoryInterface::class, RatingRepository::class);
        $this->app->bind(RatingServiceInterface::class, RatingService::class);
    }

    /**
     * @return void
     */
    public function boot()
    {
        //
    }
}
