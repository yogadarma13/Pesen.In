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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('users', 'UserController')->only(['store']);
Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {
    Route::post('login', 'UserController@login');

    Route::post('register', 'UserController@store');

    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::group(['middleware' => ['user.loggedin']], function () {
            Route::resource('user', 'UserController')->except(['store']);
            Route::resource('menu', 'MenuController')->only(['index', 'show']);
            Route::post('pesan', 'UserController@pesan');
            Route::resource('promo', 'PromoController')->only(['index', 'show']);


            Route::group(['middleware' => ['admin.loggedin']], function () {
                Route::resource('admin', 'AdminController')->only(['index']);
                Route::resource('admin/store/menu', 'MenuController')->only(['store']);
                Route::delete('admin/delete/menu/{menu}', 'MenuController@destroy')->name('destroy');
                Route::post('admin/update/menu/{menu}', 'MenuController@update')->name('update');
                Route::resource('admin/store/meja', 'MejaController')->only(['store']);
                Route::resource('admin/update/meja', 'MejaController')->only(['update']);
                Route::resource('admin/show/meja', 'MejaController')->only(['show']);
                Route::resource('admin/store/promo', 'PromoController')->only(['store']);
                Route::delete('admin/delete/promo/{promo}', 'PromoController@destroy')->name('destroy');
                Route::post('admin/store/pembayaran', 'PembayaranController@store')->name('store');
                Route::resource('admin/pembayaran', 'PembayaranController')->only(['index']);
                Route::resource('admin/pesan', 'PesanController')->only(['index']);
                Route::resource('admin/meja', 'MejaController')->only(['index']);
                Route::get('admin/show/pesan/{pesan}', 'PesanController@show')->name('show');
            });
        });
    });

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () { });
});
