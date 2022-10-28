<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    // the relations to eager load on every query
    protected $with = ['translations'];

    // the translated column
    protected $translatedAttributes = ['name'];

    protected $fillable = ['parent_id', 'slug', 'is_active'];

    // not return with queries
    protected $hidden = ['translations'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
