<?php

namespace App\Http\Controllers\Customer\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function view(Request $request){

        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        return [
            'status'=>'success',
            'date'=>[
                'user'=>$user->only('name','email','mobile', 'image')
            ]
        ];
    }


    public function update(Request $request){

        $request->validate([
            'image'=>'required|image'
        ]);
        //var_dump($request->all());
        //var_dump($request->image);die;
        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        if($request->image){

            $user->saveImage($request->image, 'customers');

        }

        return [
            'status'=>'success',
            'message'=>'Profile has been updated',
            'image_url'=>$user->image
        ];

    }


    public function updateinfo(Request $request){

        $request->validate([
            'name'=>'required|string|max:25',
            'email'=>'nullable|email|max:25'
        ]);
        //var_dump($request->all());
        //var_dump($request->image);die;
        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        //if($request->image){

            $user->update($request->only('name', 'email'));

        //}

        return [
            'status'=>'success',
            'message'=>'Profile has been updated',
        ];

    }


}
