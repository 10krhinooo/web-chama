<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
use Carbon\Carbon;

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
        'password' =>
           'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'regex:/[!@#$%^&*(),.?":{}|<>]/' ,
                'regex:/[A-Z]/'

            // 'password_confirmation' => 'required|same:password',
        ], [
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one special character.',
            'password_confirmation.same' => 'The password confirmation does not match.',
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
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email not found.');
        }

        // Generate a new reset token and set its expiration time
        $token = Str::random(60);
        $expiresAt = now()->addMinutes(60);

        // Store the token in the password_resets table
        $result = DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => now(), 'expires_at' => $expiresAt]
        );

        // \Log::info('Password reset token stored', ['email' => $user->email, 'token' => $token, 'result' => $result]);

        // Generate the password reset link
        $resetLink = route('reset.password.form', ['token' => $token]);

        // Send the reset link to the user's email
        Mail::to($user->email)->send(new ResetPasswordMail($resetLink));

        return back()->with('success', 'Reset link sent to your email.');
    }

    public function showResetPasswordForm($token)
    {
        return view('reset-passwordForm', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
       $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length of 8 characters
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // At least one special character
                'regex:/[A-Z]/'
            ],
            'password_confirmation' => 'required|same:password',
        ], [
            'password.min' => 'The password must be at least 8 characters.',
            'password.regex' => 'The password must include at least one special character.',
            'password_confirmation.same' => 'The password confirmation does not match.',
        ]);
        // \Log::info('Reset request received', $request->all());

        // Find the password reset token
        $passwordReset = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$passwordReset) {
            // \Log::warning('Invalid token', ['token' => $request->token]);
            return back()->with('error', 'Invalid token.');
        }

        if ($passwordReset->expires_at < now()) {
            // \Log::warning('Token expired', ['token' => $request->token]);
            return back()->with('error', 'Expired token.');
        }

        // Find the user by email
        $user = User::where('email', $passwordReset->email)->first();

        if (!$user) {
            // \Log::warning('User not found', ['email' => $passwordReset->email]);
            return back()->with('error', 'User not found.');
        }

        // Update the user's password and delete the reset token
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the reset token
        DB::table('password_resets')->where('email', $passwordReset->email)->delete();

        // \Log::info('Password reset successful for user', ['user_id' => $user->id]);

        // Send a reset confirmation email
        Mail::to($user->email)->send(new ResetConfirmationMail());

        return redirect()->route('login')->with('success', 'Password has been reset.');
    }

     public function testInsertToken()
    {
        $email = 'vkimanga@gmail.com.com'; // Replace with an actual email for testing
        $token = Str::random(60);
        $createdAt = now();
        $expiresAt = now()->addMinutes(60);

        // Insert the token into the password_resets table
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => $createdAt,
            'expires_at' => $expiresAt,
        ]);

        // Check if the token was successfully inserted
        $passwordReset = DB::table('password_resets')->where('email', $email)->first();

        if ($passwordReset) {
            return "Token inserted successfully: " . $passwordReset->token;
        } else {
            return "Failed to insert token.";
        }
    }
}

