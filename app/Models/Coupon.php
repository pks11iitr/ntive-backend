<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use Active;

    protected $table='coupons';


    protected $fillable=['code','description','type', 'discount', 'isactive'];


    public function calculateDiscount($amount){
        if($this->type=='fixed'){

            $discount=$this->discount;

        }else{
            $discount=floor($amount*$this->discount/100);
        }

        return $discount;
    }
}
