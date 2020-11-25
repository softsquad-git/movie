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
    });
});
