<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'movies',
    'namespace' => 'Movies'
], function () {
    Route::get('all', 'MovieController@index');
    Route::get('find/{id}', 'MovieController@find');
});

Route::group([
    'prefix' => 'photos',
    'namespace' => 'Photos'
], function () {
    Route::get('albums', 'PhotoController@index');
    Route::get('all/{albumId}', 'PhotoController@getPhotos');
});

Route::group([
    'prefix' => 'stories',
    'namespace' => 'Stories'
], function () {
    Route::get('all', 'StoryController@index');
    Route::get('find/{id}', 'StoryController@find');
});
