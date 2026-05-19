<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // LIST ALL BOOKS
  public function index(Request $request)
{
    $genres = Book::select('genre')->distinct()->get();

    $genre = $request->genre;

    $books = Book::when($genre, function ($query, $genre) {
            return $query->where('genre', $genre);
        })
        ->orderBy('id', 'asc')
        ->get();

    // 🔔 NOTIFICATION PART (ADD NI)
    $notifications = DB::table('notifications')
        ->join('users', 'notifications.from_user_id', '=', 'users.id')
        ->where('notifications.user_id', Auth::id())
        ->select('notifications.*', 'users.name')
        ->latest()
        ->get();

    $notifCount = $notifications->where('is_read', false)->count();

    return view('books', compact(
        'books',
        'genres',
        'genre',
        'notifications',
        'notifCount'
    ));
}
    // FORM CREATE
    public function create()
    {
        return view('books');
    }

    // SAVE BOOK
    public function store(Request $request)
    {
        Book::create($request->all());
        return redirect('/books');
    }

    // EDIT FORM
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books', compact('book'));
    }

    // UPDATE BOOK
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect('/books');
    }

    // DELETE BOOK
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect('/books');
    }
}