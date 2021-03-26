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

Route::get('/', 'FrontController@index')->name('home');


Route::get('/service/{prefix}', 'FrontController@servicePage')->name('front.service.page');
Route::get('/project/{prefix}', 'FrontController@projectPage')->name('front.project.page');
