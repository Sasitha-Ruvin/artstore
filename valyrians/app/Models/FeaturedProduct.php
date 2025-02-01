<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedProduct extends Model
{
    //
    protected $fillable = [
        'name', 'description', 'price', 'image',
    ];
}
