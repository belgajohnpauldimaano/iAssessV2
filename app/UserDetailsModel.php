<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetailsModel extends Model {

	protected $table = 'user_details';
	public $timestamps = true;


	public function user () 
	{
		return $this->belongsTo('App\UserModel', 'user_detail_id', 'id');
	}
}