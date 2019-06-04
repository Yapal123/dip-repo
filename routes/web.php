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

Route::get('/','UserController@catalog')->name('catalog');

Route::get('/cart','UserController@cart')->name('cart');

Route::get('/checkOrder','UserController@checkOrder')->name('checkOrder');


Route::get('/allOrders','UserController@allOrders')->name('allOrders');

Route::get('/addProduct','UserController@addProduct')->name('addProduct');

Route::get('/log','UserController@log')->name('log');

Route::get('/reg','UserController@reg')->name('reg');


Route::post('/regHandle','UserController@regHandle')->name('regHandle');

Route::post('/logHandle','UserController@logHandle')->name('logHandle');

Route::get('/logout','UserController@logout')->name('logout');

Route::get('add-to-cart/{id}', 'UserController@addToCart')->name('addToCart');

Route::patch('update-cart','UserController@update');

Route::delete('remove-from-cart','UserController@remove');

Route::get('/createOrder','UserController@createOrder')->name('createOrder');

Route::post('/getOrder','UserController@getOrder')->name('getOrder');

Route::get('/myOrders','UserController@myOrders')->name('myOrders');

Route::post('/addHandle','UserController@addHandle')->name('addHandle');

Route::get('/editOrder/{orderNumber}','UserController@editOrder')->name('editOrder');

Route::post('/updateStatus/{orderNumber}','UserController@updateStatus')->name('editStatus');

Route::post('/del/{id}','UserController@deleteOrder')->name('deleteOrder');