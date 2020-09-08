<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){

        if(isset($request->search)){
            $orders=Order::where(function($orders) use ($request){
                $orders->where('name', 'like', "%".$request->search."%")
                    ->orWhere('email', 'like', "%".$request->search."%")
                    ->orWhere('mobile', 'like', "%".$request->search."%");
            });

        }else{
            $orders =Order::where('id', '>=', 1);
        }
        if($request->ordertype)
            $orders=$orders->orderBy('created_at', $request->ordertype);

        if($request->status)
            //var_dump($request->status);die();
            $orders=$orders->where('status', $request->status);

        if(isset($request->datefrom))
            $orders = $orders->where('created_at', '>=', $request->datefrom.' 00:00:00');

        if(isset($request->dateto))
            $orders = $orders->where('created_at', '<=', $request->dateto.' 23:59:59');

        $orders =$orders->orderBy('id', 'desc')->paginate(20);

        return view('admin.order.order',['orders'=>$orders]);
    }

    public function orderview(Request $request,$id){
        $order =Order::with(['details.entity'])->where('id',$id)->first();
        return view('admin.order.orderview',['order'=>$order]);
    }

    public function changeStatus(Request $request, $id){

        $status=$request->status;
        $order=Order::find($id);

        $order->status=$status;
        $order->save();

        return redirect()->back()->with('success', 'Order has been updated');


    }

}
