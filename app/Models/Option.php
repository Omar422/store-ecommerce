<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use Translatable;
    // the relations to eager load on every query
    protected $with = ['translations'];
    // the translated column
    protected $translatedAttributes = ['name'];

    # field to deal with
    // protected $guarded = [];
    protected $fillable = ['attribute_id', 'product_id', 'price'];
    protected $hidden = ['translations'];

    # Relations
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

}
