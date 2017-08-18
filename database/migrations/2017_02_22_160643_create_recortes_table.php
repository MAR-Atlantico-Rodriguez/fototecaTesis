<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecortesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recortes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_imagen')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->string('url',100);
            $table->timestamps();

            $table->foreign('id_imagen')->references('id')->on('imagenes')->onDelete('cascade');
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
        Schema::dropIfExists('recortes');
    }
}
