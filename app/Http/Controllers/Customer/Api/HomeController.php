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

            $banners=Banner::active()->get();
            $homecategory=HomeCategory::active()->get();
        if(count($banners)>0 or count($homecategory)>0){
            
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$homecategory,
                'banners'=>$banners
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'401'
            ];
       } 

    }

}