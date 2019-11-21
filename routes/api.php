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

// Route::resource('users', 'UserController')->only(['store']);


Route::post('login', 'UserController@login');

Route::post('register', 'UserController@store');

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::group(['middleware' => ['user.loggedin']], function () {
        Route::resource('user', 'UserController')->except(['store']);
        Route::post('logout', 'UserController@logout');
        Route::resource('menu', 'MenuController')->except(['store']);


        Route::group(['middleware' => ['admin.loggedin']], function () {
            Route::resource('admin', 'AdminController')->only(['index']);
            Route::resource('store', 'MenuController')->only(['store']);
            Route::post('update/{menu}', 'MenuController@update')->name('update');

        });
    });
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

});
