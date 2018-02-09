<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class SystemType extends Model {
	public $timestamps = FALSE;
	protected $primaryKey = 'id';
	protected $table = 'SystemType';
	public function microcontrollers() {
		return $this->hasMany ( 'App\Http\Microcontroller', 'SystemType_id' );
	}
}