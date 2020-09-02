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
    protected $appends=['category'];

    protected $fillable=['image','type','isactive', 'category_id','main_category_id'];

    protected $hidden = ['created_at','deleted_at','updated_at'];

    public function getImageAttribute($value){
      return Storage::url($value);
    }

    public function getCategoryAttribute($value){
        $value=$this->category_id;

        if(stripos($value, 'main')!==false){
            $category_id=str_replace('main_', '', $value);
            $relcategory=HomeCategory::find((int)$category_id);
            return [
                'name'=>$relcategory->title??'',
                'type'=>'home',
                'id'=>$relcategory->id??''
            ];
        }else{
            //die($value);
            $category_id=str_replace('sub_', '', $value);
            $relcategory=SubCategory::find((int)$category_id);
            return [
                'cat_name'=>$relcategory->name??'',
                'type'=>'home',
                'id'=>$relcategory->id??''
            ];
        }
    }

}
