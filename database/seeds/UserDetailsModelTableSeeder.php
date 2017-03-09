<?php

use Illuminate\Database\Seeder;
use App\UserDetailsModel;

class UserDetailsModelTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('user_details')->delete();

		// user_details
		UserDetailsModel::create(array(
				'first_name' => 'Juan',
				'last_name' => 'Tamad',
				'email_address' => 'juan@gmail.com'
			));

		// user_details
		UserDetailsModel::create(array(
				'first_name' => 'Peter',
				'last_name' => 'Parker',
				'email_address' => 'peter@gmail.com'
			));

		// user_details
		UserDetailsModel::create(array(
				'first_name' => 'Maria',
				'last_name' => 'Makiling',
				'email_address' => 'maria@yahoo.com'
			));
	}
}