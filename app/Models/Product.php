<?php

namespace App\Models;

use App\Models\Traits\Active;
use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Storage;
class Product extends Model
{
    use Active, DocumentUploadTrait;
  protected $table='products';

    protected $fillable=['image','name','cat_id','subcat_id','weight','unit','actual_price','cut_price','is_featured','is_discount','is_newarrivel','isactive','out_of_stock'];

    protected $hidden = ['created_at','deleted_at','updated_at'];

    public function getImageAttribute($value){
      return Storage::url($value);
    }

    public function category(){
        return $this->belongsTo('App\Models\HomeCategory', 'cat_id');
    }
    public function subcategory(){
        return $this->belongsTo('App\Models\SubCategory', 'subcat_id');
    }

}
