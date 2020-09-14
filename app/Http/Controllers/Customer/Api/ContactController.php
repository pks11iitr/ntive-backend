<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function store(Request $request){

        $request->validate([

            'name'=>'required',
            'mobile'=>'required',
            'email'=>'required|email',
            'title'=>'required',
            'description'=>'required',

        ]);


        Contact::create($request->only('name','email','mobile', 'title', 'description'));

        return [

            'status'=>'success',
            'message'=>'Your Query Has Been Received. We Will Respond Shortly.'

        ];

    }
}
