<?php

namespace App\Auth;

use App\Farmer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class CustomUserProvider implements UserProvider {
	
	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param mixed $identifier        	
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveById($identifier) {
		$qry = Farmer::where ( 'id', '=', $identifier );
		
		if ($qry->count () > 0) {
			$user = $qry->select ( 'farmer_name', 'email', 'password' )->first ();
			
			$attributes = array (
					'id' => $user->id,
					'username' => $user->email,
					'password' => $user->password,
					'name' => $user->farmer_name 
			);
			
			return $user;
		}
		return null;
	}
	
	/**
	 * Retrieve a user by by their unique identifier and "remember me" token.
	 *
	 * @param mixed $identifier        	
	 * @param string $token        	
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByToken($identifier, $token) {
		$qry = Farmer::where ( 'id', '=', $identifier )->where ( 'remember_token', '=', $token );
		
		if ($qry->count () > 0) {
			$user = $qry->select ( 'farmer_name', 'email', 'password' )->first ();
			
			$attributes = array (
					'id' => $user->id,
					'username' => $user->email,
					'password' => $user->password,
					'name' => $user->farmer_name 
			);
			
			return $user;
		}
		return null;
	}
	
	/**
	 * Update the "remember me" token for the given user in storage.
	 *
	 * @param \Illuminate\Contracts\Auth\Authenticatable $user        	
	 * @param string $token        	
	 * @return void
	 */
	public function updateRememberToken(Authenticatable $user, $token) {
		$user->setRememberToken ( $token );
		
		$user->save ();
	}
	
	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param array $credentials        	
	 * @return \Illuminate\Contracts\Auth\Authenticatable|null
	 */
	public function retrieveByCredentials(array $credentials) {
		if (empty ( $credentials )) {
			return;
		}
		
		$qry = Famer::where ( 'email', '=', $credentials ['email'] );
		
		if ($qry->count () > 0) {
			$user = $qry->select ( 'id', 'farmer_name', 'email', 'password' )->first ();
			
			return $user;
		}
		return null;
	}
	
	/**
	 * Validate a user against the given credentials.
	 *
	 * @param \Illuminate\Contracts\Auth\Authenticatable $user        	
	 * @param array $credentials        	
	 * @return bool
	 */
	public function validateCredentials(Authenticatable $user, array $credentials) {
		$plain = $credentials ['password'];
		if ($user->email == credentials ['email'])
			return password_hash ( $plain, $user->getAuthPassword () );
		else
			return false;
	}
}