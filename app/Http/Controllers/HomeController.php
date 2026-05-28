<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')->join('users', 'notifications.from_user_id', '=', 'users.id')->where('notifications.user_id', Auth::id())->where('notifications.is_read', false)->orderBy('notifications.created_at', 'desc')->select('notifications.*', 'users.name')->get();

        $notifCount = $notifications->count();

        return view('home', compact('notifications', 'notifCount'));
    }
}
