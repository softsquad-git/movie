<?php

use Illuminate\Support\Facades\Route;

Route::get('user/find/{id}', 'ProfileController@findUser');
Route::get('user/find-info/{id}', 'ProfileController@findInfoUser');
