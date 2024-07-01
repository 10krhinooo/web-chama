<?php
// app/Http/Kernel.php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Other code...
    

    protected $routeMiddleware = [
        // Other middleware...
        'locked' => \App\Http\Middleware\CheckIfLocked::class,
        'auth.redirect' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];


    // Other code...
}

