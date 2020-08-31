<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){
        $orders = Order::get();
        return view('admin.order.order',['orders'=>$orders]);
    }
    public function orderview(Request $request,$id){
        $order =Order::with(['details.entity'])->where('id',$id)->first();
        return view('admin.order.orderview',['order'=>$order]);
    }
}