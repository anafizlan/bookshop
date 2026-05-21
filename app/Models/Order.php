<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'book_title',
        'quantity',
        'total_price',
        'user_id'
    ];

    public function book()
{
    return $this->belongsTo(Book::class);
}
}

