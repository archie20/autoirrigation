<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Microcontroller;
use App\Soil;
use App\Farmer;
use App\Moisture_Readings;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Http\Response as HttpResp;
use Illuminate\Support\Facades\Response;


class MicrocontrollerController extends Controller {
	public function registerIrrigationSystemPage(Request $request) {
		$admin = Admin::find ( Auth::guard ( 'admin' )->user ()->id );
		
		if (! $admin) {
			
			return redirect ( '/admin/home' )->with ( 'error', '
					You are not authorized to perform any action. Log in again' );
		}
		
		return view ( 'admin.register-new-system' );
	}
	public function registerIrrigationSystem(Request $request) {
		$admin = Admin::find ( Auth::guard ( 'admin' )->user ()->id );
		
		if (! $admin) {
			
			return redirect ()->back ()->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$this->validate ( $request, [ 
				'email' => 'required' 
		] );
		
		$regFarmer = Farmer::where ( 'email', $request->input ( 'email' ) )->first ();
		$irrSystem = new Microcontroller ();
		
		if (! $regFarmer) {
			return back ()->with ( 'error', 'User not found' );
		}
		
		$regFarmer->microcontrollers ()->save ( $irrSystem );
		return redirect ()->back ()->with ( 'success', 'added a new irrigation system for ' . $request->input ( 'email' ) );
	}
	public function updateIrrigationSystemPage(Request $request, $id) {
		$user = Farmer::find ( Auth::guard ()->user ()->id );
		
		if (! $user) {
			
			return redirect ( '/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$irrSystem = Microcontroller::find ( $id );
		$soilTypes = Soil::all ();
		if (! $irrSystem) {
			return redirect ( '/not-found' );
		}
		return view ( 'edit-controller' )->with ( 'irrSystem', $irrSystem )->with ( 'soilTypes', $soilTypes );
	}
	public function updateIrrigationSystem(Request $request, $id) {
		$user = Farmer::find ( Auth::guard ()->user ()->id );
		
		if (! $user) {
			
			return redirect ( '/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$irrSystem = Microcontroller::find ( $id );
		
		if ($irrSystem) {
			
			$irrSystem->Soil_id = $request->input ( 'soils' ) ? $request->input ( 'soils' ) : $irrSystem->Soil_id;
			$irrSystem->plant_name = $request->has ( 'plantName' ) ? $request->input ( 'plantName' ) : $irrSystem->plant_name;
			// $irrSystem->isActivated=$request->input('activated')? $request->input('activated'):$irrSystem->isActivated;
			$irrSystem->device_location = $request->has ( 'deviceLocation' ) ? $request->input ( 'deviceLocation' ) : $irrSystem->device_location;
			$irrSystem->save ();
			
			return redirect ( 'profile' )->with ( 'success', 'Irrigation system settings changed successfully' );
		} else {
			// $request->session()->flash('debugMessage','microcontrollerId '.$id);
			
			return redirect ( 'profile' )->with ( 'error', 'Irrigation system not found or doesnt exist!' );
		}
	}
	public function viewAllIrrigationSystems() {
		$admin = Admin::find ( Auth::guard ( 'admin' )->user ()->id );
		
		if (! $admin) {
			
			return redirect ( '/admin/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		$systems = Microcontroller::all ();
		return view ( 'admin.registered-sys' )->with ( 'systems', $systems );
	}
	public function userSystemOverview(Request $request, $sysId) {
		$system = Microcontroller::findOrfail ( $sysId );
		
		// if(! $system)
		
		if (! $system->isActivated) {
			return redirect ( '/home' )->with ( 'info', 'The  system not activated. Please activate it in profile settings!' );
		}
		
		/*
		 * Get the newest moisture reading
		 */
		$rcnt_moist = Moisture_Readings::where ( 'Microcontroller_id', $system->id )->orderBy ( 'time_recorded', 'desc' )->first ();
		
		$curr_weather = $rcnt_moist->weather_cond;
		$currentTemp = $rcnt_moist->temp_reading;
		/*
		 * Get 10 most recent moisture readings
		 */
		$moist_vals = Moisture_Readings::where ( 'Microcontroller_id', $system->id )->orderBy ( 'time_recorded', 'desc' )->take ( 10 )->get ();
		
		$arranged_arr = array_reverse ( $moist_vals->toArray () );
		return view ( 'sys-details' )->with ( 'currentTemp', $currentTemp )
									 ->with ( 'system', $system )
									 ->with ( 'rcnt_moist', $rcnt_moist )
									 ->with ( 'curr_weather', $curr_weather )
									 ->with ( 'moist_vals', json_encode ( $arranged_arr ) );
	}
	
	
	
	
	
	
	
	
	
	/*************************************************************************************************************************************
	 ***********************************The API for the uC*******************************************************************************
	 *************************************************************************************************************************************
	 */
	/**
	 * 
	 * @param array $message
	 * @param unknown $status
	 */
	protected function responseObject($message,$status){
	
		return Response::make($message,$status);
	}
	
	
	protected function validationPasser(array $inputs, array $rules){
		$validator = $this->getValidationFactory()->make($inputs, $rules);
	
		if($validator->fails())
			return false;
		else
		    return true;
	}
	
	
	
	
	
	
	
	public function generateControllerToken(Request $request,$systemId) {
// 		//Security check! Check if the user exists. from the user_id 
// 		//param of the request.
// 		$farmer = Farmer::find($request->input('user_id',0));
// 		if(! $farmer){
// 			return $this->responseObject('User not found', HttpResp::HTTP_NOT_FOUND);
// 		}
		
		
		$isAvailable = false;
		$token = '';
		
		//Generate a token string for an irrigation system
// 		while(! $isAvailable){
			$token = $this->getToken(32);
//			$usedToken = Microcontroller::where('token',$token);
			
// 			if($usedToken)
// 				$isAvailable = false;
// 			else 
// 				$isAvailable=true;
// 		}
		
		//Check if an irrigation system with this ID exists
		//Also check if the user is assigned to the farmer, from the user_id
		//param of the request.
		$irrSystem = Microcontroller::with('farmer')->where('id',$systemId)->where('Farmer_id',$request->input('user_id',0))->first();
		if(!$irrSystem){
			return $this->responseObject(['message'=>'System not found or has been deleted'], HttpResp::HTTP_NOT_FOUND);
		}
		
		$irrSystem->token = $token;
		$irrSystem->token_time_issued = date('Y-m-d H:i:s',time());
		
		if($irrSystem->save()){
			return $this->responseObject(['message'=>'token','token'=>$token,
										  'issue_time'=>$irrSystem->token_time_issued], HttpResp::HTTP_OK);
		}else{
			return $this->responseObject(['message'=>'Server Error, Try again'], HttpResp::HTTP_INTERNAL_SERVER_ERROR);
		}
 		
		
	}
	
	
	public function addSensor(Request $request,$systemId){
		$irrSystem = Microcontroller::with('farmer')->where('id',$systemId)
													->where('Farmer_id',$request->input('user_id',0))
													->where('token',$request->input('token'))
													->first();
		if(! $irrSystem){
			return $this->responseObject(['message'=>'System not found or has been deleted'], HttpResp::HTTP_NOT_FOUND);
		}
		
		$irrSystem->increment('num_of_sensors');
		return $this->responseObject(['message'=>'added successfully'], HttpResp::HTTP_OK);
	}
	
	
	
	public function getRainPrediction(Request $request,$systemid){
		$rules = [
				'mcc'=>'required',
				'mnc'=>'required',
				'radioType'=>'required',
				'cellId'=>'required',
				'lac'=>'required',		
		];
		$valid = $this->validationPasser($request->all(), $rules);
		
		if(! $valid){
			return $this->responseObject(['message'=>'missing fields'], HttpResp::HTTP_BAD_REQUEST);
		}
		
		
// 		$cellTowers = ['cellId'=>$request->input('cellId'),
// 					   'locationAreaCode'=>$request->input('lac'),
// 					   'mobileCountryCode'=>$request->input('mcc'),
// 					   'mobileNetworkCode'=>$request->input('mnc')
// 		];
		$cellTowers = ['cellId'=>17703,
				'locationAreaCode'=>10232,
				'mobileCountryCode'=>620,
				'mobileNetworkCode'=>06
		];
		$data =['homeMobileCountryCode'=>620,
				'homeMobileNetworkCode'=>06,
				'radioType'=>'gsm',
				'considerIp'=>'true',
				'cellTowers'=>$cellTowers
		];
		
		
		$coords = $this->getCoordinates($data);
		if(! $coords){
	
			return $this->responseObject(['message'=>'external request failed','reason'=>'google'], HttpResp::HTTP_INTERNAL_SERVER_ERROR); 
				
		}
		
		
// 		var_dump($coords);
		$dec_coords = json_decode($coords,true);
		if(isset($dec_coords['error'])){
			return $this->responseObject(['message'=>'external request failed','reason'=>$dec_coords['error']], HttpResp::HTTP_INTERNAL_SERVER_ERROR);	
		}
		//var_dump($dec_coords);
		$lon = $dec_coords['location']['lng'];
		$lat = $dec_coords['location']['lat'];
		
		$result = $this->contactWeatherAPI($lon, $lat);
		if (! $result) {
			return $this->responseObject(['message'=>'external request failed'], HttpResp::HTTP_INTERNAL_SERVER_ERROR);	
		}
		
		$dec_result = json_decode($result,true);
		$forecast = $dec_result['query']['results']['channel']['item']['forecast'][1];
		$location = $dec_result['query']['results']['channel']['location'];
		//$forecast keys: code,date,day,high,low,text
		
		return $this->responseObject(['message'=>'24hr forecast',
									  'forecast'=>$forecast,'location'=>$location], HttpResp::HTTP_OK);
	}
	
	/**
	 * 
	 * @param array $params
	 * @return mixed
	 * 	 */
	protected function getCoordinates(array $params){
		$apiKey = env('GOOGLE_MAPS_GEOLOCATION_APIKEY');
		
		$url = "https://www.googleapis.com/geolocation/v1/geolocate?key=".$apiKey;
		$json=html_entity_decode(json_encode($params));
		//echo $json;
		$headers =  array('Content-Type: application/json');
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		
		$result = curl_exec($ch);
		curl_close($ch);
		
		return $result;
	}
	
	/**
	 * 
	 * @param unknown $longitude
	 * @param unknown $latitude
	 * @return mixed
	 */
	protected function contactWeatherAPI($longitude,$latitude){
		$BASE_URL = "http://query.yahooapis.com/v1/public/yql";
		$yql_query = 'select * from weather.forecast where woeid in (SELECT woeid FROM geo.places WHERE text="('.$latitude.','.$longitude.')")'; 
		$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
		
		$session = curl_init($yql_query_url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
		
		$result = curl_exec($session);
		
		return $result;
	}
	
	
	/**
	 * Function to generate a random string of length 32
	 * 
	 * @param number $length
	 * @return string
	 */
	function getToken($length = 32)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		for($i=0;$i<$length;$i++){
			$token .= $codeAlphabet[$this->crypto_rand_secure(0,strlen($codeAlphabet))];
		}

		return $token;
	}
	
	//// @rook posted Scott's snippet on stackoverflow.com//////////////////////////
	function crypto_rand_secure($min,$max)
	{
		$range = $max - $min;
		if($range < 0)
			return $min;
			$log = log($range, 2);
			$bytes = (int) ($log/8) + 1; //length in bytes
			$bits = (int) $log + 1; //length in bits
			$filter = (int) (1 << $bits) - 1; //set all lower bits to 1
			do{
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
				$rnd = $rnd & $filter; //discard irrelevant bits
			}while($rnd >= $range);
	
			return $min + $rnd;
	}
}
