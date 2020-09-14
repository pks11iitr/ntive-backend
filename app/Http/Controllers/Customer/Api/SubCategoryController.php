<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function subcategory(Request $request,$catid){

        $user= auth()->guard('customerapi')->user();

        if(!$user)
            return [
                'status'=>'User is not logged in',
                'code'=>'401'
            ];

          $data=SubCategory::active()->where('category_id', $catid)->get();
           $datas=(object) ['id' => '0','name'=>'All','isactive'=>'1'];
            $data->prepend($datas);

        $cart_items=Cart::getCartTotalItems($user);

           if(count($data)>0){
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$data,
                'cart_items'=>$cart_items
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'402'
            ];
       }
   }

}
