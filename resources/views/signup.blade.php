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
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>

<body>

<div class="wrapper">

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
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>

                    <input type="password" name="password_confirmation" required />
                    <label>Confirm Password</label>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox" /> I agree to terms and conditions</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>
                        Already have an account?<a href="{{route('login')}}" class="login-link">Login</a>

                    </p>
                </div>



            </form>
        </div>
</div>


        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="{{ asset('js/signup.js') }}"></script>
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
