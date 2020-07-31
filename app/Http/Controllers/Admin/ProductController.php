<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCategory;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
        public function index(Request $request){

            $products=Product::paginate(10);
            return view('admin.product.view',['products'=>$products]);

            }

        public function create(Request $request){
          $homecategory=HomeCategory::active()->get();
          $subcategory=SubCategory::active()->get();
            return view('admin.product.add',['homecategory'=>$homecategory,'subcategory'=>$subcategory]);

        }


        public function store(Request $request){

              $request->validate([
                    'cat_id'=>'required',
                    'subcat_id'=>'required',
                    'name'=>'required',
                    'weight'=>'required',
                    'unit'=>'required',
                    'actual_price'=>'required',
                    'cut_price'=>'required',
                    'is_featured'=>'required',
                    'is_discount'=>'required',
                    'is_newarrivel'=>'required',
                    'isactive'=>'required',
                    'image'=>'required|image'

                    ]);
               if($product=Product::create([
                            'cat_id'=>$request->cat_id,
                            'subcat_id'=>$request->subcat_id,
                            'name'=>$request->name,
                            'weight'=>$request->weight,
                            'unit'=>$request->unit,
                            'actual_price'=>$request->actual_price,
                            'cut_price'=>$request->cut_price,
                            'is_featured'=>$request->is_featured,
                            'is_discount'=>$request->is_discount,
                            'is_newarrivel'=>$request->is_newarrivel,
                            'isactive'=>$request->isactive,
                            'image'=>'a',

                            ])){
                   $product->saveImage($request->image, 'products');

                        return redirect()->route('product.list')->with('success', 'Product has been created');
                }

                return redirect()->back()->with('error', 'product create failed');


          }
          public function edit(Request $request,$id){
            $product = Product::findOrFail($id);
            $homecategory=HomeCategory::active()->get();
            $subcategory=SubCategory::active()->get();
              return view('admin.product.edit',['product'=>$product,'homecategory'=>$homecategory,'subcategory'=>$subcategory]);
            }


        public function update(Request $request,$id){

            $request->validate([

                    'cat_id'=>'required',
                    'subcat_id'=>'required',
                    'name'=>'required',
                    'weight'=>'required',
                    'unit'=>'required',
                    'actual_price'=>'required',
                    'cut_price'=>'required',
                    'is_featured'=>'required',
                    'is_discount'=>'required',
                    'is_newarrivel'=>'required',
                    'isactive'=>'required',
                    'image'=>'image',


                       ]);
             $product = Product::findOrFail($id);

            if($product->update([

                            'cat_id'=>$request->cat_id,
                            'subcat_id'=>$request->subcat_id,
                            'name'=>$request->name,
                            'weight'=>$request->weight,
                            'unit'=>$request->unit,
                            'actual_price'=>$request->actual_price,
                            'cut_price'=>$request->cut_price,
                            'is_featured'=>$request->is_featured,
                            'is_discount'=>$request->is_discount,
                            'is_newarrivel'=>$request->is_newarrivel,
                            'isactive'=>$request->isactive,
            ])){

                if($request->image){

                    $product->saveImage($request->image, 'products');

                }

                return redirect()->route('product.list')->with('success', 'Product has been updated');

            }

             	return redirect()->back()->with('error', 'Product update failed');

                          }


  }

