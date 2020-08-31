<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PinCode extends Model
{
    protected $table='pin_code';

    protected $fillable=['pin_code'];

    public $timestamps = false;
}
