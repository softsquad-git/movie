<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'soft-squad'
], function () {
    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        include 'api/auth.api.php';
    });
    include 'api/front.api.php';
    include 'api/user.api.php';
});
