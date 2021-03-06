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
Route::middleware(['cors'])->group(function () {

    Route::post('/message', 'MessageController@store');
    Route::get('/message/{id}', 'MessageController@show');
    Route::get('/messages', 'MessageController@index');

    Route::get('/comments', 'CommentController@index');
    Route::post('/comment/{id}', 'CommentController@store');
});
