<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imagen extends Model {
	use SoftDeletes;

	protected $table = "imagenes";

	protected $fillable = [
		'id_categoria', 'titulo', 'descripcion', 'foto_orientacion', 'foto_color', 'url', 'fecha',
	];

	//Envia el registro de una imagen mediante el ID
	public function unaImagen($id) {
		return DB::table($this->table)
			->select(DB::raw('categorias.categoria, SUBSTRING_INDEX(imagenes.url, ".", 1) AS urlImg, imagenes.*'))
			->join('categorias', 'categorias.id', '=', 'imagenes.id_categoria')
			->where('imagenes.id', $id)
			->get();
	}

	public function urlImg($id) {
		return DB::table($this->table)->select("url")->where('imagenes.id', $id)->get();
	}

	public function scopeTitulo($query, $titulo) {
		$query->where('titulo', 'LIKE', '%' . $titulo . '%');
	}

	public function scopePrevSig($query, $id, $idCategoria, $order) {
		//SELECT id FROM `imagenes` where id_categoria = 14 and id > 20 order by id asc limit 1
		$signo = ($order == "desc") ? '<' : '>';
		$query->select('id');
		$query->where('id_categoria', '=', $idCategoria);
		$query->where('id', $signo, $id);
		$query->orderby('id', $order);
		$query->limit(1);
	}

	static function tags($id_img) {
		return DB::table('imagen_tags')
			->select(DB::raw('imagen_tags.id_imagen, imagen_tags.id_tag, tags.tag'))
			->join('tags', 'tags.id', '=', 'imagen_tags.id_tag')
			->where('imagen_tags.id_imagen', $id_img)
			->get();
	}

	public function scopeTitulos($query, $titulo) {
		if (trim($titulo) !== "") {
			$query->where('titulo', 'LIKE', '%' . $titulo . '%');
		}
	}

	public function scopeDescripcion($query, $descripcion) {
		if (trim($descripcion) !== "") {
			$query->where('descripcion', 'LIKE', '%' . $descripcion . '%');
		}
	}

	public function scopeFecha($query, $fecha) {
		if (trim($fecha) !== "") {
			//$query->where('fecha', 'LIKE', $fecha);
			$query->whereDate('fecha', $fecha);
		}
	}

	public function scopeFotoColor($query, $fotoColor) {
		if (trim($fotoColor) !== "") {
			$query->where('foto_color', '=', $fotoColor);
		}
	}

	public function scopeFotoOrientacion($query, $fotoOrientacion) {
		if (trim($fotoOrientacion) !== "") {
			$query->where('foto_orientacion', '=', $fotoOrientacion);
		}
	}

	public function scopeTags($query, $tags) {
		if (is_array($tags)) {
			$query->join('imagen_tags', 'id', '=', 'imagen_tags.id_imagen');
			$query->whereIn('imagen_tags.id_tag', $tags);
		}
	}

	public function logs() {
		return $this->hasMany('App\LogsMio');
	}

}