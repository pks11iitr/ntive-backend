<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{

      public function store(Request $request){

          $user=auth()->guard('customerapi')->user();
        if($user) {

          $request->validate([
  				      'quantity'=>'required|integer|min:0',
                      'product_id'=>'required|integer|min:1',
                      'size_id'=>'required|integer|min:0'
  				    ]);
            $size=Size::where('product_id',$request->product_id)->find($request->size_id);
            if(!$size){
                return [
                    'status'=>'failed',
                    'message'=>'Invalid Size'
                ];
            }
          $cart = Cart::where('product_id',$request->product_id)->where('user_id', auth()->guard('customerapi')->user()->id??'')->first();

          $product=Product::active()->where('out_of_stock', 0)->find($request->product_id);

          if(!$product)
              return [
                  'status'=>'failed',
                  'message'=>'Product is not available'
              ];

          if(!$cart){
              if($request->quantity>0){
                Cart::create([
                    'product_id'=>$request->product_id,
                    'quantity'=>$request->quantity,
                    'size_id'=>$request->size_id,
                    'user_id'=>auth()->guard('customerapi')->user()->id
                ]);
              }

          }else{
            if($request->quantity>0){
              $cart->quantity=$request->quantity;
                $cart->size_id=$request->size_id;
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

          $cart_items=Cart::getCartTotalItems($user);
       $cart = Cart::with(['product'=>function($product){
           $product->where('isactive', 1)->where('out_of_stock', 0);
       }])->whereHas('product', function($product){
           $product->where('isactive', true)->where('out_of_stock', 0);
       })
           ->where('user_id', $user->id??'')
           ->with('sizeprice')->get();

          $price_total=0;
          foreach($cart as $item){
            $price_total=$price_total + $item->sizeprice->price*$item->quantity;
          }
          return [
              'data'=>$cart,
              'total'=>$price_total,
              'cart_items'=>$cart_items
          ];

      }
}
