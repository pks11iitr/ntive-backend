<?php

namespace App\Http\Controllers\Admin;


use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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
        return view('admin.home', compact('total_amount','total_orders','completed_amount', 'completed_orders','products','users'));
    }
}
