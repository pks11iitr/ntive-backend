<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table='order_statuses';

    protected $fillable=['order_id', 'current_status'];
}
