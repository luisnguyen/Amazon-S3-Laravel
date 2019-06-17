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

Route::post('/upload', 'Storage\AmazonController@store')->name('upload');

Route::get('/path/{key}', 'Storage\AmazonController@show')->name('path');

Route::get('/delete/{key}', 'Storage\AmazonController@destroy')->name('path');
