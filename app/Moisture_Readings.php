<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Moisture_Readings extends Model {
	protected $primaryKey = 'id';
	public $timestamps = FALSE;
	public function microcontroller() {
		return $this->belongsTo ( 'App\Http\Microcontroller', 'Microcontroller_id' );
	}
	protected $table = 'Moisture_readings';
}