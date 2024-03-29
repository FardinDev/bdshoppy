<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ProductCategory extends Model
{
    function products(){
        return $this->hasMany('App\Product', 'category_id');
    }
}
