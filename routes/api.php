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
    $api->post('login', 'Customer\Auth\LoginController@login');
    $api->post('login-with-otp', 'LoginController@loginWithOtp');
    $api->post('register', 'RegisterController@register');
    $api->post('forgot', 'ForgotPasswordController@forgot');
    $api->post('verify-otp', 'OtpController@verify');
    $api->post('resend-otp', 'OtpController@resend');
});

$api->group(['namespace' => 'Customer\Api'], function ($api) {
    // all logged in apis will go here
});
