<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{

    public function category(){
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }

    public function brand(){
        return $this->belongsTo('App\Brand', 'brand_id');
    }
    
}
