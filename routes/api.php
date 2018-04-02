<?php

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

Route::group(['prefix' => 'v1'], function () {

    //用户认证
    Route::group(['prefix' => 'token'], function () {
        Route::post('/', 'TokenController@create');
        Route::delete('/', 'TokenController@delete')->middleware('auth:api');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('users', 'UserController@index');
    });
});
