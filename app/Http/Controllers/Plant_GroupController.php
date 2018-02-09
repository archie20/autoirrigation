<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use App\Plant_Group;

class Plant_GroupController extends Controller {
		
	
		public function addOrEditPlantGrp(Request $request) {
		$admin = Admin::find ( Auth::guard ( 'admin' )->user ()->id );
		
		if (! $admin) {
				
			return redirect ( '/admin/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		// Updating the soil
		if ($request->has ( 'pg_id' )) {
			$this->validate ( $request, [
					'group_name' => 'required',
					'kc' => 'required'
			] );
				
			$pg = Plant_Group::find ( $request->input ( 'pg_id' ) );
				
			if (! $pg) {
				return redirect ()->back ()->with ( 'error', 'This Plant Group Type is not in the database. Add it instead' );
			}
				
			$chkType = Plant_Group::where ( 'group_name', $request->input ( 'group_name' ) )->first ();
			if ($chkType && $chkType->id != $pg->id) {
		
				return redirect ()->back ()->with ( 'error', 'A Plant Group with this name already exists. Plant Group group_name names must be unique' );
			}
				
			$pg->group_name = $request->input ( 'group_name' );
			$pg->kc = $request->input ( 'kc' );
				
			if ($pg->save ()) {
		
				return redirect ()->back ()->with ( 'success', 'Updated ' . $pg->group_name . ' succesfully' );
			} else {
		
				return redirect ()->back ()->with ( 'error', 'Could not update ' . $pg->group_name . ' Try Again!' );
			}
		}
		// End system group_name updating
		
		// Add system group_name to database
		// Check if inputs are OK
		if (! $this->validationPasser ( $request->all (), [
				'group_name' => 'required|unique:Plant_Group'
		] )) {
			return redirect ()->back ()->with ( 'error', 'A Plant Group with this name already exists. Plant Group names must be unique' );
		}
		
		$this->validate ( $request, [
				'kc' => 'required'
		] );
		
		$newPg = new Plant_Group();
		$newPg->group_name = $request->group_name;
		$newPg->kc = $request->kc;
		
		if ($newPg->save ()) {
				
			return redirect ()->back ()->with ( 'success', 'Added ' . $newPg->group_name . ' succesfully' );
		} else {
				
			return redirect () - back ()->with ( 'error', 'Could not add ' . $newPg->group_name . ' Try Again!' );
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