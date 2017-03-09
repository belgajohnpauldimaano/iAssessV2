<?php

use Illuminate\Database\Seeder;
use App\BranchesModel;

class BranchesModelTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('branches')->delete();

		// branches
		BranchesModel::create(array(
				'branch_name' => 'Bataan',
				'branch_address' => 'FAB, Mariveles, Bataan',
				'branch_prefix' => 'BT'
			));

		// branches
		BranchesModel::create(array(
				'branch_name' => 'Sta. Mesa',
				'branch_address' => 'Sta. Mesa, Manila',
				'branch_prefix' => 'MNL'
			));

		// branches
		BranchesModel::create(array(
				'branch_name' => 'Commonwealth',
				'branch_address' => 'Commonwealth, Quezon City',
				'branch_prefix' => 'CM'
			));
	}
}