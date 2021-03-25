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


Route::get('/login', 'AuthController@login')->name('auth.login.page');
Route::post('/login', 'AuthController@auth')->name('auth.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    Route::prefix('settings')->group(function() {
        Route::get('/', 'SettingsController@index')->name('dashboard.settings.index');
        Route::put('/', 'SettingsController@update')->name('dashboard.settings.update');
    });
});


