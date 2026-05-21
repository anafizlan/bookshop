<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())
            ->where('role_id', '!=', 1) // admin
            ->get()
            ->sortByDesc(function ($user) {
                $friendship = DB::table('friends')->where('user_id', Auth::id())->where('friend_id', $user->id)->first();

                if ($friendship && $friendship->status == 'accepted') {
                    return 2;
                }

                if ($friendship && $friendship->status == 'pending') {
                    return 1;
                }

                return 0;
            });

        $friends = DB::table('friends')->join('users', 'friends.friend_id', '=', 'users.id')->where('friends.user_id', Auth::id())->where('friends.status', 'accepted')->select('users.*')->get();

        return view('users', compact('users', 'friends'));
    }

    public function addFriend($id)
    {
        $userId = Auth::id();

        // check kalau dia dah request kita
        $existing = DB::table('friends')->where('user_id', $id)->where('friend_id', $userId)->first();

        // kalau dia dah request kita
        if ($existing) {
            DB::table('friends')
                ->where('id', $existing->id)
                ->update([
                    'status' => 'accepted',
                    'updated_at' => now(),
                ]);

            // check reverse friendship dulu
            $reverse = DB::table('friends')->where('user_id', $userId)->where('friend_id', $id)->first();

            if (!$reverse) {
                DB::table('friends')->insert([
                    'user_id' => $userId,
                    'friend_id' => $id,
                    'status' => 'accepted',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // mark notification as read
            DB::table('notifications')
                ->where('user_id', $userId)
                ->where('from_user_id', $id)
                ->where('type', 'friend_request')
                ->update([
                    'is_read' => true,
                ]);

            return back()->with('success', 'You are now friends 🌸');
        }

        // check kalau dah pernah request
        $alreadySent = DB::table('friends')->where('user_id', $userId)->where('friend_id', $id)->first();

        if ($alreadySent) {
            return back()->with('success', 'Request already sent 🌸');
        }

        // insert friend request
        DB::table('friends')->insert([
            'user_id' => $userId,
            'friend_id' => $id,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // insert notification
        DB::table('notifications')->insert([
            'user_id' => $id,
            'from_user_id' => $userId,
            'type' => 'friend_request',
            'action_type' => 'friend',
            'action_id' => $userId,
            'message' => 'sent you a friend request',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Friend request sent 🌸');
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);

        $genres = DB::table('orders')->join('books', 'orders.book_id', '=', 'books.id')->where('orders.user_id', $user->id)->select('books.genre')->distinct()->get();

        $books = DB::table('orders')->join('books', 'orders.book_id', '=', 'books.id')->where('orders.user_id', $user->id)->select('books.*')->distinct()->get();

        $isFriend = DB::table('friends')->where('user_id', Auth::id())->where('friend_id', $id)->where('status', 'accepted')->exists();

        return view('profile-user', compact('user', 'genres', 'books', 'isFriend'));
    }

    public function accept($id)
    {
        // update request asal
        DB::table('friends')
            ->where('user_id', $id)
            ->where('friend_id', Auth::id())
            ->update([
                'status' => 'accepted',
                'updated_at' => now(),
            ]);

        // check reverse friendship
        $reverse = DB::table('friends')->where('user_id', Auth::id())->where('friend_id', $id)->first();

        // kalau belum ada reverse row
        if (!$reverse) {
            DB::table('friends')->insert([
                'user_id' => Auth::id(),
                'friend_id' => $id,
                'status' => 'accepted',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('friends')
                ->where('id', $reverse->id)
                ->update([
                    'status' => 'accepted',
                    'updated_at' => now(),
                ]);
        }

        // delete notification terus
        DB::table('notifications')->where('user_id', Auth::id())->where('from_user_id', $id)->where('type', 'friend_request')->delete();

        return back()->with('success', 'Friend accepted 🌸');
    }

    public function reject($id)
    {
        DB::table('friends')->where('user_id', $id)->where('friend_id', Auth::id())->delete();

        // delete notification
        DB::table('notifications')->where('user_id', Auth::id())->where('from_user_id', $id)->where('type', 'friend_request')->delete();

        return back()->with('success', 'Friend request rejected 😓');
    }

    public function cancelFriend($id)
    {
        // delete friend request
        DB::table('friends')->where('user_id', Auth::id())->where('friend_id', $id)->where('status', 'pending')->delete();

        // delete notification
        DB::table('notifications')->where('user_id', $id)->where('from_user_id', Auth::id())->where('type', 'friend_request')->delete();

        return back()->with('success', 'Friend request cancelled 😓');
    }

    public function unfriend($id)
    {
        // delete both friendship rows
        DB::table('friends')
            ->where(function ($query) use ($id) {
                $query->where('user_id', Auth::id())->where('friend_id', $id);
            })
            ->orWhere(function ($query) use ($id) {
                $query->where('user_id', $id)->where('friend_id', Auth::id());
            })
            ->delete();

        return back()->with('success', 'Unfriended successfully 😓');
    }
}
