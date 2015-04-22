<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});


Route::group(['prefix' => 'tryindication/api', 'before' => 'oauth'], function() {

    Route::get('/', 'HomeController@showWelcome');
    Route::post('/', 'HomeController@showWelcome');



    Route::get('/processing-indications', 'ProcessingIndicationsController@showWelcome');

    Route::get('product/{companyHash}/{id}', 'ProductController@show');

    Route::post('product', 'ProductController@store');

    Route::put('product/{id}', 'ProductController@update');

    Route::post('product/multiple', 'MultipleProductsController@store');

    // E-mails Routers

    Route::get('email/{companyHash}/{clientId}', 'AbandonedCartController@show');

    Route::post('email', 'AbandonedCartController@store');

    // E-mails Routers

    Route::get('setredisdata/{companyHash}', 'SetRedisDataController@show');

    Route::resource('client', 'ClientController');

    Route::resource('relationship', 'RelationshipController');

    // Rota para recuperar indicações de produtos
    Route::get('indications/companyhash/{companyHash}/product/{id}', 'IndicationsController@show');

    Route::get('indications/last/companyhash/{companyHash}/client/{id}', 'IndicationsController@last');

});
