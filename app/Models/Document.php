<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $table='documents';

    protected $fillable=['entity_type', 'entity_id', 'file_path'];


    public function getFilePathAttribute($value){
        if($value)
            return Storage::url($value);

        return null;
    }
}
