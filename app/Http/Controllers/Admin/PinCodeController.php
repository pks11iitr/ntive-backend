<?php

namespace App\Http\Controllers\Admin;

use App\Models\PinCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PinCodeController extends Controller
{
    public function index(Request $request){
        $pincodes=PinCode::paginate(100);
        return view('admin.pincode.view', compact('pincodes'));
    }

    public function create(Request $request){
        return view('admin.pincode.add');
    }

    public function store(Request $request){

        $pincodes=explode(',', $request->pin_code);
        foreach($pincodes as $pincode)
            $pincode=trim($pincode);
            if(!empty($pincode)){
                PinCode::create([
                    'pin_code'=>trim($pincode)
                ]);
            }
        return redirect(route('pincode.list'))->with('success','PinCode has been created');
    }

    public function delete(Request $request, $id){
        $pincode=PinCode::find($id);
        $pincode->delete();
        return redirect(route('pincode.list'))->with('success','PinCode has been deleted');

    }
}
