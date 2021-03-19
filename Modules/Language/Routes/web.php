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
    Route::prefix('language')->group(function() {
        Route::get('/', 'LanguageController@index')->name('dashboard.language.index');

        Route::post('/create', 'LanguageController@store')->name('dashboard.language.store');
        Route::get('/create', 'LanguageController@create')->name('dashboard.language.create');

        Route::get('/edit/{itemId}', 'LanguageController@edit')->name('dashboard.language.edit');
        Route::put('/edit/{itemId}', 'LanguageController@update')->name('dashboard.language.update');

        Route::delete('/delete/{itemId}', 'LanguageController@destroy')->name('dashboard.language.delete');
    });
});
