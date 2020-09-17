<?php

namespace App\Http\Controllers\Customer\Api;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index(Request $request){

        $user=auth()->guard('customerapi')->user();
        if(!$user)
            return [
                'status'=>'failed',
                'message'=>'Please login to continue'
            ];

        $notifications=Notification::where(function($notifications)use($user){
            $notifications->where('user_id', $user->id)
                ->orWhere('type', 'all');
        })
            ->where(DB::raw('TIMESTAMPDIFF(HOUR, created_at, NOW())'), '<=', 24)
            ->select('title', 'description', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return [
            'status'=>'success',
            'data'=>compact('notifications')
        ];

    }
}
