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
});

Auth::routes();

Route::group(['middle'=>['auth', 'acl'], 'is'=>'admin'], function(){
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    Route::group(['prefix'=>'banners'], function(){
        Route::get('/','Admin\BannerController@index')->name('banners.list');
        Route::get('create','Admin\BannerController@create')->name('banners.create');
        Route::post('store','Admin\BannerController@store')->name('banners.store');
        Route::get('edit/{id}','Admin\BannerController@edit')->name('banners.edit');
        Route::post('update/{id}','Admin\BannerController@update')->name('banners.update');
        Route::get('delete/{id}','Admin\BannerController@delete')->name('banners.delete');
    });

    Route::group(['prefix'=>'news'], function(){
        Route::get('/','Admin\NewsUpdateController@index')->name('news.list');
        Route::get('create','Admin\NewsUpdateController@create')->name('news.create');
        Route::post('store','Admin\NewsUpdateController@store')->name('news.store');
        Route::get('edit/{id}','Admin\NewsUpdateController@edit')->name('news.edit');
        Route::post('update/{id}','Admin\NewsUpdateController@update')->name('news.update');
        Route::post('news_search','Admin\NewsUpdateController@news_search')->name('news.news_search');

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
        Route::post('documents/{id}','Admin\CustomerController@uploadDocuments')->name('customer.documents');
        Route::get('download-documents/{id}','Admin\CustomerController@downloadZip')->name('customer.download');
        Route::get('contacts/{id}','Admin\CustomerController@contacts')->name('customer.contacts');
    });


    Route::group(['prefix'=>'applications'], function(){
        Route::get('/','Admin\LoanApplicationController@index')->name('orders.list');
        Route::get('view/{id}','Admin\LoanApplicationController@details')->name('order.view');
        Route::get('product','Admin\LoanApplicationController@product')->name('orders.product');
        Route::post('therapy_search','Admin\LoanApplicationController@therapy_search')->name('orders.therapy_search');
        Route::post('order_search','Admin\LoanApplicationController@order_search')->name('orders.order_search');
        Route::get('edit/{id}','Admin\LoanApplicationController@edit')->name('orders.edit');
        Route::post('edit/{id}','Admin\LoanApplicationController@update');

    });

    Route::group(['prefix'=>'loan-offers'], function(){
        Route::get('/','Admin\LoanOfferController@index')->name('offers.list');
        Route::get('create','Admin\LoanOfferController@create')->name('offers.create');
        Route::post('create','Admin\LoanOfferController@store');
        Route::get('edit/{id}','Admin\LoanOfferController@edit')->name('offers.edit');
        Route::post('edit/{id}','Admin\LoanOfferController@update');
    });

    Route::group(['prefix'=>'documents'], function(){
        Route::get('view/{id}','Admin\DocumentController@view')->name('document.view');
        Route::get('delete/{id}','Admin\DocumentController@delete')->name('document.delete');
    });

});
