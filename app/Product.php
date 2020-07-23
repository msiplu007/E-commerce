<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
  use SoftDeletes;
    protected $guarded = [];
    function ontoonerelationwithcategorytable(){
      return $this->hasOne('App\category', 'id', 'category_id')->withTrashed();
    }

    // function ontomanyrelationwithproductimagetable(){
    //   return $this->hasMany('App\Product_image', 'product_id', 'id')->withTrashed();
    // }
}
