<?php

Auth::routes();

Route::group(['middleware' => ['auth', 'get.menu']], function () {
    Route::get('/', function () { return view('pages.homepage'); });

    Route::resource('contact', 'ContactController');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('aboutUs', 'AboutUsController', ['parameters' => ['aboutUs' => 'aboutUs']]);
    Route::resource('news', 'NewsController');
    Route::resource('help', 'HelpController');

    Route::resource('roles', 'RolesController');
    Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
    Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');


    Route::prefix('menu/element')->group(function () {
        Route::get('/',             'MenuElementController@index')->name('menu.index');
        Route::post('/createElement',         'MenuElementController@createElement');
        Route::get('/showElement/{menuElement}',         'MenuElementController@showElement');
        Route::put('/updateElement/{menuElement}',         'MenuElementController@updateElement');
        Route::delete('/deleteElement/{menuElement}',       'MenuElementController@delete')->name('menu.delete');
        Route::post('/updateSequence',       'MenuElementController@updateSequence');
    });
});