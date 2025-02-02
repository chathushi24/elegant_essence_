<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    protected $collection = 'products'; // Define MongoDB collection name

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
