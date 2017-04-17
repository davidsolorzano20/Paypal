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
Auth::routes();
Route::get('/home', 'HomeController@index');

/*Method Payment Paypal*/
Route::get('/payment','PaypalController@Payment');
Route::get('/payment/status','PaypalController@PaymentStatus');
Route::get('/payment/status/done','PaypalController@PaymentStatusDone');
Route::get('/payment/status/cancel', 'PaypalController@PaymentStatusCancel');
