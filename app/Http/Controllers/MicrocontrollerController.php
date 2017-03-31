<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Microcontroller;
use App\Soil;
use App\Farmer;
use App\Moisture_Readings;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use Illuminate\Http\Response;

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
		return view ( 'sys-details' )->with ( 'currentTemp', $currentTemp )->with ( 'system', $system )->with ( 'rcnt_moist', $rcnt_moist )->with ( 'curr_weather', $curr_weather )->with ( 'moist_vals', json_encode ( $arranged_arr ) );
	}
}
