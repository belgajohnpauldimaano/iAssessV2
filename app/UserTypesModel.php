<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTypesModel extends Model {

	protected $table = 'user_types';
	public $timestamps = true;

	public function user () 
	{
		return $this->belongsTo('App\UserModel', 'user_type_id' , 'id');
	}

}