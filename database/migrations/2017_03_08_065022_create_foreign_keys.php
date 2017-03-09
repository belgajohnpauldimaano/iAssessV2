<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('user_type_id')->references('id')->on('user_types')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('user_detail_id')->references('id')->on('user_details')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('branch_id')->references('id')->on('branches')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('user_contact_no', function(Blueprint $table) {
			$table->foreign('user_detail_id')->references('id')->on('user_details')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_user_type_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_user_detail_id_foreign');
		});
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_branch_id_foreign');
		});
		Schema::table('user_contact_no', function(Blueprint $table) {
			$table->dropForeign('user_contact_no_user_detail_id_foreign');
		});
	}
}