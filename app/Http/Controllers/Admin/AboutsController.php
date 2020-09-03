<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutsController extends Controller
{
    public function abouts(Request $request){
        return view('abouts');
    }
    public function privacy(Request $request){
        return view('privacy');
    }
}
