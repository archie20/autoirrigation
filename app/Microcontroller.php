<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Microcontroller extends Model {
	protected $primaryKey = 'id';
	protected $table = 'Microcontroller';
	
	protected $hidden = ['token','token_time_issued'];
	
	public $timestamps = FALSE;
	public function farmer() {
		return $this->belongsTo ( 'App\Farmer', 'Farmer_id' );
	}
	public function soil() {
		return $this->belongsTo ( 'App\Soil', 'Soil_id' );
	}
	public function intrusion() {
		return $this->hasMany ( 'App\Intrusion', 'Microcontroller_id' );
	}
	public function moisture_readings() {
		return $this->hasMany ( 'App\Moisture_Readings', 'Microcontroller_id' );
	}
	
	public function systemType() {
		return $this->belongsTo('App\SystemType','SystemType_id');
	}
	
	public function plant_group() {
		return $this->belongsTo('App\Plant_Group','Plantgp_id');
	}
}