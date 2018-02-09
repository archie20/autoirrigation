<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Microcontroller;
use Illuminate\Http\Response as HttpResp;
use Illuminate\Support\Facades\Response;
use App\Moisture_Readings;
use App\Farmer;
use Illuminate\Support\Facades\Auth;
class Moisture_ReadingsController extends Controller {
	
	/**
	 *
	 * @param array $message
	 * @param unknown $status
	 */
	protected function responseObject($message,$status){
	
		return Response::make($message,$status);
	}
	
	
	/**
	 * 
	 * @param array $inputs
	 * @param array $rules
	 * @return boolean
	 */
	protected function validationPasser(array $inputs, array $rules){
		$validator = $this->getValidationFactory()->make($inputs, $rules);
	
		if($validator->fails())
			return false;
			else
				return true;
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $systemId
	 */
	public function logInfo(Request $request,$systemId){
		$validated = $this->validationPasser($request->all(), ['user_id'=>'required|numeric',
				'moist'=>'required',
				'temp' => 'required',
				'pump_status'=>'required',
				'humidity'=>'required',
				'time_recorded'=>'required'
		]);
	
		if(! $validated){
			return $this->responseObject(['message'=>'Some parameters are missing'], HttpResp::HTTP_BAD_REQUEST);
		}
	
		$irrSystem = Microcontroller::with('farmer')->where('token',$request->input('token'))
		->where('Farmer_id',$request->input('user_id'))
		->first();
	
		$readings = new Moisture_Readings;
		$readings->pump_status = $request->input('pump_status');
		$readings->temp_reading = $request->input('temp');
		$readings->moisture_value = $request->input('moist');
	//	$readings->time_recorded = $request->input('time_recorded');
		
	
		if( $irrSystem->moisture_readings()->save($readings)){
			return $this->responseObject(['message'=>'recorded successfully'], HttpResp::HTTP_CREATED);
		}else{
			return $this->responseObject(['message'=>'Server Error, Try again'], HttpResp::HTTP_INTERNAL_SERVER_ERROR);
		}
	}
	
	public function getAllMoisture(Request $request,$id) {
		$user = Farmer::find ( Auth::guard ()->user ()->id );
		
		if (! $user) {
			return redirect ( '/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$irrSystem = Microcontroller::find ( $id );
		if(! $irrSystem)
			return redirect()->back()->with ( 'error', 'Irrigation System not found, refresh the page!' );
		
		$moistures = $irrSystem->moisture_readings()->get(['time_recorded','moisture_value','pump_status']);
		return view('full-view')->with('infoType','moisture')
					   			->with('data',$moistures);
	}
	
	public function getAllTemperature(Request $request,$id) {
		$user = Farmer::find ( Auth::guard ()->user ()->id );
		
		if (! $user) {
			return redirect ( '/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$irrSystem = Microcontroller::find ( $id );
		if(! $irrSystem)
			return redirect()->back()->with ( 'error', 'Irrigation System not found, refresh the page!' );
		
		$temp = $irrSystem->moisture_readings()->get(['time_recorded','temp_reading','pump_status']);
		return view('full-view')->with('infoType','temp')
					   			->with('data',$temp);
	}
	
	public function getAllIntrusions(Request $request,$id) {
		$user = Farmer::find ( Auth::guard ()->user ()->id );
		
		if (! $user) {
			return redirect ( '/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$irrSystem = Microcontroller::find ( $id );
		if(! $irrSystem)
			return redirect()->back()->with ( 'error', 'Irrigation System not found, refresh the page!' );
		
		$intrusions = $irrSystem->intrusion()->get(['time_recorded']);
		
		return view('full-view')->with('infoType','intrus')
								->with('data',$intrusions);
		
	}
	
	
	
}
