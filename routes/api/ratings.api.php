<?php

use Illuminate\Support\Facades\Route;

Route::get('find', 'RatingController@find');
Route::post('save', 'RatingController@create');
