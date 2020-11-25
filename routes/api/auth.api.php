<?php

use Illuminate\Support\Facades\Route;

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('activate/{key}', 'AuthController@activate')
    ->name('activate_account');
