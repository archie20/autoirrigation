<?php

namespace App\Http\Controllers;

use App\Soil;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class SoilController extends Controller {
	public function addOrEditSoil(Request $request) {
		$admin = Admin::find ( Auth::guard ( 'admin' )->user ()->id );
		
		if (! $admin) {
			
			return redirect ( '/admin/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		// Updating the soil
		if ($request->has ( 'soil_id' )) {
			$this->validate ( $request, [ 
					'soil_name' => 'required',
					'threshold_value' => 'required' 
			] );
			
			$soil = Soil::find ( $request->input ( 'soil_id' ) );
			
			if (! $soil) {
				return redirect ()->back ()->with ( 'error', 'This soil is not in the database. Add it instead' );
			}
			
			$chkSoil = Soil::where ( 'soil_name', $request->input ( 'soil_name' ) )->first ();
			if ($chkSoil && $chkSoil->id != $soil->id) {
				
				return redirect ()->back ()->with ( 'error', 'A soil with this name already exists. Soil names must be unique' );
			}
			
			$soil->soil_name = $request->input ( 'soil_name' );
			$soil->threshold_value = $request->input ( 'threshold_value' );
			$soil->MAD = $request->input('MAD');
			
			if ($soil->save ()) {
				
				return redirect ()->back ()->with ( 'success', 'Updated ' . $soil->soil_name . ' succesfully' );
			} else {
				
				return redirect ()->back ()->with ( 'error', 'Could not update ' . $soil->soil_name . ' Try Again!' );
			}
		}
		// End soil updating
		
		// Add soil to database
		// Check if inputs are OK
		if (! $this->validationPasser ( $request->all (), [ 
				'soil_name' => 'required|unique:Soil' 
		] )) {
			return redirect ()->back ()->with ( 'error', 'A soil with this name already exists. Soil names must be unique' );
		}
		
		$this->validate ( $request, [ 
				'threshold_value' => 'required',
				'MAD'=>'required',
				'soil_name'=>'required'
		] );
		
		$newSoil = new Soil ();
		$newSoil->soil_name = $request->soil_name;
		$newSoil->threshold_value = $request->threshold_value;
		$newSoil->MAD = $request->input('MAD');
		if ($newSoil->save ()) {
			
			return redirect ()->back ()->with ( 'success', 'Added ' . $newSoil->soil_name . ' succesfully' );
		} else {
			
			return redirect () - back ()->with ( 'error', 'Could not add ' . $newSoil->soil_name . ' Try Again!' );
		}
	}
	protected function validationPasser(array $inputs, array $rules) {
		$validator = $this->getValidationFactory ()->make ( $inputs, $rules );
		
		if ($validator->fails ())
			return false;
		else
			return true;
	}
}
