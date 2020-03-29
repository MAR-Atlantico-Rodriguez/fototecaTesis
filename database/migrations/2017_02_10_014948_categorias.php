<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categorias extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('categorias', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_padre');
			$table->string('categoria', 100);
			$table->integer('block')->default(1); //1 desbloqueado 0 bloqueado
			$table->timestamps();
			$table->softDeletes();
		});

		$procedure = "
            CREATE PROCEDURE `categoriasLista` (IN `_id` INT(11))
            SELECT C.*,  (select count(*) from imagenes AS I where I.id_categoria = C.id) AS cantImagen, (select count(*) from categorias AS CC where CC.id_padre = C.id) AS cantSubCat FROM categorias AS C
            where C.id_padre = _id";

		DB::unprepared("DROP procedure IF EXISTS categoriasLista");
		DB::unprepared($procedure);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('categorias');
	}
}
