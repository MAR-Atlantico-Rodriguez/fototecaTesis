<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
	protected $table = "categorias";

	protected $fillable = ['id', 'id_padre', 'categoria', 'block'];

	public function subcategoria() {
		return $this->hasMany(Categoria::class);
	}

	public function imagenesGaleria() {
		return $this->hasMany('App\Imagen', 'id_categoria')->orderBy('id', 'desc');
	}

	static function listaCategoriasProcedure($id) {
		return DB::select('CALL categoriasLista(' . $id . ')');
	}
}
