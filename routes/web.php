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

Route::get('/test', function() {
	$consult_request = \App\ConsultRequest::find(3);
	$consult_contact = $consult_request->consultContact;

	return view('emails.new_consult', compact('consult_contact', 'contact', 'consult_request', 'amount', 'body', 'subject', 'setting', 'token', 'showingDate'));
})->name('test');

Route::resource('administrator', 'AdminController');

Route::resource('recommendations', 'RecommendationController');

Route::resource('consults', 'ConsultRequestController');

Route::resource('consult_responses', 'ConsultResponseController');

Route::resource('consult_contacts', 'ConsultContactController');

Route::get('/', 'HomeController@index')->name('home_index');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/pricing', 'HomeController@pricing')->name('pricing');

Route::get('survey/{survey_id}', 'RecommendationController@survey');

Route::get('/send_survey/{consult_contact}', 'RecommendationController@send_survey');

Route::delete('/consult_survey/{recommendation}', 'RecommendationController@destroy');

Route::post('/create_invoice/{consult}', 'ConsultRequestController@create_invoice');