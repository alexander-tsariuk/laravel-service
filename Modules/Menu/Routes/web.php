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

        Route::get('/create', 'MenuController@create')->name('dashboard.menu.create');
        Route::post('/create', 'MenuController@store')->name('dashboard.menu.store');

        Route::get('/edit/{itemId}', 'MenuController@edit')->name('dashboard.menu.edit');
        Route::put('/edit/{itemId}', 'MenuController@update')->name('dashboard.menu.update');


        Route::group(['prefix' => '{itemId}'], function () {
            Route::get('/items', 'MenuItemsController@index')->name('dashboard.menu.items.index');

            Route::get('/items/create', 'MenuItemsController@create')->name('dashboard.menu.items.create');
            Route::post('/items/create', 'MenuItemsController@store')->name('dashboard.menu.items.store');

            Route::get('/items/edit/{elementId}', 'MenuItemsController@edit')->name('dashboard.menu.items.edit');
            Route::put('/items/edit/{elementId}', 'MenuItemsController@update')->name('dashboard.menu.items.update');
        });

    });
});
