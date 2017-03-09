<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration {

	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('company_name');
			$table->string('company_address');
			$table->integer('company_industry_id');
		});
	}

	public function down()
	{
		Schema::drop('companies');
	}
}