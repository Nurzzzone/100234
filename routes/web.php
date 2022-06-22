<?php

use App\Http\Controllers\Discounts\DiscountLimitController;

Auth::routes();

Route::group(['middleware' => ['auth', 'get.menu']], function () {

    Route::get('/', function () { return view('pages.homepage'); });
    Route::resource('contact', 'ContactController');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('aboutUs', 'AboutUsController', ['parameters' => ['aboutUs' => 'aboutUs']]);
    Route::resource('news', 'NewsController');
    Route::get('news/updateToggle/{news}', 'NewsController@toggle')->name('news.updateToggle');
    Route::resource('help', 'HelpController');
    Route::post('help/updateSequence', 'HelpController@updateSequence')->name('help.updateSequence');
//    Route::resource('flashNotification', 'FlashNotificationController');
    Route::resource('forteBankPayment', 'ForteBankPaymentController');

    Route::get('priceList/mailing/list', 'PriceListController@mailingList')->name('priceList.mailingList');
    Route::get('priceList/mailing', 'PriceListController@mailingForm')->name('priceList.mailingForm');
    Route::post('priceList/mailing', 'PriceListController@mailing')->name('priceList.mailing');
    Route::resource('priceList', 'PriceListController');

    Route::resource('security', 'SecurityController');
    Route::post('security/updateSequence', 'SecurityController@updateSequence')->name('security.updateSequence');

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

    Route::resource('partner', 'PartnerApplicationController');

    Route::resource('managers', 'ManagerController');

    Route::resource('roles', 'RolesController');

    Route::resource('popularCategory', 'PopularCategoryController');
    Route::post('popularCategory/updateSequence', 'PopularCategoryController@updateSequence')->name('popularCategory.updateSequence');

    Route::resource('menu', 'MenuElementController', ['except' => ['create', 'edit'], 'parameters' => ['menu' => 'menuElement']]);
    Route::post('/menu/sequence', 'MenuElementController@sequence');

    Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
    Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');

});
