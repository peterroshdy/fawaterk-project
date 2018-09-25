<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function image()
    {
    	return $this->hasMany('App\Image', 'product_key', 'key');
    }

    public function color()
    {
    	return $this->hasMany('App\Color', 'product_key', 'key');
    }

    public function size()
    {
    	return $this->hasMany('App\Size', 'product_key', 'key');
    }


    public function vendor()
    {
        return $this->belongsTo('App\User');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }
}
