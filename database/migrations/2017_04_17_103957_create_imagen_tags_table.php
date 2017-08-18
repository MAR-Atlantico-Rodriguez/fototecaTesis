<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('imagen_tags', function (Blueprint $table) {            
            $table->integer('id_imagen')->unsigned();
            $table->integer('id_tag')->unsigned();
            $table->integer('id_users')->unsigned();

            $table->timestamps();

            $table->primary(['id_imagen', 'id_tag']);

            $table->foreign('id_imagen')->references('id')->on('imagenes');
            $table->foreign('id_tag')->references('id')->on('tags');
            $table->foreign('id_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagen_tags');
    }
}
