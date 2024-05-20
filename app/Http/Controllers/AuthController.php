<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Mail\VerificationMail;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function signIn(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('id_number', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('profile'))
                ->with('success', 'Logged in successfully');
        } else {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }

    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'id_number' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
    ], [
        'email.required' => 'The email field is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already in use.',
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 6 characters.',
        'password.confirmed' => 'The passwords do not match.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $verificationToken = $this->generateUniqueVerificationToken();

    try {
        $user = new User();
        $user->name = $request->input('name');
        $user->id_number = $request->input('id_number');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->verification_token = $verificationToken;
        $user->token_expiration_time = now()->addHours(2);
        $user->is_verified = false;
        $user->save();
    } catch (Exception $e) {
        return redirect()->route('register')->with('error', 'Account creation failed');
    }

    $tokenLink = route('verify', ['token' => $verificationToken]);

    try {
        Mail::to($user->email)->send(new VerificationMail($tokenLink));
        return redirect()->route('login')->with('success', 'Account created successfully. Please check your email for verification instructions.');
    } catch (Exception $e) {
        return redirect()->route('register')->with('error', 'Failed to send verification email');
    }
}


    private function generateUniqueVerificationToken()
    {
        $token = Str::random(40);

        while (User::where('verification_token', $token)->exists()) {
            $token = Str::random(40);
        }

        return $token;
    }

    public function signinpage()
    {
        return view('signin');
    }

    public function signup()
    {
        return view('signup');
    }
}
