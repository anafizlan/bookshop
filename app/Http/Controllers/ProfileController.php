<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();
        

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

   public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    $user->fill($request->validated());

    // upload profile picture
    if ($request->hasFile('pfp')) {
        $path = $request->file('pfp')->store('pfp', 'public');
        $user->profile_picture = $path;
    }

    // bio
    $user->bio = $request->bio;

    $user->save();

    return redirect('/home')
        ->with('success', 'Profile updated successfully 🌸');
}
}