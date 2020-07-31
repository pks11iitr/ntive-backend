<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\HomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class SubCategoryController extends Controller
{
        public function index(Request $request){

            $subcategory=SubCategory::paginate(10);
            return view('admin.subcategory.view',['subcategory'=>$subcategory]);

            }

        public function create(Request $request){
          $homecategory=HomeCategory::active()->get();
            return view('admin.subcategory.add',['homecategory'=>$homecategory]);

        }


        public function store(Request $request){

              $request->validate([
                    'name'=>'required',
                    'category_id'=>'required',
                    'isactive'=>'required',

                    ]);
    
               if($subcategory=SubCategory::create([
                            'name'=>$request->name,
                            'category_id'=>$request->category_id,
                            'isactive'=>$request->isactive

                            ])){

                        return redirect()->route('subcategory.list')->with('success', 'Sub Category has been created');
                }

                return redirect()->back()->with('error', 'Sub Category create failed');


          }
          public function edit(Request $request,$id){
            $subcategory = SubCategory::findOrFail($id);
            $homecategory=HomeCategory::active()->get();
              return view('admin.subcategory.edit',['homecategory'=>$homecategory,'subcategory'=>$subcategory]);
            }


        public function update(Request $request,$id){

              $request->validate([

                         'name'=>'required',
                         'category_id'=>'required',
                         'isactive'=>'required',

                       ]);
             $subcategory = SubCategory::findOrFail($id);

            if($subcategory->update([

                'name'=>$request->name,
                'category_id'=>$request->category_id,
                'isactive'=>$request->isactive,
            ])){


                return redirect()->route('subcategory.list')->with('success', 'Sub Category has been updated');

            }

             	return redirect()->back()->with('error', 'Sub Category update failed');

                          }


  }

