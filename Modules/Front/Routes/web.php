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

$pos = strpos(Request::url(),"admin");

if ($pos == false) {
    Route::prefix('{lang?}')->group(function () {

        Route::get('/', 'FrontController@index')->name('front.home')->middleware('locale');

        Route::get('/{prefix}/{subPrefix?}', 'FrontController@renderPage')->name('front.render.page')->middleware('locale');
    });


    Route::post('/ajax/projects/load-more', 'FrontController@ajaxProjectsLoad')->name('ajax.projects.load-more');
    Route::post('/ajax/contact/send', 'FrontController@ajaxSendMessage')->name('ajax.contact.send');
}
