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

Route::get('/', "TripController@index");
Route::post('/trip/start-trip', "TripController@startTrip");
Route::post('/trip/end-trip', "TripController@endTrip");
