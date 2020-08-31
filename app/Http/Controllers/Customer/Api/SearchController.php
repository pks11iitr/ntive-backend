<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request){
        $search=$request->search;

        $products=Product::active()
            ->where('name', 'like', '%'.$search.'%')
            ->get();

        return [
            'status'=>'success',
            'data'=>compact('products')
        ];
    }
}
