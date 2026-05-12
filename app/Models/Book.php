<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Nama table (optional, sebab Laravel dah auto detect "books")
    protected $table = 'books';

    // Column yang boleh insert
    protected $fillable = [
        'title',
        'genre',
        'author'
    ];
}
