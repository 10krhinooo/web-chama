<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController2 extends Controller
{
    public function profile()
    {
        return view('profile.profileLayout');

    }
}
