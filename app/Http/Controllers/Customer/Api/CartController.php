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
                    'qty'=>$request->quantity,
                    'user_id'=>auth()->guard('customerapi')->user()->id
                ]);
              }

          }else{
            if($request->quantity>0){
              $cart->qty=$request->quantity;
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
          $cart = Cart::where('user_id', auth()->guard('customerapi')->user()->id??'')->get();
           
          $price_total=0;
          foreach($cart as $i=>$c){
            $cart[$i]['product_name']=$c->product->name;
            $price_total=$price_total + $c->product->actual_price*$c->qty;
          }
          return [
              'data'=>$cart,
              'total'=>$price_total

          ];

      }
}