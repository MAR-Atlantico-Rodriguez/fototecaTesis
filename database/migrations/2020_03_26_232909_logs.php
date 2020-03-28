<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Logs extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('logs', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_accion')->unsigned();
			$table->integer('id_user')->unsigned();

			$table->integer('id_imagen');
			$table->integer('id_recorte');
			$table->integer('id_tag');
			$table->integer('id_categorias');

			$table->timestamps();

			$table->foreign('id_user')->references('id')->on('users');
			$table->foreign('id_accion')->references('id')->on('acciones');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('logs');
	}
}
