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

    public function scopeParent($q) {
        return $q->whereNull('parent_id');
    }

    public function scopeChild($q) {
        return $q->whereNotNull('parent_id');
    }

    public function getActive() {
        return $this -> is_active == 0 ? 'غير مفعل' : 'مفعل';
    }

    // return the active category
    public function scopeActive($q) {
        return $q -> where('is_active', 1);
    }

    public function category_parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
