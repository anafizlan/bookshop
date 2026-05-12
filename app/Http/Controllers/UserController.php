<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'password' => $request->password,   
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
    }

    return redirect('/users');
}
public function edit($id)
{
    $user = User::find($id);
    return view('edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::find($id);

    $user->name = $request->name;
    $user->email = $request->email;

    // kalau password diisi baru update
    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect('/users');
}

public function recommend(Request $request)
{
    dd("MASUK SINI");
}
}