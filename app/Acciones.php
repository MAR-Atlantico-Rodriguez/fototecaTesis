<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acciones extends Model {
	protected $table = "acciones";

	protected $fillable = ['id', 'descripcion'];

	public function logs() {
		return $this->hasMany(Logs::class);
	}
}
