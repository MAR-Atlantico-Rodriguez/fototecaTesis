<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('username', 20)->unique();
			$table->string('email', 50)->unique();
			$table->string('password');
			$table->smallInteger('block');
			$table->smallInteger("perfil")->default("0");
			$table->rememberToken();
			$table->timestamps();
		});

		DB::table('users')->insert(array(
			'name' => 'Martin Rodriguez',
			'username' => 'martin',
			'email' => 'martinrodriguez493@hotmail.com',
			'password' => bcrypt('martin'),
			'block' => 1,
			'perfil' => 1,
		));
		DB::table('users')->insert(array(
			'name' => 'Valeria Beltrand',
			'username' => 'valeria',
			'email' => 'valeria@unne.edu.ar',
			'password' => bcrypt('valeria'),
			'block' => 1,
			'perfil' => 1,
		));
		DB::table('users')->insert(array(
			'name' => 'Florencia Mesa',
			'username' => 'florencia',
			'email' => 'florencia_a_m@hotmail.com',
			'password' => bcrypt('florencia'),
			'block' => 1,
			'perfil' => 0,
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}
