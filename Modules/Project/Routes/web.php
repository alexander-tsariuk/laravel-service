<?php


Route::prefix('admin')->group(function() {
    Route::prefix('project')->group(function() {
        Route::get('/', 'ProjectController@index')->name('dashboard.project.index');

        Route::get('/create', 'ProjectController@create')->name('dashboard.project.create');
        Route::post('/create', 'ProjectController@store')->name('dashboard.project.store');

        Route::post('/upload-image/{itemId}', 'ProjectController@uploadImage')->name('dashboard.project.uploadImage');
        Route::post('/delete-image/{itemId}', 'ProjectController@deleteImage')->name('dashboard.project.deleteImage');

        Route::get('/edit/{itemId}', 'ProjectController@edit')->name('dashboard.project.edit');
        Route::put('/edit/{itemId}', 'ProjectController@update')->name('dashboard.project.update');
    });
});
