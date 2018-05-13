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


Route::get('/', 'AirController@index');
Route::post('/', 'AirController@index');
Route::get('/calculate', 'AirController@calculate');
Route::post('/calculate', 'AirController@calculateResult');
Route::get('/show', 'AirController@show');
Route::post('/show', 'AirController@show');

