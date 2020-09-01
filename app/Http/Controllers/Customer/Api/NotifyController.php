<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\NotifyMe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotifyController extends Controller
{
    public function update(Request $request, $id){

        $user=auth()->guard('customerapi')->user();

        $notify=NotifyMe::where('user_id', $user->id)
            ->where('product_id', $id)
            ->first();

        if(!$notify){


            NotifyMe::create([
                'user_id'=>$user->id,
                'product_id'=>$id
            ]);


        }else{
            $notify->delete();
        }


        return [
            'status'=>'success'
        ];


    }
}
