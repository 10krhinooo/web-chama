<!-- resources/views/lock-screen.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Lock Screen</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lock-screen.css') }}">

</head>
<body>
    <div class="lock-screen-container">
        <h2>Session Locked</h2>
        <form action="{{ route('unlock') }}" method="POST">
            @csrf
            <label for="password">Enter Password to Unlock:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Unlock</button>
        </form>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>


