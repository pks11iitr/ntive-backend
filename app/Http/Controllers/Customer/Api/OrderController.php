<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Cart;
use App\Models\Clinic;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PinCode;
use App\Models\Product;
use App\Models\Therapy;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){
        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];
        $orders=Order::with(['details.entity'])
            ->where('status', '!=','pending')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $lists=[];

        foreach($orders as $order) {
            //echo $order->id.' ';
            $total = count($order->details);
            $lists[] = [
                'id' => $order->id,
                'title' => ($order->details[0]->entity->name ?? '') . ' ' . ($total > 1 ? 'and ' . ($total - 1) . ' more' : ''),
                'booking_id' => $order->refid,
                'datetime' => date('D d M,Y', strtotime($order->created_at)),
                'total_price' => $order->total_cost+$order->delivery_charge,
                'image' => $order->details[0]->entity->image ?? ''
            ];
        }
        return [
            'status'=>'success',
            'data'=>$lists
        ];

    }

    public function initiateOrder(Request $request){

        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        switch($request->type){
            case 'product':
                return $this->initiateProductPurchase($request);
            default:
                return [
                    'status'=>'failed',
                    'message'=>'Invalid Operation Performed'
                ];
        }
    }

    public function initiateProductPurchase(Request $request){

        $cartitems=Cart::where('user_id', auth()->guard('customerapi')->user()->id)
            ->with(['product'])
            ->whereHas('product', function($product){
            $product->where('isactive', true)->where('out_of_stock', 0);
        })->get();

        if(!$cartitems)
            return [
                'status'=>'failed',
                'message'=>'Cart is empty'
            ];

        $refid=env('MACHINE_ID').time();
        $total_cost=0;
        foreach($cartitems as $item) {
            $total_cost=$total_cost+($item->product->sizeprice->price??0)*$item->quantity;
        }

        $order=Order::create([
            'user_id'=>auth()->guard('customerapi')->user()->id,
            'refid'=>$refid,
            'status'=>'pending',
            'total_cost'=>$total_cost,
            'delivery_charge'=>$total_cost<200?30:0
        ]);

        OrderStatus::create([
            'order_id'=>$order->id,
            'current_status'=>$order->status
        ]);

        foreach($cartitems as $item){
            OrderDetail::create([
                'order_id'=>$order->id,
                'entity_type'=>'App\Models\Product',
                'entity_id'=>$item->product_id,
                'clinic_id'=>null,
                'size_id'=>$item->size_id,
                'cost'=>$item->product->actual_price??0,
                'quantity'=>$item->quantity
            ]);
        }

        return [
            'status'=>'success',
            'data'=>[
                'order_id'=>$order->id
            ]
        ];

    }

    public function addContactDetails(Request $request, $id){

        $request->validate([
           'name'=>'required|max:60|string',
           'email'=>'email',
           'mobile'=>'required|digits:10',
            'address'=>'string|max:100|nullable',
            //'lat'=>'numeric',
            //'lang'=>'numeric'
            'pincode'=>'required|integer'
        ]);


        $pin=PinCode::where('pin_code', $request->pincode)->first();
        if(!$pin)
            return [
                'status'=>'failed',
                'message'=>'Delivery is not available for this pincode'
            ];

        $user=auth()->guard('customerapi')->user();

        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];
        $order=Order::where('user_id', $user->id)->find($id);

        if(!$order)
            return [
                'status'=>'failed',
                'message'=>'Invalid Operation Performed'
            ];
        $request->merge(['order_details_completed'=>true]);
        if($order->update($request->only('name','email','address', 'mobile','lat', 'lang', 'pincode'))){
            return [
                'status'=>'success',
                'message'=>'Address has been updated'
            ];
        }

    }

    public function getContactDetails(Request $request){
        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        $order=Order::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->where('email', '!=', null)
            ->first();

        $contact=[
            'name'=>$order->name??$user->name,
            'email'=>$order->email??$user->email,
            'mobile'=>$order->mobile??$user->mobile,
            'address'=>$order->address??'',
            'pincode'=>$order->pincode??''
        ];

        return [
            'status'=>'success',
            'data'=>compact('contact')
        ];

    }

    public function orderdetails(Request $request, $id){
        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];
        $order=Order::with(['details.entity'])->where('user_id', $user->id)->find($id);

        if(!$order)
            return [
                'status'=>'failed',
                'message'=>'Invalid Operation Performed'
            ];


        $itemdetails=[];
        foreach($order->details as $detail){
                $itemdetails[]=[
                    'name'=>$detail->entity->name??'',
                    'small'=>$detail->entity->company??'',
                    'price'=>$detail->cost,
                    'quantity'=>$detail->quantity,
                    'image'=>$detail->entity->image??'',
                    'booking_date'=>$order->booking_date,
                    'booking_time'=>$order->booking_time
                ];
        }

        // options to be displayed
        $display_cancel_button=0;
        $display_return_button=0;
        $display_pay_button=0;
        if($order->status=='pending'){
            $display_pay_button=1;
        }else if(in_array($order->status, ['pending', 'confirmed'])){
            $display_cancel_button=1;
        }elseif(in_array($order->status, ['delivered'])){
            $display_return_button=0;
        }

        if(in_array($order->status, ['pending','confirmed','processing', 'dispatched'])){
            $date=date('Y-m-d H:i', strtotime($order->created_at));
            $dateslot=date('Y-m-d', strtotime($order->created_at)).' 15:00';
            if($date > $dateslot){
                $delivery_date=date('d/m/Y', strtotime('+1 days', strtotime($order->created_at)));
                $delivery_text='Your Order Will Be Delivered on '.$delivery_date.' (between 06:00 am-10:00 am)';
            }else{
                $delivery_text='Your Order Will Be Delivered on '.date('d/m/Y').' (between 04:00 pm-08:00 pm)';
            }


        }else{
            $delivery_text='';
        }

        $prices=[
            'total'=>$order->total_cost+$order->coupon_discount,
            'coupon'=>$order->coupon_discount,
            'delivery'=>$order->delivery_charge,
            'payble'=>$order->total_cost+$order->delivery_charge,
            'payble_text'=>$order->payment_status=='payment-wait'?'Payable Amount':'Paid Amount'
        ];


        return [
            'status'=>'success',
            'data'=>[
                'orderdetails'=>$order->only('id', 'total_cost','refid', 'status','payment_mode', 'name', 'mobile', 'email', 'address','booking_date', 'booking_time','is_instant','status'),
                'itemdetails'=>$itemdetails,
                //'balance'=>Wallet::balance($user->id),
                //'points'=>Wallet::points($user->id),
                //'show_cancel'=>$show_cancel??0,
                //'show_reschedule'=>$show_reschedule??0,
                //'show_cancel_product'=>$show_cancel_product??0,
                //'dates'=>$dates,
                //'timings'=>$timings
                'display_cancel_button'=>$display_cancel_button,
                'display_return_button'=>$display_return_button,
                'display_pay_button'=>$display_pay_button,
                'delivery_text'=>$delivery_text,
                'prices'=>$prices
            ]
        ];
    }

    public function cancelOrder(Request $request, $id){
        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        $order=Order::with(['details.entity'])->where('user_id', $user->id)->find($id);

        if(!$order)
            return [
                'status'=>'failed',
                'message'=>'Invalid Operation Performed'
            ];

        if($order->details[0]->entity instanceof Product)
            return $this->cancelProductsBooking($order);
    }


    public function cancelProductsBooking($order){

        $product_cancellation_status=[
            'confirmed','pending'
        ];

        if(!in_array($order->status, $product_cancellation_status)){
            return [
                'status'=>'failed',
                'message'=>'Order cannot be cancelled now'
            ];
        }

        $order->status='cancelled';
        $order->save();

        OrderStatus::create([
            'order_id'=>$order->id,
            'current_status'=>$order->status
        ]);

        return [
            'status'=>'success',
            'message'=>'Order has been cancelled. '.($order->payment_status=='paid'?'Refund process will be initiated shortly':'')
        ];

    }

    public function returnProductsBooking(Request $request, $id){


        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        $order=Order::with(['details.entity'])->where('user_id', $user->id)->find($id);

        if(!$order)
            return [
                'status'=>'failed',
                'message'=>'Invalid Operation Performed'
            ];


        $product_return_status=[
            'delivered',
        ];

        if(!in_array($order->status, $product_return_status)){
            return [
                'status'=>'failed',
                'message'=>'Order cannot be returned now'
            ];
        }

        $order->status='return-requested';
        $order->save();

        OrderStatus::create([
            'order_id'=>$order->id,
            'current_status'=>$order->status
        ]);

        return [
            'status'=>'success',
            'message'=>'We have received your refund request. We will process this shortly'
        ];

    }

}
