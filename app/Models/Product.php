<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $collection = 'products'; 

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'category',
        'quantity',
        'size',
    ];
}
