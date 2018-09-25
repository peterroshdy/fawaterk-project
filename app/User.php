<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Invoice;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function role()
    {
        return $this->belongsTo('App\Role');
    }


    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }

    
    public function unpaidInvoices()
    {
        $invoices = Invoice::where('user_id', '=', Auth::id())->where('paid', '=', '0')->get();

        return $invoices;
    }


    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
