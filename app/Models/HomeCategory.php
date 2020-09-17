<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Storage;
class HomeCategory extends Model
{
    use Active, DocumentUploadTrait;
  protected $table='home_category';

    protected $fillable=['image','title','isactive', 'sequence_no'];

    protected $hidden = ['created_at','deleted_at','updated_at'];

    public function getImageAttribute($value){
      return Storage::url($value);
    }
}
