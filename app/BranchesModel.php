<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchesModel extends Model {

	protected $table = 'branches';
	public $timestamps = true;

	public function user ()
	{
		return $this->belongsTo('App\UserModel', 'branch_id', 'id');
	}
}