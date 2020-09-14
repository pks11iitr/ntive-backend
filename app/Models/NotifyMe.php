<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifyMe extends Model
{
    protected $table='notify_me';

    protected $fillable=['product_id', 'user_id'];

    public function customer(){
        return $this->belongsTo('App\Models\Customer', 'user_id');
    }
}
