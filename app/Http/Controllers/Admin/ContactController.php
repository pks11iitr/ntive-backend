<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(Request $request){
        $contacts =Contact::get();
        return view('admin.contact.view',['contacts'=>$contacts]);
    }
}
