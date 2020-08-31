<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Banner;
use App\Models\HomeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $request){

        $data=[];

        $pincode=$request->pincode;
        if(empty($pincode)){
            $delivery='Delivery Is Not Available At your Current Location';
        }else{
            $delivery='available';
        }



        $banners=Banner::active()->get();
        $homecategory=HomeCategory::active()->get();
        if(count($banners)>0 or count($homecategory)>0){

            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$homecategory,
                'banners'=>$banners,
                'delivery'=>$delivery
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'401'
            ];
       }

    }

}
