<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webchama</title>
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/logout-confirm.css') }}">
    <!-- Include any additional CSS or meta tags here -->

    
</head>
 <body>
  
    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content goes here -->
    
    </footer>
    <script>
        let timeout;

        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                window.location.href = '{{ route("lock-screen") }}';
            }, 1800000); // 30 minutes
        }

        window.onload = resetTimeout;
        window.onmousemove = resetTimeout;
        window.onkeypress = resetTimeout;
    </script>




    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include any additional JavaScript files or scripts here -->
</body>
</html>

<!-- resources/views/layouts/app.blade.php -->

