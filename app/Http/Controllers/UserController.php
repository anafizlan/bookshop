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

        $roleId = 2;

        if (str_contains($request->email, 'admin01')) {
            $roleId = 1;
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $roleId,
        ]);
        // return response

        return redirect('/')->with('success', 'Registered');
    }
    public function index()
    {
        $auth = auth()->user();

        $users = User::with('role')
            ->get()
            ->sortBy(function ($user) use ($auth) {
                // 1. admin paling atas
                if ($user->role->name == 'admin') {
                    return 1;
                }

                // 2. friend second
                if ($auth->friends->contains($user->id)) {
                    return 2;
                }

                // 3. normal user
                if ($user->role->name == 'user') {
                    return 3;
                }

                // 4. guest last
                if ($user->role->name == 'guest') {
                    return 4;
                }

                return 5;
            });

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        // ONLY ADMIN
        if (Auth::user()->role_id != 1) {
            abort(403);
        }

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // ONLY ADMIN
        if (Auth::user()->role_id != 1) {
            abort(403);
        }

        $user = User::findOrFail($id);

        // PREVENT ADMIN EDIT OWN ROLE
        if (Auth::id() == $user->id) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
            ]);
        }

        return redirect('/users')->with('success', 'User updated 🌸');
    }

    public function destroy($id)
    {
        // ONLY ADMIN
        if (Auth::user()->role_id != 1) {
            abort(403);
        }

        $user = User::findOrFail($id);

        // PREVENT DELETE OWN ACCOUNT
        if (Auth::id() == $user->id) {
            return back()->with('success', 'You cannot delete your own admin account 😭');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully 🌸');
    }

    public function recommend(Request $request)
    {
        dd('MASUK SINI');
    }
}
