<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function() {
    Route::prefix('user')->group(function() {
        Route::get('/', 'UserController@index')->name('dashboard.user.index');

        Route::get('/create', 'UserController@create')->name('dashboard.user.create');
        Route::post('/create', 'UserController@store')->name('dashboard.user.store');

        Route::get('/edit/{itemId}', 'UserController@edit')->name('dashboard.user.edit');
        Route::put('/edit/{itemId}', 'UserController@update')->name('dashboard.user.update');
    });
});
