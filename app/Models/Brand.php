<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;

    // the relations to eager load on every query
    protected $with = ['translations'];

    protected $fillable = ['is_active', 'photo'];

    public $timestamps = false;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // the translated column
    protected $translatedAttributes = ['name'];

    public function getActive() {
        return $this -> is_active == 0 ? 'غير مفعل' : 'مفعل';
    }

    // return the active brands
    public function scopeActive($q) {
        return $q -> where('is_active', 1);
    }


    public function getPhotoPath($val) {
        return ($val !== null) ? asset('assets/images/brands/' . $val) : "" ;
    }


    // // not return with queries
    // protected $hidden = ['translations'];
}
