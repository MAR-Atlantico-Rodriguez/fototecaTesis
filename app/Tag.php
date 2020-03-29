<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model {
	use SoftDeletes;

	protected $table = "tags";

	protected $fillable = ['tag'];

	public function users() {
		return $this->belongsTo('App\User', 'id_users');
	}

}
