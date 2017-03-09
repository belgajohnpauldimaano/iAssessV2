<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchesTable extends Migration {

	public function up()
	{
		Schema::create('branches', function(Blueprint $table) {
			$table->increments('id');
			$table->string('branch_name');
			$table->string('branch_address');
			$table->string('branch_prefix', 15);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('branches');
	}
}