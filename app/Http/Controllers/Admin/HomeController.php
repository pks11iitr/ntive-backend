<?php

namespace App\Http\Controllers\Admin;

use App\Models\LoanApplication;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $applications=LoanApplication::groupBy('approval_status')
            ->selectRaw('count(*) as count, approval_status')
            ->get();

        $applications_array=[];
        $total_order=0;
        foreach($applications as $o){
            if(isset($applications_array[$o->approval_status]))
                $applications_array[$o->approval_status]=0;
            $applications_array[$o->status]=$o->count;
            $total_order=$total_order+$o->count??0;
        }

        $applications_array['total']=$total_order;

        $profit=LoanApplication::where('approval_status', 'completed')
            ->selectRaw('sum(amount) as total_amount, sum(paid_amount) as total_paidback')
            ->get();

        return view('admin.home', [
            'applications'=>$applications_array,
            'profit'=>$profit
        ]);
    }
}
