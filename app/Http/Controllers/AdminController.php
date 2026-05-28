<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = DB::table('users')->count();

        $totalBooksSold = DB::table('orders')->sum('quantity');

$totalRevenue = DB::table('orders')->sum('total_price');

$popularBooks = DB::table('orders')
    ->select('book_title as title', DB::raw('count(*) as total'))
    ->groupBy('book_title')
    ->orderByDesc('total')
    ->get();

$genreStats = DB::table('orders')
    ->join('books', 'orders.book_title', '=', 'books.title')
    ->select('books.genre', DB::raw('count(*) as total'))
    ->groupBy('books.genre')
    ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBooksSold',
            'totalRevenue',
            'genreStats',
            'popularBooks'
        ));
    }
}