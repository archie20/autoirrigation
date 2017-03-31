<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soil;

class AdminController extends Controller {
	public function __construct() {
		$this->middleware ( 'admin' );
	}
	public function adminPage() {
		return view ( 'admin.admin-home' );
	}
	public function soilEditorPage() {
		$soils = Soil::all ();
		
		return view ( 'admin.soil-editor' )->with ( 'soils', $soils );
	}
}
