<?php

use Illuminate\Support\Facades\Route;

Route::get('all', 'CommentController@index');
Route::get('find/{id}', 'CommentController@find');
Route::post('create', 'CommentController@create');
Route::post('update/{id}', 'CommentController@update');
Route::delete('remove/{id}', 'CommentController@remove');
Route::group(['prefix' => 'answers', 'namespace' => 'Answers'], function () {
    Route::get('all', 'CommentReplyController@index');
    Route::get('find/{id}', 'CommentReplyController@find');
    Route::post('create', 'CommentReplyController@create');
    Route::post('update/{id}', 'CommentReplyController@update');
    Route::delete('remove/{id}', 'CommentReplyController@remove');
});
