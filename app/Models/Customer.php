<?php

namespace App\Models;

use App\Models\Traits\DocumentUploadTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Customer extends Authenticatable implements JWTSubject
{
    use DocumentUploadTrait;

    protected $table='customers';

    protected $fillable = [
        'name', 'email', 'mobile', 'password', 'image', 'dob','address','city', 'state','status','is_verified','phone'
    ];

    protected $hidden = [
        'password','created_at','deleted_at','updated_at','email','mobile'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageAttribute($value){
        if($value)
            return Storage::url($value);
        return null;
    }

    public function documents(){
        return $this->morphMany('App\Models\Document', 'entity');
    }

    public static function isUserVerified($user){
        if(!$user )
            return 0;
        else if($user->is_verified)
            return 0;
        else
            return 1;
    }
}
