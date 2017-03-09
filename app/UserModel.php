<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable {

	use Notifiable;

	protected $table = 'users';
	public $timestamps = true;

	public function user_type () 
	{
		return $this->hasOne('App\UserTypesModel', 'id', 'user_type_id');
	}

	public function user_detail ()
	{
		return $this->hasOne('App\UserDetailsModel', 'id', 'user_detail_id');
	}

	public function branch () 
	{
		return $this->hasOne('App\BranchesModel', 'id', 'branch_id');
	}
	/**
   	 * Overrides the method to ignore the remember token.
	 * Ejer Luna
	 * 2016-11-21
     */
  	public function setAttribute($key, $value)
  	{
    	$isRememberTokenAttribute = $key == $this->getRememberTokenName();
    	if (!$isRememberTokenAttribute)
   	 	{
     		parent::setAttribute($key, $value);
    	}
  	}
}