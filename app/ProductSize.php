<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_sizes';

    public function size()
    {
    	return $this->belongsTo('App\Size');
    }
}
