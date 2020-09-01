<?php

namespace App\Models;

use App\Models\Traits\Active;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use Active;

    protected $table='coupons';


    protected $fillable=['code','description','type', 'discount', 'isactive'];
}
