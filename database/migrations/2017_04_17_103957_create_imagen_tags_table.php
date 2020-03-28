<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagenTagsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('imagen_tags', function (Blueprint $table) {
			$table->integer('id_imagen')->unsigned();
			$table->integer('id_tag')->unsigned();

			$table->timestamps();

			$table->primary(['id_imagen', 'id_tag']);
			$table->foreign('id_imagen')->references('id')->on('imagenes');
			$table->foreign('id_tag')->references('id')->on('tags');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('imagen_tags');
	}
}
