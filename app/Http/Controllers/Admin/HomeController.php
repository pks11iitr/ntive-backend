<?php

namespace App\Http\Controllers\Admin;


use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $total_orders=Order::where('status', '!=', 'pending')->count();
        $total_amount=Order::where('status', '!=', 'pending')->sum('total_cost');
        $completed_orders=Order::where('status', 'completed')->count();
        $completed_amount=Order::where('status',  'completed')->sum('total_cost');
        $products=Product::count();
        $users=Customer::count();

        $product_orders_data=Order::where('status', 'confirmed')
            ->where('created_at', '>=', date('Y').'-01-01 00:00:00')
            ->whereHas('details',function($details){
                $details->where('entity_type', 'App\Models\Product');
            })
            ->select(DB::raw('Month(created_at) as month'), DB::raw('SUM(total_cost) as total_cost'))
            ->groupBy(DB::raw('Month(created_at)'))
            ->orderBy(DB::raw('Month(created_at)'), 'asc')
            ->get();

        $product_sales=[];
        foreach($product_orders_data as $d){
            $product_sales[$d->month]=$d->total_cost;
        }

        $sales_data=[
            'product'=>$product_sales
        ];

        return view('admin.home', compact('total_amount','total_orders','completed_amount', 'completed_orders','products','users', 'sales_data'));
    }
}
