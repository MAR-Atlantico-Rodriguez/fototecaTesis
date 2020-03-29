<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Imagenes extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('imagenes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_categoria')->unsigned();

			$table->string('titulo', 191);
			$table->mediumText('descripcion');
			$table->date('fecha');
			$table->smallInteger('foto_orientacion')->default(0); // 0 Horizontal - 1 Vertical
			$table->smallInteger('foto_color')->default(0); // 0 Color - 1 Blanco y Negro

			$table->smallInteger('repositorio')->default(0); // 0 NoRepositorio - 1 SiRepositorio

			$table->string('url', 191);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('id_categoria')->references('id')->on('categorias');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('imagenes');
	}
}
