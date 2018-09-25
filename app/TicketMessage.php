<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'ticket_messages';

    public function user()
	{
		return $this->belongsTo('App\User', 'from_user_id', 'id');
	}
}
