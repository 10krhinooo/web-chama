<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VerificationController extends Controller
{
    public function verify($token)
    {
        // Find the user by the verification token
        $user = User::where('verification_token', $token)
            ->where('token_expiration_time', '>=', now())
            ->first();

        if (!$user) {
            return redirect()->route('register');
        }

        // Update the user's verification status
        $user->is_verified = true;
        $user->verification_token = null;
        $user->save();




        return redirect()->route('login')->with('success', 'Email Verified');
    }
}
