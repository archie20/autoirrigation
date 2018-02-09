<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Plant_Group extends Model {
	public $timestamps = FALSE;
	protected $primaryKey = 'id';
	protected $table = 'Plant_Group';
	public function microcontrollers() {
		return $this->hasMany ( 'App\Http\Microcontroller', 'Plantgp_id' );
	}
}