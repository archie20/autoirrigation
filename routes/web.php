<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | This file is where you may define all of the routes that are handled
 * | by your application. Just tell Laravel the URIs it should respond
 * | to using a Closure or controller method. Build something great!
 * |
 */
Route::get ( '/', function () {
	return view ( 'welcome' );
} );

Auth::routes ();

Route::get ( '/home', 'HomeController@index' );

Route::get ( '/profile', 'FarmerController@updateDetailsPage' );

Route::post ( '/profile', 'FarmerController@updateFarmerDetails' );

Route::get ( '/microcontroller/{id}', 'MicrocontrollerController@updateIrrigationSystemPage' );

Route::post ( '/microcontroller/{id}', 'MicrocontrollerController@updateIrrigationSystem' );

Route::get ( '/dash/system/{id}', 'MicrocontrollerController@userSystemOverview' );

Route::get('/microcontroller/status/{id}','MicrocontrollerController@changeIrrigationSystemStatus');

// Admin
Route::get ( '/admin_area/login', 'Auth\Admin\LoginController@showLoginForm' );
Route::post ( '/admin/login', 'Auth\Admin\LoginController@login' );
Route::get ( '/admin_area/register', 'Auth\Admin\RegisterController@showRegistrationForm' );
Route::post ( '/admin/register', 'Auth\Admin\RegisterController@register' );
Route::post ( '/admin/logout', 'Auth\Admin\LoginController@logout' );

Route::get ( '/admin/home', 'AdminController@adminPage' );
Route::get ( '/admin_area/soils', 'AdminController@soilEditorPage' );
Route::post ( '/admin/soils', 'SoilController@addOrEditSoil' );
Route::get ( '/admin/regsys', 'MicrocontrollerController@viewAllIrrigationSystems' );
Route::get ( '/admin/all_users', 'FarmerController@allUsers' );
Route::get ( '/admin/add_irrigation', 'MicrocontrollerController@registerIrrigationSystemPage' );
Route::post ( '/admin/add_irrigation', 'MicrocontrollerController@registerIrrigationSystem' );




