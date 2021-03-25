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
    Route::prefix('ourservice')->group(function() {
        Route::get('/', 'OurWorksController@index')->name('dashboard.ourservice.index');

        Route::get('/create', 'OurWorksController@create')->name('dashboard.ourservice.create');
        Route::post('/create', 'OurWorksController@store')->name('dashboard.ourservice.store');

        Route::post('/upload-image/{itemId}', 'OurWorksController@uploadImage')->name('dashboard.ourservice.uploadImage');

        Route::get('/edit/{itemId}', 'OurWorksController@edit')->name('dashboard.ourservice.edit');
        Route::put('/edit/{itemId}', 'OurWorksController@update')->name('dashboard.ourservice.update');
    });
});

