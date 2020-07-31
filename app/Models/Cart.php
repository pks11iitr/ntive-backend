<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //public $timestamps=false;
    protected $table='cart';

    protected $fillable=['qty','product_id', 'user_id'];

    protected $hidden =['created_at','updated_at','deleted_at'];

public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }


}