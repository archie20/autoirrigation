<?php

namespace App\Http\Controllers;

use App\Farmer;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

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
}
