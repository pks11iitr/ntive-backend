<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Notification;
use App\Services\Notification\FCMNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function create(Request $request){
            return view('admin.notification.add');
               }

   public function store(Request $request){
               $request->validate([
                  			'title'=>'required',
                  			'description'=>'required'
                               ]);

          if($notification=Notification::create([
                      'title'=>$request->title,
                      'description'=>$request->description,
                      'type'=>'all',
                      'user_id'=>'0',

                      ]))
            {

                $user=Customer::select('notification_token')->get();

                foreach($user as $u){
                    FCMNotification::sendNotification($u->notification_token, $request->title, $request->description);
                }

             return redirect()->back()->with('success', 'Notification Send Successfully');
            }
             return redirect()->back()->with('error', 'Notification failed');
          }

  }
