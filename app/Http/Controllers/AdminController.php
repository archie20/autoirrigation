<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soil;
use App\SystemType;
use App\Plant_Group;

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
	public function systemTypeEditorPage() {
		$sysTypes = SystemType::all ();
	
		return view ( 'admin.system-editor' )->with ( 'systemTypes', $sysTypes );
	}
	public function plantGrpEditorPage() {
		$plantGrps = Plant_Group::all ();
	
		return view ( 'admin.plantgrp-editor' )->with ( 'plantGroups', $plantGrps);
	}
}
