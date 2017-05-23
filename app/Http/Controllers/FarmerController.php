<?php

namespace App\Http\Controllers;

use App\Farmer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response as HttpResp;
use Illuminate\Support\Facades\Response;
use App\Microcontroller;
use App\Moisture_Readings;

class FarmerController extends Controller {
	public function updateDetailsPage(Request $request) {
		$mControllers = Farmer::find ( $request->user ()->id )->microcontrollers;
		return view ( 'profile' )->with ( 'mControllers', $mControllers );
	}
	public function updateFarmerDetails(Request $request) {
		$farmer = Farmer::find ( $request->user ()->id );
		
		if ($farmer) {
			$this->validate ( $request, [ 
					'name' => 'required' 
			] );
		} else {
			return redirect ( '/unknownFarmer' );
		}
		
		$farmer->farmer_name = $request->input ( 'name' );
		$farmer->email = $request->has ( 'email' ) ? $request->input ( 'email' ) : $farmer->email;
		$farmer->password = $request->input ( 'password' ) ? $request->input ( 'password' ) : $farmer->password;
		
		$farmer->save ();
		return redirect ( '/profile' )->with ( 'success', 'Changed sucessfully' );
	}
	public function allUsers() {
		$usersAll = Farmer::all ();
		
		$usersList = new Collection ();
		foreach ( $usersAll as $usr ) {
			$usersList->add ( [ 
					'farmer_name' => $usr->farmer_name,
					'email' => $usr->email,
					'id' => $usr->id,
					'systems_count' => $usr->microcontrollers ()->count () 
			] );
		}
		
		return view ( 'admin.all-users' )->with ( 'usersList', $usersList->all () );
	}
	
	
	
	
	
	/*************************************************************************************************************
	 *****************************************MOBILE APIs*********************************************************
	 */
	
	
	public function mobileLogin(Request $request) {
		 $passed =  $this->validationPasser($request->all(), ['email'=>'required','password'=>'required']);
		 
		 if(! $passed)
		 	return $this->resObj(['message'=>'insufficient or bad parameters','required'=>'email,password'],
		 					HttpResp::HTTP_BAD_REQUEST);
		 
		 $farmer = Farmer::where('email',$request->input('email'))->first();
		 if(! $farmer)
		 	return $this->resObj(['message'=>'No user with this email found!'], HttpResp::HTTP_NOT_FOUND);
		 
		 if(! password_verify($request->input('password'), $farmer->password))
		 	return $this->resObj(['message'=>'Wrong password'], HttpResp::HTTP_UNAUTHORIZED);
		 
		 
		 $farmer->api_token = $this->getToken(60);
		 if($farmer->save())
		 	return $this->resObj(['message'=>'successfully logged in','token'=>$farmer->api_token], HttpResp::HTTP_CREATED);
		 else 
		 	return $this->resObj(['message'=>'Login failed. Try again'], HttpResp::HTTP_INTERNAL_SERVER_ERROR);
		 	
	}
	
	
	
