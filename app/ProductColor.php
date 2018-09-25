<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table = 'product_colors';

    public function color()
    {
    	return $this->belongsTo('App\Color');
    }
}
