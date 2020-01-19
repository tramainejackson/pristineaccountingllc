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

Route::get('/', 'HomeController@index')->name('home_index');

Route::post('/', 'HomeController@consult_request');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/pricing', 'HomeController@pricing')->name('pricing');

Route::resource('administrator', 'AdminController');

Route::resource('consults', 'ConsultRequestController');

Route::resource('consult_responses', 'ConsultResponseController');