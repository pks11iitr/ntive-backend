<?php

namespace App\Http\Controllers\Customer\Api\Auth;

use App\Events\CustomerRegistered;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'max:100'],
            'password' => ['required', 'string', 'min:6'],
            'mobile'=>['required', 'string', 'max:10']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email']??null,
            'password' => Hash::make($data['password']),
            'mobile'=>$data['mobile'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if($customer=Customer::where('mobile', $request->mobile)->orWhere(function($query)use($request){
            $query->where('email', $request->email)->where('email', '!=', null);
        })->first()){
            return [
                'status'=>'failed',
                'message'=>'Email or mobile already registered'
            ];
        }

        $user = $this->create($request->all());
        $user->notification_token=$request->notification_token;
        $user->save();
        event(new CustomerRegistered($user));

        return [
            'status'=>'success',
            'message'=>'Please verify otp to continue'
        ];
    }
}
