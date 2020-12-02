<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'movies',
    'namespace' => 'Movies'
], function () {
    Route::get('all', 'MovieController@index');
    Route::post('create', 'MovieController@create');
    Route::post('update/{id}', 'MovieController@update');
    Route::delete('remove', 'MovieController@remove');
    Route::post('archive', 'MovieController@archive');
    Route::get('find/{id}', 'MovieController@find');
});

Route::group([
    'prefix' => 'stories',
    'namespace' => 'Stories'
], function () {
    Route::get('all', 'StoryController@index');
    Route::get('find/{id}', 'StoryController@find');
    Route::post('create', 'StoryController@create');
    Route::post('update/{id}', 'StoryController@update');
    Route::delete('remove', 'StoryController@remove');
    Route::post('archive', 'StoryController@archive');
});

Route::group([
    'prefix' => 'albums',
    'namespace' => 'Albums'
], function () {
    Route::get('all', 'AlbumController@index');
    Route::get('find/{id}', 'AlbumController@find');
    Route::post('create', 'AlbumController@create');
    Route::post('update/{id}', 'AlbumController@update');
    Route::delete('remove', 'AlbumController@remove');
    Route::post('archive', 'AlbumController@archive');
    Route::get('find-all', 'AlbumController@findAll');
    Route::group(['prefix' => 'photos'], function () {
        Route::get('all', 'PhotoController@index');
        Route::get('find/{id}', 'PhotoController@find');
        Route::post('create', 'PhotoController@create');
        Route::delete('remove', 'PhotoController@remove');
    });
});
