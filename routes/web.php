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

Route::get('/', function () {
    return view('welcome');
})->name('website.home');

Auth::routes();

Route::group(['middleware'=>['auth', 'acl'], 'is'=>'admin'], function(){
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    Route::group(['prefix'=>'banners'], function(){
        Route::get('/','Admin\BannerController@index')->name('banners.list');
        Route::get('create','Admin\BannerController@create')->name('banners.create');
        Route::post('store','Admin\BannerController@store')->name('banners.store');
        Route::get('edit/{id}','Admin\BannerController@edit')->name('banners.edit');
        Route::post('update/{id}','Admin\BannerController@update')->name('banners.update');
        Route::get('delete/{id}','Admin\BannerController@delete')->name('banners.delete');
    });

    Route::group(['prefix'=>'notification'], function(){
        Route::get('create','Admin\NotificationController@create')->name('notification.create');
        Route::post('store','Admin\NotificationController@store')->name('notification.store');

    });

    Route::group(['prefix'=>'customer'], function(){
        Route::get('/','Admin\CustomerController@index')->name('customer.list');
        Route::get('edit/{id}','Admin\CustomerController@edit')->name('customer.edit');
        Route::post('update/{id}','Admin\CustomerController@update')->name('customer.update');
        Route::post('send_message','Admin\CustomerController@send_message')->name('customer.send_message');
        Route::get('contacts/{id}','Admin\CustomerController@contacts')->name('customer.contacts');
    });


    Route::group(['prefix'=>'homecategory'], function(){
        Route::get('/','Admin\HomeCategoryController@index')->name('homecategory.list');
        Route::get('create','Admin\HomeCategoryController@create')->name('homecategory.create');
        Route::post('store','Admin\HomeCategoryController@store')->name('homecategory.store');
        Route::get('edit/{id}','Admin\HomeCategoryController@edit')->name('homecategory.edit');
        Route::post('update/{id}','Admin\HomeCategoryController@update')->name('homecategory.update');
    });

    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/','Admin\SubCategoryController@index')->name('subcategory.list');
        Route::get('create','Admin\SubCategoryController@create')->name('subcategory.create');
        Route::post('store','Admin\SubCategoryController@store')->name('subcategory.store');
        Route::get('edit/{id}','Admin\SubCategoryController@edit')->name('subcategory.edit');
        Route::post('update/{id}','Admin\SubCategoryController@update')->name('subcategory.update');
    });

    Route::group(['prefix'=>'product'], function(){
        Route::get('/','Admin\ProductController@index')->name('product.list');
        Route::get('create','Admin\ProductController@create')->name('product.create');
        Route::post('store','Admin\ProductController@store')->name('product.store');
        Route::get('edit/{id}','Admin\ProductController@edit')->name('product.edit');
        Route::post('update/{id}','Admin\ProductController@update')->name('product.update');
        Route::post('upload-images/{id}','Admin\ProductController@uploadImages')->name('product.upload.image');
        Route::get('delete/{id}','Admin\ProductController@delete')->name('product.delete');
        Route::post('product-sizeprice/{id}','Admin\ProductController@sizeprice')->name('product.sizeprice');
        Route::get('size-update','Admin\ProductController@updatesizeprice')->name('product.size.update');
        Route::get('sizeprice-delete/{id}','Admin\ProductController@sizeprice_delete')->name('product.delete.sizeprice');
    });

    Route::group(['prefix'=>'order'], function(){
        Route::get('/','Admin\OrderController@index')->name('order.list');
        Route::get('orderview/{id}','Admin\OrderController@orderview')->name('order.orderview');
        Route::get('change-status/{id}','Admin\OrderController@changeStatus')->name('order.status.change');
        Route::get('change-payment-status/{id}','Admin\OrderController@changePaymentStatus')->name('payment.status.change');

    });

    Route::group(['prefix'=>'contact'], function(){
        Route::get('/','Admin\ContactController@index')->name('contact.list');

    });

    Route::group(['prefix'=>'pincode'], function(){
        Route::get('/','Admin\PinCodeController@index')->name('pincode.list');
        Route::get('create','Admin\PinCodeController@create')->name('pincode.create');
        Route::post('store','Admin\PinCodeController@store')->name('pincode.store');
        Route::get('delete/{id}','Admin\PinCodeController@delete')->name('pincode.delete');

    });

    Route::group(['prefix'=>'coupon'], function(){
        Route::get('/','Admin\CouponController@index')->name('coupon.list');
        Route::get('create','Admin\CouponController@create')->name('coupon.create');
        Route::post('store','Admin\CouponController@store')->name('coupon.store');
        Route::get('edit/{id}','Admin\CouponController@edit')->name('coupon.edit');
        Route::post('update/{id}','Admin\CouponController@update')->name('coupon.update');

    });


});

Route::get('abouts','Admin\AboutsController@abouts');
Route::get('privacy','Admin\AboutsController@privacy');

Route::get('privacy-policy','Admin\AboutsController@privacyweb')->name('privacy.web');
Route::get('terms-and-conditions','Admin\AboutsController@termsweb')->name('terms.web');
Route::get('about-us','Admin\AboutsController@aboutweb')->name('about.us.web');
Route::get('contact-us','Admin\AboutsController@contactweb')->name('contact.us.web');

