<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	public function user()
	{
		return $this->belongsTo('App\Customer', 'user_id', 'user_id');
	}

	public function customer()
	{
		return $this->belongsTo('App\Customer', 'user_id', 'id');
	}

	public function vendor()
	{
		return $this->belongsTo('App\User');
	}

}
