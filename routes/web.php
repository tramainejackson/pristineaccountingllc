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
	$consult_contact = \App\ConsultContact::find(1);

	$consult_contact->first_name = "Bigalo";
	$consult_contact->last_name = "Jiggalo";
	$consult_contact->email = "Bigalo.Jiggalo@test.com";
	$consult_contact->phone = "215-Phone-Home";

	return view('emails.new_contact', compact('consult_contact', 'contact', 'amount', 'body', 'subject', 'setting', 'token', 'showingDate'));
})->name('test');

Route::get('/', 'HomeController@index')->name('home_index');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/pricing', 'HomeController@pricing')->name('pricing');

Route::get('/testimonials', 'HomeController@testimonials')->name('testimonials');

Route::resource('administrator', 'AdminController');

Route::get('survey/{survey_id}', 'RecommendationController@survey');

Route::get('/send_survey/{consult_contact}', 'RecommendationController@send_survey');

Route::resource('recommendations', 'RecommendationController');

Route::resource('consults', 'ConsultRequestController');

Route::resource('consult_responses', 'ConsultResponseController');

Route::resource('consult_contacts', 'ConsultContactController');