<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();


		$this->call('UserTypesModelTableSeeder');
		$this->command->info('UserTypesModel table seeded!');

		$this->call('UserDetailsModelTableSeeder');
		$this->command->info('UserDetailsModel table seeded!');

		$this->call('BranchesModelTableSeeder');
		$this->command->info('BranchesModel table seeded!');

		$this->call('UserModelTableSeeder');
		$this->command->info('UserModel table seeded!');
		
		$this->call('UserContactModelTableSeeder');
		$this->command->info('UserContactModel table seeded!');


	}
}