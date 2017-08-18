<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenDescargasTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('imagen_descargas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_imagen')->unsigned();
            $table->integer('id_imagen_recorte')->unsigned()->default(0);
            $table->integer('id_users')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('id_imagen')->references('id')->on('imagenes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagen_descargas');
    }
}
