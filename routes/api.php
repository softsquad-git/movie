<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'soft-squad'
], function () {
   include 'api/front.api.php';
   include 'api/user.api.php';
   include 'api/auth.api.php';
   Route::post('create', 'CCCController@create');
});
