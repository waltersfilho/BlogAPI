<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/post', 'PostsController@index');
Route::post('/post/new', 'PostsController@store');
Route::post('post/update/{id}', 'PostsController@update');
Route::get('post/{id}', 'PostsController@show');
Route::get('post/destroy/{id}', 'PostsController@destroy');

Route::post('/post/comments/new', 'CommentsController@store');
Route::post('post/comments/update/{id}', 'CommentsController@update');
Route::get('post/comments/{id}', 'CommentsController@show');
Route::get('post/comments/destroy/{id}', 'CommentsController@destroy');