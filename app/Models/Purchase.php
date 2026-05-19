<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'author',
        'price',
        'stock'
    ];

    public $timestamps = false;
}