<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTypesTable extends Migration {

	public function up()
	{
		Schema::create('user_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('user_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('user_types');
	}
}