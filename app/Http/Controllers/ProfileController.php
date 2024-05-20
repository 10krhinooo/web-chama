<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->update($request->only('name', 'id_number', 'email'));

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::delete('public/' . $user->profile_photo_path);
            }
            $photoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $photoPath;
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_photo_path) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        Auth::logout();
        $user->delete();

        return redirect()->route('login')->with('success', 'Your account has been deleted.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
