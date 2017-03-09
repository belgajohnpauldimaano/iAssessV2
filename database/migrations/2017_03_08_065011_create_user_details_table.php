<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserDetailsTable extends Migration {

	public function up()
	{
		Schema::create('user_details', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email_address');
		});
	}

	public function down()
	{
		Schema::drop('user_details');
	}
}