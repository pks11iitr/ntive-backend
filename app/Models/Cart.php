<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //public $timestamps=false;
    protected $table='cart';

    protected $fillable=['qty','product_id', 'user_id','quantity','size_id'];

    protected $hidden =['created_at','updated_at','deleted_at'];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function sizeprice(){
        return $this->belongsTo('App\Models\Size', 'size_id');
    }
    public static function getUserCart($user){

        $items=Cart::whereHas('product',function($product){
            $product->where('isactive', 1)
                ->where('out_of_stock', 0);
        })
        ->where('user_id', $user->id??null)
            ->get();

        $products=[];

        foreach($items as $item){
            $products[$item->product_id]=$item->quantity;
        }

        return $products;
    }

    public static function getUserCartSizes($user){

        $items=Cart::whereHas('product',function($product){
            $product->where('isactive', 1)
                ->where('out_of_stock', 0);
        })
            ->where('user_id', $user->id??null)
            ->get();

        $products=[];

        foreach($items as $item){
            $products[$item->product_id]=$item->size_id;
        }

        return $products;
    }


    public static function getCartTotalItems($user){
        $total=Cart::whereHas('product',function($product){
            $product->where('isactive', 1)
                ->where('out_of_stock', 0);
        })->where('user_id', $user->id??null)->sum('quantity');
        return $total;
    }


}
