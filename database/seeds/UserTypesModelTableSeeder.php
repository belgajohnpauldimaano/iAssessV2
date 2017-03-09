<?php

use Illuminate\Database\Seeder;
use App\UserTypesModel;

class UserTypesModelTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('user_types')->delete();

		// usertypes
		UserTypesModel::create(array(
				'user_type' => 'Administrator'
			));

		// usertypes
		UserTypesModel::create(array(
				'user_type' => 'Director'
			));

		// usertypes
		UserTypesModel::create(array(
				'user_type' => 'Practicum Coordinator'
			));
	}
}