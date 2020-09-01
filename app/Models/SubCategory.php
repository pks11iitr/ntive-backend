<?php

namespace App\Models;
use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use Active, DocumentUploadTrait;
    protected $table='sub_category';

    protected $fillable=['category_id','name', 'isactive'];

    protected $hidden =['created_at','updated_at','deleted_at'];

    public function category(){
        return $this->belongsTo('App\Models\HomeCategory', 'category_id');
    }


}
