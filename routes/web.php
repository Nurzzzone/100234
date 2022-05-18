<?php

Auth::routes();

Route::group(['middleware' => ['auth', 'get.menu']], function () {
    Route::get('/', function () { return view('pages.homepage'); });

    Route::resource('contact', 'ContactController');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');

    Route::prefix('discount')->group(function () {
        Route::prefix('limit')->group(function () {
            Route::resource('periodic', 'Discounts\DiscountLimitOnPeriodController',
                array('names' => array(
                    'create' => 'discount.limit.periodic.create',
                    'index' => 'discount.limit.periodic.index',
                    'store' => 'discount.limit.periodic.store',
                    'show' => 'discount.limit.periodic.show',
                    'update' => 'discount.limit.periodic.update',
                    'destroy' => 'discount.limit.periodic.destroy',
                    'edit' => 'discount.limit.periodic.edit')))
                ->parameters([
                'periodic' => 'discountLimit',
            ]);
        });
    });

    Route::resource('roles', 'RolesController');
    Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
    Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');


    Route::prefix('menu/element')->group(function () {
        Route::get('/',             'MenuElementController@index')->name('menu.index');
        Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
        Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
        Route::get('/create',       'MenuElementController@create')->name('menu.create');
        Route::post('/store',       'MenuElementController@store')->name('menu.store');
        Route::get('/get-parents',  'MenuElementController@getParents');
        Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
        Route::post('/update',      'MenuElementController@update')->name('menu.update');
        Route::get('/show',         'MenuElementController@show')->name('menu.show');
        Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
    });

    Route::prefix('menu/menu')->group(function () {
        Route::get('/',         'MenuController@index')->name('menu.menu.index');
        Route::get('/create',   'MenuController@create')->name('menu.menu.create');
        Route::post('/store',   'MenuController@store')->name('menu.menu.store');
        Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
        Route::post('/update',  'MenuController@update')->name('menu.menu.update');
        Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
    });
});