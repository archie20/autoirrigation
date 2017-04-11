<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResp;
use Illuminate\Support\Facades\Response;
use App\Intrusion;
use App\Microcontroller;

class IntrusionController extends Controller {
	
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
	
	
	public function reportIntrusion(Request $request, $systemId){
		$irrSystem = Microcontroller::with('farmer')->where('id',$systemId)
		->where('Farmer_id',$request->input('user_id',0))
		->where('token',$request->input('token'))
		->first();
		if(! $irrSystem){
			return $this->responseObject(['message'=>'System not found or has been deleted'], HttpResp::HTTP_NOT_FOUND);
		}
	
		if(! $request->has('time_recorded')){
			return $this->responseObject(['message'=>'missing time_recorded param'], HttpResp::HTTP_BAD_REQUEST);
		}
	
		$intrusion = new Intrusion;
		$intrusion->time_recorded = $request->input('time_recorded');
	
		if($irrSystem->intrusion()->save($intrusion))
			return $this->responseObject(['message'=>'reported successfully'], HttpResp::HTTP_CREATED);
			else
				return $this->responseObject(['message'=>'Server Error, Try again'], HttpResp::HTTP_INTERNAL_SERVER_ERROR);
	}
}
