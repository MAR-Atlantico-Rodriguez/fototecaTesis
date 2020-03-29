<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Recorte extends Model {

	protected $table = "recortes";

	protected $fillable = [
		'id_imagen', 'url',
	];

	public function recortesDeUnaImagen($id) {
		return DB::table($this->table)
			->select(DB::raw('recortes.url, recortes.created_at, recortes.id'))
			->where('recortes.id_imagen', $id)
			->get();
	}

	public function urlImg($id) {
		return DB::table($this->table)->select("url")->where('recortes.id', $id)->get();
	}
}