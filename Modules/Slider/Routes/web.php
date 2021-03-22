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
    Route::prefix('slider')->group(function() {
        Route::get('/', 'SliderController@index')->name('dashboard.slider.index');
        Route::get('/create', 'SliderController@create')->name('dashboard.slider.create');
    });
});
