<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller


{
    public function store(Request $request)
    {
      $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),   
        ]);
        // return response
        
        return redirect('/')->with('success', 'Registered');
    }
    public function index()
{
    $users = User::all(); // ambil semua data dari database

    return view('users', compact('users'));
}

public function delete($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete(); // ONLY 1 ROW

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

    return redirect('/users');
}
public function edit($id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect('/users')->with('error', 'User not found');
    }

    return view('edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return redirect('/users')->with('error', 'User not found');
    }

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect('/users')->with('success', 'User updated');
}


public function destroy($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
    }

    return redirect('/users');
}


public function recommend(Request $request)
{
    dd("MASUK SINI");
}
}