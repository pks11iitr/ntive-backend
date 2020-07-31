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
    $api->post('forgot', 'ForgotPasswordController@forgot');
    $api->post('verify-otp', 'OtpController@verify');
    $api->post('resend-otp', 'OtpController@resend');
});

$api->group(['namespace' => 'Customer\Api'], function ($api) {
    // all logged in apis will go here
});
$api->get('home', ['as'=>'api.home', 'uses'=>'Customer\Api\HomeController@index']);
$api->get('special-product/{type}/product', ['as'=>'api.special-product', 'uses'=>'Customer\Api\ProductController@special_product']);
$api->get('category-product/{type}/{subcatid}/product', ['as'=>'api.category-product', 'uses'=>'Customer\Api\ProductController@category_product']);
$api->get('sub-category/{catid}/category', ['as'=>'api.sub-category', 'uses'=>'Customer\Api\SubCategoryController@subcategory']);
$api->post('add-cart', ['as'=>'api.cart', 'uses'=>'Customer\Api\CartController@store']);
$api->get('get-cart', ['as'=>'api.get.cart', 'uses'=>'Customer\Api\CartController@getCart']);