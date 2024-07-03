<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LockScreenController extends Controller
{
    public function showLockScreen()
    {
        return view('lock-screen');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            session(['locked' => false]);
            return redirect()->route('profile')->with('success', 'Session unlocked.');
        } else {
            return redirect()->route('lock-screen')->withErrors(['password' => 'Incorrect password.']);
        }
    }
}
