<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\NotifyMe;
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
            $products=Product::active()->with('sizeprice')->where('is_featured',1)->get();
            }elseif($type=='discount'){
                $products=Product::active()->with('sizeprice')->where('is_discount',1)->get();
            }else{
                $products=Product::active()->with('sizeprice')->where('is_newarrivel',1)->get();
            }
            $cart_items=Cart::getCartTotalItems($user);
        if(count($products)>0){

             $product_cart=Cart::getUserCart($user);

             foreach($products as $i=>$r)
                       {
                       $products[$i]['qty']=$product_cart[$r->id]??0;
                     }
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$products,
                'cart_items'=>$cart_items
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
            $products=Product::active()->with('sizeprice');
            if($type=='all'){
            //$products=Product::active()->where('cat_id',$subcatid)->get();
                $products=$products->whereHas('category', function($category) use($subcatid){
                    $category->where('home_category.id', $subcatid);
                });
            }else{
                //$products=Product::active()->where('subcat_id',$subcatid)->get();
                $products=$products->whereHas('subcategory', function($category) use($subcatid){
                    $category->where('sub_category.id', $subcatid);
                });
            }
            $products=$products->get();
            $cart_items=Cart::getCartTotalItems($user);


        if(count($products)>0){

            $product_cart=Cart::getUserCart($user);
             foreach($products as $i=>$r)
                       {

                       //$cart=Cart::where('user_id', auth()->guard('customerapi')->user()->id??'')->where('product_id',$r['id'])->get();
                       $products[$i]['qty']=$product_cart[$r->id]??0;
                     }
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$products,
                'cart_items'=>$cart_items
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
//    public function products(Request $request){
//        $user=auth()->guard('customerapi')->user();
//
//        if(!$user)
//            return [
//                'status'=>'failed',
//                'message'=>'Please login to continue'
//            ];
//        if(!empty($request->sub_cat_id)){
//
//            $product=Product::active()->whereHas('subcategory', function($category) use($request){
//                $category->where('sub_category.id', $request->sub_cat_id);
//            });
//        }else{
//            $product=Product::active()->whereHas('category', function($category) use($request){
//                $category->where('home_category.id', $request->category_id);
//            });
//        }
//
////        $cart=Cart::getUserCart($user);
//
//        $products=$product->with('sizeprice')->paginate(20);
////
////        foreach($products as $product){
////            foreach($product->sizeprice as $size)
////                $size->quantity=$cart[$size->id]??0;
////
////        }
//
//        return [
//            'status'=>'success',
//            'data'=>$products,
//        ];
//    }


    public function details(Request $request, $id){

        $user=auth()->guard('customerapi')->user();
        $product=Product::active()->with('gallery')->find($id);

        $notify=NotifyMe::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        $is_notified=$notify?1:0;
        $cart_items=Cart::getCartTotalItems($user);
        if(!$product)
            return [
                'status'=>'No Record Found',
                'code'=>'402'
            ];

        return [
            'status'=>'success',
            'data'=>compact('product', 'is_notified', 'cart_items')
        ];



    }


}
