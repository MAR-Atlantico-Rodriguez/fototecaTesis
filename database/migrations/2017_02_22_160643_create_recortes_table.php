<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecortesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('recortes', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_imagen')->unsigned();
			$table->string('url', 100);
			$table->timestamps();

			$table->foreign('id_imagen')->references('id')->on('imagenes')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('recortes');
	}
}
