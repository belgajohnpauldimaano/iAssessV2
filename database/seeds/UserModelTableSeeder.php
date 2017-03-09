<?php

use Illuminate\Database\Seeder;
use App\UserModel;

class UserModelTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('users')->delete();

		// users
		UserModel::create(array(
				'username' => 'admin',
				'password' => encrypt('123456'),
				'user_type_id' => 1,
				'user_detail_id' => 1,
				'branch_id' => 1,
				'isactive' => 1
			));

		// users
		UserModel::create(array(
				'username' => 'DIR_01',
				'password' => encrypt('123456'),
				'user_type_id' => 2,
				'user_detail_id' => 2,
				'branch_id' => 2,
				'isactive' => 1
			));

		// users
		UserModel::create(array(
				'username' => 'PC_01',
				'password' => encrypt('123456'),
				'user_type_id' => 3,
				'user_detail_id' => 3,
				'branch_id' => 3,
				'isactive' => 1
			));
	}
}