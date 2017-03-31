<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Soil extends Model {
	public $timestamps = FALSE;
	protected $primaryKey = 'id';
	protected $table = 'Soil';
	public function microcontrollers() {
		return $this->hasMany ( 'App\Http\Microcontroller', 'Soil_id' );
	}
}