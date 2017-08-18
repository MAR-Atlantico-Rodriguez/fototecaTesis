<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Imagenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_user')->unsigned();            

            $table->string('titulo',191);
            $table->mediumText('descripcion');
            $table->date('fecha');
            $table->smallInteger('foto_orientacion')->default(0); // 0 Horizontal - 1 Vertical
            $table->smallInteger('foto_color')->default(0); // 0 Color - 1 Blanco y Negro

            $table->smallInteger('repositorio')->default(0); // 0 NoRepositorio - 1 SiRepositorio
            
            $table->string('url',191);
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('categorias');
            $table->foreign('id_user')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes');
    }
}
