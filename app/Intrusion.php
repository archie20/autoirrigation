<?php
use Illuminate\Database\Eloquent\Model as Model;
class Intrusion extends Model {
	protected $primaryKey = 'id';
	protected $table = 'Intrusion';
	public $timestamps = FALSE;
	public function microcontroller() {
		return $this->belongsTo ( 'App\Http\Microcontroller', 'Microcontroller_id' );
	}
}