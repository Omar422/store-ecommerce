<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Translatable;

    // the relations to eager load on every query
    protected $with = ['translations'];
    // the translated column
    protected $translatedAttributes = ['name'];

    protected $guarded = [];
    public $timestamps = false;

    public function options() {
        return $this->hasMany(Option::class, 'attribute_id');
    }

}
