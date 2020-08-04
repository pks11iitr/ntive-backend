<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{


    public function subcategory(Request $request,$catid){

        $data=[];

          $data=SubCategory::active()->where('category_id', $catid)->get();    
          // $data[]=(object) ['id' => '0','name'=>'all','isactive'=>'1']; 
          
          $data = array_add($data, 'key', 'value');
           if(count($data)>0){
            return [
                'status'=>'success',
                'code'=>'200',
                'data'=>$data
            ];
        }else{
            return [
                 'status'=>'No Record Found',
                  'code'=>'402'
            ];
       } 
   }

}