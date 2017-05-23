<?php
use Illuminate\Http\Request;
use App\Http\Controllers\FarmerController;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

Route::get ( '/user', function (Request $request) {
	echo 'wi';
} );

Route::post('/refresh/token/{systemId}','MicrocontrollerController@generateControllerToken');

Route::post('/add/sensor/{systemId}','MicrocontrollerController@addSensor')->middleware('token');

Route::post('/log/readings/{systemId}','Moisture_ReadingsController@logInfo')->middleware('token');

Route::post('/log/intrusion/{systemId}','IntrusionController@reportIntrusion')->middleware('token');

Route::post('/forecast/{systemId}','MicrocontrollerController@getRainPrediction')->middleware('token');

Route::get('/system/pump/{systemId}','MicrocontrollerController@checkPumpStatus')->middleware('token');


///Mobile devices APIs
Route::post('/user/login','FarmerController@mobileLogin');

Route::post('/user/logout','FarmerController@mobileLogout');

Route::get('/user/system/all','FarmerController@getAllIrrigationSystems');

Route::get('/user/system/{systemId}','FarmerController@getSystemDetails');

Route::get('/user/system/recorded/{systemId}','FarmerController@systemRecordedInfo');

Route::post('/user/system/pump/{systemId}','FarmerController@pumpSwitch');