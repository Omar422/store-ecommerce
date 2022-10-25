<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

// class Admin extends Model
class Admin extends Authenticatable
{
    //
    // protected $table = "admins"; // it's with laravel con
    protected $guarded = []; // all fields
    public $timestamps = true;

    // cast to native types
    // protected $casts = [
    //     'password' => '',
    // ];
}
