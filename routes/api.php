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
    $api->post('login', ['as' => 'api.login', 'uses' => 'LoginController@login']);

    $api->post('verify-otp', ['as' => 'api.otp.verify', 'uses' => 'LoginController@verifyOTP']);

    $api->post('resend-otp', ['as' => 'api.otp.resend', 'uses' => 'LoginController@resendOTP']);
});

$api->group(['namespace' => 'Customer\Api'], function ($api) {
    $api->get('home', ['as' => 'api.home', 'uses' => 'HomeController@home']);
    $api->get('offers', ['as' => 'api.offers', 'uses' => 'OffersController@index']);
    $api->get('notifications', ['as' => 'api.notifications', 'uses' => 'NotificationController@index']);
    $api->get('my-applications', ['as' => 'api.applications', 'uses' => 'OrderController@history']);
    $api->post('verify-step1', ['as' => 'api.verify.step1', 'uses' => 'VerificationController@step1']);
    $api->post('verify-step2', ['as' => 'api.verify.step2', 'uses' => 'VerificationController@step2']);

    $api->get('start-loan-application/{id}', ['as' => 'api.start.applications', 'uses' => 'ApplicationController@start_application']);

    $api->post('apply-loan', ['as' => 'api.apply.loan', 'uses' => 'ApplicationController@apply']);
    $api->get('application-details/{id}', ['as' => 'api.apply.loan', 'uses' => 'OrderController@details']);

    $api->get('send-contacts', ['as' => 'api.apply.loan', 'uses' => 'ContactController@store']);

});
