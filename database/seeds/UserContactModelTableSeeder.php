<?php

use Illuminate\Database\Seeder;
use App\UserContactModel;

class UserContactModelTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('user_contact_no')->delete();

		// user_contact
		UserContactModel::create(array(
				'contact_no' => '09392245661',
				'user_detail_id' => 1,
				'isactive' => 1
			));

		// user_contact
		UserContactModel::create(array(
				'contact_no' => '09958598305',
				'user_detail_id' => 1,
				'isactive' => 1
			));

		// user_contact
		UserContactModel::create(array(
				'contact_no' => '0929458698',
				'user_detail_id' => 3,
				'isactive' => 1
			));

		// user_contact
		UserContactModel::create(array(
				'contact_no' => '09458657842',
				'user_detail_id' => 2,
				'isactive' => 1
			));

		// user_contact
		UserContactModel::create(array(
				'contact_no' => '09726584264',
				'user_detail_id' => 3,
				'isactive' => 1
			));
	}
}