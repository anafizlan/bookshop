<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Order;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
        return view('purchases', compact('purchases'));
    }

    
    // 🔥 LETAK SINI (DI BAWAH FUNCTION BUY)
  public function buy(Request $request, $id)
{
    return redirect("/checkout/$id")
        ->with('quantity', $request->quantity);
}
    public function paymentSuccess(Request $request, $id)
    {
        $book = Purchase::find($id);

        $qty = $request->quantity;
        $total = $request->total;

        Order::create([
            'book_title' => $book->title,
            'quantity' => $qty,
            'total_price' => $total,
        ]);

        $book->stock -= $qty;
        $book->save();

        return redirect('/purchase')->with('success', 'Payment successful!');
        
        if ($qty > $book->stock) {
    return redirect('/purchase')
        ->with('error', 'Stock not enough');
}
    }
  public function checkout(Request $request, $id)
{
    $book = Purchase::find($id);
    $qty = session('quantity', 1);

    $total = $book->price * $qty;

    return view('payment', compact('book', 'qty', 'total'));
}
}

