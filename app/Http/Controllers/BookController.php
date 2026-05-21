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

        $genresSelected = $request->genres;

        $user = Auth::user();

        $books = Book::when($genresSelected, function ($query, $genresSelected) {
            return $query->whereIn('genre', $genresSelected);
        })
            ->when($user->role_id != 1, function ($query) {
                // USER ONLY SEE VISIBLE BOOKS
                return $query->where('is_visible', true);
            })
            ->orderBy('id', 'asc')
            ->get();

        // 🔔 NOTIFICATION PART (ADD NI)
        $notifications = DB::table('notifications')->join('users', 'notifications.from_user_id', '=', 'users.id')->where('notifications.user_id', Auth::id())->select('notifications.*', 'users.name')->latest()->get();

        $notifCount = $notifications->where('is_read', false)->count();

        return view('books', compact('books', 'genres', 'notifications', 'notifCount'));
    }
    // FORM CREATE
    public function create()
    {
        return view('books');
    }

    // SAVE BOOK
    public function store(Request $request)
{
    Book::create([
        'title' => $request->title,
        'genre' => $request->genre,
        'author' => $request->author,
        'price' => $request->price,
        'stock' => $request->stock,
    ]);

    return back()->with('success', 'Book added successfully!');
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

    public function hide($id)
    {
        if (Auth::user()->role_id != 1) {
            abort(403);
        }

        Book::where('id', $id)->update([
            'is_visible' => false,
        ]);

        return back()->with('success', 'Book hidden');
    }

    public function show($id)
    {
        if (Auth::user()->role_id != 1) {
            abort(403);
        }

        Book::where('id', $id)->update([
            'is_visible' => true,
        ]);

        return back()->with('success', 'Book visible');
    }
}
