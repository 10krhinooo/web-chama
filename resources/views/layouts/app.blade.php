<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webchama</title>
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <!-- Include any additional CSS or meta tags here -->
</head>
<body>
    <header>
        <nav>
            <ul>
                {{-- <li><a href="{{ route('home') }}">Home</a></li> --}}
                <li><a href="{{ route('profile') }}">Profile</a></li>
                <!-- Add more navigation links as needed -->
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content goes here -->
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include any additional JavaScript files or scripts here -->
</body>
</html>
