<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Microcontroller extends Model {
	protected $primaryKey = 'id';
	protected $table = 'Microcontroller';
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
}