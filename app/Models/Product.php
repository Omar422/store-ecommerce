<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Translatable,
        SoftDeletes;

    // the relations to eager load on every query
    protected $with = ['translations'];

    // the translated column
    protected $translatedAttributes = ['name', 'description','short_description'];

    protected $fillable = [
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active']
        ;

    // not return with queries
    protected $hidden = ['translations'];

    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'special_price_start',
        'special_price_end',
        'deleted_at',
    ];

    // relations

    public function brand() {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

}
