<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('username');
			$table->string('password');
			$table->integer('user_type_id')->unsigned();
			$table->integer('user_detail_id')->unsigned();
			$table->integer('isactive')->default('1');
			$table->integer('branch_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}