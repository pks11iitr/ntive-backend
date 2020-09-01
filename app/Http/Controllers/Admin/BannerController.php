<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\HomeCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class BannerController extends Controller
{
        public function index(Request $request){

            $banners=Banner::get();
            return view('admin.banner.view',['banners'=>$banners]);

            }

        public function create(Request $request){

            $category=HomeCategory::get();
            $subcategory=SubCategory::get();
            return view('admin.banner.add', compact('category', 'subcategory'));

        }


        public function store(Request $request){

              $request->validate([
                    'isactive'=>'required',
                    'image'=>'required|image'

                    ]);
               if($banner=Banner::create([
                            'isactive'=>$request->isactive,
                            'image'=>'a',
                            'category_id'=>$request->category_id
                            ])){
                   $banner->saveImage($request->image, 'banners');

                        return redirect()->route('banners.list')->with('success', 'Banner has been created');
                }

                return redirect()->back()->with('error', 'Banner create failed');


          }
          public function edit(Request $request,$id){
              $category=HomeCategory::get();
              $subcategory=SubCategory::get();

              $banner = Banner::findOrFail($id);
              return view('admin.banner.edit',compact('banner','category','subcategory'));
            }


        public function update(Request $request,$id){

              $request->validate([

                         'isactive'=>'required',
                         'image'=>'image',

                       ]);
             $banner = Banner::findOrFail($id);

            if($banner->update([
                'category_id'=>$request->category_id,
                'isactive'=>$request->isactive,
            ])){

                if($request->image){

                    $banner->saveImage($request->image, 'banners');

                }

                return redirect()->route('banners.list')->with('success', 'Banner has been updated');

            }

             	return redirect()->back()->with('error', 'Banner update failed');

                          }

          public function delete(Request $request, $id){
              Banner::where('id', $id)->delete();
              return redirect()->back()->with('success', 'Banner has been deleted');
          }

  }

