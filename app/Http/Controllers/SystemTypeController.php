<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use App\SystemType;

class SystemTypeController extends Controller {
	
	public function addOrEditSystemType(Request $request) {
		$admin = Admin::find ( Auth::guard ( 'admin' )->user ()->id );
		
		if (! $admin) {
				
			return redirect ( '/admin/home' )->with ( 'error', 'You are not authorized to perform any action. Log in again' );
		}
		
		// Updating the System Type
		if ($request->has ( 'systemType_id' )) {
			$this->validate ( $request, [
					'type' => 'required',
					'p_rate' => 'required'
			] );
				
			$type = SystemType::find ( $request->input ( 'systemType_id' ) );
				
			if (! $type) {
				return redirect ()->back ()->with ( 'error', 'This System Type is not in the database. Add it instead' );
			}
				
			$chkType = SystemType::where ( 'type', $request->input ( 'type' ) )->first ();
			if ($chkType && $chkType->id != $type->id) {
		
				return redirect ()->back ()->with ( 'error', 'A System with this name already exists. System type names must be unique' );
			}
				
			$type->type = $request->input ( 'type' );
			$type->p_rate = $request->input ( 'p_rate' );
				
			if ($type->save ()) {
		
				return redirect ()->back ()->with ( 'success', 'Updated ' . $type->type . ' succesfully' );
			} else {
		
				return redirect ()->back ()->with ( 'error', 'Could not update ' . $type->type . ' Try Again!' );
			}
		}
		// End system type updating
		
		// Add system type to database
		// Check if inputs are OK
		if (! $this->validationPasser ( $request->all (), ['type' => 'required|unique:SystemType'] )) {
			return redirect ()->back ()->with ( 'error', 'A System with this name already exists. System names must be unique' );
		}
		
		$this->validate ( $request, [
				'p_rate' => 'required'
		] );
		
		$newType = new SystemType();
		$newType->type = $request->type;
		$newType->p_rate = $request->p_rate;
		
		if ($newType->save ()) {
				
			return redirect ()->back ()->with ( 'success', 'Added ' . $newType->type . ' succesfully' );
		} else {
				
			return redirect () - back ()->with ( 'error', 'Could not add ' . $newType->type . ' Try Again!' );
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