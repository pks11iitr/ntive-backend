<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Customer;
use App\Models\Document;
use App\Models\HomeCategory;
use App\Models\Notification;
use App\Models\NotifyMe;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Product;
use App\Services\Notification\FCMNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
        public function index(Request $request){
            $products =Product::orderBy('cat_id','asc')->orderBy('subcat_id','asc');

            if(isset($request->category))//die;
                $products=$products->where('cat_id', $request->category);

            if(isset($request->subcategory))//die;
                $products=$products->where('subcat_id', $request->subcategory);

            if($request->ordertype)
                $products=$products->orderBy('created_at', $request->ordertype);

            if(isset($request->search))
                $products=$products->where('name', 'like', "%".$request->search."%");

            $products=$products->paginate(20);
            $homecategorys=HomeCategory::active()->get();
            $subcategorys=SubCategory::active()->get();

            return view('admin.product.view',['products'=>$products,'homecategorys'=>$homecategorys,'subcategorys'=>$subcategorys]);

            }

        public function create(Request $request){
          $homecategory=HomeCategory::active()->get();
          $subcategory=SubCategory::active()->get();
            return view('admin.product.add',['homecategory'=>$homecategory,'subcategory'=>$subcategory]);

        }


        public function store(Request $request){

              $request->validate([
                    //'cat_id'=>'required',
                    //'subcat_id'=>'required',
                    'name'=>'required',
                    //'weight'=>'required',
                    //'unit'=>'required',
                    //'actual_price'=>'required',
                    //'cut_price'=>'required',
                    'is_featured'=>'required',
                    'is_discount'=>'required',
                    'is_newarrivel'=>'required',
                    'isactive'=>'required',
                    'out_of_stock'=>'required',
                    'image'=>'required|image'

                    ]);
               if($product=Product::create([
                            'cat_id'=>$request->cat_id,
                            'subcat_id'=>$request->subcat_id,
                            'name'=>$request->name,
                            //'weight'=>$request->weight,
                            //'unit'=>$request->unit,
                            //'actual_price'=>$request->actual_price,
                            //'cut_price'=>$request->cut_price,
                            'is_featured'=>$request->is_featured,
                            'is_discount'=>$request->is_discount,
                            'description'=>$request->description,
                            'is_newarrivel'=>$request->is_newarrivel,
                            'isactive'=>$request->isactive,
                            'out_of_stock'=>$request->out_of_stock,
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
            $sizeprice=Size::where('product_id',$id)->get();
              $documents = $product->gallery;
              return view('admin.product.edit',['product'=>$product,'categories'=>$homecategory,'subcategories'=>$subcategory,'documents'=>$documents,'sizeprice'=>$sizeprice]);
            }


        public function update(Request $request,$id){
            //var_dump($request->sub_cat_id);die;
            $request->validate([

                    //'cat_id'=>'required',
                    //'subcat_id'=>'required',
                    'name'=>'required',
                    //'weight'=>'required',
                    //'unit'=>'required',
                    //'actual_price'=>'required',
                    //'cut_price'=>'required',
                    'is_featured'=>'required',
                    'is_discount'=>'required',
                    'is_newarrivel'=>'required',
                    'isactive'=>'required',
                    'image'=>'image',


                       ]);
             $product = Product::findOrFail($id);
            $old_stock=$product->out_of_stock;
            if($product->update([

                            'cat_id'=>$request->cat_id??0,
                            'subcat_id'=>$request->subcat_id??0,
                            'name'=>$request->name,
                            //'weight'=>$request->weight,
                            //'unit'=>$request->unit,
                            //'actual_price'=>$request->actual_price,
                            //'cut_price'=>$request->cut_price,
                            'description'=>$request->description,
                            'is_featured'=>$request->is_featured,
                            'is_discount'=>$request->is_discount,
                            'is_newarrivel'=>$request->is_newarrivel,
                            'isactive'=>$request->isactive,
                            'out_of_stock'=>$request->out_of_stock
            ])){

                CategoryProduct::where('product_id', $product->id)->delete();

                $added_categories=[];
                if(!empty($request->sub_cat_id)){
                    $subcat=SubCategory::with('category')
                        ->whereIn('id', $request->sub_cat_id)
                        ->get();

                    foreach($subcat as $subcategory) {
                        CategoryProduct::create([
                            'category_id' => $subcategory->category_id,
                            'sub_cat_id' => $subcategory->id,
                            'product_id' => $product->id,

                        ]);
                        $added_categories[] = $subcategory->category_id;
                    }
                }

                if(!empty($request->category_id)){
                    $reqcat=$request->category_id;
                    $remaining_ids=array_diff($reqcat,$added_categories);
                    //return $remaining_ids;
                    foreach($remaining_ids as $catid)
                        CategoryProduct::create([
                            'category_id' => $catid,
                            'sub_cat_id' =>null,
                            'product_id' => $product->id,

                        ]);
                }


                if($request->image){

                    $product->saveImage($request->image, 'products');

                }
            if(empty($request->out_of_stock) && $old_stock){
                $users=NotifyMe::with('customer')->where('product_id', $product->id)->get();

                if($users){
                    $message=$product->name. ' is available in stock at KPG Wholesale Bazzar. Book your order now';
                    $title=$product->name.' in stock';
                }

                foreach($users as $u){
                    if($u->customer){
                        Notification::create([
                            'user_id'=>$u->customer->id,
                            'title'=>$title,
                            'description'=>$message,
                            'data'=>null,
                            'type'=>'individual'
                        ]);

                        FCMNotification::sendNotification($u->customer->notification_token, $title, $message);
                    }

                }





            }
                return redirect()->back()->with('success', 'Product has been updated');

            }

             	return redirect()->back()->with('error', 'Product update failed');

                          }


        public function uploadImages(Request $request, $id){


            $request->validate([
                'file_path'=>'required|array',
                'file_path.*'=>'image'
            ]);


            $product=Product::find($id);


            foreach($request->file_path as $image)
                $product->saveDocument($image, 'products');

            return redirect()->back()->with('success', 'Images has been uploaded');


        }

        public function delete(Request $request,$id){
            Document::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Document has been deleted');
        }
    public function sizeprice(Request $request,$id){
        $request->validate([
            'isactive'=>'required',
            'size'=>'required',
            'price'=>'required',
            'cut_price'=>'required',
        ]);
        if($products=Size::create([
            'size'=>$request->size,
            'price'=>$request->price,
            'product_id'=>$id,
            'cut_price'=>$request->cut_price,
            'isactive'=>$request->isactive
        ]))
        {

            return redirect()->back()->with('success', 'Product sizeprice has been created');
        }
        return redirect()->back()->with('error', 'Product sizeprice create failed');
    }
    public function sizeprice_delete(Request $request,$id){
        Size::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Size Price has been deleted');
    }

    public function updatesizeprice(Request $request){
       // var_dump($request->size);die();
        $request->validate([
            'isactive'=>'required',
            'price'=>'required',
            'cut_price'=>'required',
            'size'=>'required',
        ]);

        $product = Size::findOrFail($request->size_id);

        $product->update([
            'size'=>$request->size,
            'price'=>$request->price,
            'cut_price'=>$request->cut_price,
            'isactive'=>$request->isactive,
        ]);
        {

            return redirect()->back()->with('success', 'Product sizeprice has been created');
        }
        return redirect()->back()->with('error', 'Product sizeprice create failed');
    }

  }

