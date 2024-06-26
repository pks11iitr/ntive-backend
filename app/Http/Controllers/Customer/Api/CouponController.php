<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function applyCoupon(Request $request, $order_id){


        $coupon=Coupon::where(DB::raw('BINARY code'), $request->coupon??null)->first();
        if(!$coupon){
            return [
                'status'=>'failed',
                'message'=>'Invalid Coupon Applied',
            ];
        }


        if($coupon->isactive==false || $coupon->is_expired==true){
            return [
                'status'=>'failed',
                'message'=>'Coupon Has Been Expired',
            ];
        }

        $order=Order::find($order_id);

        $discount=$coupon->calculateDiscount($order->total_cost+$order->coupon_discount);

        $prices=[
            'total'=>$order->total_cost+$order->coupon_discount,
            'coupon'=>$discount,
            'delivery'=>(($order->total_cost+$order->coupon_discount-$discount)<200?30:0),
            'payble'=>($order->total_cost+$order->coupon_discount-$discount)+(($order->total_cost+$order->coupon_discount-$discount)<200?30:0),
            'payble_text'=>$order->payment_status=='payment-wait'?'Payable Amount':'Paid Amount'
        ];

        if($discount > $order->total_cost+$order->coupon_discount)
        {
            return [
                'status'=>'failed',
                'message'=>'Coupon Cannot Be Applied',
            ];
        }

        return [

            'status'=>'success',
            'message'=>'Discount of Rs. '.$discount.' Applied Successfully',
            'prices'=>$prices
        ];


    }
}
