<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

      public function store(Request $request){

          $user=auth()->guard('customerapi')->user();
        if($user) {

          $request->validate([
  				      'quantity'=>'required|integer|min:0',
                'product_id'=>'required|integer|min:1'
  				    ]);

          $cart = Cart::where('product_id',$request->product_id)->where('user_id', auth()->guard('customerapi')->user()->id??'')->first();

          if(count($cart)<=0){
              if($request->quantity>0){
                Cart::create([
                    'product_id'=>$request->product_id,
                    'quantity'=>$request->quantity,
                    'user_id'=>auth()->guard('customerapi')->user()->id
                ]);
              }

          }else{
            if($request->quantity>0){
              $cart->quantity=$request->quantity;
              $cart->save();
            }else{

              $cart->delete();
            }
          }

          return [
            'status'=>'success',
            'code'=>'200'
          ];

      }else{
        return [
            'status'=>'User is not logged in',
            'code'=>'401'
        ];
      }
    }

      public function getCart(Request $request){
        $data=[];
       $user= auth()->guard('customerapi')->user();

       if(!$user)
           return [
               'status'=>'User is not logged in',
               'code'=>'401'
           ];

       $cart = Cart::with(['product'=>function($product){
           $product->where('isactive', 1);
       }])->where('user_id', $user->id??'')->get();

          $price_total=0;
          foreach($cart as $item){
            $price_total=$price_total + $item->product->actual_price*$item->qty;
          }
          return [
              'data'=>$cart,
              'total'=>$price_total
          ];

      }
}
