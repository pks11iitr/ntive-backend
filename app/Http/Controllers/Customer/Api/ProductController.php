<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function special_product(Request $request,$type){

        $data=[];

        $user=auth()->guard('customerapi')->user();
        if($user) {
            if($type=='featured'){
            $products=Product::active()->where('is_featured',1)->get();
            }elseif($type=='discount'){
                $products=Product::active()->where('is_discount',1)->get();
            }else{
                $products=Product::active()->where('is_newarrivel',1)->get();
            }

        if(count($products)>0){
             foreach($products as $i=>$r)
                       {

                       $cart=Cart::where('user_id', auth()->guard('customerapi')->user()->id??'')->where('product_id',$r['id'])->get();
                       $products[$i]['qty']=isset($cart[0]->qty)?$cart[0]->qty:0;
                     }
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$products
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'402'
            ];
       }

    }else{

         return [
            'status'=>'User is not logged in',
            'code'=>'401'
        ];

    }
}

public function category_product(Request $request,$type,$subcatid){

        $data=[];

        $user=auth()->guard('customerapi')->user();
        if($user) {
            if($type=='all'){
            $products=Product::active()->where('cat_id',$subcatid)->get();
            }else{
                $products=Product::active()->where('subcat_id',$subcatid)->get();
            }

        if(count($products)>0){
             foreach($products as $i=>$r)
                       {

                       $cart=Cart::where('user_id', auth()->guard('customerapi')->user()->id??'')->where('product_id',$r['id'])->get();
                       $products[$i]['qty']=isset($cart[0]->qty)?$cart[0]->qty:0;
                     }
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$products
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'402'
            ];
       }

    }else{

         return [
            'status'=>'User is not logged in',
            'code'=>'401'
        ];

    }
}


    public function details(Request $request, $id){

        $product=Product::active()->with('gallery')->find($id);

        if(!$product)
            return [
                'status'=>'No Record Found',
                'code'=>'402'
            ];

        return [
            'status'=>'success',
            'data'=>compact('product')
        ];



    }


}
