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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('types','TypesController');
Route::put('types/disable/{id}','TypesController@disable');
Route::get('types/status/{status}','TypesController@getAllActive');

Route::resource('propertyTypes','PropertyTypesController');
Route::put('propertyTypes/disable/{id}','PropertyTypesController@disable');
Route::get('propertyTypes/status/{status}','PropertyTypesController@getAllActive');

Route::resource('locations','LocationsController');
Route::put('locations/disable/{id}','LocationsController@disable');
Route::get('locations/status/{status}','LocationsController@getAllActive');

Route::resource('communities','CommunitiesController');
Route::put('communities/disable/{id}','CommunitiesController@disable');
Route::get('communities/status/{status}','CommunitiesController@getAllActive');

Route::resource('villages','VillagesController');
Route::put('villages/disable/{id}','VillagesController@disable');
Route::get('villages/status/{status}','VillagesController@getAllActive');

Route::resource('customers','CustomersController');
Route::put('customers/disable/{id}','CustomersController@disable');
Route::get('customers/status/{status}','CustomersController@getAllActive');

Route::resource('properties','PropertiesController');
Route::put('properties/disable/{id}','PropertiesController@disable');
Route::get('properties/status/{status}','PropertiesController@getAllActive');
