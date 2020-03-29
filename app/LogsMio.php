<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogsMio extends Model {
	protected $table = "logs";

	protected $fillable = ['id', 'id_accion', 'id_user', 'id_imagen', 'id_recorte', 'id_tag', 'id_categoria'];

	public function acciones() {
		return $this->belongsto(Acciones::class);
	}

	public function users() {
		return $this->belongsTo('App\User', 'id_user');
	}

	static function insertLog($idAccion, $idUsuario, $tabla, $idRegistro) {
		switch ($tabla) {
		case 'imagenes':
			$campo_tabla = 'id_imagen';
			break;
		case 'tags':
			$campo_tabla = 'id_tag';
			break;
		case 'recortes':
			$campo_tabla = 'id_recorte';
			break;
		case 'categorias':
			$campo_tabla = 'id_categorias';
			break;
		}

		return LogsMio::insert(['id_accion' => $idAccion, 'id_user' => $idUsuario, $campo_tabla => $idRegistro]);

	}

}
