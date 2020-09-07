<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Banner;
use App\Models\Cart;
use App\Models\HomeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){

        $data=[];

        $user= auth()->guard('customerapi')->user();
        if($user)
            $user=$user->only('name', 'image');
        else{
            $user=[
                'image'=>'',
                'name'=>'Guest'
            ];
        }

        $pincode=$request->pincode;
        if(empty($pincode)){
            $delivery='Delivery Is Not Available At your Current Location';
        }else{
            $delivery='available';
        }

        $cart_items=Cart::getCartTotalItems($user);

        $banners=Banner::active()->select('image','category_id', 'main_category_id','title')->get();
        $homecategory=HomeCategory::active()->get();
        if(count($banners)>0 or count($homecategory)>0){

            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$homecategory,
                'banners'=>$banners,
                'delivery'=>$delivery,
                'user'=>$user,
                'cart_items'=>$cart_items
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'401'
            ];
       }

    }

}
