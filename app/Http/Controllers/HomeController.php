<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Microcontroller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware ( 'auth' );
	}
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$systems = Microcontroller::where ( 'Farmer_id', Auth::guard ()->user ()->id )->get ();
		
		return view ( 'home' )->with ( 'systems', $systems );
	}
}
