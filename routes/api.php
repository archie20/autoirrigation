<?php
use Illuminate\Http\Request;

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