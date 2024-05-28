<!DOCTYPE html>

<html lang="en">
@include('alert.success-msg')
{{-- @include('layouts.navBar') --}}

@include('alert.error-msg')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
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
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif


        <div class="form-box .registration">
            <h2>Registration</h2>
           <form action="{{route ('register')}}" method="post" name="registrationForm">
            @csrf
            <div class="input-box">
                    <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
                    <input type="text" name="name" required onblur="generateUsername(registrationForm)" />
                    <label>Your Name</label>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

               <div class="input-box">
                <span class="icon">
                    <ion-icon name="person-circle"></ion-icon>
                </span>
                <input type="text" name="id_number" id="id_number" required />
                <label for="id_number">ID Number</label>
            </div>


                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email"name="email" required />
                    <label>Email</label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>

                    <input type="password" name="password" required minlength="8" />
                    <label>Password</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <ul class="password-requirements mt-2">
                            <li id="length">Minimum 8 characters</li>
                            <li id="special">At least one special character</li>
                            <li id="uppercase">At least one uppercase letter</li>
                        </ul>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>

                    <input type="password" name="password_confirmation" required />
                    <label>Confirm Password</label>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>

                {{-- <div class="remember-forgot">
                    <label><input type="checkbox" /> I agree to terms and conditions</label>
                </div> --}}
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>
                        Already have an account? <a href="{{route('login')}}" class="login-link">Login</a>

                    </p>
                </div>



            </form>
        </div>
</div>


        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="{{ asset('js/mian.js') }}"></script>
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
            document.getElementById('password').addEventListener('input', function () {
            const password = this.value;
            const lengthRequirement = document.getElementById('length');
            const specialRequirement = document.getElementById('special');
            const uppercaseRequirement = document.getElementById('uppercase');

            // Check password length
            if (password.length >= 8) {
            lengthRequirement.classList.add('valid');
            } else {
            lengthRequirement.classList.remove('valid');
            }

            // Check for special character
            const specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/;
                if (specialCharPattern.test(password)) {
                specialRequirement.classList.add('valid');
                } else {
                specialRequirement.classList.remove('valid');
                }
                });
                const uppercasePattern = /[A-Z]/;
                if (uppercasePattern.test(password)) {
                uppercaseRequirement.classList.add('valid');
                } else {
                uppercaseRequirement.classList.remove('valid');
                }

            </script>
</body>

</html>
{{--
<form method="post" name="form" action="">
<div><label for="fname">First Name: </label><input type="text" name="fname" id="fname" /></div>
<div><label for="lname">Last Name: </label><input type="text" name="lname" id="lname" onblur="
if(document.form.username.value=='' && document.form.fname.value!='' && document.form.lname.value!='') {
     var username = document.form.fname.value.substr(0,1) +      document.form.lname.value.substr(0,49);
     username = username.replace(/\s+/g, '');
     username = username.replace(/\'+/g, '');
     username = username.replace(/-+/g, '');
     username = username.toLowerCase();
     document.form.username.value = username;
}" /></div>
<div><label for="username">Username: </label><input type="text" name="username" id="username" /></div>
</form> --}}
<script >
function generateUsername(formName) {
        var form = document.forms[formName];
        var firstName = form.firstName.value;
        var lastName = form.lastName.value;

        if (firstName !== '' && lastName !== '') {
          var username = firstName.substr(0, 1) + lastName;
          username = username.replace(/\s+/g, ''); // Remove spaces
          username = username.replace(/'+/g, ''); // Remove single quotes
          username = username.replace(/-+/g, ''); // Remove hyphens
          username = username.toLowerCase(); // Convert to lowercase
          form.username.value = username;
    </script>
@error('name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

@error('email')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
