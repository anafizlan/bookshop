<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')
            ->join('users', 'notifications.from_user_id', '=', 'users.id')
            ->where('notifications.user_id', Auth::id())
            ->where('notifications.is_read', false)
            ->orderBy('notifications.created_at', 'desc')
            ->select('notifications.*', 'users.name')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function read($id)
{
    $notif = DB::table('notifications')->where('id', $id)->first();

    DB::table('notifications')
        ->where('id', $id)
        ->update(['is_read' => true]);

    if ($notif->type == 'message') {
        return redirect('/chat/' . $notif->from_user_id);
    }

    return redirect()->back();
}
}