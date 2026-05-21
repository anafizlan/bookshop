<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
        'title',
        'genre',
        'author',
        'price',
        'stock'
    ];

    public function orders()
{
    return $this->hasMany(Order::class);
}
}