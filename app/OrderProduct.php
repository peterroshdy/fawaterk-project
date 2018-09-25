<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function color()
    {
    	return $this->hasMany('App\ProductColor', 'id', 'color_id');
    }

    public function size()
    {
    	return $this->hasMany('App\ProductSize', 'id', 'size_id');
    }
}
