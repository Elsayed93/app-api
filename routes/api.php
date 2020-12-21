<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


/**
 * api response 
 * [
 *  'data'=> data,
 *  'status'=> true or false,
 *  'message' => 'string message, error or success'
 * ]
 * 
 */
Route::get('posts', 'PostsController@index'); //list all post
Route::get('posts/{id}', 'PostsController@show'); //show a post with id
Route::post('posts', 'PostsController@store'); //stor a post
Route::post('posts/{id}', 'PostsController@update'); //update a post with id
Route::get('posts/delete/{id}', 'PostsController@delete'); //delete post with id
