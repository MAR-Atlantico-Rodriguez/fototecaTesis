<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImagenTag extends Model {
	protected $table = "imagen_tags";

	protected $fillable = [
		'id_imagen', 'id_tag',
	];
}
