<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserContactNoTable extends Migration {

	public function up()
	{
		Schema::create('user_contact_no', function(Blueprint $table) {
			$table->increments('id');
			$table->string('contact_no')->nullable();
			$table->integer('user_detail_id')->unsigned();
			$table->integer('isactive')->default('1');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('user_contact_no');
	}
}