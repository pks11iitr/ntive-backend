<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


$api = app('Dingo\Api\Routing\Router');

$api->group(['namespace' => 'Customer\Api\Auth'], function ($api) {
    $api->post('login', 'LoginController@login');
    $api->post('login-with-otp', 'LoginController@loginWithOtp');
    $api->post('register', 'RegisterController@register');
    $api->post('forgot', 'ForgotPasswordController@sendResetOTP');
    $api->post('verify-otp', 'OtpController@verify');
    $api->post('resend-otp', 'OtpController@resend');
    $api->post('update-password', 'ForgotPasswordController@updatePassword');
});

$api->group(['namespace' => 'Customer\Api'], function ($api) {
    // all logged in apis will go here
});
$api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
$api->post('search', ['as'=>'api.search', 'uses'=>'Customer\Api\SearchController@index']);
$api->get('special-product/{type}/product', ['as'=>'api.special-product', 'uses'=>'Customer\Api\ProductController@special_product']);
$api->get('category-product/{type}/{subcatid}/product', ['as'=>'api.category-product', 'uses'=>'Customer\Api\ProductController@category_product']);
$api->get('sub-category/{catid}/category', ['as'=>'api.sub-category', 'uses'=>'Customer\Api\SubCategoryController@subcategory']);
$api->get('products', ['as'=>'products.list', 'uses'=>'Customer\Api\ProductController@products']);
//cart apis
$api->post('add-cart', ['as'=>'api.cart', 'uses'=>'Customer\Api\CartController@store']);
$api->get('get-cart', ['as'=>'api.cart', 'uses'=>'Customer\Api\CartController@getCart']);


//product details
$api->get('product-details/{id}', ['as'=>'api.get.product', 'uses'=>'Customer\Api\ProductController@details']);

//notifications api
$api->get('notifications', ['as'=>'notifications.list', 'uses'=>'Customer\Api\NotificationController@index']);


//Order apis
$api->post('initiate-order', ['as'=>'initiate.order', 'uses'=>'Customer\Api\OrderController@initiateOrder']);

$api->get('order-details/{id}', ['as'=>'order.details', 'uses'=>'Customer\Api\OrderController@orderdetails']);

$api->get('order-history', ['as'=>'order.history', 'uses'=>'Customer\Api\OrderController@index']);

$api->get('cancel-order/{id}', ['as'=>'order.cancel', 'uses'=>'Customer\Api\OrderController@cancelOrder']);

$api->get('return-order/{id}', ['as'=>'order.return', 'uses'=>'Customer\Api\OrderController@returnProductsBooking']);

$api->post('update-contact/{id}', ['as'=>'order.contact.update', 'uses'=>'Customer\Api\OrderController@addContactDetails']);

$api->get('get-contact', ['as'=>'order.contact', 'uses'=>'Customer\Api\OrderController@getContactDetails']);

$api->get('profile', ['as'=>'user.profile', 'uses'=>'Customer\Api\ProfileController@view']);

$api->post('update-profile', ['as'=>'user.profile.update', 'uses'=>'Customer\Api\ProfileController@update']);

$api->post('update-profile-info', ['as'=>'user.profile.update', 'uses'=>'Customer\Api\ProfileController@updateinfo']);

$api->get('notify-me/{id}', ['as'=>'user.notify.me', 'uses'=>'Customer\Api\NotifyController@update']);

$api->post('apply-coupon/{id}', ['as'=>'user.notify.me', 'uses'=>'Customer\Api\CouponController@applyCoupon']);

$api->post('contact', ['as'=>'user.contact', 'uses'=>'Customer\Api\ContactController@store']);



//payment apis
$api->post('initiate-payment/{id}', ['as'=>'order.payment', 'uses'=>'Customer\Api\PaymentController@initiatePayment']);
$api->post('verify-payment', ['as'=>'order.payment.verify', 'uses'=>'Customer\Api\PaymentController@verifyPayment']);

