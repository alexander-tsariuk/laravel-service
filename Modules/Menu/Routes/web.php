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
    Route::prefix('menu')->group(function() {
        Route::get('/', 'MenuController@index')->name('dashboard.menu.index');

//        Route::get('/create', 'PageController@create')->name('dashboard.page.create');
//        Route::post('/create', 'PageController@store')->name('dashboard.page.store');
//
//        Route::get('/edit/{itemId}', 'PageController@edit')->name('dashboard.page.edit');
//        Route::put('/edit/{itemId}', 'PageController@update')->name('dashboard.page.update');
//
//        Route::post('/upload-image/{directory}', 'PageController@uploadImage')->name('dashboard.page.uploadImage');

    });
});
