<?php


Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () { return view('pages.homepage'); });
    Route::resource('contact', 'Marketing\ContactController');
    Route::resource('user', 'Users\UserController');
    Route::resource('role', 'RoleController');
    Route::resource('aboutUs', 'Marketing\AboutUsController', ['parameters' => ['aboutUs' => 'aboutUs']]);
    Route::resource('news', 'Marketing\NewsController');
    Route::get('news/updateToggle/{news}', 'Marketing\NewsController@toggle')->name('news.updateToggle');
    Route::resource('help', 'Marketing\HelpController');
    Route::post('help/updateSequence', 'Marketing\HelpController@updateSequence')->name('help.updateSequence');
//    Route::resource('flashNotification', 'FlashNotificationController');
    Route::resource('forteBankPayment', 'ForteBankPaymentController');
    Route::resource('kaspiQrPayment', 'KaspiQrPaymentController');
    Route::resource('halykBankPayment', 'HalykBankPaymentController');

    Route::get('priceList/mailing/list', 'PriceListController@mailingList')->name('priceList.mailingList');
    Route::get('priceList/mailing', 'PriceListController@mailingForm')->name('priceList.mailingForm');
    Route::post('priceList/mailing', 'PriceListController@mailing')->name('priceList.mailing');
    Route::resource('priceList', 'PriceListController');

    Route::resource('security', 'Marketing\SecurityController');
    Route::post('security/updateSequence', 'Marketing\SecurityController@updateSequence')->name('security.updateSequence');

    Route::resource('paymentMethod', 'PaymentMethodController');
    Route::get('paymentMethod/updateToggle/{paymentMethod}', 'PaymentMethodController@toggle')->name('paymentMethod.updateToggle');

    Route::prefix('discount')->group(function () {
        Route::prefix('limit')->group(function () {
            Route::resource('periodic', 'Discounts\DiscountLimitOnPeriodController', ['as' => 'discount.limit'])
                ->parameters([
                    'periodic' => 'discountLimit',
                ]);
        });
        Route::resource('document', 'Discounts\DiscountDocumentController',
            ['as' => 'discount']
        );
    });

    Route::resource('remains', 'RemainsController');

    Route::resource('partner', 'Users\PartnerApplicationController');

    Route::resource('managers', 'Users\ManagerController');

    Route::resource('roles', 'RolesController');

    Route::resource('orders', 'OrdersController');

    Route::prefix('cross')->group(function () {
        Route::get('create', 'Cross\CrossController@create')->name('cross.create');
        Route::post('/', 'Cross\CrossController@store')->name('cross.store');
        Route::get('destroy', 'Cross\CrossController@destroy')->name('cross.destroy');
        Route::post('delete', 'Cross\CrossController@delete')->name('cross.delete');
        Route::post('import', 'Cross\CrossImportController@store')->name('cross.import');
        Route::post('import/delete', 'Cross\CrossImportController@delete')->name('cross.import.delete');
        Route::get('check', 'Cross\CrossCheckController@index')->name('cross.check');
    });


    Route::resource('permission', 'PermissionController');


    Route::resource('popularCategory', 'Marketing\PopularCategoryController');
    Route::post('popularCategory/updateSequence', 'Marketing\PopularCategoryController@updateSequence')->name('popularCategory.updateSequence');

    Route::resource('menu', 'Menu\MenuElementController', ['except' => ['create', 'edit'], 'parameters' => ['menu' => 'menuElement']]);
    Route::post('/menu/sequence', 'Menu\MenuElementController@sequence');

    Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
    Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');

});
