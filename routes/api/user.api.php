<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'movies',
    'namespace' => 'Movies'
], function () {
    Route::get('all', 'MovieController@index');
    Route::post('create', 'MovieController@create');
    Route::post('update/{id}', 'MovieController@update');
    Route::delete('remove/{id}', 'MovieController@remove');
    Route::get('find/{id}', 'MovieController@find');
});
