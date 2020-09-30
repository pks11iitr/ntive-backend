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

    public function privacyweb(Request $request){
        return view('privacy');
    }

    public function termsweb(Request $request){
        return view('terms-and-conditions');
    }

    public function aboutweb(Request $request){
        return view('about-web');
    }

    public function contactweb(Request $request){
        return view('contact-us');
    }
}
