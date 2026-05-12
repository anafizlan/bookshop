<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function recommend(Request $request)
    {
        $genre = $request->genre;

        $books = Book::where('genre', 'LIKE', "%$genre%", "")->get();

        return view('books', compact('books', 'genre'));
    }
}