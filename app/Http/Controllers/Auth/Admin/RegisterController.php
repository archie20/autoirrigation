<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Admin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller {
	/*
	 * |--------------------------------------------------------------------------
	 * | Register Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | This controller handles the registration of new users as well as their
	 * | validation and creation.
	 * |
	 */
	
	use RedirectsUsers;
	
	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/admin/home';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware ( 'guest' );
	}
	
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param array $data        	
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make ( $data, [ 
				'username' => 'required|max:20|unique:admin',
				'password' => 'required|confirmed' 
		] );
	}
	
	/**
	 * Create a new Admin instance after a valid registration.
	 *
	 * @param array $data        	
	 * @return Admin
	 */
	protected function create(array $data) {
		return Admin::create ( [ 
				'username' => $data ['username'],
				'password' => password_hash ( $data ['password'], PASSWORD_BCRYPT, [ 
						'cost' => 11 
				] ) 
		] );
	}
	
	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm() {
		return view ( 'admin.auth.admin_area_register' );
	}
	
	/**
	 * Handle a registration request for the application.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {
		$this->validator ( $request->all () )->validate ();
		
		event ( new Registered ( $user = $this->create ( $request->all () ) ) );
		
		$this->guard ()->login ( $user );
		
		return $this->registered ( $request, $user ) ?: redirect ( $this->redirectPath () );
	}
	
	/**
	 * Get the guard to be used during registration.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard ();
	}
	
	/**
	 * The user has been registered.
	 *
	 * @param \Illuminate\Http\Request $request        	
	 * @param mixed $user        	
	 * @return mixed
	 */
	protected function registered(Request $request, $user) {
		//
	}
}
