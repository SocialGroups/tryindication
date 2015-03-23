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

//-- Home
Route::get('/', 'HomeController@showWelcome');


//-- Product
Route::get('product/{companyHash}/{id}', 'ProductController@show');

Route::post('product', 'ProductController@store');

Route::put('product/{id}', 'ProductController@update');

Route::post('product/multiple', 'MultipleProductsController@store');


//-- Query
//Route::post('query', 'QueryController@store');

Route::get('query', 'QueryController@index');


// E-mails Routers
Route::get('email/{companyHash}/{clientId}', 'GetEmailIndicationsController@show');

Route::post('email', 'GetEmailIndicationsController@store');


// E-mails Routers
Route::get('setredisdata/{companyHash}', 'SetRedisDataController@show');

Route::resource('client', 'ClientController');

Route::resource('relationship', 'RelationshipController');
