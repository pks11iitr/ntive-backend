<?php

namespace App\Http\Controllers\Admin;

use App\Models\PinCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PinCodeController extends Controller
{
    public function index(Request $request){
        return view('admin.pincode.view');
    }

    public function create(Request $request){
        return view('admin.pincode.add');
    }

    public function store(Request $request){
        PinCode::create($request->only(['pin_code']));

        return redirect(route('pincode.list'))->with('success','PinCode has been created');
    }
}
