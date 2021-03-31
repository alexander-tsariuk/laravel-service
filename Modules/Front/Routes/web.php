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

//Route::group(['prefix?' => ])
if (!strpos(Request::url(),"admin")) {

//    Route::group(['langPrefix' => \Modules\Front\Http\Middleware\LocaleMiddleware::getLocale(), 'middleware' => 'locale'], function () {
    Route::prefix('{lang?}')->group(function () {

        Route::get('/', 'FrontController@index')->name('home')->middleware('locale');

        Route::get('/{prefix}/{subPrefix?}', 'FrontController@renderPage')->name('front.render.page')->middleware('locale');
    });

}
