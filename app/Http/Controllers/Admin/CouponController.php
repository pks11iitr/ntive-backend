<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index(Request $request){
        $coupons =Coupon::get();
        return view('admin.coupon.view',['coupons'=>$coupons]);
    }

    public function create(Request $request){
        return view('admin.coupon.add');
    }


    public function store(Request $request){
        Coupon::create($request->only(['code','description','type', 'discount', 'isactive']));
        return redirect()->route('coupon.list')->with('success', 'Coupon has been created');
    }


    public function edit(Request $request,$id){
        $coupon=Coupon::findOrFail($id);
        return view('admin.coupon.edit',['coupon'=>$coupon]);
    }


    public function update(Request $request,$id){
        $coupon=Coupon::findOrFail($id);
        $coupon->update($request->only(['code','description','type', 'discount', 'isactive']));
        return redirect()->route('coupon.list')->with('success', 'Coupon has been updated');
    }
}
