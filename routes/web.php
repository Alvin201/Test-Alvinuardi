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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/topup', 'TopupController@index')->name('topup');
Route::post('topup', 'TopupController@store');  
Route::get('/history', 'HistoryController@index')->name('history');
Route::get('/history/edit/{id}','HistoryController@edit');
Route::post('/history/update/{id}','HistoryController@update');