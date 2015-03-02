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

Route::get('/', 'HomeController@showWelcome');

Route::get('product/{companyHash}/{id}', 'ProductController@show');

Route::post('product', 'ProductController@store');

Route::put('product/{id}', 'ProductController@update');

// E-mails Routers

Route::get('email/{companyHash}/{clientId}', 'GetEmailIndicationsController@show');

Route::post('email', 'GetEmailIndicationsController@store');

// E-mails Routers

Route::get('setredisdata/{companyHash}', 'SetRedisDataController@show');

Route::resource('client', 'ClientController');

Route::resource('relationship', 'RelationshipController');


