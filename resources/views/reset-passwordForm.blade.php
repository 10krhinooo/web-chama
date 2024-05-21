<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
    <title>Forgot Password</title>
</head>

<body>
    <div class="alert-container">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <span class="close">&times;</span>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <span class="close">&times;</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <span class="close">&times;</span>
        </div>
        @endif
    </div>

    <div class="wrapper">
        <div class="form-box.login">
            <h2>Reset password</h2>
            <form action="{{route ('password.reset')}}" method="POST" name="loginForm">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>

                    <input type="password" name="password" required minlength="8" />
                    <label>Password</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>

                    <input type="password" name="password_confirmation" required />
                    <label>Confirm Password</label>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>
                <button type="submit" class="btn">Reset Password</button>
            </form>
        </div>
    </div>
</body>
<script>
    // Function to close alert
    function closeAlert(element) {
    element.parentElement.style.display = 'none';
    }

    // Attach click event to close buttons
    document.querySelectorAll('.alert .close').forEach(function(element) {
    element.onclick = function() {
    closeAlert(this);
    };
    });

    // Auto close alerts after 5 seconds
    setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(element) {
    element.style.display = 'none';
    });
    }, 5000);
    </script>
</html>
