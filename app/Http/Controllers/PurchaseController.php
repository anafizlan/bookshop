<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // show purchase page
    public function index()
    {
        $books = Book::where('is_visible', 1)->orderBy('id', 'asc')->get();

        return view('purchases', compact('books'));
    }

    // buy book
    public function buy(Request $request, $id)
    {
        session(['quantity' => $request->quantity]);

        return redirect()->route('payment', $id);
    }

    public function payment($id)
    {
        $book = Book::findOrFail($id);

        $qty = session('quantity', 1);

        $total = $book->price * $qty;

        return view('payment', compact('book', 'qty', 'total'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $book = Book::where('id', $id)->where('is_visible', 1)->firstOrFail();
        $book = Book::findOrFail($id);

        $qty = $request->quantity;

        $total = $book->price * $qty;

        // check stock
        if ($qty > $book->stock) {
            return redirect('/purchase')->with('error', 'Not enough stock!');
        }

        // reduce stock
        $book->stock -= $qty;
        $book->save();

        // save order
        Order::create([
            'user_id' => Auth::id(),
            'book_title' => $book->title,
            'quantity' => $qty,
            'total_price' => $total,
        ]);
        return redirect('/purchase')->with('success', 'Payment successful!');
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->is_visible = $request->is_visible;
        $book->is_visible = $request->is_visible ?? 1;
        $book->save();

        return back()->with('success', 'Book updated successfully');
    }
}
