<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request){
        $search=$request->search;

        $user=auth()->guard('customerapi')->user();

        $products=Product::active()
            ->where('name', 'like', '%'.$search.'%')
            ->get();

        $product_cart=Cart::getUserCart($user);
        foreach($products as $i=>$r)
        {

            //$cart=Cart::where('user_id', auth()->guard('customerapi')->user()->id??'')->where('product_id',$r['id'])->get();
            $products[$i]['qty']=$product_cart[$r->id]??0;
        }

        return [
            'status'=>'success',
            'code'=>'200',
            'data'=>$products
        ];
    }
}
