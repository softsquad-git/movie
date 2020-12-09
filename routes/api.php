<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'soft-squad'
], function () {
    Route::group([
        'prefix' => 'auth',
        'namespace' => 'Auth'
    ], function () {
        include 'api/auth.api.php';
    });
    Route::group([
        'prefix' => 'user',
        'namespace' => 'Users'
    ], function () {
        include 'api/user.api.php';
    });
    Route::group([
        'prefix' => 'front',
        'namespace' => 'Front'
    ], function () {
        include 'api/front.api.php';
        Route::group([
            'prefix' => 'profile',
            'namespace' => 'Profiles'
        ], function (){
            include 'api/profile.api.php';
        });
    });
    Route::group(['prefix' => 'categories', 'namespace' => 'Categories'], function () {
        Route::get('all', 'CategoryController@index');
    });
    Route::group([
        'prefix' => 'comments',
        'namespace' => 'Comments'
    ], function () {
        include 'api/comments.api.php';
    });
    Route::group([
        'prefix' => 'ratings',
        'namespace' => 'Ratings'
    ], function () {
       include 'api/ratings.api.php';
    });
    Route::group([
        'prefix' => 'likes',
        'namespace' => 'Likes'
    ], function () {
        include 'api/likes.api.php';
    });
});
