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
    Route::post('help/updateSequence', 'HelpController@updateSequence')->name('help.updateSequence');

    Route::resource('roles', 'RolesController');

    Route::resource('popularCategory', 'PopularCategoryController');
    Route::post('popularCategory/updateSequence', 'PopularCategoryController@updateSequence')->name('popularCategory.updateSequence');

    Route::resource('menu', 'MenuElementController', ['except' => ['create', 'edit'], 'parameters' => ['menu' => 'menuElement']]);
    Route::post('/menu/sequence', 'MenuElementController@sequence');

    Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
    Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');

});