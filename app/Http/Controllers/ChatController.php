<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ChatController extends Controller

{
public function index($id)
{
    $friend = DB::table('users')
        ->where('id', $id)
        ->first();

    $messages = DB::table('messages')
        ->where(function($query) use ($id) {

            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $id);

        })
        ->orWhere(function($query) use ($id) {

            $query->where('sender_id', $id)
                  ->where('receiver_id', Auth::id());

        })
        ->orderBy('created_at')
        ->get();

        DB::table('notifications')
    ->where('user_id', Auth::id())
    ->where('from_user_id', $id)
    ->where('type', 'message')
    ->update(['is_read' => true]);


    return view(
        'chat.index',
        compact('friend', 'messages')
    );
}

public function send(Request $request, $id)
{
    $request->validate([
        'message' => 'required'
    ]);

    DB::table('messages')->insert([

        'sender_id' => Auth::id(),
        'receiver_id' => $id,
        'message' => $request->message,
        'created_at' => now(),
        'updated_at' => now(),

    ]);

    DB::table('notifications')->insert([
    'user_id' => $id,
    'from_user_id' => Auth::id(),
    'type' => 'message',
    'action_type' => 'chat',
    'action_id' => Auth::id(),
    'message' => 'sent you a message',
    'is_read' => false,
    'created_at' => now(),
    'updated_at' => now(),
]);

    return back();
}

}