	public function mobileLogout(Request $request) {
		$passed = $this->validationPasser($request->all(),['api_token'=>'required']);
		
		if(! $passed)
			return $this->resObj(['message'=>'token not included','required'=>'api_token'],
					HttpResp::HTTP_BAD_REQUEST);
		
		$farmer = Farmer::where('api_token',$request->input('api_token'))->first();
		if(! $farmer)
			return $this->resObj(['message'=>'No account with this token found'], HttpResp::HTTP_UNAUTHORIZED);
		
		$farmer->api_token = "";
		$farmer->save();
		return $this->resObj(['message'=>'Logged out'], HttpResp::HTTP_OK);
	}
	
	
	public function getAllIrrigationSystems(Request $request){
		$passed = $this->validationPasser($request->all(), ['api_token'=>'required']);
		if(! $passed)
			return $this->resObj(['message'=>'token not included','required'=>'api_token'],
								HttpResp::HTTP_BAD_REQUEST);
		
		$farmer = Farmer::where('api_token',$request->input('api_token'))->first();
		if(! $farmer)
			return $this->resObj(['message'=>'No account with this token found'], HttpResp::HTTP_UNAUTHORIZED);
		
		$systems = $farmer->microcontrollers()->get(['id','isActivated','plant_name','device_location','pump_status']);
		if($systems)
			return $this->resObj(['message'=>'user_systems','user_systems'=>$systems], HttpResp::HTTP_OK);
		else
			return $this->resObj(['message'=>'no user systems found'], HttpResp::HTTP_NOT_FOUND);
			
	}
	
	
	public function getSystemDetails(Request $request,$systemId){
		$passed = $this->validationPasser($request->all(), ['api_token'=>'required']);
		if(! $passed)
			return $this->resObj(['message'=>'token not included','required'=>'api_token'],
								HttpResp::HTTP_BAD_REQUEST);
		
		$farmer = Farmer::where('api_token',$request->input('api_token'))->first();
		if(! $farmer)
			return $this->resObj(['message'=>'No account with this token found'], HttpResp::HTTP_UNAUTHORIZED);
		
		$system = Microcontroller::where('id',$systemId)->where('Farmer_id',$farmer->id)->first();
		if($system)
			return $this->resObj(['message'=>'system','system'=>$system], HttpResp::HTTP_OK);
		else
			return $this->resObj(['message'=>'System not found'], HttpResp::HTTP_NOT_FOUND);
		
	}
	
	
	public function systemRecordedInfo(Request $request,$systemId){
		
			$passed = $this->validationPasser($request->all(), ['api_token'=>'required']);
			if(! $passed)
				return $this->resObj(['message'=>'token not included','required'=>'api_token'],
						HttpResp::HTTP_BAD_REQUEST);
			
				
				$farmer = Farmer::where('api_token',$request->input('api_token'))->first();
				if(! $farmer)
					return $this->resObj(['message'=>'No account with this token found'], HttpResp::HTTP_UNAUTHORIZED);
					
					
				$system = Microcontroller::where('id',$systemId)->where('Farmer_id',$farmer->id)->first();
				if(! $system)
					return $this->resObj(['message'=>'System not found'], HttpResp::HTTP_NOT_FOUND);
				
		
			/*
			 * Get 10 most recent moisture readings
			 */
			$moist_vals = Moisture_Readings::where ( 'Microcontroller_id', $system->id )->orderBy ( 'time_recorded', 'desc' )->take ( 10 )->get();
		
			$arranged_arr = array_reverse ( $moist_vals->toArray () );
			
			return $this->resObj(['message'=>'recorded_info',
								  'moist_vals'=>$arranged_arr ], HttpResp::HTTP_OK);
	}
	
	public function pumpSwitch(Request $request,$systemId){
		$passed = $this->validationPasser($request->all(), ['api_token'=>'required','pump_status'=>'required|numeric']);
		if(! $passed)
			return $this->resObj(['message'=>'insufficient params','required'=>'api_token,pump_status'],
					HttpResp::HTTP_BAD_REQUEST);
				
		
		$farmer = Farmer::where('api_token',$request->input('api_token'))->first();
		if(! $farmer)
			return $this->resObj(['message'=>'No account with this token found'], HttpResp::HTTP_UNAUTHORIZED);
		
		$system = Microcontroller::where('id',$systemId)->where('Farmer_id',$farmer->id)->first();
		if(! $system)
			return $this->resObj(['message'=>'System not found'], HttpResp::HTTP_NOT_FOUND);
		
		
		$system->pump_status = $request->pump_status;
		if($system->save())
			return $this->resObj(['message'=>'Pump status changed'], HttpResp::HTTP_OK);
		else 
			return $this->resObj(['message'=>'Sever error'], HttpResp::HTTP_INTERNAL_SERVER_ERROR);
					
	}
	
	
	protected function validationPasser(array $inputs, array $rules){
		$validator = $this->getValidationFactory()->make($inputs, $rules);
	
		if($validator->fails())
			return false;
			else
				return true;
	}
	 
	
	/**
	 * Returns a respoonse object made by the message supplies and the HTTP status code
	 * @param array $message
	 * @param int $status
	 */
	protected function resObj($message,$status){
	
		return Response::make($message,$status);
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
