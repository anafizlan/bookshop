<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    // show purchase page
    public function index()
    {
        $books = Purchase::orderBy('id', 'asc')->get();

        return view('purchases', compact('books'));

        $notifications = DB::table('notifications')
    ->join('users', 'notifications.from_user_id', '=', 'users.id')
    ->where('notifications.user_id', Auth::id())
    ->where('notifications.is_read', false)
    ->orderBy('notifications.created_at', 'desc')
    ->select('notifications.*', 'users.name')
    ->get();

$notifCount = $notifications->count();

    return view('home', compact('notifications', 'notifCount'));
    }

    // buy book
   public function buy(Request $request, $id)
{
    session(['quantity' => $request->quantity]);

return redirect()->route('payment', $id);
}


public function payment($id)
{
    $book = Purchase::findOrFail($id);

    $qty = session('quantity', 1);

    $total = $book->price * $qty;

    return view('payment', compact('book', 'qty', 'total'));
}

public function confirmPayment(Request $request, $id)
{
    $book = Purchase::findOrFail($id);

    $qty = $request->quantity;

    // check stock
    if ($qty > $book->stock) {
        return redirect('/purchase')
            ->with('error', 'Not enough stock!');
    }

    // reduce stock
    $book->stock -= $qty;
    $book->save();

    // save order
    Order::create([
    'book_title' => $book->title,
    'quantity' => $qty,
    'total_price' => $book->price * $qty,
    'user_email' => Auth::user()->email
]);
    return redirect('/purchase')
        ->with('success', 'Payment successful!');
}
}