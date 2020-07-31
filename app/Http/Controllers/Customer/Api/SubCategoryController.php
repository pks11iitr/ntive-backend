<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{

    public function subcategory(Request $request,$catid){

        $data=[];
      
            $subcategory=SubCategory::active()->where('category_id', $catid)->get();    
          // var_dump($subcategory); die();
           if(count($subcategory)>0){
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$subcategory
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'402'
            ];
       } 
   }

}