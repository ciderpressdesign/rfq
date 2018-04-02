<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameComponent extends Model
{
    //
	protected $guarded = [];

	public function componentType() {
		return $this->belongsTo( 'App\ComponentType' );
	}
}
