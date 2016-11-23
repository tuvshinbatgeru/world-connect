<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
	return view('admin.index');
});

Route::get('/album', 'AlbumController@albums');
Route::get('/news', 'NewsController@news');
Route::get('/school', 'SchoolController@schools');

Route::group(['prefix' => '/admin'], function () {
	Route::get('/dashboard', 'AdminController@dashboard');
	
	Route::get('/country/list', 'CountryController@list');
	Route::get('/country/check', 'CountryController@check');
	Route::get('/country/select', 'CountryController@counties');
	Route::post('/country/{country}', 'CountryController@update');
	Route::resource('/country', 'CountryController');
	Route::post('/upload', 'AdminController@upload');
	Route::delete('/delete', 'AdminController@delete');


	Route::get('/school/list', 'SchoolController@list');
	Route::get('/school/check', 'SchoolController@check');
	Route::post('/school/{school}', 'SchoolController@update');
	Route::resource('/school', 'SchoolController');

	Route::get('/news/list', 'NewsController@list');
	Route::post('/news/{news}', 'NewsController@update');
	Route::resource('/news', 'NewsController');

	Route::get('/album/list', 'AlbumController@list');
	Route::get('/album/check', 'AlbumController@check');
	Route::post('/album/photo', 'AlbumController@uploadPhotos');
	Route::post('/album/{album}', 'AlbumController@update');
	Route::resource('/album', 'AlbumController');
	Route::delete('/album/photo/{photo}', 'AlbumController@deletePhoto');
});
