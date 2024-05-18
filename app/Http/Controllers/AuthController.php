<?php
namespace App\Http\Controllers;

use Auth;
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
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('homePage'))
                ->with('success', 'logged in successully');
        } else {
            return redirect()->intended(route('login'))->with('error', 'invalid credentials');
        }

    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'userEmail' => 'required|email',
            'password' => 'required|min:6|confirmed',


        ], [

            'userEmail.required' => 'The email field is required.',
            'userEmail.email' => 'Please enter a valid email address.',
            'userEmail.unique' => 'This email is already in use.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The passwords do not match.',
        ]);



        if ($validator->fails()) {
            // return response()->json(['error' => $validator->errors()->first()]);
            return with('error', 'failed to add user');
        }
        $verificationToken = $this->generateUniqueVerificationToken();
        try {
            $user = new User();
            $user->Name = $request->input('name');
            $user->userName = $request->input('username');
            $user->email = $request->input('userEmail');
            $user->password = bcrypt($request->input('password'));
            $user->verification_token = $verificationToken;
            $user->token_expiration_time = now()->addHours(2);
            $user->is_verified = false;


            $user->save();
        } catch (Exception $e) {
            return redirect()->intended(route('login'))->with('error', 'Account already exists');

        }



        $tokenLink = route('verify', ['token' => $verificationToken]);

        try {
            Mail::to($user->email)
                ->send(new VerificationMail($tokenLink));

            // Redirect to a success page or provide feedback to the user
            return redirect()->intended(route('login'))->with('success', 'Account created successfully, check your email');


        } catch (\Exception $e) {
            // Handle email sending failure
            return redirect()->intended(route('register'))->with('error', 'failure to create account');
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

