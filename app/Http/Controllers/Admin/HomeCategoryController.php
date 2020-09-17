<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class HomeCategoryController extends Controller
{
        public function index(Request $request){

            $homecategory=HomeCategory::paginate(10);
            return view('admin.homecategory.view',['homecategory'=>$homecategory]);

            }

        public function create(Request $request){
            return view('admin.homecategory.add');

        }


        public function store(Request $request){

              $request->validate([
                    'title'=>'required',
                    'isactive'=>'required',
                    'image'=>'required|image'

                    ]);
               if($homecategory=HomeCategory::create([
                            'title'=>$request->title,
                            'isactive'=>$request->isactive,
                            'image'=>'a',
                            'sequence_no'=>$request->sequence_no

                            ])){
                   $homecategory->saveImage($request->image, 'home-category');

                        return redirect()->route('homecategory.list')->with('success', 'Home Category has been created');
                }

                return redirect()->back()->with('error', 'Home Category create failed');


          }
          public function edit(Request $request,$id){
            $homecategory = HomeCategory::findOrFail($id);
              return view('admin.homecategory.edit',['homecategory'=>$homecategory]);
            }


        public function update(Request $request,$id){

              $request->validate([

                         'title'=>'required',
                         'isactive'=>'required',
                         'image'=>'image',


                       ]);
             $homecategory = HomeCategory::findOrFail($id);

            if($homecategory->update([

                'title'=>$request->title,
                'isactive'=>$request->isactive,
                'sequence_no'=>$request->sequence_no
            ])){

                if($request->image){

                    $homecategory->saveImage($request->image, 'home-category');

                }

                return redirect()->route('homecategory.list')->with('success', 'Home Category has been updated');

            }

             	return redirect()->back()->with('error', 'Home Category update failed');

                          }


  }

