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

 Route::get('/', function () {
     return view('welcome');
 });
Route::get('/getToken', 'UserController@showToken');
Route::post('/userSave', 'UserController@saveUser');
Route::post('/user/{id}/user_address', 'UserController@storeUserAddress');
Route::get('/user/{id}', 'UserController@show');
Route::get('/user/{id}/user_address', 'UserController@showUserAddress');
Route::put('/user/{id}', 'UserController@update');
Route::delete('/user/{id}', 'UserController@userDelete');
Route::delete('/user_address/{id}', 'UserController@userAddressDelete');

