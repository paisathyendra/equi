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

Route::group(['middleware' => ['auth']], function() {
	route::resource('company', 'CompanyController');
	route::resource('user', 'UsersController');
	route::resource('syndicate', 'SyndicateController');
}); 

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('profile/{id}', 'ProfileController@show');

Route::get('company/{id}/edit', 'CompanyController@update');
