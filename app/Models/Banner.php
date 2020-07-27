<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Storage;
class Banner extends Model
{
    use Active, DocumentUploadTrait;
  protected $table='banners';

    protected $fillable=['image','type','isactive'];

    protected $hidden = ['created_at','deleted_at','updated_at'];

    public function getImageAttribute($value){
      return Storage::url($value);
    }
}
