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
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use App\Mail\ResetConfirmationMail;

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
            return redirect()->intended(route(''))
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




    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['id_number' => 'required']);

        $user = User::where('id_number', $request->id_number)->first();

        if (!$user) {
            return back()->with('error', 'ID number not found.');
        }

        $token = Str::random(60);
        $user->reset_token = $token;
        $user->token_expiration = now()->addMinutes(60);
        $user->save();

        $resetLink = route('reset.password.form', ['token' => $token]);

        Mail::to($user->email)->send(new ResetPasswordMail($resetLink));

        return back()->with('status', 'Reset link sent to your email.');
    }

    public function showResetPasswordForm($token)
    {
        return view('reset-passwordForm', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('reset_token', $request->token)
                    ->where('token_expiration', '>=', now())
                    ->first();

        if (!$user) {
            return back()->with('error', 'Invalid or expired token.');
        }

        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->token_expiration = null;
        $user->save();

        Mail::to($user->email)->send(new ResetConfirmationMail());

        return redirect()->route('login')->with('status', 'Password has been reset.');
    }

}