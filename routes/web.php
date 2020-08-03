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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
// ----------------------------Cash_box------------------
Route::resource('/cash-box', 'CashBoxController');
/*-----------------------------CashFinanceController-------------------------*/
Route::resource('/cash-finance', 'CashFinanceController');
Route::get('/add-cash-finance/{id}', 'CashFinanceController@addCashFinance')->name('add-cash-finance');
/*-----------------------------CashOperationController-------------------------*/
Route::resource('/cash-operation', 'CashOperationController');
Route::get('/add-cash-operation/{id}', 'CashOperationController@addCashOperation')->name('add-cash-operation');


